<?php

namespace App\Enums\Address;

use App\Concerns\Enums\HasKey;
use App\Concerns\Enums\HasLabel;

enum AddressType implements HasKey, HasLabel
{
    case home;
    case work;
    case temporary;

    public function key(): string
    {
        return match ($this)
        {
            AddressType::home => 'home',
            AddressType::work => 'work',
            AddressType::temporary => 'temporary'
        };
    }

    public function label(): string
    {
        return match ($this)
        {
            AddressType::home => 'Home',
            AddressType::work => 'Work',
            AddressType::temporary => 'Temporary'
        };
    }
}
