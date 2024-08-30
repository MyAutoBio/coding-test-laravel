<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderedItems>
 */
class OrderedItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'   => Order::factory(),
            'item_id'    => Item::factory(),
            'quantity'   =>  $this->faker->numberBetween(1, 8)
        ];
    }
}
