<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderedItems;
use App\Models\User;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
       // insert 10 product items first 
        Item::factory(10);
        // insert customers with their ordered items 
        Customer::factory(50)
        ->has(Order::factory(4)
            ->has(OrderedItems::factory(6)))
        ->create();
    }
}
