<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       /* User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);*/

         //Customer::factory()->count(10)->create();
         // Seed customers with related orders and items
        Customer::factory()
            ->count(10) // Number of customers
            ->has(
                Order::factory()
                    ->count(5) // Number of orders per customer
                    ->has(
                        Item::factory()
                            ->count(2) // Number of items per order
                    )
            )
            ->create();
    }
}
