{{--パスワード再設定画面--}}
@extends('login.layouts.loginLayout')

{{--  ページタイトル  --}}
@section('title','Reregistration')

{{--  css/js  --}}
@section('css')
    <link href="../css/loginPage.css" rel="stylesheet" type="text/css">

@endsection
@section('js')
    <script src="../js/login_validation.js" type="text/javascript" charset="utf-8"></script>
@endsection
@section('other')

@endsection

{{--  本文  --}}
@section('body')
    <p id="formTitle">
        パスワード再設定ページ
    </p>
    <p class="ErrMsg" style="text-align: center"> 
    @if (count($errors)>0)
    入力に誤りがあります。再入力してください。
    @endif
    </p>
    <div id="frame">
        <form method="POST" action="/forgetPass/registration">
            <input type="hidden" name="id" value="{{$userData->UserID}}">
            {{csrf_field()}}
            <table id="regiForm">
                <caption>新しいパスワードを入力し、再設定ボタンをクリックしてください。</caption>
                <tr>
                    <th>Email</th>
                    <td><input type="text" name="mail" class="formParts" value="{{$userData->Email}}" readonly></td>
                </tr>
                <tr>
                    <th>New Password</th>
                    <td><input type="password" name="passWord" class="formParts">
                        @if ($errors->has('passWord'))
                        <br><span class="ErrMsg">{{$errors->first('passWord')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>New Password(confirm)</th>
                    <td><input type="password" name="passWord2" class="formParts passcheck">
                        @if ($errors->has('passWord2'))
                        <br><span class="ErrMsg">{{$errors->first('passWord2')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="再設定"></td>
                </tr>
            </table>
        </form>
    </div>
@endsection