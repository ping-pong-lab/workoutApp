<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\Models\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Validator;

class logincontroller extends Controller
{
    // ログインページを表示
    public function showLoginPage(Request $request){
        return view('login.loginPage');
    }


    // ログイン処理
    public function login(Request $request){
        $user = UserInfo::where('Email',$request->mailAd)->get();
        if (count($user) === 0){
            return view('login.loginPage', ['login_error' => '1']);
        }
        // 一致
        if ($request->passWord == $user[0]->Password) {
            // セッション
            session(['name'  => $user[0]->Name]);
            session(['email' => $user[0]->Email]);
            session(['userID' => $user[0]->UserID]);

            // フラッシュ
            session()->flash('flash_flg', 1);
            session()->flash('flash_msg', 'ログインしました。');

            return redirect(url('/user'));
            
         // 不一致
         }else{
             return view('login.loginPage', ['login_error' => '1']);
         }
    } 
    // ログアウト
    public function logout(Request $request)
    {
        session()->forget('name');
        session()->forget('email');
        $MSG = 'ログアウトしました。';
        return view('compPage',['MSG'=>$MSG]);
    }  



    // 新規登録ページを表示
    public function showSignUpPage(){
        return view('login.signUpPage');
    }
    // 新規登録Validation+DB登録
    public function signUp(Request $request){
            $this->validate($request, UserInfo::$rules, UserInfo::$messages);
            $UserInfo = new UserInfo;
            $UserInfo->Email = $request->mail;
            $UserInfo->Password = $request->passWord;
            $UserInfo->Name = $request->name;
            $UserInfo->Height = $request->height;
            $UserInfo->Weight = $request->weight;
            $UserInfo-> save();
            return redirect('/login/comp');
    }

    // パスワード再設定ページを表示
    public function forgetPass(Request $request){
        return view ('login.forgetPass');
    }
    // 再設定メール送信
    public function sendMail(Request $request){
        $usermail = UserInfo::where('Email',$request->mailAd)->first();
        // if (count($usermail) === 0){
        //     return view('login.forgetPass', ['mail_error' => '1']);
        if (!$usermail){
            return view('login.forgetPass', ['mail_error' => '1']);

        }else{
            // 送信処理という体で
            $name = $usermail->Name;
            $to = $request->mailAd;
            $id = $usermail->UserID;
            return view('login.mail.mail_forgetpass',['name'=>$name,'mail'=>$to, 'id'=>$id]);
            // Mail::send('login.mail.mail_forgetpass', ['name'=>$name,'mail'=>$mail], function($message,$mail) {
            //     $message
            //         ->to($mail)
            //         ->subject("パスワード再設定用URLのご連絡");
            // });
        }
    }
    // パスワード再設定画面を表示
    public function registration(Request $request){
        $userData = UserInfo::where('UserID',$request->XXX)->first();
        return view('login.reregistration',['userData'=>$userData]);
    }
    // 新パスワードをDB更新
    public function passUpdate(Request $request){
        $this->validate($request, UserInfo::$passUpRules, UserInfo::$messages);
        $newpass = UserInfo::where('UserID',$request->id);
        $newpass-> update(['Password' => $request->passWord]);
        $MSG = 'パスワード更新が完了しました。';
        return view('compPage',['MSG'=>$MSG]);
    }

    // Compページの表示＋画面遷移
    // public function comp(Request $request){
    //     return view('compPage',['MSG'=>$request->MSG]);
        
    // }
}
