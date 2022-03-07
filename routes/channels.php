<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('my-channel', function ($user, $channel) {
    // return (int) $user->id === (int) $id;
    return true;
});


// Broadcast::channel('channel.{channelName}', function ($user, $eventId) {
//     if(in_array($user->userType, ['admin', 'curator'])) {
//         return true;
//     }
//     return $user->tickets_event_id === Event::findOrNew($eventId)->tickets_event_id;
// });
