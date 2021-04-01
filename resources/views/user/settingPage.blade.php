<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);
?>
<div>
@if (count($allHabbit) !== 0) 
    <table id="allHabbitTable">
        <caption>Workout一覧</caption>
        <tr>
            <td></td>
            <th>WorkOut名</th>
            <th>曜日</th>
            <td></td>
        </tr>
        @foreach ($allHabbit as $item)
        <tr>
            <form class="deleteBox">
                {{csrf_field()}}
                <td>
                    <input type="checkbox" name="itemID" class="deleteItem" value="{{$item->WorkoutID}}">
                </td>
            </form>
            <form class="updateBox" action="/user/upHabbit" id="{{$item->WorkoutID}}" method="POST">
                {{csrf_field()}}
                <td>
                    <input type="hidden" name="id" value="{{$item->WorkoutID}}">
                    <input type="text" name="workoutName" value="{{$item->WorkoutName}}" class="{{$item->WorkoutID}} upHabbit"><br>
                </td>
                <td>
                    <input type="checkbox" class="{{$item->WorkoutID}} upHabbit" name="week[]" value="1" {{ preg_match("/1/", $item->Week)? ' checked' : '' }}>月
                    <input type="checkbox" class="{{$item->WorkoutID}} upHabbit" name="week[]" value="2" {{ preg_match("/2/", $item->Week)? ' checked' : '' }}>火
                    <input type="checkbox" class="{{$item->WorkoutID}} upHabbit" name="week[]" value="3" {{ preg_match("/3/", $item->Week)? ' checked' : '' }}>水
                    <input type="checkbox" class="{{$item->WorkoutID}} upHabbit" name="week[]" value="4" {{ preg_match("/4/", $item->Week)? ' checked' : '' }}>木
                    <input type="checkbox" class="{{$item->WorkoutID}} upHabbit" name="week[]" value="5" {{ preg_match("/5/", $item->Week)? ' checked' : '' }}>金
                    <input type="checkbox" class="{{$item->WorkoutID}} upHabbit" name="week[]" value="6" {{ preg_match("/6/", $item->Week)? ' checked' : '' }}>土
                    <input type="checkbox" class="{{$item->WorkoutID}} upHabbit" name="week[]" value="0" {{ preg_match("/0/", $item->Week)? ' checked' : '' }}>日
                </td>
                <td>
                    <textarea name="explanation" class="{{$item->WorkoutID}} upHabbit" placeholder="トレーニングの説明" style="width: 100%">{{$item->Explanation}}</textarea>
                </td>
                <td>
                    <input type="submit" class="{{$item->WorkoutID}} updateButton" value="変更">
                </td>
            </form>
        </tr>
        @endforeach
        <tr>
            <td>
                <button class="deleteButton">削除</button>
            </td>
        </tr>
    </table>
@else 
    <p id="noDataTitle">Workout一覧</p>
    <p id="noData">Workoutデータが登録されていません。</p>
@endif
</div>
