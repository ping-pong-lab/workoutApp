{{--  レイアウトの継承  --}}
@extends('user.layouts.userLayouts')

{{--  ページタイトル  --}}
@section('title','home')

{{--  css/js  --}}
@section('css')
    <link href="css/userHome.css" rel="stylesheet" type="text/css">
    <link href="css/userLog.css" rel="stylesheet" type="text/css">
    <link href="css/userSet.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="js/userHome.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/userLog.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/userSet.js" type="text/javascript" charset="utf-8"></script>
@endsection
@section('other')

@endsection

{{--  本文(homeタブ))  --}}
@section('home')
unchi
@endsection