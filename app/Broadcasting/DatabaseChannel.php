<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Channels\DatabaseChannel as DBO;

class DatabaseChannel extends DBO
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }
    protected function buildPayload($notifiable, Notification $notification)
    {
        return [
            'id' => $notification->id,
            'type' => get_class($notification),
            'data' => ['data' => serialize($notification)],
            'read_at' => null,
            'serialized' => true
        ];
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): array|bool
    {
        //
    }

}
