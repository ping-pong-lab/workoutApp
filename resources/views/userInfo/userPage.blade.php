{{--  レイアウトの継承  --}}
@extends('userInfo.layouts.userInfoLayouts')

{{--  ページタイトル  --}}
@section('title','userINFO')

{{--  css/js  --}}
@section('css')
    <link href="css/userInfo.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="js/userInfo.js" type="text/javascript" charset="utf-8"></script>
@endsection
@section('other')

@endsection

{{--  本文  --}}
@section('userInfo')
<div id="pageBody">
    <table id="userInfoTable" align="center">
        <caption>User Info</caption>
        <tr>
            <th>userID</th>
            <td>{{$user->UserID}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$user->Email}}</td>
        </tr>
        <tr>
            <th>氏名/ニックネーム</th>
            <td>{{$user->Name}}</td>
        </tr>
        <tr>
            <th>身長</th>
            <td>
                @if($user->Height)
                    {{$user->Height}}cm
                @endif
            </td>
        </tr>
        <tr>
            <th>体重</th>
            <td>
                @if($user->Weight)
                    {{$user->Weight}}Kg
                @endif
            </td>
        </tr>
    </table>
    <table id="anotherTable">
        <tr>
            <td><button class="userInfoButton" id="userInfoUP">ユーザー情報変更</button></td>
        </tr>
        <tr>
            <td><button class="userInfoButton" id="updatePass" data-id="{{$user->UserID}}">パスワードの変更</button></td>
        </tr>
        <tr>
            <td><button class="userInfoButton" id="logout">ログアウト</button></td>
        </tr>
        <tr>
            <td><button class="userInfoButton" id="userdelete">退会する</button></td>
        </tr>
    </table>
</div>
@endsection