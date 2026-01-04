<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class RecipeList extends Component
{
    use WithPagination;


    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $category = '';

    #[Url(history: true)]
    public $ingredient = '';

    public $perPage = 9;

    public function loadMore()
    {
        $this->perPage += 9;
    }

    public function render()
    {
        $categories = \App\Models\Category::all();
        $ingredients = \App\Models\Ingredient::has('recipes')->take(15)->get();

        $query = Recipe::query()
            ->with(['user', 'ingredients'])
            ->withCount('comments');

        // 1. Filtre Recherche
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

        // 2. Filtre Catégorie
        if (!empty($this->category)) {
            $query->where('type_id', $this->category);
        }

        // 3. Filtre Ingrédient
        if (!empty($this->ingredient)) {
            $query->whereHas('ingredients', function ($q) {
                // On précise la table pour éviter les colonnes ambiguës
                $q->where('ingredients.id', $this->ingredient);
            });
        }

        $recipes = $query->latest()->paginate($this->perPage);

        return view('livewire.recipe-list', [
            'recipes' => $recipes,
            'categories' => $categories,
            'ingredients' => $ingredients,
            'hasMore' => $recipes->hasMorePages(),
        ]);
    }

    // Réinitialise la page si l'un des filtres change
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedCategory()
    {
        $this->resetPage();
    }
    public function updatedIngredient()
    {
        $this->resetPage();
    }
}
