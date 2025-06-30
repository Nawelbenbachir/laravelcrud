<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});
//route pour les 9 fonction du controller article
Route::resource('articles', ArticleController::class);
