@extends('template.app')
@section('main_content')
@include('template.heroRecipe', ['recipe' => $heroRecipe])
<h2 class="text-2xl font-bold mb-4">Recettes populaires</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($popularRecipes as $recipe)
    {{-- On passe la variable $recipe actuelle au fichier _card --}}
    @include('template.recipes._card', ['recipe' => $recipe])
    @endforeach
</div>
<div>
    <h2 class="text-2xl font-bold mb-4 mt-4">Chef populaire</h2>
    @include('template.heroUser', ['user' => $heroUser])
</div>
@endsection