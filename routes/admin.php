<?php

use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\MenuController; // Import the Menu Controller
use Illuminate\Support\Facades\Route;

// --- BRANCH MANAGEMENT ---
Route::middleware(['auth', 'verified', 'setLocale'])->prefix("branch")->name("branch.")->group(function () {
    Route::get("/index", [BranchController::class, "index"])->name("index");
    Route::post("/store", [BranchController::class, "store"])->name("store");
    Route::get("/{branch}/edit", [BranchController::class, "edit"])->name("edit");
    Route::post("/{branch}/update", [BranchController::class, "update"])->name("update");
    Route::delete("/{branch}/delete", [BranchController::class, "destroy"])->name("delete");
});

// --- CATEGORY MANAGEMENT ---
Route::middleware(['auth', 'verified', 'setLocale'])->prefix("category")->name("category.")->group(function () {
    Route::get("/index", [CategoryController::class, "index"])->name("index");
    Route::post("/store", [CategoryController::class, "store"])->name("store");
    Route::get("/{category}/edit", [CategoryController::class, "edit"])->name("edit");
    Route::post("/{category}/update", [CategoryController::class, "update"])->name("update");
    Route::delete("/{category}/delete", [CategoryController::class, "destroy"])->name("delete");
});

// --- MENU MANAGEMENT (NEW) ---
Route::middleware(['auth', 'verified', 'setLocale'])->prefix("menu")->name("menu.")->group(function () {
    Route::get("/index", [MenuController::class, "index"])->name("index");
    Route::post("/store", [MenuController::class, "store"])->name("store");
    Route::get("/{menu}/edit", [MenuController::class, "edit"])->name("edit");
    Route::post("/{menu}/update", [MenuController::class, "update"])->name("update");
    Route::delete("/{menu}/delete", [MenuController::class, "destroy"])->name("delete");
    Route::post('menu/{id}/update', [MenuController::class, 'update'])->name('admin.menu.update');
});