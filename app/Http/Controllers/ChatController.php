<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Channel;
use Illuminate\Support\Facades\DB;
use App\Events\EventMessage;
use App\Events\EventChannel;

class ChatController extends Controller
{


    /* get live chat channels */
    public function index()
    {
        try {
            $channels = Channel::all();
            return response()->json(['data' => $channels]);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage()]);
        }
    }


    public function addMessage($channel, $message)
    {
        //validation here

        DB::beginTransaction();
        try {

            if ($channel != 'null') {
                $channel = Channel::whereName($channel)->get();
            } else {
                $channel = Channel::create([
                    'name' => bin2hex(openssl_random_pseudo_bytes(16))
                ]);
                EventChannel::dispatch($channel);
            }

            /* add message to above channel */
            $message = Message::create([
                'channel_id' =>  $channel->id,
                'user_id' => 99999,
                'message' => $message
            ]);

            EventMessage::dispatch($channel, $message);
            DB::commit();

            return response()->json(['data' => $channel->name, 200]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['data' => $th->getMessage()]);
        }
    }
}
