<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\PostCreationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreationNotification;

class PostCreationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreationEvent $event): void
    {
        $user = auth()->user();
        $admins = User::role('admin')->get();
        $delay = now()->addMinutes(1);
        
        Notification::send($admins, new PostCreationNotification($event->post));
        $user->notify((new PostCreationNotification($event->post))->delay($delay));
    }
}
