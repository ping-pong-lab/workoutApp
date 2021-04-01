document.addEventListener("DOMContentLoaded", function(){
    // infoマークHover時の吹き出し表示
    $('.infTip').hide();
    $('.info').hover(
      function () {
          $(this).next('.infTip').fadeIn('fast');
      },
      function () {
          $(this).next('.infTip').fadeOut('fast');
      }
    );

},false);

