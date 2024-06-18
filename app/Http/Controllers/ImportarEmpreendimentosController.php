<?php

namespace App\Http\Controllers;

use App\Services\Integracao\IntegracaoService;

class ImportarEmpreendimentosController
{
    public function __invoke(string $empresa, IntegracaoService $service)
    {
        if (! in_array($empresa, ['bild', 'vitta'])) {
            return abort(404);
        }

        $service->importarEmpreendimentos($empresa);

        return response()->json(['status' => 'success']);
    }
}
