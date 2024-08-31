<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Customer::truncate();
        CustomerAddress::truncate();
        ProductCategory::truncate();
        Product::truncate();
        OrderStatus::truncate();
        Order::truncate();
        OrderItem::truncate();
        Schema::enableForeignKeyConstraints();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(OrderStatusSeeder::class);
        ProductCategory::factory(10)->create();
        Product::factory(500)->create();

        Customer::factory(50)->create()->each(function ($customer) {
            $shipping_address = $customer->addresses()->save(CustomerAddress::factory()->create([
                'is_active' => true,
                'type' => 'shipping'
            ]));
            $billing_address = $customer->addresses()->save(CustomerAddress::factory()->create([
                'is_active' => true,
                'type' => 'billing'
            ]));
            //Prevent duplicate order reference exception
            Order::factory(5)->create([
                'customer_id' => $customer->id,
                'shipping_address_id' => $shipping_address->id,
                'billing_address_id' => $billing_address->id,
            ])->each(function ($order) {
                $orderItems = $order->orderItems()->save(OrderItem::factory()->make([
                    'order_id' => $order->id,
                    'product_id' => Product::inRandomOrder()->first()->id,
                    'quantity' => rand(1, 10)
                ]));
            });
        });
    }
}
