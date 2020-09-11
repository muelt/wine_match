<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 認証済みであれば表示、認証していなければ/loginにリダイレクトされるようになっている
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    // Route::get('/home', 'HomeController@index')->name('home');でルーティング設定しているトップ画面
    public function index()
    {
        // ユーザーの情報を全て取ってきて(Eloquent: User::all())、ビューファイルに渡す
        $users = User::all();


        $userCount = $users->count();//全ユーザーの数を取得
        $from_user_id = Auth::id();//現在ログインしているユーザーのIDを取得

        // compactメソッドで複数の変数をビュー側(home.blade.php)へ渡す
        return view('home', compact('users', 'userCount', 'from_user_id'));
    }
}
