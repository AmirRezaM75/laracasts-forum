<?php

namespace App\Utilities;

use ParsedownExtra;

class Markdown
{
    public static function parse(string $text)
    {
        $parsedown = new ParsedownExtra;

        if (! app()->environment('testing'))
            $parsedown->setSafeMode(true);

        return $parsedown->text($text);
    }
}
