<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewUserRegistered as NewUserRegisteredNotification;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewUserRegistered $event)
    {
        // Send notification to the admin or any other recipient
        Notification::route('mail', 'admin@example.com')
                    ->notify(new NewUserRegisteredNotification($event->user));
    }
}
