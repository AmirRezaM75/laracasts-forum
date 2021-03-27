<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Inspections\Spam as SpamDetector;

class Spam implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ! resolve(SpamDetector::class)->detect($value);
    }

    public function message()
    {
        return 'Content includes spam';
    }
}
