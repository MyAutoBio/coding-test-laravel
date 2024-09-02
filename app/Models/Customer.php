<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['email','name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
           $q->where('email','like', "$search%")
               ->orWhereHas('orders',function ($q) use($search) {
                    $q->where('order_number', 'like', "$search%")
                        ->orWhereHas('items', function ($q) use($search) {
                            $q->where('name', 'like', "%$search%");
                        });
               });
        });
    }
}
