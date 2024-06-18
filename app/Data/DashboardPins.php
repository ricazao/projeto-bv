<?php

namespace App\Data;

use App\Models\Empreendimento;

class DashboardPins
{
    public static function get()
    {
        $pins = Empreendimento::query()
            ->select('pid', 'nome', 'latitude', 'longitude')
            ->where('processado', true)
            ->get()
            ->toArray();

        return [
            'pins' => $pins,
        ];
    }
}
