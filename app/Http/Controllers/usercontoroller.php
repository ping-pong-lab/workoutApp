<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutHabbitTable;
use App\Models\LogsTable;
use App\Models\UserInfo;
use Validator;

class usercontoroller extends Controller
{
    //ユーザーホーム・ログ・設定表示
    public function userHome(Request $request){
        // Habbit取得
        $others = WorkoutHabbitTable::where('week', 'not like', '%'.date('w').'%')->get(); 
        $today = WorkoutHabbitTable::where('week', 'like', '%'.date('w').'%')->get(); 
        $all = WorkoutHabbitTable::all();

        // callender取得
        // 今日の日付取得
        $ym = date('Y-m');//2020-02
        $calender = $this->calender($ym);
        // 引数用に設定
        $calender['othersHabbit'] = $others;
        $calender['todayHabbit'] = $today;
        $calender['allHabbit'] = $all;

        return view('user.home',$calender);
    }
    // カレンダー作成関数
    public function calender($ym){
        date_default_timezone_set('Asia/Tokyo');
        $timestamp = strtotime($ym . '-01');    // タイムスタンプを作成し、フォーマットをチェックする
        if ($timestamp === false) {
            $ym = date('Y-m');
            $timestamp = strtotime($ym . '-01');
        }
        $today = date('Y-m-j'); // 今日の日付 フォーマット 例）2018-07-3
        $html_title = date('Y年n月', $timestamp);   // カレンダーのタイトルを作成 例）2017年7月
        $html_titledata = date('Y-m', $timestamp);   // カレンダーのタイトルを作成 例）2017-7

        // 前月・次月の年月を取得
        $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
        $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
        $day_count = date('t', $timestamp); // 該当月の日数を取得
        $youbi = date('w', $timestamp); //1日が何曜日か

        //カレンダー作成
        $weeks = [];
        $week = '';
        $week .= str_repeat('<td></td>', $youbi);   // 第１週目：空のセルを追加
        for ( $day = 1; $day <= $day_count; $day++, $youbi++) {
            $date = $ym . '-' . $day;   //2020-01-1

            $LogDate = $ym . '-' .sprintf('%02d', $day);//2020-01-01
            $Log = LogsTable::where('Date','like', $LogDate.'%')->first(); //$dateに一致するLogTable検索

            if (($today == $date)||!empty($Log->Date)) { //$dateが今日OR LogTableにLogが存在する場合
                if (($today == $date) && !empty($Log->Date)) {
                    // 今日かつLogが存在する
                    $week .= '<td class="today log day"><label class="dayLabel">' . $day . '</label>';
                }else if(($today == $date) && empty($Log->Date)){
                    // 今日のみ
                    $week .= '<td class="today day"><label class="dayLabel">' . $day . '</label>';
                }else if(!empty($Log->Date) && ($today !== $date) ){
                    // Logが存在するのみ
                    $week .= '<td class="log day"><label class="dayLabel">' . $day . '</label>';
                }
            } else {
                $week .= '<td class="day"><label class="dayLabel">' . $day . '</label>';
            }
            $week .= '</td>';
            // 週終わり、または、月終わりの場合
            if ($youbi % 7 == 6 || $day == $day_count) {
                if ($day == $day_count) {
                    // 月の最終日の場合、空セルを追加
                    // 例）最終日が木曜日の場合、金・土曜日の空セルを追加
                    $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
                }
            // weeks配列にtrと$weekを追加する
            $weeks[] = '<tr>' . $week . '</tr>';

            // weekをリセット
            $week = '';
            }
        }
        $param = ['weeks'=>$weeks, 'html_title'=>$html_title, 'html_titledata'=>$html_titledata, 'prev'=>$prev, 'next'=>$next, 'month'=>$ym, 'today'=>$today];
        return $param;
    }
    // habbit登録
    public function addHabit(Request $request){
        $this->validate($request, WorkoutHabbitTable::$rules, WorkoutHabbitTable::$messages);
        $session_userID = session()->get('userID');

        $addHabbit = new WorkoutHabbitTable;
        $addHabbit->WorkoutName = $request->workoutName;
        $addHabbit->Week = implode(',',$request->week);
        $addHabbit->Explanation = $request->explanation;
        $addHabbit->UserID = $session_userID;
        $addHabbit-> save();
        return redirect('/user');
    }
    // Habbit更新
    public function updateHabbit(Request $request){
        $this->validate($request, WorkoutHabbitTable::$rules, WorkoutHabbitTable::$messages);
        $upHabbit = WorkoutHabbitTable::where('WorkoutID',$request->id)->first();
        $upHabbit->WorkoutName = $request->workoutName;
        $upHabbit->Week = implode(',',$request->week);
        $upHabbit->Explanation = $request->explanation;
        $upHabbit-> save();
        return redirect('/user');
    }
    // Habbit削除
    public function deleteHabbit(Request $request){
        // data = (2) ["5", "8"]
        $a =[];
        $request = file_get_contents("php://input");
        $item = json_decode($request,true);
        foreach ($item as $value) {
            array_push($a,$value);
            $deleteHabbit = WorkoutHabbitTable::where('WorkoutID',$value)->delete();
            $deleteLog = LogsTable::where('WorkoutID',$value)->delete();
        }
        return redirect('/user');
    }

    // Logに記録
    public function addLog(Request $request){
        $session_userID = session()->get('userID');
        date_default_timezone_set('Asia/Tokyo');
        $date = date("Y/m/d H:i:s");
        $workoutID = $request->workoutID;

        $addLog = new LogsTable;
        $addLog->Date = $date;
        $addLog->WorkoutID = $workoutID;
        $addLog->UserID = $session_userID;
        $addLog->save();
        return redirect('/user');
    }
    // 表示用Log取得
    public function getLog(Request $request){
        $param = [];
        $date = $request->date;
        $Log = LogsTable::where('Date','like', $date.'%')->get();

        foreach ($Log as $Log) {
            $param[] = [
                'logID' => $Log->LogID,
                'date' => date('H:i',strtotime($Log->Date)),
                'habbitName'  => $Log->habbitInfo->WorkoutName,
            ];
        }
        return $param;
    }
    // 編集用Log取得
    public function getEditLog(Request $request){
        $param = [];
        $logID = $request->logID;
        $Log = LogsTable::where('LogID',$logID)->first();
        $workOut = WorkoutHabbitTable::all();
        $param = [
            'Log' => $Log,
            'workOut' => $workOut
        ];
        return $param;
    }

    // Log更新
    public function upLog(Request $request){
        $id = $request->logID;
        $date = $request->date;
        $time = $request->time;
        $datetime = date('Y-m-d H:i:s' ,strtotime($date.$time));

        $upLog = LogsTable::where('LogID',$id)->first();
        $upLog->Date = $datetime;
        $upLog->WorkoutID = $request->workout;
        $upLog-> save();
        return redirect('/user');
    }
    // Log削除
    public function delLog(Request $request){
        $id = $request->logID;
        LogsTable::where('LogID',$id)->delete();
        return redirect('/user');
    }


}
