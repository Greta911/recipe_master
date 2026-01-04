<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'types_of_dishes';
    protected $fillable = ['name', 'description'];

    const UPDATED_AT = null;

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'type_id');
    }
}
