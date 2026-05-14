<?php

use App\Http\Controllers\Backend\BranchController;
use Illuminate\Support\Facades\Route;

//******** BRANCH MANAGEMENT
Route::prefix("branch")->name("branch.")->group(function () {
    Route::get("/index", [BranchController::class, "index"])->name("index");
    Route::post("/store", [BranchController::class, "store"])->name("store");

    // New Routes
    Route::get("/{branch}/edit", [BranchController::class, "edit"])->name("edit");
    Route::post("/{branch}/update", [BranchController::class, "update"])->name("update");
    Route::delete("/{branch}/delete", [BranchController::class, "destroy"])->name("delete");
});
