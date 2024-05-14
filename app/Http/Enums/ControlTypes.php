<?php


namespace App\Enums;


class ControlTypes
{
    public const SHOCK = 'shock';

    public const VIBRATE = 'vibrate';

    public const BEEP = 'beep';

    /**
     * @var array|string[]
     */
    public static array $types = [
      self::SHOCK,
      self::VIBRATE,
      self::BEEP,
    ];
}
