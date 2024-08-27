<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
        use HasFactory;
        //Customer Details
 public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
// Get all Items belongs to One order.
public function items()
{
    return $this->hasMany(Item::class);
}
}
