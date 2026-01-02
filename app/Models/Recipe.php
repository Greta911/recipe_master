<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'dish_id');
    }

    public function updateAverageRating()
    {
        $this->average_rating = $this->ratings()->avg('value') ?? 0;
        $this->save();
    }
}
