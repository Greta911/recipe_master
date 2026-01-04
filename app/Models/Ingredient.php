<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    const UPDATED_AT = null;
    protected $fillable = [
        'name',
        'unit',
    ];
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'dishes_has_ingredients', 'ingredient_id', 'dish_id');
    }
}
