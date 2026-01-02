@extends('template.app')
@section('main_content')
@include('template.heroRecipe')
<h2 class="text-2xl font-bold mb-4">Recettes populaires</h2>
@include('template.recipes._card')
@endsection