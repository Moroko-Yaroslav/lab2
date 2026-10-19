<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;

class HomeController extends Controller
{
    public function __construct(
        private CatalogService $catalog
    ) {
    }

    public function index()
    {
        return view('home', [
            'featured' => $this->catalog->featured()
        ]);
    }
}