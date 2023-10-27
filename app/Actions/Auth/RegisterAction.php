<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Enums\UserRole;
use App\Models\User;
use App\Services\Dto\RegisterDto;
use Illuminate\Support\Facades\Auth;

final class RegisterAction
{
    /**
     * Register the user
     */
    public function __invoke(RegisterDto $registerDto)
    {
        $user = User::create([
            'name' => $registerDto->name,
            'email' => $registerDto->email,
            'password' => $registerDto->password,
        ]);

        // assign default role to newly created user to "user" role
        $user->roles()->create([
            "role" => UserRole::User
        ]);

        return Auth::login($user);   
    }
}
