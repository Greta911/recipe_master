<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ChefList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 9;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->perPage += 9;
    }


    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->has('recipes')
            ->with(['recipes' => function ($query) {
                $query->latest()->limit(3);
            }])
            ->withCount('recipes')
            ->paginate($this->perPage);

        return view('livewire.chef-list', [
            'users' => $users,
            'hasMore' => $users->hasMorePages(),
        ]);
    }
}
