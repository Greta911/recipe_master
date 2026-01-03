<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    protected $table = 'dishes';
    protected $fillable = ['name', 'description', 'average_rating'];
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredient::class,
            'dishes_has_ingredients',
            'dish_id',
            'ingredient_id'
        )->withPivot('quantity');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'dish_id');
    }

    public function updateAverageRating()
    {
        $this->average_rating = $this->ratings()->avg('value') ?? 0;
        $this->save();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'dish_id');
    }
}
