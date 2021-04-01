<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LogsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            'Date' => '2021-02-19 11:23:39',
            'WorkoutID' => 1,
            'UserID' => 1,
        ];
        DB::table('LogsTable')->insert($param);

    }
}
