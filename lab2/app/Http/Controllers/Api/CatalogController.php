<?php

namespace App\Http\Controllers\Api;

use App\Data\CatalogFilterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogFilterRequest;
use App\Http\Resources\ProductResource;
use App\Services\CatalogService;

class CatalogController extends Controller
{
    public function __construct(
        private CatalogService $catalog
    ) {
    }

    public function index(CatalogFilterRequest $request)
    {
        $filters = CatalogFilterData::fromArray(
            $request->validated()
        );

        $products = $this->catalog->paginate($filters);

        $products->appends(
            collect($request->validated())
                ->except('page')
                ->all()
        );

        return ProductResource::collection($products);
    }

    public function show(string $slug)
    {
        $product = $this->catalog->findBySlug($slug);

        return new ProductResource($product);
    }
}
