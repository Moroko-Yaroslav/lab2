<?php

namespace App\Services;

use Faker\Factory;
use Illuminate\Support\Str;

class CatalogService
{
    private array $items = [];

    public function __construct()
    {
        $variant = (int) config('catalog.variant', 1);
        $profile = config("catalog.profiles.$variant");

        if (!$profile) {
            throw new \InvalidArgumentException(
                "Невідомий варіант каталогу: $variant"
            );
        }

        $faker = Factory::create('uk_UA');
        $faker->seed((int) $profile['seed']);

        $usedSlugs = [];

        for ($i = 1; $i <= 12; $i++) {
            $title = $profile['titles'][($i - 1) % count($profile['titles'])];
            $category = $profile['categories'][($i - 1) % count($profile['categories'])];

            $slug = Str::slug($title . '-' . $category);
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

            $this->items[] = [
                'id' => $i,
                'slug' => $slug,
                'title' => $title,
                'category' => $category,
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
                'published_at' => sprintf(
                    '2026-09-%02d 12:00:00',
                    $i
                ),
                'attributes' => $attributes,
            ];
        }
    }

    public function featured(int $limit = 3): array
    {
        return array_slice(
            array_values(array_filter(
                $this->items,
                fn ($item) => $item['status'] === 'featured'
            )),
            0,
            max(0, $limit)
        );
    }

    public function all(): array
    {
        return $this->items;
    }

    public function findBySlug(string $slug): ?array
    {
        foreach ($this->items as $item) {
            if ($item['slug'] === $slug) {
                return $item;
            }
        }

        return null;
    }
}
