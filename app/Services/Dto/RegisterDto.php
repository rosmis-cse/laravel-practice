<?php

namespace App\Services\Dto;

final class RegisterDto {
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    )
    {}
}