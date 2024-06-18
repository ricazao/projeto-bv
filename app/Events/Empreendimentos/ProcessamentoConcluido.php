<?php

namespace App\Events\Empreendimentos;

use App\Models\Empreendimento;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProcessamentoConcluido implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct(Empreendimento $empreendimento)
    {
        $this->data = [
            'pin' => [
                'pid' => $empreendimento->pid,
                'nome' => $empreendimento->nome,
                'latitude' => $empreendimento->latitude,
                'longitude' => $empreendimento->longitude,
            ],
            'totais' => [
                'pendentes' => Empreendimento::where('processado', false)->count(),
            ],
        ];
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('dashboard'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'empreendimentos.processamento.concluido';
    }

    public function broadcastQueue(): string
    {
        return 'notificacoes';
    }
}
