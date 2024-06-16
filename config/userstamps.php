<?php

use App\Models\Usuario;

return [
    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | This is the User model used by Userstamps relationship.
    |
    */

    'user_class' => Usuario::class,

    /*
    |--------------------------------------------------------------------------
    | Fallback User
    |--------------------------------------------------------------------------
    |
    | This user will be used as the creator/updater/destroyer if the user is
    | not available.
    |
    */

    'fallback_user' => [
        'id' => 0,
        'nome' => 'Sistema',
    ],
];
