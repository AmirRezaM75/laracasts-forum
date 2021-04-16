<?php

namespace App\Http\Requests;

use App\Utilities\Regex;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'username' => ['required', 'string', 'max:255', 'regex:' . Regex::USERNAME, $this->unique('username')],
            'email' => ['required', 'string', 'max:255', 'email', $this->unique('email')]
        ];

        if ($this->isMethod('POST') or $this->has('password')) {
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function unique($column)
    {
        return $this->isMethod('POST')
            ? 'unique:users'
            : 'unique:users,' . $column . ','. auth()->id() . ',id';
    }
}
