<?php

namespace App\Modules\Auth\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Auth\Domain\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;

class EloquentAuthRepository implements AuthInterface
{
    public function attempt(array $credentials, bool $remember): bool
    {
        return Auth::attempt($credentials, $remember);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
