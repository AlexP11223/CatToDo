<?php

namespace App\Listeners;

use App\Events\UserCreated as UserCreatedEvent;

class UserCreated
{
    /**
     * Handle the event.
     *
     * @param UserCreatedEvent $event
     * @return mixed
     */
    public function handle(UserCreatedEvent $event)
    {
        // todo: create default categories, etc.
    }
}
