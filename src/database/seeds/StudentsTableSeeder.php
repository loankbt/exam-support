<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'name' => 'Nguyễn Thị Bích Loan',
                'card_id' => 9873276,
                'shift_id' => 1
            ],
            [
                'name' => 'Nguyễn Thị Hoa Lá',
                'card_id' => 9442876,
                'shift_id' => 2
            ]
        ]);
    }
}
