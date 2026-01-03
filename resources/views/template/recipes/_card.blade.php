<!-- Recipe Card -->
{{-- On ajoute wire:key --}}

<article wire:key="recipe-{{ $recipe->id }}" class="bg-white rounded-lg overflow-hidden shadow-lg flex flex-col h-full">
    <img class="w-full h-56 object-cover"
        src="{{ Str::startsWith($recipe->picture, ['http://', 'https://']) ? $recipe->picture : asset('storage/' . $recipe->picture) }}"
        alt="{{ $recipe->name }}" />

    <div class="p-5 flex flex-col grow">
        <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $recipe->name }}</h3>

        <p class="text-gray-600 text-sm mb-4 grow">
            {{ Str::limit($recipe->description, 100, '...') }}
        </p>
        <div class="flex items-center mb-4">
            <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
            <span class="text-gray-800">{{ number_format($recipe->average_rating ?? 0, 1) }}</span>
        </div>
        <div class="border-t pt-4 mt-auto">
            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                <span><strong>Chef:</strong> {{ $recipe->user->name }}</span>
                <span><i class="fas fa-comment"></i> {{ $recipe->comments_count }}</span>
            </div>

            <a href="{{ route('recipes.show', $recipe->id) }}"
                class="block text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                Voir la recette
            </a>
        </div>
    </div>
</article>