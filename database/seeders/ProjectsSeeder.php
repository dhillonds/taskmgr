<?php

namespace Database\Seeders;
use App\Models\Projects;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('projects')->insert([
            'project_name' => 'Art Project'
        ]);
        \DB::table('projects')->insert([
            'project_name' => 'Crafts Project'
        ]);
        \DB::table('projects')->insert([
            'project_name' => 'Dance Project'
        ]);
        \DB::table('projects')->insert([
            'project_name' => 'Music Project'
        ]);
    }
}
