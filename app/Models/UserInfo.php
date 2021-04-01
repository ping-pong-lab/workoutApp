<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserInfo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'UserInfoTable';
    protected $primaryKey = 'UserID';

    // 新規ユーザー登録validation
    protected $guarded = array('id'); //値を用意しておかない項目
    public static $rules = array( //新規登録時のルール
        'mail' => 'required|email|unique:userinfotable,Email',
        'passWord' => 'required|between:6,10|regex:/^[a-zA-Z0-9]+$/',
        'passWord2' => 'required|same:passWord',
        'name' => 'required',
    );
    public static $messages = array(
        'mail.required' => '必須項目です。',
        'mail.email' => 'メールアドレスを入力してください。',
        'mail.unique' => 'このメールアドレスはすでに登録されています。',
        'passWord.required' => '必須項目です。',
        'passWord.between' => 'パスワードは6-10文字で設定してください。',
        'passWord.regex' => '半角英数字で入力してください。',
        'passWord2.required' => '必須項目です。',
        'passWord2.same' => 'パスワードが一致しません。',
        'name.required' => '必須項目です。',
    );

    // パスワード更新Validation
    public static $passUpRules = array(
        'passWord' => 'required|between:6,10|regex:/^[a-zA-Z0-9]+$/',
        'passWord2' => 'required|same:passWord',
    );

    // 情報更新時のルール
    public static $updateRule = array(
        'mail' => 'required|email',
        'name' => 'required',
    );

}
