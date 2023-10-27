<?php

namespace App\Services;

use App\Actions\Auth\RegisterAction;
use App\Services\Dto\RegisterDto;

class AuthService {
    public function register(RegisterDto $registerDto)
    {
        return app()->call(RegisterAction::class, [
             'registerDto' => $registerDto
        ]);
    }
}