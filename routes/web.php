<?php

use App\Models\Recipe;
use Illuminate\Support\Facades\Route;

//ROUTE PAR DEFAUT
//PATTERN: /
//VUE: templates/app.blade.php
Route::get('/', function () {
    $heroRecipe = Recipe::inRandomOrder()->first();
    $recipes = Recipe::latest()->limit(3)->get();
    return view('template.recipes.index', [
        'heroRecipe' => $heroRecipe,
        'recipes' => $recipes
    ]);
})->name('home');

//ROUTE LISTE DES RECETTES
//PATTERN: /index
//VUE: templates/recipes/index.blade.php

Route::get('/recipes', function () {
    $recipes = Recipe::all();
    return view('template.recipes._index', [
        'recipes' => $recipes
    ]);
})->name('recipes._index');

//ROUTE DETAIL D'UNE RECETTE
//PATTERN: /show
//VUE: templates/recipes/show.blade.php

Route::get('/recipes/{id}', function ($id) {
    $recipe = App\Models\Recipe::findOrFail($id);
    return view('template.recipes.show', compact('recipe'));
})->name('recipes.show');
