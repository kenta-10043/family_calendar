<?php

namespace App\Enums;

enum CategoryName: int
{
    case OTHER = 0;
    case HOBBY = 1;
    case WORK = 2;
    case STUDY = 3;

    public function label(): string
    {
        return match ($this) {
            self::OTHER => 'other',
            self::HOBBY => 'hobby',
            self::WORK => 'work',
            self::STUDY => 'study',
        };
    }
}
