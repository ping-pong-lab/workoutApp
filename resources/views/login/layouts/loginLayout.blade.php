<!DOCTYPE html> {{--ログイン関連親レイアウト--}}
<html>
    <head>
        <title>@yield('title')</title>
        {{-- その他CDN読み込み --}}
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        @yield('other')
        {{--  CSS  --}}
        @yield('css')
        {{--  JS  --}}
        <script src="../js/common.js" type="text/javascript" charset="utf-8"></script>
        @yield('js')
    </head>
    <body>
        <header>
            <h1 id="appTitle">WorkOut App</h1>
        </header>
        <div class="body">
            @yield('body')
        </div>
    </body>
</html>