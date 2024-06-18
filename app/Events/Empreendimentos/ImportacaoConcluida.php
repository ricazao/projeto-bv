<?php

namespace App\Events\Empreendimentos;

use App\Data\DashboardData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportacaoConcluida implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct()
    {
        $this->data = DashboardData::get();
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('dashboard'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'empreendimentos.importacao.concluida';
    }

    public function broadcastQueue(): string
    {
        return 'notificacoes';
    }
}
