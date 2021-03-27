<?php


namespace App\Inspections;


interface Inspector
{
    public function detect($text);
}
