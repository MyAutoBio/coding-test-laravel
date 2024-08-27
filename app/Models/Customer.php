<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
           // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     public function scopeSearch($query, array $filters)
    {
        if (isset($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (isset($filters['order_number'])) {
            $query->whereHas('orders', function ($q) use ($filters) {
                $q->where('order_number', 'like', '%' . $filters['order_number'] . '%');
            });
        }

        if (isset($filters['item_name'])) {
            $query->whereHas('orders.items', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['item_name'] . '%');
            });
        }

        return $query;
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
