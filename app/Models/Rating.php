<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id', 'dish_id', 'value'];
    public $incrementing = false;

    protected static function booted()
    {
        // Quand une note est créée ou modifiée, on recalcule la moyenne de la recette
        static::saved(fn($rating) => $rating->recipe->updateAverageRating());
        static::deleted(fn($rating) => $rating->recipe->updateAverageRating());
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'dish_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
