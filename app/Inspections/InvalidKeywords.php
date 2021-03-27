<?php


namespace App\Inspections;


class InvalidKeywords implements Inspector
{
    protected $keywords = [
        'online dating',
        'car rental',
        'suicide',
        'idiot',
        'shit'
    ];

    public function detect($text)
    {
        foreach ($this->keywords as $keyword)
            if (stripos($text, $keyword) !== false)
                return true;

        return false;
    }
}
