<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::insert([
            ['name' => 'Pending'],
            ['name' => 'Processing'],
            ['name' => 'Shipped'],
            ['name' => 'Delivered'],
            ['name' => 'Cancelled'],
            ['name' => 'Refunded'],
            ['name' => 'Returned'],
            ['name' => 'Partially Shipped'],
            ['name' => 'Partially Delivered'],
            ['name' => 'Partially Cancelled'],
            ['name' => 'Partially Refunded'],
            ['name' => 'Partially Returned'],
            ['name' => 'On Hold'],
            ['name' => 'Awaiting Payment'],
            ['name' => 'Payment Failed'],
            ['name' => 'Payment Refunded'],
            ['name' => 'Payment Partially Refunded'],
        ]);
    }
}
