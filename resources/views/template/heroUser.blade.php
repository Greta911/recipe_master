<section class="bg-gray-700 text-white rounded-lg shadow-2xl p-6 my-6 border-l-8 border-yellow-500">
    <div class="flex items-center mb-6">
        <img
            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=EAB308&color=1F2937&size=300"
            alt="{{ $user->name }}"
            class="w-24 h-24 rounded-full border-4 border-yellow-500 mr-4 object-cover" />

        <div>
            <h3 class="text-2xl font-bold text-yellow-500">
                {{ $user->name }}
            </h3>
            <p class="text-gray-400">
                Membre depuis : {{ $user->created_at->format('d/m/Y') }}
            </p>
            <p class="text-gray-400">
                Nombre de recettes postées : <strong>{{ $user->recipes_count }}</strong>
            </p>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <a
            href="{{ route('users.show', $user->id) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold rounded-full px-6 py-2 transition">Voir son profil et ses recettes</a>
    </div>

    <div>
        <h4 class="text-xl font-bold mb-4 border-b-2 border-yellow-500 pb-2 inline-block">
            Ses dernières créations
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
            @foreach($user->recipes->take(3) as $recipe)
            <article class="bg-gray-800 rounded-lg overflow-hidden shadow-lg relative flex flex-col h-full border border-gray-600">
                <img
                    src="{{ $recipe->picture ?? 'https://images.unsplash.com/photo-1495521821757-a1efb6729352?w=400' }}"
                    alt="{{ $recipe->name }}"
                    class="w-full h-40 object-cover" />
                <div class="p-4 flex flex-col grow">
                    <h5 class="text-lg font-bold mb-2 line-clamp-1">
                        {{ $recipe->name }}
                    </h5>
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                        <span class="font-bold">{{ number_format($recipe->average_rating, 1) }}</span>
                    </div>
                    <p class="text-gray-400 text-sm grow mb-3">
                        {{ Str::limit($recipe->description, 60) }}
                    </p>
                    <a
                        href="{{ route('recipes.show', $recipe->id) }}"
                        class="text-yellow-500 hover:text-yellow-600 font-bold text-sm inline-block">Voir la recette →</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>