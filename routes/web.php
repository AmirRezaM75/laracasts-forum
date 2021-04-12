<?php

use App\Utilities\Regex;
use App\Http\Controllers\{
    NotificationController,
    SubscriptionController,
    MarkdownController,
    FavoriteController,
    ProfileController,
    AvatarController,
    ThreadController,
    ReplyController
};

use Illuminate\Support\Facades\Route;


Route::redirect('/', 'threads');

Route::post('markdown', MarkdownController::class);

Route::post('threads/{thread}/subscriptions', [SubscriptionController::class, 'store']);
Route::delete('threads/{thread}/subscriptions', [SubscriptionController::class, 'destroy']);

Route::get('threads/{thread}/replies', [ReplyController::class, 'index'])->name('threads.replies.index');
Route::post('threads/{thread}/replies', [ReplyController::class, 'store'])->name('threads.replies.store');
Route::patch('replies/{reply}', [ReplyController::class, 'update'])->name('replies.update');
Route::delete('replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.delete');
Route::post('replies/{reply}/best', [ReplyController::class, 'best'])->name('replies.best');

Route::resource('threads', ThreadController::class)->except(['index', 'show', 'create', 'edit',]);
Route::get('threads/{category?}', [ThreadController::class, 'index'])->name('threads.index');
Route::get('threads/{category}/{thread}', [ThreadController::class, 'show'])->name('threads.show');

Route::post('replies/{reply}/favorites', [FavoriteController::class, 'store']);
Route::delete('replies/{reply}/favorites', [FavoriteController::class, 'destroy']);


Route::get('users/notifications', [NotificationController::class, 'index']);
Route::delete('users/notifications/{notification}', [NotificationController::class, 'destroy']);

Route::get('@{username}', [ProfileController::class, 'show'])
    ->where('username', trim(Regex::USERNAME, '/'))
    ->name('profile');

Route::post('users/{user}/avatar', [AvatarController::class, 'store']);

require __DIR__.'/auth.php';
