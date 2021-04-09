<?php


namespace App\Utilities;


class Regex
{
    const KEY_HELD_DOWN = '/[^\s](.)\\1{4,}/';

    const USER_MENTION =  '/@([\w-]+)/';
    // TODO: What about ``@foreach``?

    const USERNAME = '/^[\w-]+$/';
}
