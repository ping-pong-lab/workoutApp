$(function () {
    //必須バリデーション
    $("input.passcheck").on("blur", function () {
      let error;
      let pass2Value = $(this).val();
      let pass1Value = $("input[name='passWord']").val();
      if (pass1Value == pass2Value) {
        error = false;
      }else{
        error = true;
      }
      if (error) {
        //エラー時の処理
        //エラーで、エラーメッセージがなかったら
        if(!$(this).nextAll('span.error-info').length){
          //メッセージを後ろに追加
          $(this).after('<br><span class = "error-info">パスワードが一致しません。</span>');
        }
      }else{
        //エラーじゃないのにメッセージがあったら
        if($(this).nextAll('span.error-info').length){
          //消す
          $(this).nextAll('span.error-info').remove();
        }
      }
    });
  });
