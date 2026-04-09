<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Token Bearer interno (implementação atual: InternalBearerTokenAuthenticator)
    |--------------------------------------------------------------------------
    |
    | Enviar: Authorization: Bearer {INTERNAL_API_TOKEN}
    | Para trocar por JWT ou outra estratégia, altere o binding de
    | App\Contracts\Auth\TokenAuthenticator em AppServiceProvider.
    |
    */

    'bearer_token' => env('API_KEY', ''),

];
