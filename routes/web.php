<?php

use Illuminate\Support\Facades\Route;

//ROUTE PAR DEFAUT
//PATTERN: /
//VUE: templates/index.blade.php
Route::get('/', function () {
    return view('template.index');
})->name('home');
