<?php

namespace App\Data;

final readonly class CatalogFilterData
{
    public function __construct(
        public ?string $q = null,
        public ?string $category = null,
        public ?string $operation = null,
        public string $sort = 'newest',
        public int $page = 1,
        public int $perPage = 9,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            q: $data['q'] ?? null,
            category: $data['category'] ?? null,
            operation: $data['operation'] ?? null,
            sort: $data['sort'] ?? 'newest',
            page: (int) ($data['page'] ?? 1),
            perPage: (int) ($data['per_page'] ?? 9),
        );
    }
}
