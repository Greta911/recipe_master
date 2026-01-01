<aside class="w-full md:w-1/4 p-3">
    <div class="bg-yellow-500 text-white rounded-lg shadow-md p-4 mb-4">
        <h2 class="font-bold text-lg mb-4">Catégories</h2>
        <ul class="list-reset text-gray-100">
            @foreach ($categories as $category )
            <li>
                <a
                    class="hover:text-white hover:bg-yellow-600 px-2 block"
                    href="#">{{ $category->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="bg-yellow-600 text-white rounded-lg shadow-md p-4">
        <h2 class="font-bold text-lg mb-4">Ingrédients</h2>
        <ul class="list-reset text-gray-200">
            @foreach ($ingredients as $ingredient )
            <li>
                <a
                    class="hover:text-white hover:bg-yellow-700 px-2 block"
                    href="#">{{ Str::ucfirst($ingredient->name) }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</aside>