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

    CONST MESSAGE_WAS_READ = 'read';
    CONST MESSAGE_WAS_NOT_READ = 'not_read';

    /* get live chat channels */
    public function index()
    {
        try {
            $channels = Channel::whereStatus('active')->with(['messages'])->get();
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

            if ($channel !== 'null') {
                $channelModel = Channel::whereName($channel)->first();
            } else {
                $channelModel = Channel::create([
                    'name' => bin2hex(openssl_random_pseudo_bytes(4))
                ]);
            }

            /* add message to above channel */
            $message = Message::create([
                'channel_id' =>  $channelModel->id,
                'user_id' => 99999,
                'message' => $message
            ]);

            /* send event to admin to listen only if it's new */
            if($channelModel->wasRecentlyCreated) {
                EventChannel::dispatch($channelModel);
            }

            EventMessage::dispatch($channelModel, $message);
            DB::commit();

            return response()->json(['data' => $channelModel->name], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['data' => $th->getMessage()]);
        }
    }

    public function updateMessageStatus($channel) {
        $channel = Channel::find($channel);

        if(!$channel) {
            return response()->json(['data' => 'Error - model missing'], 500);
        }

        foreach ($channel->messages as $message) {
            $message->status = self::MESSAGE_WAS_READ;
            $message->save();
        }

        return response()->json(['data' => 'All done'], 200);

    }
}
