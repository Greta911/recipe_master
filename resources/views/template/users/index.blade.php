@extends('template.app')

@section('main_content')
@foreach ($users as $user)
<section class="bg-gray-700 text-white rounded-lg shadow-2xl p-6 my-6">
    <div class="flex items-center mb-6">
        <img
            src="https://source.unsplash.com/300x300/?portrait"
            alt="Nom de l'utilisateur"
            class="w-24 h-24 rounded-full border-4 border-yellow-500 mr-4" />

        <div>
            <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
            <p class="text-gray-400">Membre depuis: {{ $user->created_at->format('d/m/Y') }}</p>
            <p class="text-gray-400">Nombre de recettes postées: {{ $user->recipes->count() }}</p>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <a
            href="{{ route('users.show', $user->id) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 rounded-full px-6 py-2">Voir mes recettes</a>
    </div>

    <div>
        <h4 class="text-xl font-bold mb-4 border-b-2 border-yellow-500 pb-2">
            Mes dernières recettes
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($user->recipes->sortByDesc('created_at')->take(3) as $recipe)
            <article class="bg-white rounded-lg overflow-hidden shadow-lg relative text-gray-900">
                <img class="w-full h-48 object-cover" src="https://source.unsplash.com/480x360/?recipe" alt="Recipe Image" />
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2">{{ $recipe->name }}</h3>
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                        <span>{{ number_format($recipe->average_rating, 1)}}</span>
                    </div>
                    <p class="text-gray-600 text-sm">{{ Str::limit($recipe->description, 100) }}</p>
                    <a href="{{ route('recipes.show', $recipe->id) }}" class="inline-block mt-4 bg-red-500 hover:bg-red-800 rounded-full px-4 py-2 text-white">
                        Voir la recette
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endforeach

<div class="mt-8">
    {{ $users->links() }}
</div>
@endsection