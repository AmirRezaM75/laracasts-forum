<?php


namespace App\Inspections;


use App\Utilities\Regex;

class KeyHeldDown implements Inspector
{
    public function detect($text)
    {
        if (preg_match(Regex::KEY_HELD_DOWN, $text))
            return true;

        return false;
    }
}
