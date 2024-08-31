<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use Carbon\Carbon;
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
        $statusIds = OrderStatus::get('id')->pluck('id')->toArray();
        $orderDate = Carbon::parse($this->faker->dateTimeBetween('-2 years', 'now'));
        return [
            'reference' => "OR-".$orderDate->timestamp
                .$orderDate->format('-m-Y'),
            'tax' => $this->faker->randomFloat(2, 10, 100),
            'order_status_id' => $this->faker->randomElement($statusIds),
        ];
    }
}
