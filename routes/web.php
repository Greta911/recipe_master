<?php

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//ROUTE PAR DEFAUT
//PATTERN: /
//VUE: templates/app.blade.php
Route::get('/', function () {
    $heroRecipe = Recipe::inRandomOrder()->first();
    $recipes = Recipe::orderByDesc('average_rating')->limit(3)->get();
    return view('template.recipes.index', [
        'heroRecipe' => $heroRecipe,
        'recipes' => $recipes
    ]);
})->name('home');

//ROUTE LISTE DES RECETTES
//PATTERN: /index
//VUE: templates/recipes/index.blade.php

Route::get('/recipes', function () {
    $recipes = Recipe::limit(9)->get();
    return view('template.recipes._index', [
        'recipes' => $recipes
    ]);
})->name('recipes._index');

//ROUTE DETAIL D'UNE RECETTE
//PATTERN: /show
//VUE: templates/recipes/show.blade.php

Route::get('/recipes/{id}', function ($id) {
    $recipe = Recipe::findOrFail($id);
    return view('template.recipes.show', compact('recipe'));
})->name('recipes.show');

//ROUTE LISTE DES USERS
//PATTERN: /index
//VUE: templates/users/index.blade.php

Route::get('/users', function () {
    $users = User::with('recipes')->get();
    return view('template.users.index', compact('users'));
})->name('users.index');

//ROUTE DETAIL D'UN USER
//PATTERN: /show
//VUE: templates/users/show.blade.php

Route::get('/users/{id}', function ($id) {
    $user = User::with('recipes')->findOrFail($id);
    $userRecipes = $user->recipes()->latest()->get();
    return view('template.users.show', compact('user'));
})->name('users.show');
