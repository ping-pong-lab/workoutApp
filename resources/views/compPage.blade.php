{{--  レイアウトの継承  --}}
@extends('login.layouts.loginLayout')

{{--  ページタイトル  --}}
@section('title','Completed!')

{{--  css/js  --}}
@section('css')
    <link href="../css/loginPage.css" rel="stylesheet" type="text/css">
    <link href="../css/compPage.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
    {{--  <script src="js/" type="text/javascript" charset="utf-8"></script>  --}}
@endsection
@section('other')
        <META http-equiv="Refresh" content="3;URL=/">
@endsection

{{--  本文  --}}
@section('body')
    <div id="compLabel" ><p id="comp">Completed!</p></div>
    <P id="MSG">{{$MSG}}</P>
    <p id="moveLabel">このページは数秒後にログインページへ遷移します。<br>
    ページが切り替わらない場合は<a href="http://127.0.0.1:8000/">こちら</a>をクリックしてください。<br>
    </p>
@endsection