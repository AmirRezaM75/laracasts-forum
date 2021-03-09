<?php

use App\Http\Controllers\ {
    FavoriteController,
    ProfileController,
    ThreadController,
    ReplyController,
};

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('threads', ThreadController::class)->except(['create', 'edit', 'show', 'index']);
Route::get('threads/{category?}', [ThreadController::class, 'index'])->name('threads.index');
Route::get('threads/{category}/{thread}', [ThreadController::class, 'show'])->name('threads.show');

Route::post('replies/{reply}/favorites', [FavoriteController::class, 'store']);
Route::delete('replies/{reply}/favorites', [FavoriteController::class, 'destroy']);

Route::post('threads/{thread}/replies', [ReplyController::class, 'store'])->name('threads.replies.store');
Route::patch('replies/{reply}', [ReplyController::class, 'update'])->name('replies.update');;
Route::delete('replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.delete');;

Route::get('users/{user}', [ProfileController::class, 'show']);

require __DIR__.'/auth.php';
