$(document).ready(function() {
// ロード時実行------------------------------------------------------------

    // 今日のLog表示
    var day = new Date();
    var today = day.getDate()//今日の日にち取得
    createLog(today);

    // イベント作成-日付クリック
    for(let c = 0; c < $('label.dayLabel').length; c++){
        $('label.dayLabel')[c].addEventListener('click', viewLog);
    }
    // イベント作成-カレンダー翌・前月クリック
    for(let a = 0; a < $('a.clenderYM').length; a++){
        $('a.clenderYM')[a].addEventListener('click',changeCL);
    }
    // イベント作成-ログ編集ボタン・削除ボタン・フォームキャンセル クリック
    $('button#update')[0].addEventListener('click', updateButton);
    $('button#delete')[0].addEventListener('click', deleteButton);
    $('span#logCancel')[0].addEventListener('click', function(){
        $('div#editRecordForm').hide();
    },false);
    // form非表示
    $('div#editRecordForm').hide();
    // カレンダーが当月の場合、ボタン非表示
    $('a#this').hide();


// イベント関数 ------------------------------------------------------------

    // カレンダーの前月・翌月表示
    function changeCL(c){
        $('a#this').hide();
        $('table#monthLog').hide();
        $('div#editRecordForm').hide();
        $('tr#youbi').nextAll().remove();
        $('#record').empty();
        var ym = $(c.target)[0].dataset.date;
        var clender = "";

        $.ajax({
            url:"/user/clender/" + ym,
            type: 'GET',
            data: { 
                ym: ym
            }
        }).done(function (data) { //ajaxが成功したときの処理
            // 返り値：['weeks'=>$weeks, 'html_title'=>$html_title, 'html_titledata'=>$html_titledata, 'prev'=>$prev, 'next'=>$next, 'month'=>$ym];
            for(let w = 0; w < data.weeks.length; w++){
                clender += data.weeks[w];
            }
            $('tr#youbi').after(clender);
            $('a#prev').attr('data-date',data.prev);
            $('a#next').attr('data-date',data.next);
            $('label#clTitle').text(data.html_title);
            $('label#clTitle').attr('data-date',data.html_titledata);
            $('label#thisMonth').text(data.month);
            $('table#monthLog').show();
            // クリックイベント作成
            for(let c = 0; c < $('label.dayLabel').length; c++){
                $('label.dayLabel')[c].addEventListener('click', viewLog);
            }

            // カレンダーが当月の場合、ボタン非表示
            $thisButton = $('a#this')[0].dataset.date;
            $thisMonth = $('label#clTitle')[0].dataset.date;
            if($thisMonth == $thisButton){
                $('a#this').hide();
            }else{
                $('a#this').show();
            }

        }).fail(function () {//ajax通信がエラーのときの処理
        })
    };

    // 日付をクリックするとLogが表示
    function viewLog(e){
        $('#record').empty();
        $('div#editRecordForm').hide();
        var day = $(e.target)[0].innerHTML;
        createLog(day);
    }

    // 対象日付のLog一覧作成関数
    function createLog(day){
        var viewDate = $('#monthLog caption')[0].childNodes[1].data.trim() + day +'日'; //表示用の日付作成
        day = ("00" + day).slice( -2 ) ;
        var month = $('#thisMonth')[0].innerHTML;
        var date = month + '-' + day; //データ送信用の日付作成
        $.ajax({
            url:"/user/getLog",
            type: 'GET',
            data: { 
                date: date
            }
        }).done(function (data) { //ajaxが成功したときの処理
            var html = "";
            var logTable = "";
            html = '<table id="dayRecord"><caption>'+ viewDate +'</caption>';
            if(data.length > 0){
                $.each(data, function (index,value) { //dataの中身からvalueを取り出す
                    let logID = value.logID;
                    let LogTime = value.date;
                    let name = value.habbitName;
                    logTable += '<tr id="'+logID+'"><td class="logTd">'+LogTime+'</td><td><u class="logLabel" id="'+logID+'">'+name+'</u></td></tr>';
                })
                html += logTable + '</table>';
            }else if (data.length === 0) {// 検索結果がなかったときの処理
                html += '<tr><td colspan="2" style="color:red;">データがありません。</td></tr></table>';
            }
            $('#record').html(html);

            // クリックイベント作成
            for(let c = 0; c < $('u.logLabel').length; c++){
                $('u.logLabel')[c].addEventListener('click', editLog);
            }

        }).fail(function () {//ajax通信がエラーのときの処理
            console.log('miss');
        })
    };

    // logクリックで編集モード
    function editLog(e){
        var logID = $(e.target)[0].id;
        $('div#logEdit').empty();
        // 対象logIDのデータ取得、編集モードで出力する
        $.ajax({
            url:"/user/getEditLog",
            type: 'GET',
            data: { 
                logID: logID
            }
        }).done(function (data) { //ajaxが成功したときの処理
            let logID = data.Log.LogID; //ex：1
            let LogDateTime = data.Log.Date; //ex：2021-02-19 11:23:39
            LogDateTime = new Date(LogDateTime); 
            var yyyy = LogDateTime.getFullYear(); //ex: 2021
            var MM = (LogDateTime.getMonth()+1).toString().padStart(2, '0'); //ex: 02
            var dd = LogDateTime.getDate().toString().padStart(2, '0'); //ex: 19
            let LogDate = yyyy +'-'+ MM +'-'+ dd; //ex：2021-02-19
            var HH = LogDateTime.getHours(); //ex: 11
            var mm = LogDateTime.getMinutes(); //ex: 23
            let LogTime = HH +':'+ mm; //ex: 11:23
            let selectWorkoutID = data.Log.WorkoutID; //ex：5

            // formに設定する。
            var option = '<select class="logForm" name="workout">';
            $.each(data.workOut, function (index, value) {
                if(value.WorkoutID == selectWorkoutID) {//選択中のWorkOutの時、Select状態にする。
                    option += '<option value="'+value.WorkoutID+'" selected>'+value.WorkoutName+'</option>';
                }else{
                    option += '<option value="'+value.WorkoutID+'">'+value.WorkoutName+'</option>';
                }
            });
            option += '</select>'

            $('input[name="logID"]').val(logID); //valueにLogIDを設定
            $('input[name="date"]').val(LogDate); //valueに日付を設定
            $('input[name="time"]').val(LogTime); //valueに時刻を設定
            $('td#workout').html(option); //tdにセレクトボックスを設定

            //form表示
            $('div#editRecordForm').show()
            

        }).fail(function () {//ajax通信がエラーのときの処理
            console.log('miss');
        })

    }

    // 編集ボタンonclick
    function updateButton(){
        $('form#editRecordForm').attr('action', '/user/upLog');
        $('form#editRecordForm').submit();
    }
    // 削除ボタンonclick
    function deleteButton(){
        $('form#editRecordForm').attr('action', '/user/delLog');
        $('form#editRecordForm').submit();
    }

})
