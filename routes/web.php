<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckNoteOwnership;
use App\Http\Controllers\DashboardController;


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [NoteController::class, 'index'])->name('dashboard');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');

    
    Route::middleware(CheckNoteOwnership::class)->group(function () {
        Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
        Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{note}/update', [NoteController::class, 'update'])->name('notes.update');
        Route::delete('/notes/{note}/delete', [NoteController::class, 'destroy'])->name('notes.destroy');
    });

});

require __DIR__.'/auth.php';
