<?php

namespace App\Models;

use App\Enums\Address\AddressType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, HasUlids;

    public function casts()
    {
        return [
            'type' => AddressType::class
        ];
    }

    public function addressable()
    {
        return $this->morphTo();
    }
}
