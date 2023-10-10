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

//TODO Raggruppo queste rotte utilizzando il middleware() per assicurarmi che siano accessibili esclusivamente dagli utenti loggati

Route::middleware(['auth', 'verified'])

    ->prefix("admin")
    ->name("admin.")
    ->group(function() {

    //CREATE
    Route::get("/projects/create", [ProjectController::class, "create"])->name("projects.create");
    Route::post("/projects", [ProjectController::class, "store"])->name("projects.store");
    
    //READ
    Route::get("/projects", [ProjectController::class, "index"])->name("projects.index");
    Route::get("/projects/{id}", [ProjectController::class, "show"])->name("projects.show");

});


Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
