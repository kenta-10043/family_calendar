<?php

namespace App\Enums;

enum TaskStatus: int
{
    case INCOMPLETE = 0;
    case COMPLETED = 1;

    public function label(): string
    {
        return match ($this) {
            self::INCOMPLETE => 'Incomplete',
            self::COMPLETED => 'Completed!!',
        };
    }
}
