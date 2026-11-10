<?php

namespace App\Enums;

enum UserRole: string
{
    case GROOM = 'groom';
    case BRIDE = 'bride';
    case FAMILY_REP = 'family_rep';
    case PANDIT = 'pandit';
    case ADMIN = 'admin';

    /**
     * Check if this role represents a primary marriage seeker.
     */
    public function isSeeker(): bool
    {
        return in_array($this, [self::GROOM, self::BRIDE], true);
    }

    /**
     * Human-readable title honoring customary Dharmic tradition.
     */
    public function label(): string
    {
        return match ($this) {
            self::GROOM => 'Var (Groom)',
            self::BRIDE => 'Kanya (Bride)',
            self::FAMILY_REP => 'Family Representative (Ghotok)',
            self::PANDIT => 'Pandit Acharya',
            self::ADMIN => 'System Administrator',
        };
    }
}

