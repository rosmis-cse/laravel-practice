<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function estates(): BelongsToMany
    {
        return $this->belongsToMany(Estate::class, 'estate_option');
    }
}
