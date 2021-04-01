{{--パスワード再設定画面--}}
@extends('login.layouts.loginLayout')

{{--  ページタイトル  --}}
@section('title','Reregistration')

{{--  css/js  --}}
@section('css')
    <link href="css/loginPage.css" rel="stylesheet" type="text/css">
@endsection
{{-- @section('js')
    <script src="js/" type="text/javascript" charset="utf-8"></script>
@endsection --}}
@section('other')

@endsection

{{--  本文  --}}
@section('body')
    <p id="formTitle">
        パスワード再設定ページ
    </p>
    @if(isset($mail_error))
        <p id="mailCheck">
            存在しないメールアドレスです。
        </p>
    @endif
    <div>
        <form method="POST" action="/forgetPass">
            {{csrf_field()}}
            <table id="mailForm">
                <caption>メールアドレスを入力してください。</caption>
                <tr>
                    <td><input type="text" name="mailAd" class="formParts"></td>
                </tr>
            </table>
            <input type="submit" name="submit" class="submit" value="送信">
        </form>
        <button class="submit" id="cancelButton">キャンセル</button>
    </div>
@endsection