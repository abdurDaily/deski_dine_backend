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
                        <button class="btn btn-sm btn-soft-info edit-btn" data-id="' . $row->id . '">
                            <i class="ri-pencil-fill"></i>
                        </button>
                        <button class="btn btn-sm btn-soft-danger delete-btn" data-id="' . $row->id . '">
                            <i class="ri-delete-bin-fill"></i>
                        </button>';
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
            'name'     => 'required|string|max:255|unique:branches,name',
            'phone'    => 'required|string|max:20',
            'location' => 'required|string|max:500',
        ]);

        $branch = Branch::create($request->all());

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
            'name'     => 'required|string|max:255|unique:branches,name,' . $branch->id,
            'phone'    => 'required|string|max:20',
            'location' => 'required|string|max:500',
        ]);

        $branch->update($request->all());

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
