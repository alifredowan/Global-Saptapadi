<?php

namespace App\Enums;

enum ProposalStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case DECLINED = 'declined';
    case CANCELLED = 'cancelled';

    public function isFinal(): bool
    {
        return in_array($this, [self::ACCEPTED, self::DECLINED, self::CANCELLED], true);
    }
}

