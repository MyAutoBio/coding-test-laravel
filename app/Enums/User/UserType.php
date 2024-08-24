<?php

namespace App\Enums\User;

use App\Concerns\Enums\HasKey;
use App\Concerns\Enums\HasLabel;

enum UserType implements HasKey, HasLabel
{
    case super_admin;
    case customer;

    public function key(): string
    {
        return match ($this) {
            self::super_admin => 'super_admin',
            self::customer => 'customer'
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::super_admin => 'Super admin',
            self::customer => 'Customer'
        };
    }
}
