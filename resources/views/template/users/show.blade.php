@extends('template.app')

@section('main_content')
<main class="w-full md:w-3/4 p-3">
    <div class="p-3">
        <section class="relative mb-6">
            <img
                class="w-full h-96 object-cover rounded-lg shadow-lg"
                src="https://source.unsplash.com/1600x900/?portrait,{{ urlencode($user->name) }}"
                alt="Profile de {{ $user->name }}" />
            <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-gray-900 to-transparent rounded-b-lg">
                <h1 class="text-3xl font-bold mb-2 text-white">
                    {{ $user->name }}
                </h1>
                <p class="text-gray-300 mb-4">
                    Membre passionné depuis le {{ $user->created_at->format('d/m/Y') }}.
                    A déjà partagé {{ $user->recipes->count() }} pépites culinaires !
                </p>
            </div>
        </section>

        <section>
            <h2 class="text-2xl font-bold mb-4">Les recettes de {{ $user->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach($user->recipes as $recipe)
                <article class="bg-white rounded-lg overflow-hidden shadow-lg relative text-gray-900">
                    <img
                        src="https://source.unsplash.com/480x360/?food,recipe,{{ $recipe->id }}"
                        alt="{{ $recipe->name }}"
                        class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ $recipe->name }}</h3>
                        <div class="flex items-center mb-2">
                            <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                            <span>{{ number_format($recipe->average_rating, 1) }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">
                            {{ Str::limit($recipe->description, 100) }}
                        </p>
                        <a
                            href="{{ route('recipes.show', $recipe->id) }}"
                            class="inline-block mt-4 bg-red-500 hover:bg-red-800 rounded-full px-4 py-2 text-white">
                            Voir la recette
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
    </div>
</main>
@endsection