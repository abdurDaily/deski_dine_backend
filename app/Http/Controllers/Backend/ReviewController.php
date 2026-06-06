<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Review::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('member_image', function($row) {
                    if ($row->image) {
                        return '<img src="' . asset('storage/' . $row->image) . '" alt="' . htmlspecialchars($row->name) . '" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">';
                    } else {
                        $gravatarId = $row->email ? urlencode($row->email) : urlencode($row->name);
                        return '<img src="https://i.pravatar.cc/32?u=' . $gravatarId . '" alt="' . htmlspecialchars($row->name) . '" style="width: 32px; height: 32px; border-radius: 50%;">';
                    }
                })
                ->addColumn('name_with_image', function($row) {
                    $image = $row->image 
                        ? '<img src="' . asset('storage/' . $row->image) . '" alt="' . htmlspecialchars($row->name) . '" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">'
                        : '<img src="https://i.pravatar.cc/32?u=' . urlencode($row->email ?? $row->name) . '" alt="' . htmlspecialchars($row->name) . '" style="width: 32px; height: 32px; border-radius: 50%;">';
                    return '<div style="display: flex; align-items: center; gap: 0.5rem;"><div>' . $image . '</div><div>' . htmlspecialchars($row->name) . '</div></div>';
                })
                ->addColumn('email_display', function($row) {
                    return $row->email ? '<a href="mailto:' . htmlspecialchars($row->email) . '">' . htmlspecialchars($row->email) . '</a>' : '<span class="text-muted">-</span>';
                })
                ->addColumn('rating_display', function($row) {
                    return '<div style="color: #f39c12; font-size: 1.1rem;">' . str_repeat('★', $row->rating) . str_repeat('☆', 5 - $row->rating) . '</div>';
                })
                ->addColumn('status_badge', function($row) {
                    $class = 'bg-warning';
                    if ($row->status === 'approved') $class = 'bg-success';
                    if ($row->status === 'rejected') $class = 'bg-danger';
                    return '<span class="badge ' . $class . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('comment_preview', function($row) {
                    return htmlspecialchars(substr($row->comment, 0, 50)) . (strlen($row->comment) > 50 ? '...' : '');
                })
                ->addColumn('action', function($row) {
                    $buttons = '<div class="btn-group btn-group-sm" role="group">';
                    
                    $buttons .= '<button type="button" class="btn btn-outline-primary btn-view" 
                        data-id="' . $row->id . '" 
                        data-image="' . ($row->image ? asset('storage/' . $row->image) : '') . '" 
                        data-name="' . htmlspecialchars($row->name) . '" 
                        data-email="' . ($row->email ?? '-') . '" 
                        data-rating="' . $row->rating . '" 
                        data-title="' . htmlspecialchars($row->title ?? '') . '" 
                        data-comment="' . htmlspecialchars($row->comment) . '" 
                        data-status="' . $row->status . '" 
                        data-created="' . $row->created_at->format('M d, Y H:i') . '" 
                        data-approved="' . ($row->approved_at ? $row->approved_at->format('M d, Y H:i') : '') . '" 
                        title="View"><i class="ri-eye-line"></i></button>';
                    
                    if ($row->status !== 'approved') {
                        $buttons .= '<button type="button" class="btn btn-outline-success btn-approve" data-id="' . $row->id . '" title="Approve"><i class="ri-check-line"></i></button>';
                    }
                    
                    if ($row->status !== 'rejected') {
                        $buttons .= '<button type="button" class="btn btn-outline-danger btn-reject" data-id="' . $row->id . '" title="Reject"><i class="ri-close-line"></i></button>';
                    }
                    
                    $buttons .= '<button type="button" class="btn btn-outline-danger btn-delete" data-id="' . $row->id . '" title="Delete"><i class="ri-delete-bin-line"></i></button>';
                    
                    $buttons .= '</div>';
                    
                    return $buttons;
                })
                ->rawColumns(['name_with_image', 'email_display', 'rating_display', 'status_badge', 'action', 'member_image'])
                ->make(true);
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
