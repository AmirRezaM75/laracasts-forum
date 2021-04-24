<?php

namespace App\Http\Controllers;


class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return auth()->user()->unreadNotifications;
    }


    public function destroy($notificationId = null)
    {
        $notifications = auth()->user()->notifications();

        $notificationId ? $notifications->findOrFail($notificationId)->markAsRead() : $notifications->delete();

        return response()->noContent();
    }
}
