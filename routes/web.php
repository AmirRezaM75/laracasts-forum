<?php

use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('threads', [ThreadController::class, 'index'])->name('threads.index');
Route::post('threads', [ThreadController::class, 'store'])
    ->name('threads.store')
    ->middleware('auth');
Route::get('threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::post('threads/{thread}/replies', [ReplyController::class, 'store'])
    ->middleware('auth')
    ->name('threads.replies.store');

require __DIR__.'/auth.php';
