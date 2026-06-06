<?php

//--------------------------------------------------------------------------
// LogoutUseCase: Ejecución de la lógica de cierre de sesión
//--------------------------------------------------------------------------

namespace App\Modules\Auth\Application\UseCases;

use App\Modules\Auth\Domain\Interfaces\AuthInterface;

class LogoutUseCase
{
    public function __construct(
        private readonly AuthInterface $authInterface
    ) {}

    //--------------------------------------------------------------------------
    // Autenticación: Revocación del token de acceso de la sesión activa
    //--------------------------------------------------------------------------
    public function execute(): void
    {
        $this->authInterface->logout();
    }
}
