<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class RecipeList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 9;

    public function updateSearch($query)
    {
        $this->search = $query;
        $this->resetPage(); // On remet la pagination à zéro ici
    }
    public function loadMore()
    {
        $this->perPage += 9;
    }
    public function render()
    {
        // On commence par charger la requête et les relations
        $query = Recipe::query()
            ->with(['user', 'ingredients'])
            ->withCount('comments');

        // On applique la recherche multi-mots sur Nom, Description et la table pivot des Ingrédients
        if (!empty($this->search)) {
            $words = explode(' ', $this->search);

            foreach ($words as $word) {
                $word = trim($word);
                if ($word == "") continue;

                $query->where(function ($q) use ($word) {
                    $q->where('name', 'like', "%{$word}%")
                        ->orWhere('description', 'like', "%{$word}%")
                        // Laravel s'occupe de passer par 'dishes_has_ingredients' automatiquement
                        ->orWhereHas('ingredients', function ($queryInv) use ($word) {
                            $queryInv->where('name', 'like', "%{$word}%");
                        });
                });
            }
        }

        $recipes = $query->latest()->paginate($this->perPage);

        return view('livewire.recipe-list', [
            'recipes' => $recipes,
            'hasMore' => $recipes->hasMorePages(),
        ]);
    }
}
