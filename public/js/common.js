$(document).ready(function() {

    // タイトルクリックでログイン画面へ
    $('#appTitle').click(
        function (){
            window.location.href = '/';
        }
    );
    
    // キャンセルボタンでloginに戻る
    $('#cancelButton').click(
        function(){
            window.location.href = '/';
        }
    );

    // タブ操作
    $('#tavNavigate > ul > li > a').eq(0).addClass( "selected" );
    // $('#tavNavigate > div > article').css('display','block');
    $('#tavNavigate > div > article').eq(0).css('display','block');
    $('#tavNavigate > ul').click(function(e){
        if($(e.target).is("a")){
            // console.log($(e.target)[0].getAttribute("data-page"));
          /*Handle Tab Nav*/
          $('#tavNavigate > ul > li > a').removeClass( "selected");
          $(e.target).addClass( "selected");
          var clicked_index = $("a",this).index(e.target);
          $('#tavNavigate > div > article').css('display','none');
          $('#tavNavigate > div > article').eq(clicked_index).fadeIn();
        }
        $(this).blur();
        return false;
    });

});