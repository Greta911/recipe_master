<?php

use App\Models\Recipe;
use App\Models\User;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

//ROUTE PAR DEFAUT
//PATTERN: /
//VUE: templates/recipes/index.blade.php
Route::get('/', function () {
    $heroRecipe = Recipe::with(['user', 'comments'])
        ->withCount('comments')
        ->inRandomOrder()
        ->first();
    $popularRecipes = Recipe::with(['user'])
        ->withCount('comments')
        ->orderByDesc('average_rating')
        ->limit(3)
        ->get();
    $heroUser = User::withCount('recipes')
        ->has('recipes')
        ->with(['recipes'])
        ->get()
        ->sortByDesc(function ($user) {
            return $user->recipes->avg('average_rating');
        })->first();
    return view('template.recipes.index', [
        'heroRecipe' => $heroRecipe,
        'popularRecipes' => $popularRecipes,
        'heroUser' => $heroUser
    ]);
})->name('home');

//ROUTE LISTE DES RECETTES
//PATTERN: /recipes
//VUE: templates/recipes/index.blade.php

Route::get('/recipes', function () {
    // On retourne la vue sans passer la variable $recipes
    return view('template.recipes._index');
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
