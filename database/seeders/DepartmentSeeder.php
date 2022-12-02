<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            ['department_name' => 'IT Department', 'description' => 'This is IT Department'],
            ['department_name' => 'Accounting Department', 'description' => 'This is the Accounting Department'],
        ]);
    }
}
