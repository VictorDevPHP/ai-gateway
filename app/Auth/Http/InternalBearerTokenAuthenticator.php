<?php

namespace App\Auth\Http;

use App\Contracts\Auth\TokenAuthenticator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InternalBearerTokenAuthenticator implements TokenAuthenticator
{
    public function authenticate(Request $request): void
    {
        $token = $request->bearerToken();

        if ($token === null || $token === '') {
            throw new UnauthorizedHttpException('Bearer', 'Token ausente.');
        }

        $expected = (string) config('internal_auth.bearer_token', '');

        if ($expected === '') {
            throw new UnauthorizedHttpException('Bearer', 'Token da API não configurado no servidor.');
        }

        if (! hash_equals($expected, $token)) {
            throw new UnauthorizedHttpException('Bearer', 'Token inválido.');
        }
    }
}
