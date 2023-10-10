<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('guests.index');
});

//INDEX
Route::get("/projects", [GuestProjectController::class, "index"])->name("guest.index");



Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//TODO Raggruppo queste rotte utilizzando il middleware() per assicurarmi che siano accessibili esclusivamente dagli utenti loggati

Route::middleware(['auth', 'verified'])

    ->prefix("admin")
    ->name("admin.")
    ->group(function() {

    //CREATE
    Route::get("/projects/create", [AdminProjectController::class, "create"])->name("projects.create");
    Route::post("/projects", [AdminProjectController::class, "store"])->name("projects.store");
    
    //READ
    Route::get("/projects", [AdminProjectController::class, "index"])->name("projects.index");
    Route::get("/projects/{id}", [AdminProjectController::class, "show"])->name("projects.show");

});


Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
