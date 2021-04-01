{{--  レイアウトの継承  --}}
@extends('user.layouts.userLayouts')

{{--  ページタイトル  --}}
@section('title','home')

{{--  css/js  --}}
@section('css')
    <link href="{{asset('css/userHome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/userLog.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/userSet.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/userHome.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('js/userLog.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('js/userSet.js')}}" type="text/javascript" charset="utf-8"></script>
@endsection
@section('other')

@endsection

{{--  本文(homeタブ))  --}}    
@section('home')
@php
$week = ['日', '月', '火', '水', '木', '金', '土'];
@endphp
{{--  記録ボタン DBから持ってくる  --}}
<hr class="TaskLabel" data-symbol="Today's Task">
{{--  本日のタスク枠  --}}
@foreach ($todayHabbit as $item)  
    <div class="record">
        <a class="recordButton" href="#" onclick="document.Log_{{$item->WorkoutID}}.submit();">{{$item->WorkoutName}}</a>
        <form method="POST" action="/user/addLog" name="Log_{{$item->WorkoutID}}">
            {{csrf_field()}}
            <input type="hidden" name="workoutID" value="{{$item->WorkoutID}}">
        </form>
    </div>
@endforeach
<hr class="TaskLabel" data-symbol="Other Task">
{{--  それ以外のタスク  --}}
@foreach ($othersHabbit as $item)
    <div class="record otherRecord">
        <a class="recordButton" href="#" onclick="document.Log_{{$item->WorkoutID}}.submit();">{{$item->WorkoutName}}</a>
        <p class="infoWeek">
            @php
                $taskWeek = explode(',', $item->Week);
                foreach($taskWeek as $value){
                    echo $week[$value];
                }
            @endphp
        </p>
        <form method="POST" action="/user/addLog" name="Log_{{$item->WorkoutID}}">
            {{csrf_field()}}
            <input type="hidden" name="workoutID" value="{{$item->WorkoutID}}">
        </form>
    </div>
@endforeach

{{--  新規登録ボタン  DBに登録 --}}
<div class="record" id="addRecord">
    <a class="recordButton" id="addRecordButton" href="#"><span>+</span></a>
    <div class="recordFrame" id="addRecordFrame">
        <form id="addRecordForm" method="POST" action="/user/addHabit">
            {{csrf_field()}}
            <table class="recordTable" id="addRecordTable">
                <tr>
                    <td colspan="2"><input type="text" value="{{old('workoutName')}}" name="workoutName" placeholder="トレーニングを入力" style="width: 100%"><br>
                    @if ($errors->has('workoutName'))
                        <span class="ErrMsg">{{$errors->first('workoutName')}}</span>
                    @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="explanation" placeholder="トレーニングの説明" style="width: 100%">{{old('explanation')}}</textarea><br>
                    @if ($errors->has('explanation'))
                        <span class="ErrMsg">{{$errors->first('explanation')}}</span>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>曜日</th>
                    <td><input type="checkbox" name="week[]" value="1" {{ is_array(old("week")) && in_array("1", old("week"), true)? ' checked' : '' }}>月
                        <input type="checkbox" name="week[]" value="2" {{ is_array(old("week")) && in_array("2", old("week"), true)? ' checked' : '' }}>火
                        <input type="checkbox" name="week[]" value="3" {{ is_array(old("week")) && in_array("3", old("week"), true)? ' checked' : '' }}>水
                        <input type="checkbox" name="week[]" value="4" {{ is_array(old("week")) && in_array("4", old("week"), true)? ' checked' : '' }}>木
                        <input type="checkbox" name="week[]" value="5" {{ is_array(old("week")) && in_array("5", old("week"), true)? ' checked' : '' }}>金
                        <input type="checkbox" name="week[]" value="6" {{ is_array(old("week")) && in_array("6", old("week"), true)? ' checked' : '' }}>土
                        <input type="checkbox" name="week[]" value="0" {{ is_array(old("week")) && in_array("0", old("week"), true)? ' checked' : '' }}>日
                        <input type="checkbox" name="allday" value="">毎日<br>
                        @if ($errors->has('week'))
                            <span class="ErrMsg">{{$errors->first('week')}}</span>
                        @endif
                    </td>
                </tr>
                {{--  <input type="hidden" name="userID" value="{{$session_id}}">  --}}
                <tr><td colspan="2"><input type="submit" name="submit" value="登録"></td></tr>
            </table>
        </form>
    </div>
</div>
@endsection

{{--  本文(Logタブ) --}}
@section('log')
<hr class="noneHR">
@include('user.logPage')
@endsection

{{--  本文(Settingタブ)  --}}
@section('setting')
<hr class="noneHR">
@include('user.settingPage')
@endsection