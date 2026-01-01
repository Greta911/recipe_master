<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    protected $table = 'dishes';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
