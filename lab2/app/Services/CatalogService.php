<?php

namespace App\Services;

use App\Data\CatalogFilterData;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogService
{
    public function featured(int $limit = 3): Collection
    {
        return Product::with('category')
            ->where('status', 'featured')
            ->orderBy('id')
            ->limit(max(0, $limit))
            ->get();
    }

    public function all(): Collection
    {
        return Product::with('category')
            ->orderBy('id')
            ->get();
    }

    public function findBySlug(string $slug): Product
    {
        return Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function categories(): Collection
    {
        return Category::orderBy('name')->get();
    }

    public function count(): int
    {
        return Product::count();
    }

    public function paginate(
        CatalogFilterData $filters
    ): LengthAwarePaginator {
        $query = Product::with('category');

        if ($filters->q !== null && $filters->q !== '') {
            $query->where(function ($query) use ($filters) {
                $query->where('title', 'like', '%' . $filters->q . '%')
                    ->orWhere(
                        'short_description',
                        'like',
                        '%' . $filters->q . '%'
                    );
            });
        }

        if ($filters->category) {
            $query->whereHas('category', function ($query) use ($filters) {
                $query->where('name', $filters->category);
            });
        }

        if ($filters->operation) {
            $query->where('operation', $filters->operation);
        }

        switch ($filters->sort) {
            case 'price_asc':
                $query->orderBy('price')->orderBy('id');
                break;

            case 'price_desc':
                $query->orderByDesc('price')->orderByDesc('id');
                break;

            default:
                $query->orderByDesc('published_at')->orderByDesc('id');
                break;
        }

        return $query->paginate(
            perPage: $filters->perPage,
            page: $filters->page
        );
    }
}
