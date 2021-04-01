<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutHabbitTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            'WorkoutName' => 'test_user@test.com',
            'Week' => '0,1,2,3,4,5,6',
            'Explanation' => 'てすとWorkoutDATA',
            'UserID' => 1,
        ];
        DB::table('WorkoutHabbitTable')->insert($param);

    }
}
