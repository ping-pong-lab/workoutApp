<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UseInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            'Email' => 'test_user@test.com',
            'Password' => 'TEST',
            'name' => 'てすとユーザー',
            'Height' => 170.5,
            'Weight' => 65.5,
        ];
        DB::table('UserInfoTable')->insert($param);

        $param =[
            'Email' => 'naoe_misaki@tenda.co.jp',
            'Password' => 'password',
            'name' => 'みさ',
        ];
        DB::table('UserInfoTable')->insert($param);
    }
}
