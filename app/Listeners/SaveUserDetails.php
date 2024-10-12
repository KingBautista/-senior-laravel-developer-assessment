<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Detail;

class SaveUserDetails
{
    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        Detail::updateOrCreate(
            [
                'user_id' => $event->user->id,
                'key' => 'full_name'
            ],
            [
                'key' => 'full_name',
                'value' => $event->user->fullname,
                'type' => 'bio'
            ]
        );

        Detail::updateOrCreate(
            [
                'user_id' => $event->user->id,
                'key' => 'middle_initial'
            ],
            [
                'key' => 'middle_initial',
                'value' => $event->user->middleinitial,
                'type' => 'bio'
            ]
        );

        Detail::updateOrCreate(
            [
                'user_id' => $event->user->id,
                'key' => 'avatar'
            ],
            [
                'key' => 'avatar',
                'value' => $event->user->avatar,
                'type' => 'bio'
            ]
        );
    }
}
