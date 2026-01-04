{{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}


<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($recipes as $recipe)
        @include('template.recipes._card', ['recipe' => $recipe])
        @endforeach
    </div>

    @if($hasMore)
    <div class="flex justify-center mt-12 mb-8">
        <button wire:click="loadMore"
            wire:loading.attr="disabled"
            class="bg-gray-800 hover:bg-black text-white font-bold py-3 px-10 rounded-full shadow-md transition-all flex items-center">
            <span wire:loading class="mr-2"><i class="fas fa-circle-notch fa-spin"></i></span>
            <span wire:loading.remove>Voir plus de recettes</span>
            <span wire:loading>Chargement...</span>
        </button>
    </div>
    @endif
</div>
</div>