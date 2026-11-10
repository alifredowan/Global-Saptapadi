<?php

namespace App\Enums;

enum MaritalStatus: string
{
    case NEVER_MARRIED = 'never_married';
    case DIVORCED = 'divorced';
    case WIDOWED = 'widowed';
    case ANNULLED = 'annulled';

    /**
     * Human-readable label for matrimonial profile display.
     */
    public function label(): string
    {
        return match ($this) {
            self::NEVER_MARRIED => 'Never Married',
            self::DIVORCED => 'Divorced (Dignified Remarriage)',
            self::WIDOWED => 'Widowed (Dignified Remarriage)',
            self::ANNULLED => 'Annulled',
        };
    }
}

