<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'order_number' => $this->faker->unique()->numerify('ORD-#####'),
            'order_date' => $this->faker->date,
            'shipped_date' => $this->faker->optional()->date,
            'status' => $this->faker->randomElement(Order::STATUSES),
        ];
    }
}
