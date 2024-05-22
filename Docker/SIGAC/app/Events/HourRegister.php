<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HourRegister {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $categoria_id;
    public $atividade;
    public $horas;
    
    public function __construct($user, $categoria_id, $atividade, $horas) {
        $this->user = $user;
        $this->categoria_id = $categoria_id;
        $this->atividade = $atividade;
        $this->horas = $horas;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
