<?php

namespace App\Listeners;

use App\Category;
use App\Events\UserCreated as UserCreatedEvent;

class UserCreated
{
    /**
     * Handle the event.
     *
     * @param UserCreatedEvent $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        $categoryNames = ['Work', 'Home', 'Study', 'Other'];

        $i = 1;
        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->name = $name;
            $category->order = $i++;
            $category->user_id = $event->user->id;
            $category->save();
        }
    }
}
