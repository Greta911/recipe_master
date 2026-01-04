<aside class="w-full md:w-1/4 p-3 space-y-4">
    <div class="bg-yellow-500 text-white rounded-lg shadow-md p-4">
        <h2 class="font-bold text-lg mb-4 border-b border-yellow-400 pb-2">Catégories</h2>
        <ul class="grid grid-cols-2 md:grid-cols-1 gap-2 text-gray-100">
            @foreach ($categories as $category)
            <li>
                <a href="{{ route('recipes._index', ['category' => $category->id]) }}"
                    class="hover:bg-yellow-600 px-2 py-1 block rounded {{ request('category') == $category->id ? 'bg-yellow-700 font-bold' : '' }}">
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
            @if(request('category'))
            <li class="mt-2 border-t border-yellow-400 pt-2">
                <a href="{{ route('recipes._index', request()->except('category', 'page')) }}"
                    class="text-xs italic underline">Effacer le filtre</a>
            </li>
            @endif
        </ul>
    </div>

    <div class="bg-yellow-600 text-white rounded-lg shadow-md p-4">
        <h2 class="font-bold text-lg mb-4 border-b border-yellow-500 pb-2">Ingrédients</h2>
        <ul class="grid grid-cols-2 md:grid-cols-1 gap-2 text-gray-200">
            @foreach ($ingredients as $ingredient)
            <li>
                <a href="{{ route('recipes._index', ['ingredient' => $ingredient->id]) }}"
                    class="hover:bg-yellow-600 px-2 py-1 block rounded {{ request('ingredient') == $ingredient->id ? 'bg-yellow-700 font-bold' : '' }}">
                    {{ Str::ucfirst($ingredient->name) }}
                </a>
            </li>
            @endforeach
            @if(request('ingredient'))
            <li class="mt-2 border-t border-yellow-500 pt-2">
                <a href="{{ route('recipes._index', request()->except('ingredient', 'page')) }}"
                    class="text-xs italic underline">Effacer le filtre</a>
            </li>
            @endif
        </ul>
    </div>
</aside>