<?php

namespace App\Enums;

enum IsActiveEnum: string
{
    case NO = 'no';
    case YES = 'yes';

    public function label(): string
    {
        return match ($this) {
            self::NO => __('No'),
            self::YES => __('Yes'),
        };
    }
}
