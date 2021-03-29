<?php


namespace App\Utilities;


class Regex
{
    const KEY_HELD_DOWN = '/(.)\\1{4,}/';

    const USER_MENTION =  '/@([\w\-]+)/';
}
