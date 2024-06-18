<?php

namespace App\Jobs;

use App\Actions\GoogleMaps\Geocode;
use App\Events\Empreendimentos\ProcessamentoConcluido;
use App\Models\Empreendimento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessaEmpreendimento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Empreendimento $empreendimento)
    {
    }

    public function handle(): void
    {
        if ($this->empreendimento->processado) {
            return;
        }

        // Obtem UF, latitute e longitude do endereço através da API do Google Maps
        $endereco = implode(', ', [
            $this->empreendimento->end_logradouro,
            $this->empreendimento->end_numero,
            $this->empreendimento->end_bairro,
            $this->empreendimento->end_cidade,
        ]);

        $geocode = Geocode::run($endereco);

        if ($geocode) {
            $this->empreendimento->update([
                'latitude' => $geocode['latitude'],
                'longitude' => $geocode['longitude'],
                'uf' => $geocode['uf'],
                'processado' => true,
            ]);

            // Dispara evento
            ProcessamentoConcluido::dispatch($this->empreendimento);
        }
    }
}
