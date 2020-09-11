<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ChatRoom;
use App\ChatRoomUser;
use App\ChatMessage;
use App\User;
use Log;

use App\Events\ChatPusher;

use Auth;

class ChatController extends Controller
{
    public static function show(Request $request){
        Log::debug('$requestの中身は下記の通り');
        Log::debug($request);
        // 下の$request->user_idとして相手のidを取得
        $matching_user_id = $request->user_id;

        // 自分の持っているチャットルームを取得
        $current_user_chat_rooms = ChatRoomUser::where('user_id', Auth::id())
        ->pluck('chat_room_id');

        // 自分の持っているチェットルームからチャット相手のいるルームを探す
        $chat_room_id = ChatRoomUser::whereIn('chat_room_id', $current_user_chat_rooms)->where('user_id', $matching_user_id)->pluck('chat_room_id');

        // ログイン中のユーザーと、マッチングした相手とでチャットルームをつくっているかどうかを判定。なければチャットルームを新規作成する
        if($chat_room_id->isEmpty()){
            ChatRoom::create();//チャットルーム作成

            $latest_chat_room = ChatRoom::orderBy('created_at', 'desc')->first();//最新チャット

            $chat_room_id = $latest_chat_room->id;

            
            // 新規登録、モデル側、$fillableで許可したフィールドを指定して保存
            ChatRoomUser::create(
                ['chat_room_id' => $chat_room_id, 'user_id' => Auth::id()]);

            ChatRoomUser::create(
                ['chat_room_id' => $chat_room_id, 'user_id' => $matching_user_id]);
        
        }

        // チャットルーム取得時はオブジェクト型なので数値に変換
        if(is_object($chat_room_id)){
            $chat_room_id = $chat_room_id->first();
        }

        // チャット相手のユーザー情報を取得(下で使う)
        // findOrFailは例外処理

        $chat_room_user = User::findOrFail($matching_user_id);

        //  チャット相手のユーザー名を取得（JS用）
        $chat_room_user_name = $chat_room_user->name;

        $chat_messages = ChatMessage::where('chat_room_id', $chat_room_id)->orderby('created_at')->get();

        Log::debug('ログイン中のユーザーです');
        Log::debug(Auth::user());
        Log::debug('chat_room_idです');
        Log::debug($chat_room_id);
        Log::debug('$chat_room_userです');
        Log::debug($chat_room_user);
        Log::debug('$chat_messagesです');
        Log::debug($chat_messages);
        Log::debug('$chat_room_user_nameです');
        Log::debug($chat_room_user_name);
        return view('chat.show', compact('chat_room_id', 'chat_room_user', 'chat_messages', 'chat_room_user_name'));

    }

    // チャットが投稿されたらデータベースに保存した後、イベント発火する
    public static function chat(Request $request){

        $chat = new ChatMessage();
        $chat->chat_room_id = $request->chat_room_id;
        $chat->user_id = $request->user_id;
        $chat->message = $request->message;
        $chat->save();

        event(new ChatPusher($chat));
    }
}
