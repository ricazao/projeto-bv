<?php

namespace App\Services\Integracao;

use App\Events\Empreendimentos\ImportacaoConcluida;
use App\Jobs\ProcessaEmpreendimento;
use App\Models\Empreendimento;
use App\Services\Integracao\Contracts\DataReader;
use App\Services\Integracao\DataTransformers\EmpreendimentoTransformer;

class IntegracaoService
{
    public function __construct(protected DataReader $reader)
    {
    }

    public function importarEmpreendimentos(string $empresa)
    {
        // Lê os dados para importação
        $data = $this->reader->read($empresa);

        foreach ($data as $empreendimento) {
            // Transforma os dados para o formato do banco
            $empreendimento = EmpreendimentoTransformer::fromSite($empresa, $empreendimento);

            // Salva ou atualiza o empreendimento no banco
            $empreendimento = Empreendimento::updateOrCreate(
                ['codigo_externo' => $empreendimento['codigo_externo']],
                $empreendimento
            );

            ProcessaEmpreendimento::dispatch($empreendimento);
        }

        // Disparar evento para atualizar totais
        ImportacaoConcluida::dispatch();
    }
}
