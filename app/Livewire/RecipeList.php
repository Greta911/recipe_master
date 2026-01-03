<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class RecipeList extends Component
{
    use WithPagination;

    protected $queryString = ['search'];
    public $search = '';
    public $perPage = 9;

    public function loadMore()
    {
        $this->perPage += 9;
    }
    public function render()
    {
        // 1. On commence la requête avec les relations
        $query = Recipe::query()
            ->with(['user', 'ingredients'])
            ->withCount('comments');

        // 2. On applique la recherche multi-mots si elle n'est pas vide
        if (!empty($this->search)) {
            $words = explode(' ', $this->search);

            foreach ($words as $word) {
                $word = trim($word);
                if ($word == "") continue;

                $query->where(function ($q) use ($word) {
                    $q->where('name', 'like', "%{$word}%")
                        ->orWhere('description', 'like', "%{$word}%")
                        ->orWhereHas('ingredients', function ($queryInv) use ($word) {
                            $queryInv->where('name', 'like', "%{$word}%");
                        });
                });
            }
        }

        // 3. Pagination et tri
        $recipes = $query->latest()->paginate($this->perPage);

        return view('livewire.recipe-list', [
            'recipes' => $recipes,
            'hasMore' => $recipes->hasMorePages(),
        ]);
    }

    // Optionnel : Réinitialise la page quand on tape une nouvelle recherche
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
