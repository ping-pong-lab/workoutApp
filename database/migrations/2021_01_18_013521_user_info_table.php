<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'UserInfoTable';

    public function up()
    {
        // テーブル作成
        Schema::create('UserInfoTable', function (Blueprint $table) {
            $table->increments('UserID');
            $table->string('Email')->nullable(false);
            $table->string('Password')->nullable(false);
            $table->string('Name')->nullable();
            $table->double('Height', 5, 1)->nullable();
            $table->double('Weight', 5, 1)->nullable();
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
        Schema::dropIfExists('UserInfoTable');
        
    }
}
