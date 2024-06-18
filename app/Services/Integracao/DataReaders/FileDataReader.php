<?php

namespace App\Services\Integracao\DataReaders;

use App\Services\Integracao\Contracts\DataReader;

class FileDataReader implements DataReader
{
    private $paths = [];

    public function __construct()
    {
        $this->paths = [
            'bild' => config('integracao.bild.file'),
            'vitta' => config('integracao.vitta.file'),
        ];
    }

    public function read(string $empresa): array
    {
        if (! array_key_exists($empresa, $this->paths)) {
            throw new \InvalidArgumentException('Empresa não encontrada');
        }

        if (is_null($this->paths[$empresa])) {
            throw new \RuntimeException('Arquivo não configurado');
        }

        $path = base_path($this->paths[$empresa]);

        if (! file_exists($path)) {
            throw new \RuntimeException('Arquivo não encontrado');
        }

        return json_decode(file_get_contents($path), true);
    }
}
