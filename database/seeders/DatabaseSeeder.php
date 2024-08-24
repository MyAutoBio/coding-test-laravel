<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SuperAdmin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Create a super admin
            if (!SuperAdmin::where('email', 'admin@gmail.com')->first()) {
                SuperAdmin::factory()->create([
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('password')
                ]);
            }

            // Create 3 customers
            for ($i = 0; $i < 10; $i++) {
                $customer = Customer::factory()->create();

                // Create an address for each customer
                $addresses = Address::factory(3)->create([
                    'addressable_type' => Customer::class,
                    'addressable_id' => $customer->id
                ]);;

                $orders = Order::factory(rand(0, 10))->create([
                    'customer_id' => $customer,
                    'address_id' => data_get($addresses, rand(0, count($addresses) - 1))
                ]);

                collect($orders)->each(function ($order) {
                    $orderItems = OrderItem::factory(rand(1, 10))->create([
                        'order_id' => $order
                    ]);

                    $order->update([
                        'total' => collect($orderItems)->sum('price')
                    ]);
                });
            }
        });
    }
}
