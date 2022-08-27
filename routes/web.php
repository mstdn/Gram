<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'landing'])->name('landing')->middleware('guest');
Route::get('@{user:username}', [UserController::class, 'show'])->name('user-profile');
Route::get('/p/{post:id}', [PostController::class, 'show'])->name('show-post');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [TimelineController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', [PostController::class, 'index'])->name('home');
        Route::middleware('optimizeImages')->group(function () {
            Route::post('/', [PostController::class, 'store'])->name('store.post');
        });
        // Route::get('/{note}/edit', [NoteController::class, 'edit']);
        // Route::patch('/{note}/edit', [NoteController::class, 'update'])->name('note.edit');
        // Route::delete('/{note}/delete', [NoteController::class, 'destroy'])->name('note.destroy');
    });
});
