<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class WorkoutHabbitTable extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'WorkoutHabbitTable';
    protected $primaryKey ="WorkoutID";

    //
    protected $guarded = array('WorkoutID'); //値を用意しておかない項目
    public static $rules = array(
        'workoutName' => 'required',
        'week' => 'required',
    );
    public static $messages = array(
        'workoutName.required' => '必須項目です。',
        'week.required' => '1つ以上選択してください。',
    );

    protected static function boot(){
        parent::boot();

        static::addGlobalScope('UserID', function(Builder $builder){
            $session_userID = session()->get('userID');
            $builder->where('UserID','=',$session_userID);
        });
    }

    public function getData(){
        return $this->WorkoutName;
    }
}
