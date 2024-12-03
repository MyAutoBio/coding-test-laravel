<?php

namespace App\Models;

use App\Concerns\Scopes\TypeScope;
use App\Enums\User\UserType;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends User
{
    use HasFactory;

    protected $table = 'users';

    public static function booted()
    {
        static::addGlobalScope(new TypeScope(UserType::customer->name));
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function newFactory()
    {
        return UserFactory::new()
            ->forType(UserType::customer->name);
    }
}
