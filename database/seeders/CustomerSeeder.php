<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\ItemPurchased;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::factory(200)->create()->each(function ($customer) {
            Order::factory(8)->create([
                'customer_id' => $customer->id,
            ])->each(function ($order) use ($customer) {
                ItemPurchased::factory(1)->create([
                    'order_id' => $order->id,
                ]);
            });
        });
    }
}
