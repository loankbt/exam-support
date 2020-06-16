<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'name' => 'English',
                'code' => 'eng',
                'isMCQ' => 1,
                'time' => 60
            ],
            [
                'name' => 'Literature',
                'code' => 'lit',
                'isMCQ' => 0,
                'time' => 90
            ],
            [
                'name' => 'Chemistry',
                'code' => 'che',
                'isMCQ' => 1,
                'time' => 90
            ],
            [
                'name' => 'Math',
                'code' => 'mat',
                'isMCQ' => 0,
                'time' => 90
            ],
        ]);
    }
}
