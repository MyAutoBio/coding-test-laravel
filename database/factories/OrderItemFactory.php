<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Fetch an existing order (you can adjust the logic as needed)
        $order = Order::inRandomOrder()->first();

        // Get all items that are not already in the order
        $existingItemIds = $order->items()->pluck('item_id')->toArray();

        // Get a random item that is not already in this order
        $item = Item::whereNotIn('id', $existingItemIds)->inRandomOrder()->first();

        return [
            'order_id' => $order->id, // Use an existing order
            'item_id' => $item->id, // Use a new item not in the order
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
