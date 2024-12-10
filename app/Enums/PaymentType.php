<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentType: string implements HasLabel
{
    case onCash = '0';
    case mobileWallet = '1';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::onCash => 'On Cash',
            self::mobileWallet => 'Mobile Wallet',
        };
    }
}
