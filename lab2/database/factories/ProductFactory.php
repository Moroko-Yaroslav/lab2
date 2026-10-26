<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(),
            'category_id' => Category::factory(),
            'operation' => 'Оренда',
            'price' => fake()->numberBetween(100, 20000),
            'currency' => '₴',
            'short_description' => fake()->sentence(8),
            'description' => fake()->paragraph(4),
            'image' => 'images/catalog-atlas.png',
            'contact_name' => fake()->name(),
            'contact_phone' => fake()->phoneNumber(),
            'contact_email' => fake()->safeEmail(),
            'status' => 'active',
            'published_at' => '2026-09-01',
            'attributes' => [],
        ];
    }
}
