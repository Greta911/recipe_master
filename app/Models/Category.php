<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'types_of_dishes';
    protected $fillable = ['name'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'type_id');
    }
}
