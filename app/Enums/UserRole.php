<?php

namespace App\Enums;

enum UserRole: string
{
    case User = "user";
    case Admin = "admin";

    public function roles(): string
    {
        return match($this) {
            self::Admin => 'Administrateur',
            self::User => 'Utilisateur'
        };
    }
}
