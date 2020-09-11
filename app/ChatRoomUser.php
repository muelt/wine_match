<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoomUser extends Model
{
    protected $fillable = ['chat_room_id', 'user_id'];

    public function charRoom(){
        return $this->belongsTo('App\ChatRoom', 'chat_room_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
