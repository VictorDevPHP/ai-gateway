<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    /**
     * Garante expectsJson() nas rotas API, para falhas de validação retornarem 422 JSON
     * em vez de redirect (evita cair na rota GET / com outra mensagem).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
