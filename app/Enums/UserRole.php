<?php

namespace App\Enums;

enum UserRole: string
{
    case User = "user";
    case Admin = "admin";

    static function roles(): array
    {
        return [
            'user' => self::User->value,
            'admin' => self::Admin->value,
        ];
    }
}
