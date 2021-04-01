<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'LogsTable';

    public function up()
    {
        Schema::create('LogsTable', function (Blueprint $table) {
            $table->increments('LogID');
            $table->datetime('Date')->nullable(false);
            $table->integer('WorkoutID')->nullable(false);
            $table->integer('UserID')->nullable(false);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LogsTable');
    }
}
