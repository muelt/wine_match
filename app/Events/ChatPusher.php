<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


// Pusherに通知するためのイベント[ChatPusher]
class ChatPusher implements ShouldBroadcast // 追加
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Pusherに渡す情報をpublic $messageで設定しておく
    public $message; // 追加

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message) // 追加
    {
        $this->message = $message; // 追加
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
    
        return new Channel('ChatRoomChannel');

    }
}