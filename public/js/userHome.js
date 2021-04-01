$(document).ready(function() {
    // バリデーションエラーがあるとき、フォーム表示したままにする
    if ($('span.ErrMsg').length){
        $('#addRecordFrame').show();
    }else{
        $('.recordFrame').hide();
    }

    // 毎日にチェックが入ったら全曜日にチェック入れる
    $('input[name="allday"]').change(function() {
        if($(this).prop('checked')){
            $('input[name="week[]"]').prop('checked', true);
        }else{
            $('input[name="week[]"]').prop('checked', false);
        }
    })

    // クリックイベント実行
    $(document).click(function(e) {
        var classSelect = $('[data-page = "home"]')[0].className;
        if(classSelect == 'selected'){ //Homeタブが表示されてるときに実行
            // 登録フォームが表示されているとき
            if($('.recordFrame').css('display') == 'block'){
                // フォームの外側（グレー部分）をクリックしたらフォーム非表示
                if(!$(e.target).closest('form').length) {
                    $('.recordFrame').hide();
                }

            //登録フォームが非表示のとき 
            }else if($('.recordFrame').css('display') == 'none'){
                // ボタンクリックしたらフォーム表示
                if($(e.target).closest('a')[0].id == 'addRecordButton'){
                    $('#addRecordFrame').show();
                }else{
                }
            }
        }
    });
    // ボタンHover時の吹き出し表示
    $('.infoWeek').hide();
    $('.otherRecord').hover(
        function () {
            // $('.infoWeek').fadeIn('fast');
            $(this).children('.infoWeek').fadeIn('fast');
        },
        function () {
            // $('.infoWeek').fadeOut('fast');
            $(this).children('.infoWeek').fadeOut('fast');
        }
    );
});