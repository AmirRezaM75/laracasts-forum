<?php

namespace App\Http\Requests;

use App\Rules\Spam;
use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'body' => ['required', new Spam],
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
