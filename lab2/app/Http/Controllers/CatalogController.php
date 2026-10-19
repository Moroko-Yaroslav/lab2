<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;

class CatalogController extends Controller
{
    public function __construct(
        private CatalogService $catalog
    ) {
    }

    public function index()
    {
        return view('catalog.index', [
            'items' => $this->catalog->all()
        ]);
    }

    public function show(string $slug)
    {
        $item = $this->catalog->findBySlug($slug);

        if ($item === null) {
            abort(404);
        }

        return view('catalog.show', [
            'item' => $item
        ]);
    }
}