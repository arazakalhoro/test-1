<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sku = $this->faker->unique()->numerify('P-####-###');
        $name = $sku.": ".$this->faker->word();
        $category = ProductCategory::inRandomOrder()->first();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'sku' => $sku,
            'description' => $this->faker->sentence(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'cover' => $this->faker->imageUrl(400, 300),
            'status' => $this->faker->boolean(75),
            'category_id' => $category->id,
        ];
    }
}
