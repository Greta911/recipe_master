@extends('template.app')
@section('main_content')
<main class="w-full md:w-3/4 p-3">
    <!-- Recipe Detail -->
    <section class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <!-- Recipe Image -->
        <img
            class="w-full h-96 object-cover rounded-t-lg"
            src="{{ $recipe->picture ?? 'https://images.unsplash.com/photo-1495521821757-a1efb6729352?auto=format&fit=crop&w=800&q=80' }}"
            alt="Nom de la recette" />

        <!-- Recipe Info -->
        <div class="p-4">
            <h1 class="text-3xl font-bold mb-4">{{ $recipe->name }}</h1>
            <div class="flex items-center mb-4">
                <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                <span>4.9</span>
                <span class="ml-4 text-gray-700"><i class="fas fa-clock"></i> 45 minutes</span>
            </div>
            <p class="text-gray-700 mb-4">
                {{ $recipe->description }}
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
            <ol class="list-decimal pl-5">
                <li>Préchauffez le four à 180°C.</li>
                <li>Dans un saladier, mélangez la farine et le sucre.</li>
                <li>
                    Ajoutez les œufs un à un en mélangeant bien entre chaque ajout.
                </li>
                <!-- ... (autres étapes) ... -->
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