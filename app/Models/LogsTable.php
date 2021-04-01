<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LogsTable extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'LogsTable';
    protected $primaryKey = 'LogID';

    protected $guarded = array('LogID'); //値を用意しておかない項目
    public static $rules = array(
        'Date' => 'required',
        'WorkoutID' => 'required',
    );
    public static $messages = array(
        'Date.required' => '必須項目です。',
        'WorkoutID.required' => '1つ以上選択してください。',
    );

    protected static function boot(){
        parent::boot();

        static::addGlobalScope('UserID', function(Builder $builder){
            $session_userID = session()->get('userID');
            $builder->where('UserID','=',$session_userID);
        });
    }

    public function habbitInfo(){
        return $this->hasOne('App\Models\WorkoutHabbitTable','WorkoutID','WorkoutID');
    }
    public function LogData(){
        $item = $this->habbitInfo->WorkoutName;
        return $item;
    }


}
