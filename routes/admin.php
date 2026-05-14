<?php

use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\CategoryController; // Don't forget this import
use Illuminate\Support\Facades\Route;

//******** BRANCH MANAGEMENT
Route::prefix("branch")->name("branch.")->group(function () {
    Route::get("/index", [BranchController::class, "index"])->name("index");
    Route::post("/store", [BranchController::class, "store"])->name("store");
    Route::get("/{branch}/edit", [BranchController::class, "edit"])->name("edit");
    Route::post("/{branch}/update", [BranchController::class, "update"])->name("update");
    Route::delete("/{branch}/delete", [BranchController::class, "destroy"])->name("delete");
});

//******** CATEGORY MANAGEMENT
Route::prefix("category")->name("category.")->group(function () {
    Route::get("/index", [CategoryController::class, "index"])->name("index");
    Route::post("/store", [CategoryController::class, "store"])->name("store");
    Route::get("/{category}/edit", [CategoryController::class, "edit"])->name("edit");
    Route::post("/{category}/update", [CategoryController::class, "update"])->name("update");
    Route::delete("/{category}/delete", [CategoryController::class, "destroy"])->name("delete");
});