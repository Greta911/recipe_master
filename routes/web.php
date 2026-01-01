<?php

use App\Models\Recipe;
use Illuminate\Support\Facades\Route;

//ROUTE PAR DEFAUT
//PATTERN: /
//VUE: templates/index.blade.php
Route::get('/', function () {
    $heroRecipe = Recipe::query()->inRandomOrder()->first();
    $allRecipes = Recipe::all();
    return view('template.index', [
        'heroRecipe' => $heroRecipe,
        'allRecipes' => $allRecipes
    ]);
})->name('home');
