@extends('template.app')

@section('main_content')
<!-- User Profile Section -->
@foreach ($users as $user )
<section class="bg-gray-700 text-white rounded-lg shadow-2xl p-6 my-6">
    <!-- User Info -->

    <div class="flex items-center mb-6">
        <!-- User Avatar -->
        <img
            src="https://source.unsplash.com/300x300/?portrait"
            alt="Nom de l'utilisateur"
            class="w-24 h-24 rounded-full border-4 border-yellow-500 mr-4" />

        <!-- User Details -->
        <div>
            <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
            <p class="text-gray-400">Membre depuis: {{ $user->created_at->format('d/m/Y') }}</p>
            <p class="text-gray-400">Nombre de recettes postées: {{ $user->recipes->count() }}</p>
        </div>
    </div>

    <!-- User Actions -->
    <div class="flex justify-between items-center mb-4">
        <a
            href="{{ route('users.show', $user->id) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 rounded-full px-6 py-2">Voir mes recettes</a>
    </div>

    <!-- User's Latest Recipes -->
    <div>
        <h4
            class="text-xl font-bold mb-4 border-b-2 border-yellow-500 pb-2">
            Mes dernières recettes
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($user->recipes->sortByDesc('created_at')->take(3) as $recipe)
            @include('template.recipes._card')
            @endforeach
        </div>
</section>
@endforeach

@endsection