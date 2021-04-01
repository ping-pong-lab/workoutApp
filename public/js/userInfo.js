$(document).ready(function() {
    // クリックイベント作成-更新ページへ
    $('Button#userInfoUP').click(function(){
        window.location.href = '/userInfo/updateUserInfo';
    });
    // クリックイベント作成-退会ページへ
    $('Button#userdelete').click(function(){
        window.location.href = '/userInfo/deleteUserInfo';
    });
    // クリックイベント作成-ログアウト
    $('Button#logout').click(function(){
        window.location.href = '/logout';
    });
    // クリックイベント作成-パスワード変更
    $('Button#updatePass').click(function(){
        var XXX = $('Button#updatePass')[0].dataset.id;
        window.location.href = '/forgetPass/registration?XXX='+XXX;
    });
    // クリックイベント作成-戻る
    $('Button#back').click(function(){
        window.location.href = '/userInfo';
    });
    // クリックイベント作成-更新実行
    $('Button#update').click(function(){
        $('form#updateForm').submit();
    });

    // クリックイベント作成-退会実行
    $('Button#delete').click(function(){
        $('form#deleteForm').submit();
    });
})