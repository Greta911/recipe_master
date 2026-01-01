<?php

use App\Models\Recipe;
use Illuminate\Support\Facades\Route;

//ROUTE PAR DEFAUT
//PATTERN: /
//VUE: templates/index.blade.php
Route::get('/', function () {
    $heroRecipe = Recipe::inRandomOrder()->first();
    return view('template.index', [
        'featuredRecipe' => $heroRecipe,
        'recipes' => Recipe::all()
    ]);
})->name('home');
