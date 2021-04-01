{{--  レイアウトの継承  --}}
@extends('userInfo.layouts.userInfoLayouts')

{{--  ページタイトル  --}}
@section('title','UPDATEINFO')

{{--  css/js  --}}
@section('css')
    <link href="../css/userInfo.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="../js/userInfo.js" type="text/javascript" charset="utf-8"></script>
@endsection
@section('other')

@endsection

{{--  本文  --}}
@section('userInfo')
    <table id="userInfoTable" align="center">
        <caption>ユーザー情報の変更</caption>
        <p class="ErrMsg" style="text-align: center"> 
            @if (count($errors)>0)
                入力に誤りがあります。再入力してください。
            @endif
        </p>
        <form id="updateForm" method="POST" action="/userInfo/update">
            {{csrf_field()}}
            <tr>
                <th>userID</th>
                <td>{{$user->UserID}}
                    <input type="hidden" name="id" value="{{$user->UserID}}">
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="text" name="mail" value="{{count($errors)>0 ? old('mail') : $user->Email }}">
                    @if ($errors->has('mail'))
                    <br><span class="ErrMsg">{{$errors->first('mail')}}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>氏名/ニックネーム</th>
                <td><input type="text" name="name" value="{{count($errors)>0 ? old('name') : $user->Name }}">
                    @if ($errors->has('name'))
                    <br><span class="ErrMsg">{{$errors->first('name')}}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>身長</th>
                <td><input type="number" name="height" value="{{count($errors)>0 ? old('height') : $user->Height }}">
                    @if ($errors->has('height'))
                    <br><span class="ErrMsg">{{$errors->first('height')}}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>体重</th>
                <td><input type="number" name="weight" value="{{count($errors)>0 ? old('weight') : $user->Weight }}">
                    @if ($errors->has('weight'))
                    <br><span class="ErrMsg">{{$errors->first('weight')}}</span>
                    @endif
                </td>
            </tr>
        </form>
            <tr>
                <td colspan="2" id="lastTd">
                    <button class="userInfoButton" id="update">ユーザー情報変更</button>
                    <button class="userInfoButton" id="back">戻る</button>
                </td>
            </tr>
        </table>
@endsection