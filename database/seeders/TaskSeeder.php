<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->insert([
            ['title' => 'Buy milk', 'description' => '2L whole milk', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Send email', 'description' => 'Weekly report', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Study Laravel', 'description' => 'Blade & routes', 'order' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
