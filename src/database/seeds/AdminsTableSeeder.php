<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
