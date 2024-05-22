<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentRegister {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $aluno;
    public $curso_id;
    public $turma_id;

    public function __construct($aluno, $curso_id, $turma_id) {
        $this->aluno = $aluno;
        $this->curso_id = $curso_id;
        $this->turma_id = $turma_id;
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
