<section class="relative mb-6">
    <img
        class="w-full h-96 object-cover"
        src="{{ $recipe->picture ?? 'https://images.unsplash.com/photo-1495521821757-a1efb6729352?auto=format&fit=crop&w=800&q=80' }}"
        alt="Featured Recipe Image" />
    <div
        class="absolute bottom-0 left-0 w-full p-6 bg-linear-to-t from-gray-900 to-transparent">
        <h1 class="text-3xl font-bold mb-2 text-white">
            {{ $heroRecipe->name }}
        </h1>
        <div class="flex items-center mb-4">
            <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
            <span class="text-white">{{ number_format($recipe->average_rating ?? 0, 1) }}</span>
        </div>
        <p class="text-gray-300 mb-4">
            {{ Str::limit($heroRecipe->description, 200, '...') }}
        </p>
        <div class="flex items-center mb-4">
            <span class="text-gray-400 mr-2">{{ $heroRecipe->user->name }}</span>
            <span class="text-gray-500"><i class="fas fa-comment"></i> {{ $heroRecipe->comments_count }} {{ Str::plural('commentaire', $recipe->comments_count) }}</span>
        </div>
        <a href="{{ route('recipes.show', $heroRecipe->id) }}"
            class="inline-block text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
            Voir la recette
        </a>
    </div>
</section>