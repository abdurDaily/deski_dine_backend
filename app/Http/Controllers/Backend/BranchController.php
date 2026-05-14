<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    //*CREATE A NEW BRANCH  
    public function create()
    {
        return view("backend.branch.index");
    }
    /**
     * Store a newly created branch in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation (Laravel automatically returns JSON errors if the request is AJAX)
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:500',
            'phone'    => 'required|string|max:20',
        ]);

        try {
            // 2. Save to Database
            $branch = Branch::create($validated);

            // 3. Return JSON Success
            return response()->json([
                'status' => 'success',
                'message' => 'Branch "' . $branch->name . '" created successfully!'
            ], 200);
        } catch (\Exception $e) {
            // 4. Return JSON Error
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }
}
