<?php

namespace App\Data;

use App\Models\Empreendimento;

class DashboardData
{
    public static function get()
    {
        $empreendimentos = Empreendimento::query()
            ->select('pid', 'nome', 'empresa', 'end_bairro', 'end_cidade', 'link', 'thumb', 'latitude', 'longitude', 'processado')
            ->orderBy('criado_em', 'desc')
            ->get();

        return [
            'totais' => [
                'cadastrados' => $empreendimentos->count(),
                'pendentes' => $empreendimentos->where('processado', false)->count(),
                'bild' => $empreendimentos->where('empresa', 'bild')->count(),
                'vitta' => $empreendimentos->where('empresa', 'vitta')->count(),
            ],
            'ultimosEmpreendimentos' => $empreendimentos->take(10)->toArray(),
        ];
    }
}
