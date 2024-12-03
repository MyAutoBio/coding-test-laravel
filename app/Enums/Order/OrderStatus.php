<?php

namespace App\Enums\Order;

use App\Concerns\Enums\HasColor;
use App\Concerns\Enums\HasKey;
use App\Concerns\Enums\HasLabel;

enum OrderStatus implements HasKey, HasLabel, HasColor
{
    case pending;
    case paid;
    case cancelled;

    public function key(): string
    {
        return match($this) {
            self::pending => 'pending',
            self::paid => 'paid',
            self::cancelled => 'cancelled'
        };
    }

    public function label(): string
    {
        return match($this) {
            self::pending => 'Pending',
            self::paid => 'Paid',
            self::cancelled => 'Cancelled'
        };
    }

    public function color(): string
    {
        return match($this) {
            self::pending => 'blue',
            self::paid => 'green',
            self::cancelled => 'red'
        };
    }
}
