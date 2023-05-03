<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthRepository
{
    public function hash(string $value): string
    {
        return Hash::make($value, config('hashing.argon'));
    }

    public function hash_check(string $value, string $hashed_value): bool
    {
        return Hash::check($value, $hashed_value, config('hashing.argon'));
    }

    public function salt(): string
    {
        return Str::random(config('hashing.argon.time'));
    }
}
