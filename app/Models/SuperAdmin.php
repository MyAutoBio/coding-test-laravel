<?php

namespace App\Models;

use App\Concerns\Scopes\TypeScope;
use App\Enums\User\UserType;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends User
{
    use HasFactory;

    protected $table = 'users';

    public static function booted()
    {
        static::addGlobalScope(new TypeScope(UserType::super_admin->name));
    }

    public static function newFactory()
    {
        return UserFactory::new()
            ->forType(UserType::super_admin->name);
    }
}
