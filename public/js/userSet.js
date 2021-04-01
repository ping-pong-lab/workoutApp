$(document).ready(function() {
    // ボタン非活性
    $('input.updateButton[type="submit"]').prop('disabled', true);
    $('button.deleteButton').prop('disabled', true);
    $('u#uncheck').css('display','none');
    $('u#clear').css('display','none');

    // アイテム変更時に変更ボタン活性/非活性化
    $(document).on('change', function(e) {
        var change = $(e.target)[0].className; //変更した要素(className)の取得
        var disable = '';
        var textValue = '';
        var textarea = '';
        // 更新OR削除-判定-
        if(change.match(/upHabbit/)){ //更新の時
            change = change.replace(' upHabbit','');                 // クラス名
            disable = 'input.'+change+'[type="submit"]';             // ボタン
            textValue = $('input.'+change+'[type="text"]')[0].value; // タイトル
            textarea = $('textarea.'+change)[0].value;               // テキストエリア
        }else if(change.match(/deleteItem/)){ //削除の時
            disable = 'button.deleteButton';
            textValue = true;
        }else {
            return false;
        }
        // checkbox判定
        var checked = [];
        var check = $('input.'+change+'[type="checkbox"]');
        for(var i=0; i < check.length; i++){
            if(check[i].checked == true){
                checked.push(true);
            }else{
                checked.push(false);
            }
        }
        var checkbox = checked.some( function( value ) {
            //配列内に「true」が存在するかどうかを検索 ：含まれてたらTrue
            return value === true;
        });

        // ボタン活性判定
        if(checkbox && textValue){ //trueが含まれてたら活性
            $(disable).prop('disabled', false);
            $('u#check').css('display','block');
        }else{
            $(disable).prop('disabled', true);
            $('u#uncheck').css('display','block');
        }
    });

    //deleteボタンクリックで削除実行
    $('button.deleteButton').click(function(){
        // checkbox trueの取得
        var deleteItem =[];
        for(let i = 0; i < $('input.deleteItem').length; i++){
            if($('input.deleteItem')[i].checked == true){ //checkが入ってるとき配列に入れる。
                deleteItem.push($('input.deleteItem')[i].value);
            }
        };
        // 削除実行
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"/user/delHabbit",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(deleteItem),
        }).done(function () {
            window.location.reload();
        }).fail(function () {
            alert('ajaxError!!!');
        })


    })

})