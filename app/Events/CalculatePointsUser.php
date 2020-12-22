<?php

namespace App\Events;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CalculatePointsUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderProduct;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $orderProduct)
    {
        $this->orderProduct = $orderProduct;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
