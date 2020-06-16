<?php

use Illuminate\Database\Seeder;
use Illuminate\Routing\Middleware\SubstituteBindings;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SubjectsTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
    }
}
