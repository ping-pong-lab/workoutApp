{{--  レイアウトの継承  --}}
@extends('login.layouts.loginLayout')

{{--  ページタイトル  --}}
@section('title','signupPage')

{{--  css/js  --}}
@section('css')
    <link href="css/loginPage.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="js/login_validation.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/login_action.js" type="text/javascript" charset="utf-8"></script>
@endsection

{{--  本文  --}}
@section('body')
    <p id="formTitle">
        新規登録ページ
    </p>
    <p class="ErrMsg" style="text-align: center"> 
        @if (count($errors)>0)
            入力に誤りがあります。再入力してください。
        @endif
    </p>
    <div id="formBox">
        <form id="suForm" method="POST" action="/signUp">
            {{csrf_field()}}
            <table id="signUpForm">
                <tr>
                    <td>*Email</td>
                    <td><input type="text" name="mail" value="{{old('mail')}}" placeholder="TARO_YAMADA@XXXX.com" class="formParts"><br>
                        @if ($errors->has('mail'))
                        <span class="ErrMsg">{{$errors->first('mail')}}</span>
                        @endif
                    </td>
                    <td><span class="info"></span>
                        <p class="infTip">メールアドレスを入力してください。</p>
                    </td>
                </tr>
                <tr>
                    <td>*Password</td>
                    <td><input type="password" name="passWord" class="formParts"><br>
                        @if ($errors->has('passWord'))
                        <span class="ErrMsg">{{$errors->first('passWord')}}</span>
                        @endif
                    </td>
                    <td><span class="info"></span>
                        <p class="infTip">6-10文字,半角英数字で入力してください</p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="password" name="passWord2" class="passcheck formParts"><br>
                        @if ($errors->has('passWord2'))
                        <span class="ErrMsg">{{$errors->first('passWord2')}}</span>
                        @endif
                    </td>
                    <td><span class="info"></span>
                        <p class="infTip">再度パスワードを入力してください。</p>
                    </td>
                </tr>
                <tr><td colspan="2">--以下情報を入力してください。--</td></tr>
                <tr>
                    <td>*氏名/ニックネーム</td>
                    <td><input type="text" name="name" value="{{old('name')}}" placeholder="たろう" class="formParts"><br>
                        @if ($errors->has('name'))
                        <span class="ErrMsg">{{$errors->first('name')}}</span>
                        @endif
                    </td>
                    <td><span class="info"></span>
                        <p class="infTip">アプリ内で使用する名前です。</p>
                    </td>
                </tr>
                <tr>
                    <td>身長</td>
                    <td><input type="number" step="0.1" name="height" value="{{old('height')}}" placeholder="170.5" class="formParts-50">cm<br>
                        @if ($errors->has('height'))
                        <span class="ErrMsg">{{$errors->first('height')}}</span>
                        @endif
                    </td>
                    <td><span class="info"></span>
                        <p class="infTip">小数点1位まで入力してください。</p>
                    </td>
                </tr>
                <tr>
                    <td>体重</td>
                    <td><input type="number" step="0.1" name="weight" value="{{old('weight')}}" placeholder="65.5" class="formParts-50">Kg<br>
                        @if ($errors->has('weight'))
                        <span class="ErrMsg">{{$errors->first('weight')}}</span>
                        @endif
                    </td>
                    <td><span class="info"></span>
                        <p class="infTip">小数点1位まで入力してください。</p>
                    </td>
                </tr>
            </table>
            <p><input type="submit" name="submit" class="submit" id="submitButton" value="登録"></p>
        </form>
        <button class="submit" id="cancelButton">キャンセル</button>
    </div>
@endsection