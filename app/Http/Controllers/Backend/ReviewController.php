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
        if ($request->ajax() || $request->wantsJson()) {
            $page = max(1, $request->get('page', 1));
            $search = trim($request->get('search', ''));
            $perPage = 10;

            $query = Review::query();

            // Search across name, email, and comment
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('comment', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
                });
            }

            $total = $query->count();
            $reviews = $query->orderByDesc('created_at')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $rows = $reviews->map(function ($row, $index) use ($page, $perPage) {
                $image = $row->image 
                    ? '<img src="' . asset('storage/' . $row->image) . '" alt="' . htmlspecialchars($row->name) . '" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">'
                    : '<img src="https://i.pravatar.cc/32?u=' . urlencode($row->email ?? $row->name) . '" alt="' . htmlspecialchars($row->name) . '" style="width: 32px; height: 32px; border-radius: 50%;">';
                
                $nameWithImage = '<div style="display: flex; align-items: center; gap: 0.5rem;"><div>' . $image . '</div><div>' . htmlspecialchars($row->name) . '</div></div>';
                
                $emailDisplay = $row->email ? '<a href="mailto:' . htmlspecialchars($row->email) . '">' . htmlspecialchars($row->email) . '</a>' : '<span class="text-muted">-</span>';
                
                $ratingDisplay = '<div style="color: #f39c12; font-size: 1.1rem;">' . str_repeat('★', (int)$row->rating) . str_repeat('☆', 5 - (int)$row->rating) . '</div>';
                
                $class = 'bg-warning';
                if ($row->status === 'approved') $class = 'bg-success';
                if ($row->status === 'rejected') $class = 'bg-danger';
                $statusBadge = '<span class="badge ' . $class . '">' . ucfirst($row->status) . '</span>';
                
                $commentPreview = htmlspecialchars(substr($row->comment ?? '', 0, 50)) . (strlen($row->comment ?? '') > 50 ? '...' : '');
                
                $createdDate = $row->created_at ? $row->created_at->format('M d, Y H:i') : '-';
                
                $buttons = '<div class="btn-group btn-group-sm" role="group">';
                $buttons .= '<button type="button" class="btn btn-outline-primary btn-view" 
                    data-id="' . $row->id . '" 
                    data-image="' . ($row->image ? asset('storage/' . $row->image) : '') . '" 
                    data-name="' . htmlspecialchars($row->name) . '" 
                    data-email="' . htmlspecialchars($row->email ?? '-') . '" 
                    data-rating="' . (int)$row->rating . '" 
                    data-title="' . htmlspecialchars($row->title ?? '') . '" 
                    data-comment="' . htmlspecialchars($row->comment) . '" 
                    data-status="' . htmlspecialchars($row->status) . '" 
                    data-created="' . htmlspecialchars($createdDate) . '" 
                    data-approved="' . htmlspecialchars($row->approved_at ? $row->approved_at->format('M d, Y H:i') : '') . '" 
                    title="View"><i class="ri-eye-line"></i></button>';
                
                if ($row->status !== 'approved') {
                    $buttons .= '<button type="button" class="btn btn-outline-success btn-approve" data-id="' . $row->id . '" title="Approve"><i class="ri-check-line"></i></button>';
                }
                
                if ($row->status !== 'rejected') {
                    $buttons .= '<button type="button" class="btn btn-outline-danger btn-reject" data-id="' . $row->id . '" title="Reject"><i class="ri-close-line"></i></button>';
                }
                
                $buttons .= '<button type="button" class="btn btn-outline-danger btn-delete" data-id="' . $row->id . '" title="Delete"><i class="ri-delete-bin-line"></i></button>';
                $buttons .= '</div>';
                
                return [
                    'DT_RowIndex' => (($page - 1) * $perPage) + $index + 1,
                    'name_with_image' => $nameWithImage,
                    'email_display' => $emailDisplay,
                    'rating_display' => $ratingDisplay,
                    'title' => htmlspecialchars($row->title ?? '-'),
                    'comment_preview' => $commentPreview,
                    'status_badge' => $statusBadge,
                    'created_at' => $createdDate,
                    'action' => $buttons,
                ];
            })->values();

            $totalPages = ceil($total / $perPage);

            return response()->json([
                'success' => true,
                'data' => $rows->toArray(),
                'pagination' => [
                    'total' => $total,
                    'per_page' => $perPage,
                    'current_page' => (int)$page,
                    'total_pages' => $totalPages,
                    'from' => $total === 0 ? 0 : (($page - 1) * $perPage) + 1,
                    'to' => min($page * $perPage, $total),
                ],
            ]);
        }

        // Non-AJAX request - return view
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
