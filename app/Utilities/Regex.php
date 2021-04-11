<?php


namespace App\Utilities;


class Regex
{
    const KEY_HELD_DOWN = '/[^\s](.)\\1{4,}/';

    /*
     * [^>\/]: this handles edge cases like <a href='/@amir'>@amir</a>
     * when users update conversation that already consists of username
     * TODO: What about ``@foreach``?
    */
    const USER_MENTION = '/[^>\/](@([\w-]+))/';

    const USER_MENTION_RAW = '/@([\w-]+)/';

    const USERNAME = '/^[\w-]+$/';
}
