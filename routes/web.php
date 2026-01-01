<?php

use Illuminate\Support\Facades\Route;

//ROUTE PAR DEFAUT
//PATTERN: /
//VUE: welcome.blade.php
Route::get('/', function () {
    return view('welcome');
})->name('home');

//ROUTE CATEGORIES
//PATTERN: /categories
//VUE: index.blade.php
Route::get('/categories', function () {
    return view('categories.index');
})->name('categories');

//ROUTE INGREDIENTS
//PATTERN: /ingredients
//VUE: index.blade.php
Route::get('/ingredients', function () {
    return view('ingredients.index');
})->name('ingredients');

//ROUTE RECETTES
//PATTERN: /recipes
//VUE: index.blade.php
Route::get('/recipes', function () {
    return view('recipes.index');
})->name('recipes.index');
