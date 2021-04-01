<!DOCTYPE html> {{-- メール --}}
<html lang="ja">
    <head>
        <link rel="stylesheet" href="{{{asset('/css/mail.css')}}}">
    </head>
    <body>
        <h4>
            {{$name}}様
        </h4>
        <p>
            下記URLをクリックしていただき、パスワード再設定のお手続きをお願いいたします。
        </p>
        <form id="button" method="POST" action="/forgetPass/registration">
            {{csrf_field()}}
            <span>▼パスワード再設定</span><br>
            {{-- <input type="hidden" name="mail" value="{{$mail}}">
            <input type="submit" name="submit" value="再設定"> --}}
            <a href="http://127.0.0.1:8000/forgetPass/registration?XXX={{$id}}">http://127.0.0.1:8000/forgetPass/registration</a>
        </form>
        <p>
            ※変更後は古いパスワードでのログインができなくなりますので、ご確認の上お手続きください。
            <br>
            <br>
            このメールにお心当たりのない場合は、メールの削除をお願いいたします。
        </p>
    </body>
</html>