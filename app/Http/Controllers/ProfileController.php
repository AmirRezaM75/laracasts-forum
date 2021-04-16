<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('update');
    }

    public function show($username)
    {
        $user = User::where('username', $username)
            ->where('private', false)
            ->firstOrFail();

        return view('profiles.show', [
            'user' => $user,
            'items' => Activity::feed($user)
        ]);
    }

    public function update(UserRequest $request)
    {
        $user = auth()->user();

        $user->email = $request->get('email');

        $user->private = $request->get('private', false);

        $user->username = $request->get('username');

        if ($request->has('password'))
            $user->password = Hash::make($request->get('password'));

        $user->save();

        if ($user->wasChanged('email')) {
            $user->sendEmailVerificationNotification();

            $user->forceFill(['email_verified_at' => null])->save();
        }
    }
}
