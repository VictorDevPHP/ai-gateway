<?php

namespace App\Http\Middleware;

use App\Contracts\Auth\TokenAuthenticator;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApiToken
{
    public function __construct(
        private readonly TokenAuthenticator $tokenAuthenticator,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $this->tokenAuthenticator->authenticate($request);

        return $next($request);
    }
}
