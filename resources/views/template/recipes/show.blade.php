@extends('template.app')
@section('main_content')
<main class="w-full md:w-3/4 p-3">
    <!-- Recipe Detail -->
    <section class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <!-- Recipe Image -->
        <img
            class="w-full h-96 object-cover rounded-t-lg"
            src="{{ Str::startsWith($recipe->picture, ['http://', 'https://']) ? $recipe->picture : asset('storage/' . $recipe->picture) }}"
            alt="Nom de la recette" />

        <!-- Recipe Info -->
        <div class="p-4">
            <h1 class="text-3xl font-bold mb-4">{{ $recipe->name }}</h1>
            <div class="flex items-center mb-4">
                <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                <span>{{ number_format($recipe->average_rating ?? 0, 1) }}</span>
                <span class="ml-4 text-gray-700"><i class="fas fa-clock"></i> {{ $recipe->prep_time }}</span>
                <span class="ml-4 text-gray-700"><i class="fas fa-utensils"></i> {{ $recipe->portions }} pers.</span>
            </div>
            <p class="text-gray-700 mb-4">
                {{ Str::limit($recipe->description, 150, '...') }}
            </p>
            <div class="flex items-center mb-4">
                <span class="text-gray-700 mr-2">{{ $recipe->user->name }}</span>
                <span class="text-gray-500"><i class="fas fa-comment"></i>{{ $recipe->comments_count ?? $recipe->comments->count() }}
                    {{ Str::plural('commentaire', $recipe->comments_count ?? $recipe->comments->count()) }}</span>
            </div>
        </div>

        <!-- Ingredients -->
        <div class="p-4 border-t">
            <h2 class="text-2xl font-bold mb-4">Ingrédients</h2>
            <ul class="list-disc pl-5">
                @foreach($recipe->ingredients as $ingredient)
                <li>{{ $ingredient->pivot->quantity }} {{ $ingredient->unit }} {{ $ingredient->name }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Steps -->
        <div class="p-4 border-t">
            <h2 class="text-2xl font-bold mb-4">Étapes</h2>
            <ol class="list-decimal pl-5 space-y-4">
                @php
                // On essaie d'abord de couper par ligne, sinon par point
                $steps = str_contains($recipe->description, "\n")
                ? explode("\n", $recipe->description)
                : explode(".", $recipe->description);
                @endphp

                @foreach($steps as $step)
                @if(strlen(trim($step)) > 5) {{-- Évite les petits morceaux vides --}}
                <li class="text-gray-700 leading-relaxed">
                    {{ ucfirst(trim($step)) }}{{ !str_ends_with(trim($step), '.') ? '.' : '' }}
                </li>
                @endif
                @endforeach
            </ol>
        </div>

        <!-- Comments -->
        <div class="p-4 border-t">
            <h2 class="text-2xl font-bold mb-4">Commentaires</h2>
            <!-- Comment -->
            @foreach ($recipe->comments as $comment)
            <div class="mb-4">
                <div class="flex items-center mb-2">
                    <img
                        src="https://source.unsplash.com/50x50/?portrait"
                        alt="Nom de l'utilisateur"
                        class="w-10 h-10 rounded-full mr-2" />
                    <span class="font-bold">{{ $comment->user->name }}</span>
                </div>
                <p class="text-gray-700">
                    {{ $comment->content }}
                </p>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection