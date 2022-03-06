<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'channel_id',
        'status'
    ];


    public function channels()
    {
        return $this->belongsTo(Message::class);
    }

}
