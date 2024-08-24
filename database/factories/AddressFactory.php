<?php

namespace Database\Factories;

use App\Enums\Address\AddressType;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = collect(AddressType::cases())->pluck('name')->toArray();

        return [
            'type' => data_get($types, rand(0, count($types) - 1)),
            'city' => fake()->city,
            'region' => fake()->citySuffix,
            'street' => fake()->streetAddress,
            'full_address' => fake()->address,
            'zip_code' => fake()->postcode
        ];
    }
}
