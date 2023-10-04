<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use Faker\Generator as Faker;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
       Task::factory(
            $faker -> numberBetween(25, 50)      
       )->create();
            

    }
}
