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


    public function destroy($notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
