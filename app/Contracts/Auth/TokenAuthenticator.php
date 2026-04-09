<?php

namespace App\Contracts\Auth;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

interface TokenAuthenticator
{
    /**
     * Valida o pedido (ex.: header Authorization). Lança UnauthorizedHttpException se inválido.
     *
     * @throws UnauthorizedHttpException
     */
    public function authenticate(Request $request): void;
}
