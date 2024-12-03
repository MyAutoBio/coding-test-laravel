<?php

namespace Database\Factories;

use App\Enums\Order\OrderStatus;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = collect(OrderStatus::cases())->pluck('name')
            ->toArray();

        return [
            'customer_id' => Customer::factory(),
            'status' => data_get($statuses, rand(0, count($statuses) - 1)),
            'total' => floatval(0),
            'note' => rand(0, 1) ? fake()->text(150) : null
        ];
    }
}
