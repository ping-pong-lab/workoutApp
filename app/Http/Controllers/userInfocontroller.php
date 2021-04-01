<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\WorkoutHabbitTable;
use App\Models\LogsTable;
use Validator;

class userInfocontroller extends Controller
{
    //ページ表示
    public function page(Request $request){
        $user = $this->userInfo(); // user情報取得
        return view('userInfo.userPage',['user'=>$user]);
    }
    // 更新ページ表示
    public function updatepage(Request $request){
        $user = $this->userInfo(); // user情報取得
        return view('userInfo.upUserPage',['user'=>$user]);
    }
    // 退会ページ表示
    public function deletepage(Request $request){
        $user = $this->userInfo(); // user情報取得
        return view('userInfo.delUserPage',['user'=>$user]);
    }

    // user情報取得
    public function userInfo(){
        $session_userID = session()->get('userID');
        $user = UserInfo::where('UserID',$session_userID)->first();
        return $user;
    }

    // 情報更新
    public function update(Request $request){
        $this->validate($request, UserInfo::$updateRule, UserInfo::$messages);
        $userID = $request->id;
        $update = UserInfo::where('UserID',$userID)->first();
        $update->Email = $request->mail;
        $update->Name = $request->name;
        $update->Height = $request->height;
        $update->Weight = $request->weight;
        $update-> save();

        return redirect('/userInfo');
    }

    // 情報削除
    public function delete(Request $request){
        $userID = $request->userID;
        // ユーザー情報・ログ・WorkOut削除
        WorkoutHabbitTable::where('UserID',$userID)->delete();
        LogsTable::where('UserID',$userID)->delete();
        UserInfo::where('UserID',$userID)->first()->delete();

        $MSG = '退会処理が完了しました。';
        return view('compPage',['MSG'=>$MSG]);
    }


}
