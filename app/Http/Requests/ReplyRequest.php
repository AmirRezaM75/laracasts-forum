<?php

namespace App\Http\Requests;

use App\Models\Reply;
use App\Rules\Spam;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ReplyRequest extends FormRequest
{
    public function authorize()
    {
        return $this->isMethod('POST')
            ? Gate::authorize('create', new Reply)
            : Gate::authorize('update', $this->route('reply'));
    }

    // TODO: failedAuthorization()

    public function rules()
    {
        return [
            'body' => ['required', new Spam]
        ];
    }
}
