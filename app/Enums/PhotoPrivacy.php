<?php

namespace App\Enums;

enum PhotoPrivacy: string
{
    case PUBLIC = 'public';
    case BLUR_UNTIL_MUTUAL = 'blur_until_mutual';
    case RESTRICTED = 'restricted';

    public function label(): string
    {
        return match ($this) {
            self::PUBLIC => 'Fully Public to Verified Seekers',
            self::BLUR_UNTIL_MUTUAL => 'Modesty Shielded (Unlocks upon mutual consent)',
            self::RESTRICTED => 'Restricted (Granted on individual request only)',
        };
    }
}

