<?php

namespace App\Utilities;

use ParsedownExtra;
use Stevebauman\Purify\Facades\Purify;

class Markdown
{
    public static function parse(string $text)
    {
        $parsedown = new ParsedownExtra;

        if (! app()->environment('testing'))
            $parsedown->setSafeMode(true);

        return Purify::clean($parsedown->text($text));
    }
}
