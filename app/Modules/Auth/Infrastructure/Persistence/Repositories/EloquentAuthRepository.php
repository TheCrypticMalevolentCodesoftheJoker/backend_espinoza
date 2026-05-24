<?php

namespace App\Modules\Auth\Infrastructure\Persistence\Repositories;


use App\Modules\Auth\Domain\Exceptions\TokenExpiredOrInvalidException;
use App\Modules\Auth\Domain\Interfaces\AuthInterface;
use App\Modules\User\Infrastructure\Persistence\Models\TblUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EloquentAuthRepository implements AuthInterface
{
    //--------------------------------------------------------------------------
    // INICIAR SESIÓN -> Generar token de acceso
    //--------------------------------------------------------------------------
    public function login(string $email, string $password): ?string
    {
        $user = TblUser::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        return $user->createToken('auth_token')->plainTextToken;
    }

    //--------------------------------------------------------------------------
    // CERRAR SESIÓN -> Revocar token actual
    //--------------------------------------------------------------------------
    public function logout(): void
    {
        $user = Auth::user();

        if (!$user instanceof TblUser) {
            throw new TokenExpiredOrInvalidException();
        }

        /** @var \Laravel\Sanctum\PersonalAccessToken|null $token */
        $token = $user->currentAccessToken();
        $token?->delete();
    }
}
