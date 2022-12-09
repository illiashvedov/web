<?php

use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::resource('articles', ArticlesController::class);
