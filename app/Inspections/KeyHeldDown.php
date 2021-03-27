<?php


namespace App\Inspections;


class KeyHeldDown implements Inspector
{
    public function detect($text)
    {
        if (preg_match('/(.)\\1{4,}/', $text))
            return true;

        return false;
    }
}
