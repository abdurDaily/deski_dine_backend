<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // CRITICAL: .with('variations') is required to show the prices
            $data = Menu::with(['category', 'variations'])->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', fn($row) => $row->category->name ?? 'N/A')
                ->addColumn('variations', function ($row) {
                    $html = '';
                    foreach ($row->variations as $v) {
                        $html .= '<span class="badge bg-light text-dark border me-1">' . $v->name . ': ' . number_format($v->price, 0) . ' TK</span>';
                    }
                    return $html ?: '<span class="text-muted">No variations</span>';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_available
                        ? '<span class="badge bg-success">Available</span>'
                        : '<span class="badge bg-danger">Out of Stock</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-soft-info edit-btn" data-id="' . $row->id . '"><i class="ri-pencil-fill"></i></button>
                        <button class="btn btn-sm btn-soft-danger delete-btn" data-id="' . $row->id . '"><i class="ri-delete-bin-fill"></i></button>
                    </div>';
                })
                ->rawColumns(['action', 'variations', 'status'])
                ->make(true);
        }
        $categories = Category::all();
        return view('backend.menu.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'variations'  => 'required|array|min:1',
            'variations.*.name'  => 'required|string',
            'variations.*.price' => 'required|numeric',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                // Create Parent
                $menu = Menu::create([
                    'category_id'  => $request->category_id,
                    'name'         => $request->name,
                    'slug'         => Str::slug($request->name) . '-' . rand(1000, 9999),
                    'description'  => $request->description,
                    'is_available' => $request->is_available ?? 1,
                ]);

                // Create Children (Variations)
                foreach ($request->variations as $index => $vData) {
                    $imagePath = null;
                    if ($request->hasFile("variations.$index.image")) {
                        $file = $request->file("variations.$index.image");
                        $imageName = time() . '_' . $index . '.' . $file->extension();
                        $file->move(public_path('uploads/menus/variations'), $imageName);
                        $imagePath = 'uploads/menus/variations/' . $imageName;
                    }

                    $menu->variations()->create([
                        'name'  => $vData['name'],
                        'price' => $vData['price'],
                        'image' => $imagePath,
                    ]);
                }

                return response()->json(['status' => 'success', 'message' => 'Menu Item & Variations Saved!']);
            });
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    public function edit($id)
    {
        // Load variations so the edit form can see them
        $menu = Menu::with('variations')->findOrFail($id);
        return response()->json($menu);
    }


    // app/Http/Controllers/Backend/MenuController.php

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'variations'  => 'required|array|min:1',
        ]);

        try {
            DB::transaction(function () use ($request, $menu) {
                // Update Parent
                $menu->update([
                    'category_id' => $request->category_id,
                    'name'        => $request->name,
                    'description' => $request->description,
                    'is_available' => $request->is_available,
                    'slug'        => Str::slug($request->name) . '-' . $menu->id,
                ]);

                // Handle Variations
                // Only delete images if you are replacing them or if business logic requires it.
                // For simplicity in dynamic forms, we replace:
                foreach ($menu->variations as $oldVar) {
                    // Only delete if NOT provided in old_image or if a new file is uploaded
                    if ($oldVar->image && file_exists(public_path($oldVar->image))) {
                        // Check if this image is still being used by checking old_image inputs
                        $stillUsed = false;
                        foreach ($request->variations as $v) {
                            if (($v['old_image'] ?? '') == $oldVar->image && !$request->hasFile("variations." . $loop->index . ".image")) {
                                $stillUsed = true;
                            }
                        }
                        if (!$stillUsed) unlink(public_path($oldVar->image));
                    }
                }

                $menu->variations()->delete();

                foreach ($request->variations as $index => $vData) {
                    $imagePath = $vData['old_image'] ?? null;

                    if ($request->hasFile("variations.$index.image")) {
                        $file = $request->file("variations.$index.image");
                        $imageName = time() . '_' . $index . '.' . $file->extension();
                        $file->move(public_path('uploads/menus/variations'), $imageName);
                        $imagePath = 'uploads/menus/variations/' . $imageName;
                    }

                    $menu->variations()->create([
                        'name'  => $vData['name'],
                        'price' => $vData['price'],
                        'image' => $imagePath,
                    ]);
                }
            });
            return response()->json(['status' => 'success', 'message' => 'Updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        foreach ($menu->variations as $v) {
            if ($v->image && file_exists(public_path($v->image))) {
                unlink(public_path($v->image));
            }
        }
        $menu->delete();
        return response()->json(['status' => 'success', 'message' => 'Deleted successfully!']);
    }
}
