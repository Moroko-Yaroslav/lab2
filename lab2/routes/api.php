<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CatalogController;

Route::get('/catalog', [CatalogController::class, 'index']);

Route::get('/catalog/{slug}', [CatalogController::class, 'show']);
