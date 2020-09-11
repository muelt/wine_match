<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sex', 'age', 'address', 'type_of_wine', 'verify_of_wine', 'producing_area', 'favorite_food', 'price_range', 'favorite_restaurant', 'image', 'self_introduction',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function toUserIds(){
        // [User->多Like]という関係のためhasManyを使う
        // hasMany(紐付けたい子のフルパス, 紐付けたい子の外部キー, 自(親)モデルの主キー)
        return $this->hasMany('App\Like', 'to_user_id', 'id');
    }

    public function fromUserIds(){
        return $this->hasMany('App\Like', 'from_user_id', 'id');
    }

    public function chatMessages(){
        return $this->hasMany('App\ChatMessage', 'user_id', 'id');
    }

    public function ChatRoomUsers(){
        return $this->hasMany('App\ChatRoomUsers', 'user_id', 'id');
    }
}
