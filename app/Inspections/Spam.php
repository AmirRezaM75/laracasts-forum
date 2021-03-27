<?php


namespace App\Inspections;


class Spam
{
    private $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];


    public function detect($text)
    {
        foreach($this->inspections as $inspection) {
            if (resolve($inspection)->detect($text))
                return true;
        }

        return false;
    }
}
