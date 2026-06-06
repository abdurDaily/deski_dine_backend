<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{

    /**
     * Display the list and the form.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Branch::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="btn btn-sm btn-soft-info view-details-btn" data-id="' . $row->id . '" title="View Details">
                                <i class="ri-eye-fill"></i>
                            </button>
                            <button class="btn btn-sm btn-soft-info copy-link-btn" data-url="' . route('frontend.branches.show', $row->slug) . '" title="Copy Link">
                                <i class="ri-links-fill"></i>
                            </button>
                            <button class="btn btn-sm btn-soft-warning edit-btn" data-id="' . $row->id . '" title="Edit">
                                <i class="ri-pencil-fill"></i>
                            </button>
                            <button class="btn btn-sm btn-soft-danger delete-btn" data-id="' . $row->id . '" title="Delete">
                                <i class="ri-delete-bin-fill"></i>
                            </button>
                        </div>';
                })
                ->make(true);
        }
        return view('backend.branch.index');
    }

    /**
     * Store a newly created branch.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255|unique:branches,name',
            'phone'            => 'required|string|max:20',
            'location'         => 'required|string|max:500',
            'foodpanda_url'    => 'nullable|url',
            'pathao_url'       => 'nullable|url',
            'foodi_url'        => 'nullable|url',
            'foodpanda_logo'   => $request->filled('foodpanda_url') ? 'required|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pathao_logo'      => $request->filled('pathao_url') ? 'required|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foodi_logo'       => $request->filled('foodi_url') ? 'required|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'foodpanda_logo.required' => 'Logo is required when providing FoodPanda URL',
            'pathao_logo.required' => 'Logo is required when providing Pathao URL',
            'foodi_logo.required' => 'Logo is required when providing Foodi URL',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->name);
        
        // Handle logo uploads
        foreach (['foodpanda_logo', 'pathao_logo', 'foodi_logo'] as $logoField) {
            if ($request->hasFile($logoField)) {
                $file = $request->file($logoField);
                $filename = time() . '_' . $logoField . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/branches'), $filename);
                $data[$logoField] = $filename;
            }
        }
        
        $branch = Branch::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Branch "' . $branch->name . '" created successfully!'
        ]);
    }

    /**
     * Show the form for editing (via JSON).
     */
    public function edit(Branch $branch)
    {
        return response()->json($branch);
    }

    /**
     * Update the specified branch.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name'             => 'required|string|max:255|unique:branches,name,' . $branch->id,
            'phone'            => 'required|string|max:20',
            'location'         => 'required|string|max:500',
            'foodpanda_url'    => 'nullable|url',
            'pathao_url'       => 'nullable|url',
            'foodi_url'        => 'nullable|url',
            'foodpanda_logo'   => $request->filled('foodpanda_url') && !$branch->foodpanda_logo ? 'required|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pathao_logo'      => $request->filled('pathao_url') && !$branch->pathao_logo ? 'required|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foodi_logo'       => $request->filled('foodi_url') && !$branch->foodi_logo ? 'required|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'foodpanda_logo.required' => 'Logo is required when providing FoodPanda URL',
            'pathao_logo.required' => 'Logo is required when providing Pathao URL',
            'foodi_logo.required' => 'Logo is required when providing Foodi URL',
        ]);

        $data = $request->all();
        
        // Handle logo uploads
        foreach (['foodpanda_logo', 'pathao_logo', 'foodi_logo'] as $logoField) {
            if ($request->hasFile($logoField)) {
                // Delete old logo if exists
                if ($branch->$logoField && file_exists(public_path('uploads/branches/' . $branch->$logoField))) {
                    unlink(public_path('uploads/branches/' . $branch->$logoField));
                }
                
                $file = $request->file($logoField);
                $filename = time() . '_' . $logoField . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/branches'), $filename);
                $data[$logoField] = $filename;
            }
        }

        $branch->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Branch updated successfully!'
        ]);
    }

    /**
     * Remove the specified branch.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Branch deleted successfully!'
        ]);
    }
}
