<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $variant = 8;
        $profile = config("catalog.profiles.$variant");

        if (!$profile) {
            throw new \RuntimeException(
                'Не знайдено профіль каталогу для варіанта 8.'
            );
        }

        $faker = Factory::create('uk_UA');
        $faker->seed((int) $profile['seed']);

        $usedSlugs = [];

        for ($i = 1; $i <= 12; $i++) {
            $title = $profile['titles'][($i - 1) % count($profile['titles'])];
            $categoryName = $profile['categories'][($i - 1) % count($profile['categories'])];

            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );

            $slug = Str::slug($title . '-' . $categoryName);
            $baseSlug = $slug;
            $number = 2;

            while (in_array($slug, $usedSlugs, true)) {
                $slug = $baseSlug . '-' . $number;
                $number++;
            }

            $usedSlugs[] = $slug;

            $attributes = [];

            foreach ($profile['attributes'] as $name => $values) {
                $attributes[$name] = $faker->randomElement($values);
            }

            $data = [
                'slug' => $slug,
                'title' => $title,
                'category_id' => $category->id,
                'operation' => $profile['operation'],
                'price' => $faker->numberBetween(
                    $profile['price'][0],
                    $profile['price'][1]
                ),
                'currency' => $profile['currency'],
                'short_description' => $faker->sentence(8),
                'description' => $faker->paragraph(4),
                'image' => 'images/catalog-atlas.png',
                'contact_name' => $faker->name(),
                'contact_phone' => $faker->phoneNumber(),
                'contact_email' => $faker->safeEmail(),
                'status' => $i <= 3 ? 'featured' : 'active',
                'published_at' => sprintf('2026-09-%02d', $i),
                'attributes' => $attributes,
            ];

            Product::firstOrCreate(
                ['slug' => $slug],
                $data
            );
        }
    }
}
