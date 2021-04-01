<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WorkoutHabbitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'WorkoutHabbitTable';

    public function up()
    {
        // テーブル作成
        Schema::create('WorkoutHabbitTable', function (Blueprint $table) {
            $table->increments('WorkoutID');
            $table->string('WorkoutName')->nullable(false);
            $table->string('Week')->nullable(false);
            $table->string('Explanation')->nullable();
            $table->string('UserID')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //テーブル削除
        Schema::dropIfExists('WorkoutHabbitTable');

    }
}
