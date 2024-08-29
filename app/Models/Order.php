<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /** const Status Enums */
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Available order statuses.
     *
     * @var string[]
     */
    const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PROCESSING,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'order_number',
        'order_date',
        'shipped_date',
        'status',
    ];

    /**
     * RELATIONS
     */

    /**
     * get order customer
     *
     * @return BelongsTo
     */
     public function customer():BelongsTo
    {
        return $this->belongsTo(
            Customer::class,
            'customer_id',
            'id',
            'customer'
        );
    }

    /**
     * get order items
     *
     * @return HasMany
     */
    public function items():HasMany
    {
        return $this->hasMany(
            OrderItem::class,
            'order_id',
            'id'
        );
    }
}
