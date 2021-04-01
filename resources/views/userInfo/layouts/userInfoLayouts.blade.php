<!DOCTYPE html> {{--ユーザーページ関連親レイアウト--}}
<html>
    <head>
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- その他CDN読み込み --}}
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        @yield('other')
        {{--  CSS  --}}
        <link href="{{asset('css/commonUserInfo.css')}}" rel="stylesheet" type="text/css">
        @yield('css')
        {{--  JS  --}}
        <script src="{{asset('js/common.js')}}" type="text/javascript" charset="utf-8"></script>
        @yield('js')
    </head>
    <body>
        <header>
            <h1 id="appTitle">WorkOut App</h1>
            <a href="/userInfo" id="userPage">
                <span class="material-icons" id="userAccount">account_circle</span>
            </a>
        </header>
        <section id="backHome">
            <ul>
                <li>
                    <a href="/user">
                        <span class="material-icons">arrow_back_ios_new</span>
                        Homeに戻る
                    </a>
                </li>
            </ul>
            <div class="body">
                <hr class="noneHR">
                @yield('userInfo')
            </div>
        </section>
    </body>
</html>