<?php

namespace App\Enums;

enum ManglikStatus: string
{
    case NON_MANGLIK = 'non_manglik';
    case MANGLIK = 'manglik';
    case ANSHIK_MANGLIK = 'anshik_manglik';

    public function label(): string
    {
        return match ($this) {
            self::NON_MANGLIK => 'Non-Manglik',
            self::MANGLIK => 'Manglik (Kuja Dosha)',
            self::ANSHIK_MANGLIK => 'Anshik Manglik (Partial)',
        };
    }
}

