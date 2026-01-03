{{-- Do your work, then step back. --}}

<div>
    {{-- Barre de recherche --}}
    <div class="mb-10 flex justify-center">
        <div class="relative w-full max-w-xl">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Rechercher un chef..."
                class="w-full px-6 py-4 rounded-full border border-gray-200 shadow-lg focus:ring-2 focus:ring-yellow-500 outline-none text-gray-800" />
            <span class="absolute right-6 top-4 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>

    {{-- Liste des Chefs --}}
    @foreach ($users as $user)
    <section wire:key="chef-{{ $user->id }}" class="bg-gray-700 text-white rounded-lg shadow-2xl p-6 my-8 border-l-8 border-yellow-500">

        <div class="flex items-center mb-6">
            <img
                src="{{ $user->picture ? asset('storage/avatars/' . $user->picture) : asset('images/default_avatar.png') }}"
                alt="{{ $user->name }}"
                class="w-24 h-24 rounded-full border-4 border-yellow-500 mr-6 object-cover" />

            <div>
                <h3 class="text-2xl font-bold text-yellow-500">{{ $user->name }}</h3>
                <p class="text-gray-400">Membre depuis : {{ $user->created_at->format('d/m/Y') }}</p>
                <p class="text-gray-400">Nombre de recettes : <strong>{{ $user->recipes_count }}</strong></p>
            </div>
        </div>

        <div class="mb-6">
            <a href="{{ route('users.show', $user->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold rounded-full px-8 py-2 transition inline-block">
                Voir son profil complet
            </a>
        </div>

        {{-- Grille des 3 dernières recettes du chef --}}
        <div>
            <h4 class="text-xl font-bold mb-4 border-b-2 border-yellow-500 pb-2 inline-block">
                Ses dernières recettes
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
                @foreach($user->recipes as $recipe)
                <article class="bg-white rounded-xl overflow-hidden shadow-lg text-gray-900 flex flex-col h-full">
                    <img class="w-full h-40 object-cover" src="{{ $recipe->picture ?? 'https://source.unsplash.com/400x300/?cooking' }}" alt="{{ $recipe->name }}" />
                    <div class="p-4 flex flex-col grow">
                        <h5 class="text-lg font-bold mb-1">{{ $recipe->name }}</h5>
                        <div class="flex items-center mb-2 text-sm">
                            <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                            <span class="font-bold">{{ number_format($recipe->average_rating, 1)}}</span>
                        </div>
                        <p class="text-gray-600 text-xs grow">{{ Str::limit($recipe->description, 70) }}</p>
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="mt-4 bg-red-500 hover:bg-red-700 text-white text-center py-2 rounded-lg text-sm font-bold transition">
                            Voir la recette
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endforeach

    {{-- Bouton "Voir plus" (exactement comme pour les recettes) --}}
    @if($hasMore)
    <div class="flex justify-center mt-12 mb-8">
        <button wire:click="loadMore"
            wire:loading.attr="disabled"
            class="bg-gray-800 hover:bg-black text-white font-bold py-4 px-12 rounded-full shadow-xl transition-all flex items-center">
            <span wire:loading class="mr-2"><i class="fas fa-circle-notch fa-spin"></i></span>
            <span wire:loading.remove>Voir plus de chefs</span>
            <span wire:loading>Chargement...</span>
        </button>
    </div>
    @endif
</div>