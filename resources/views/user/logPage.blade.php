<label id="thisMonth" style="display: none">{{$month}}</label>
<div id="calender" class="logBox">
    <a class="clenderYM"  id="this" data-date="{{$month}}">今月を表示</a>
    <table id="monthLog" >
        <caption><a class="clenderYM" id="prev" data-date="{{$prev}}">&lt;</a> <label id="clTitle" data-date="{{$html_titledata}}">{{$html_title}}</label> <a class="clenderYM" id="next" data-date="{{$next}}">&gt;</a></caption>
        <tr id="youbi">
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thr</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>
        @foreach ($weeks as $week)
            {!!$week!!}
        @endforeach
    </table>
</div>
<div id="record" class="logBox" align="left">
</div>
<div id="editRecordForm" class="logBox" align="left">
    <span class="material-icons" id="logCancel">clear</span>
    <form id="editRecordForm" action="" method="POST">
        {{csrf_field()}}
        <table id="editRecordForm">
            <tr>
                <td id="date">
                    <input type="hidden" name="logID" value="">
                    <input type="date" class="logForm" name="date" value=""><br>
                    <input type="time" class="logForm" name="time" value="">
                </td>
                <td id="workout">
                </td>
            </tr>
        </table>
    </form>
    <p id="editRecordForm">
        <button class="formButton" id="update">変更</button>
        <button class="formButton" id="delete">削除</button>
    </p>
</div>



