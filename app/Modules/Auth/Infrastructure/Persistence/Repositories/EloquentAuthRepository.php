<?php

//--------------------------------------------------------------------------
// EloquentAuthRepository: Implementación Eloquent para la validación y gestión de tokens de sesión
//--------------------------------------------------------------------------

namespace App\Modules\Auth\Infrastructure\Persistence\Repositories;


use App\Modules\Auth\Domain\Exceptions\TokenExpiredOrInvalidException;
use App\Modules\Auth\Domain\Interfaces\AuthInterface;
use App\Modules\User\Infrastructure\Persistence\Models\TblUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EloquentAuthRepository implements AuthInterface
{
    //--------------------------------------------------------------------------
    // Autenticación: Verificación de credenciales del usuario y emisión de token
    //--------------------------------------------------------------------------
    public function login(string $email, string $password): ?array
    {
        $user = TblUser::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'id' => $user->id,
            'name' => $user->name,
        ];
    }

    //--------------------------------------------------------------------------
    // Persistencia: Revocación del token de acceso actual en la base de datos
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
