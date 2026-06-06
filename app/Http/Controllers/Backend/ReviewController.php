<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $draw = intval($request->input('draw', 0));
            $start = intval($request->input('start', 0));
            $length = intval($request->input('length', 10));
            $searchValue = $request->input('search.value', '');

            // Build query
            $query = Review::query();

            // Apply search
            if (!empty($searchValue)) {
                $query->where(function($q) use ($searchValue) {
                    $q->where('name', 'like', "%{$searchValue}%")
                      ->orWhere('email', 'like', "%{$searchValue}%")
                      ->orWhere('comment', 'like', "%{$searchValue}%");
                });
            }

            // Get counts
            $totalRecords = Review::count();
            $filteredRecords = $query->count();

            // Get paginated data
            $reviews = $query->orderBy('created_at', 'desc')
                ->skip($start)
                ->take($length)
                ->get();

            // Build response data
            $data = [];
            foreach ($reviews as $review) {
                // Build action buttons
                $viewBtn = '<button class="btn btn-sm btn-outline-primary btn-view" data-id="' . $review->id . '" data-image="' . ($review->image ? asset('storage/' . $review->image) : '') . '" data-name="' . htmlspecialchars($review->name) . '" data-email="' . ($review->email ?? '-') . '" data-rating="' . $review->rating . '" data-title="' . htmlspecialchars($review->title ?? '') . '" data-comment="' . htmlspecialchars($review->comment) . '" data-status="' . $review->status . '" data-created="' . $review->created_at->format('M d, Y H:i') . '" data-approved="' . ($review->approved_at ? $review->approved_at->format('M d, Y H:i') : '') . '" title="View"><i class="ri-eye-line"></i></button>';

                $approveBtn = ($review->status !== 'approved') 
                    ? '<button class="btn btn-sm btn-outline-success btn-approve" data-id="' . $review->id . '" title="Approve"><i class="ri-check-line"></i></button>' 
                    : '';

                $rejectBtn = ($review->status !== 'rejected') 
                    ? '<button class="btn btn-sm btn-outline-danger btn-reject" data-id="' . $review->id . '" title="Reject"><i class="ri-close-line"></i></button>' 
                    : '';

                $deleteBtn = '<button class="btn btn-sm btn-outline-danger btn-delete" data-id="' . $review->id . '" title="Delete"><i class="ri-delete-bin-line"></i></button>';

                $actions = '<div class="btn-group btn-group-sm">' . $viewBtn . $approveBtn . $rejectBtn . $deleteBtn . '</div>';

                // Build image HTML
                $imageHtml = '';
                if ($review->image) {
                    $imageHtml = '<img src="' . asset('storage/' . $review->image) . '" alt="' . htmlspecialchars($review->name) . '" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">';
                } else {
                    $gravatarId = $review->email ? urlencode($review->email) : urlencode($review->name);
                    $imageHtml = '<img src="https://i.pravatar.cc/32?u=' . $gravatarId . '" alt="' . htmlspecialchars($review->name) . '" style="width: 32px; height: 32px; border-radius: 50%;">';
                }

                // Build name with image
                $nameHtml = '<div style="display: flex; align-items: center; gap: 0.5rem;"><div>' . $imageHtml . '</div><div>' . htmlspecialchars($review->name) . '</div></div>';

                // Build email HTML
                $emailHtml = $review->email 
                    ? '<a href="mailto:' . htmlspecialchars($review->email) . '">' . htmlspecialchars($review->email) . '</a>'
                    : '<span class="text-muted">-</span>';

                // Build rating HTML
                $ratingHtml = '<div style="color: #f39c12; font-size: 1.1rem;">' . str_repeat('★', $review->rating) . str_repeat('☆', 5 - $review->rating) . '</div>';

                // Build status badge
                $statusClass = 'bg-warning';
                if ($review->status === 'approved') $statusClass = 'bg-success';
                if ($review->status === 'rejected') $statusClass = 'bg-danger';
                $statusHtml = '<span class="badge ' . $statusClass . '">' . ucfirst($review->status) . '</span>';

                $data[] = [
                    'id' => $review->id,
                    'name' => $nameHtml,
                    'email' => $emailHtml,
                    'rating' => $ratingHtml,
                    'title' => htmlspecialchars($review->title ?? '-'),
                    'comment' => htmlspecialchars(substr($review->comment, 0, 50)) . (strlen($review->comment) > 50 ? '...' : ''),
                    'status' => $statusHtml,
                    'created_at' => $review->created_at->format('M d, Y'),
                    'action' => $actions,
                ];
            }

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data,
            ]);
        }

        // Non-AJAX request - show page with stats
        $pending = Review::where('status', 'pending')->count();
        $approved = Review::where('status', 'approved')->count();
        $rejected = Review::where('status', 'rejected')->count();

        $reviews = Review::orderByDesc('created_at')->paginate(20);

        return view('backend.reviews.index', compact('reviews', 'pending', 'approved', 'rejected'));
    }

    public function approve(Review $review)
    {
        $review->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review approved successfully!',
        ]);
    }

    public function reject(Review $review)
    {
        $review->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review rejected.',
        ]);
    }

    public function delete(Review $review)
    {
        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully!',
        ]);
    }
}
