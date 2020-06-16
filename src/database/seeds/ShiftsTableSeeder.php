<?php

use Carbon\Traits\Timestamp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shifts')->insert([
            [
                'name' => 'English1',
                'key' => 'eng1',
                'subject_id' => 1,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Literature1',
                'key' => 'lit1',
                'subject_id' => 2,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Chemistry1',
                'key' => 'che1',
                'subject_id' => 3,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Math1',
                'key' => 'mat1',
                'subject_id' => 4,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'English2',
                'key' => 'eng1',
                'subject_id' => 2,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Literature2',
                'key' => 'lit2',
                'subject_id' => 2,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Chemistry2',
                'key' => 'che2',
                'subject_id' => 3,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Math2',
                'key' => 'mat2',
                'subject_id' => 4,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'English3',
                'key' => 'eng3',
                'subject_id' => 1,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Literature3',
                'key' => 'lit3',
                'subject_id' => 2,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Chemistry3',
                'key' => 'che3',
                'subject_id' => 3,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Math3',
                'key' => 'mat3',
                'subject_id' => 4,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
