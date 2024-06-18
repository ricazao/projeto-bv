<?php

namespace App\Services\Integracao\DataTransformers;

use Illuminate\Support\Str;

class EmpreendimentoTransformer
{
    private static $links = [
        'bild' => 'https://bild.com.br/imoveis/?/?',
        'vitta' => 'https://vittaresidencial.com.br/?/imoveis/?',
    ];

    public static function fromSite(string $empresa, array $data): array
    {
        return [
            'empresa' => $empresa,
            'codigo_externo' => data_get($data, 'id'),
            'nome' => data_get($data, 'nome'),
            'end_logradouro' => data_get($data, 'rua'),
            'end_numero' => data_get($data, 'numero'),
            'end_complemento' => data_get($data, 'complemento'),
            'end_bairro' => data_get($data, 'bairro'),
            'end_cidade' => data_get($data, 'cidadeNome'),
            'end_cep' => data_get($data, 'cep'),
            'thumb' => data_get($data, 'thumb'),
            'link' => Str::replaceArray('?', [data_get($data, 'cidadeSlug'), data_get($data, 'slug')], self::$links[$empresa]),
        ];
    }
}
