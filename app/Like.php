<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // Likeモデルでは不要のため無効化
    public $incrementing = false;//インクリメントIDを無効化
    public $timestamps = false;//update_at, created_atを無効化

    // UserモデルはLikeモデルからそれぞれ1つのidを参照したいのでbelongsToを使う
    // belongsTo(紐付けたい親のフルパス, 紐付けたい自分の外部キー, 紐付けたい親の主キー)
    public function toUserId(){
        return $this->belongsTo('App\User', 'to_user_id', 'id');
    }

    public function fromUserId(){
        return $this->belongsTo('App\User', 'from_user_id', 'id');
    }


}
