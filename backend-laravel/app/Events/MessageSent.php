<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $userId;
    public $message;
    public $role;
    public function __construct($userId, $message, $role)
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->role = $role;
    }
    public function broadcastOn(): Channel
    {
        return new Channel('chatroom'.$this->userId);
    }
    public function broadcastAs()
    {
        return 'MessageSent'; // Tên sự kiện Pusher
    }
}