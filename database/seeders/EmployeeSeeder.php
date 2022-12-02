<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'first_name' => 'HRM',
            'last_name' => 'Admin',
            'email' => 'bnhao10062001@gmail.com',
            'password' => bcrypt('admin'),
            'phone_number' => '0931345672',
            'birth_date' => '2001/06/10',
            'department_id' => 1,
            'gender' => '0',
            'status' => 'active',
        ]);
    }
}
