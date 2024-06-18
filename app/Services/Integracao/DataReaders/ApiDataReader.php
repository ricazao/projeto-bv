<?php

namespace App\Services\Integracao\DataReaders;

use App\Services\Integracao\Contracts\DataReader;
use Illuminate\Support\Facades\Http;

class ApiDataReader implements DataReader
{
    private $urls = [];

    public function __construct()
    {
        $this->urls = [
            'bild' => config('integracao.bild.api'),
            'vitta' => config('integracao.vitta.api'),
        ];
    }

    public function read(string $empresa): array
    {
        if (! array_key_exists($empresa, $this->urls)) {
            throw new \InvalidArgumentException('Empresa não encontrada');
        }

        if (is_null($this->urls[$empresa])) {
            throw new \RuntimeException('API não configurada');
        }

        $url = $this->urls[$empresa];

        $response = Http::get($url);

        if ($response->failed()) {
            throw new \RuntimeException('Erro ao acessar a API');
        }

        return $response->json();
    }
}
