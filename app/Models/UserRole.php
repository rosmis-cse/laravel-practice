<?php

namespace App\Models;

use App\Enums\UserRole as EnumsUserRole;
use App\Policies\RolePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
    ];

    protected $casts = [
        'role' => EnumsUserRole::class
    ];
}
