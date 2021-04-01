{{--  レイアウトの継承  --}}
@extends('login.layouts.loginLayout')

{{--  ページタイトル  --}}
@section('title','loginPage')

{{--  css/js  --}}
@section('css')
    <link href="css/loginPage.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
    
@endsection

{{--  本文  --}}
@section('body')
    <p id="formTitle">
        ログインページ<br>
        <a href="/signUp" class="aTag">初めての方はこちら</a>
    </p>
    @if(isset($login_error))
        <p id="loginCheck">
            メールアドレスまたはパスワードが間違っています。
        </p>
    @endif
    <div id="formBox">
        <form method="POST" action="/">
            {{csrf_field()}}
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="mailAd"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="passWord"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Login"><br>
                    <a href="/forgetPass" class="aTag">パスワードを忘れた場合はこちら</a></td>
                </tr>
            </table>
        </form>
    </div>
@endsection