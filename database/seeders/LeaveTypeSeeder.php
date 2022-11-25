<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->insert([
            ['type_name' => 'Sick leave'],
            ['type_name' => 'Casual leave'],
            ['type_name' => 'Public leave'],
            ['type_name' => 'Bereavement leave'],
            ['type_name' => 'Maternity leave']
        ]);
    }
}
