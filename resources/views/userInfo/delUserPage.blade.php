{{--  レイアウトの継承  --}}
@extends('userInfo.layouts.userInfoLayouts')

{{--  ページタイトル  --}}
@section('title','DELETEINFO')

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
        <caption>User Info</caption>
        <form id="deleteForm" method="POST" action="/userInfo/delete">
            {{csrf_field()}}
            <tr>
                <th>userID</th>
                <td>{{$user->UserID}}
                    <input type="hidden" name="userID" value="{{$user->UserID}}">
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$user->Email}}</td>
            </tr>
            <tr>
                <th>氏名/ニックネーム</th>
                <td>{{$user->Name}}</td>
            </tr>
        </form>
    </table>
    <div id="delComment">
        <p id="delMSG">本当に退会しますか？</p>
        <button class="userInfoButton" id="delete">退会する</button>
        <button class="userInfoButton" id="back">キャンセル</button>
    </div>
@endsection