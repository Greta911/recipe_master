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
//PATTERN: /recipes
//VUE: templates/recipes/index.blade.php

Route::get('/recipes', function () {
    $recipes = Recipe::withCount('comments')->paginate(9);
    return view('template.recipes._index', [
        'recipes' => $recipes
    ]);
})->name('recipes._index');

//ROUTE DETAIL D'UNE RECETTE
//PATTERN: /show
//VUE: templates/recipes/show.blade.php

Route::get('/recipes/{id}', function ($id) {
    $recipe = Recipe::with(['ingredients', 'user', 'comments'])->findOrFail($id);
    return view('template.recipes.show', compact('recipe'));
})->name('recipes.show');

//ROUTE LISTE DES USERS
//PATTERN: /users
//VUE: templates/users/index.blade.php

Route::get('/users', function () {
    $users = User::withCount('recipes')->paginate(9);
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
