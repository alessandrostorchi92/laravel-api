<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('guests.welcome');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//CREATE
Route::get("/admin/projects/create", [ProjectController::class, "create"])->name("admin.projects.create");
Route::post("/admin/projects", [ProjectController::class, "store"])->name("admin.projects.store");

//READ
Route::get("/admin/projects", [ProjectController::class, "index"])->name("admin.projects.index");
Route::get("/admin/projects/{id}", [ProjectController::class, "show"])->name("admin.projects.show");

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
