<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'landing'])->name('landing')->middleware('guest');
Route::get('@{user:username}', [UserController::class, 'show'])->name('user-profile');
Route::get('/p/{post:id}', [PostController::class, 'show'])->name('show-post');
Route::get('/explore', [CategoryController::class, 'index'])->name('categories');
Route::get('/explore/{category:slug}', [CategoryController::class, 'show'])->name('show-category');
Route::get('/community', [UserController::class, 'index'])->name('community');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/public', [PostController::class, 'public'])->name('public');
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', [PostController::class, 'index'])->name('home');
        Route::middleware('optimizeImages')->group(function () {
            Route::post('/', [PostController::class, 'store'])->name('store.post');
        });
        Route::delete('/{post}/delete', [PostController::class, 'destroy'])->name('post.destroy');
    });
    Route::post('/@{user:username}/follow', [UserController::class, 'follow'])->name('follow');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('like');
    Route::post('/posts/{post}/reply', [ReplyController::class, 'store'])->name('reply');
    Route::delete('/replies/{reply}/delete', [ReplyController::class, 'destroy'])->name('reply.destroy');
    Route::group(['middleware' => 'admin'], function () {
        Route::post('/explore', [CategoryController::class, 'store'])->name('category.store');
        Route::delete('/explore/{categeory:slug}/delete', [CategoryController::class, 'destory'])->name('category.destroy');
    });
});
