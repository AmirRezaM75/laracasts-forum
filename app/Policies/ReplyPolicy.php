<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Reply $reply)
    {
        return optional($user->fresh()->recentReply)->wasRecentlyCreated()
            ? Response::deny('You are posting too frequently. Please take a break. :)', 429)
            : Response::allow();
    }

    public function update(User $user, Reply $reply)
    {
        return $user->id == $reply->user_id;
    }
}
