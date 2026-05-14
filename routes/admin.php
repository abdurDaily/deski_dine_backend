<?php

use App\Http\Controllers\Backend\BranchController;
use Illuminate\Support\Facades\Route;

//******** BRANCH MANAGEMENT
// We use the 'admin.' name prefix so the route becomes 'admin.branch.store'
Route::prefix("branch")->name("branch.")->group(function () {
    
    // Display the Form
    Route::get("/create", [BranchController::class, "create"])->name("create");
    
    // Handle the AJAX Submission
    Route::post("/store", [BranchController::class, "store"])->name("store");
    
    // Display the List (Index)
    Route::get("/index", [BranchController::class, "index"])->name("index");
});