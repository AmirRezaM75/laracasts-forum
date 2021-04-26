<?php

namespace App\Http\Requests;

use App\Models\Reply;
use App\Rules\Spam;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ReplyRequest extends FormRequest
{
    public function authorize()
    {
        if ($this->isMethod('POST'))
            return $this->route('thread')->locked
                ? Response::deny('Thread is locked.')->authorize()
                : Gate::authorize('create', new Reply);

        return Gate::authorize('update', $this->route('reply'));
    }

    // TODO: failedAuthorization()

    public function rules()
    {
        return [
            'body' => ['required', new Spam]
        ];
    }
}
