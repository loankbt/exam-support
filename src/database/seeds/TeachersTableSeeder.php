<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'email' => 'teacher@gmail.com',
                'name' => 'Nguyễn Văn An',
                'password' => Hash::make('teacher123'),
                'shift_id' => 2
            ]
        ]);
    }
}
