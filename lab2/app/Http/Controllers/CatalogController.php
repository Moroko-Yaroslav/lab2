<?php

namespace App\Http\Controllers;

use App\Data\CatalogFilterData;
use App\Http\Requests\CatalogFilterRequest;
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

        $items = $this->catalog->paginate($filters);

        $items->appends(
            collect($request->validated())
                ->except('page')
                ->all()
        );

        return view('catalog.index', [
            'items' => $items,
            'categories' => $this->catalog->categories(),
            'filters' => $filters,
        ]);
    }

    public function show(string $slug)
    {
        $item = $this->catalog->findBySlug($slug);

        return view('catalog.show', [
            'item' => $item,
        ]);
    }
}
