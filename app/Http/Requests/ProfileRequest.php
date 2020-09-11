<?php
// プロフィールを編集する際にもバリデーションが必要
// フォームリクエストクラスを使って対応する
// これはコマンドプロンプトでphp artisan make:request ProfileRequestと入力することで生成されたファイル

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 
use Auth;


class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // ユーザーがデータを更新するための権限を持っているかどうかを確認するために使う
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    // バリデーションルールを記載する
    public function rules()
    {
        // ログイン済みユーザーのメアドを変数に格納
        $myEmail = Auth::user()->email;

        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 
                        'string', 
                        'email', 
                        'max:255', 
                        // ユーザー情報のメアドがユニークであるか確認し、ログイン済みユーザーのメアドをバリデーション除外する
                        Rule::unique('users', 'email')->whereNot('email', $myEmail)],   
        ];
    }
}
