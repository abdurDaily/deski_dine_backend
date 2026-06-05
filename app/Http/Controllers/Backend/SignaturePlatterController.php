<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SignaturePlatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SignaturePlatterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = SignaturePlatter::latest()->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image_preview', function ($row) {
                        $url = $row->image
                            ? asset('uploads/platters/' . $row->image)
                            : 'https://via.placeholder.com/60x60?text=No+Img';
                        return '<img src="' . $url . '" width="60" height="60" class="rounded shadow-sm object-fit-cover" />';
                    })
                    ->addColumn('status', function ($row) {
                        return $row->status
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>';
                    })
                    ->addColumn('action', function ($row) {
                        return '
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-soft-info edit-btn" data-id="' . $row->id . '" title="Edit">
                                    <i class="ri-pencil-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-soft-danger delete-btn" data-id="' . $row->id . '" title="Delete">
                                    <i class="ri-delete-bin-fill"></i>
                                </button>
                            </div>';
                    })
                    ->rawColumns(['image_preview', 'status', 'action'])
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return view('backend.signature-platters.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:webp,png,jpg,jpeg|max:2048',
            'status'      => 'required|in:0,1',
            'sort_order'  => 'nullable|integer|min:0',
            'features'    => 'nullable|array',
            'features.*.icon'  => 'nullable|string|max:100',
            'features.*.label' => 'nullable|string|max:100',
            'features.*.text'  => 'nullable|string|max:500',
        ]);

        try {
            $data = $request->only(['title', 'subtitle', 'description', 'status', 'sort_order']);
            $data['sort_order'] = $data['sort_order'] ?? 0;

            // Handle features array – filter out empty rows
            if ($request->has('features')) {
                $features = array_values(array_filter($request->features, function ($f) {
                    return !empty($f['label']) || !empty($f['text']);
                }));
                $data['features'] = $features ?: null;
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/platters'), $imageName);
                $data['image'] = $imageName;
            }

            SignaturePlatter::create($data);

            return response()->json(['status' => 'success', 'message' => 'Signature Platter created successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(SignaturePlatter $signaturePlatter)
    {
        return response()->json($signaturePlatter);
    }

    public function update(Request $request, SignaturePlatter $signaturePlatter)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:webp,png,jpg,jpeg|max:2048',
            'status'      => 'required|in:0,1',
            'sort_order'  => 'nullable|integer|min:0',
            'features'    => 'nullable|array',
            'features.*.icon'  => 'nullable|string|max:100',
            'features.*.label' => 'nullable|string|max:100',
            'features.*.text'  => 'nullable|string|max:500',
        ]);

        try {
            $data = $request->only(['title', 'subtitle', 'description', 'status', 'sort_order']);
            $data['sort_order'] = $data['sort_order'] ?? 0;

            // Handle features
            if ($request->has('features')) {
                $features = array_values(array_filter($request->features, function ($f) {
                    return !empty($f['label']) || !empty($f['text']);
                }));
                $data['features'] = $features ?: null;
            } else {
                $data['features'] = null;
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($signaturePlatter->image && file_exists(public_path('uploads/platters/' . $signaturePlatter->image))) {
                    unlink(public_path('uploads/platters/' . $signaturePlatter->image));
                }
                $file      = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/platters'), $imageName);
                $data['image'] = $imageName;
            }

            $signaturePlatter->update($data);

            return response()->json(['status' => 'success', 'message' => 'Signature Platter updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(SignaturePlatter $signaturePlatter)
    {
        if ($signaturePlatter->image && file_exists(public_path('uploads/platters/' . $signaturePlatter->image))) {
            unlink(public_path('uploads/platters/' . $signaturePlatter->image));
        }
        $signaturePlatter->delete();

        return response()->json(['status' => 'success', 'message' => 'Signature Platter deleted!']);
    }
}
