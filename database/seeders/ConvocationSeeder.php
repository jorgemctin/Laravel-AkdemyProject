<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
        DB::table('convocations')->insert([
            // [
            //     'program_id' => '1',
            //     'beginning' => '2023-12-17',
            //     'schedule' => 'Tardes 15:00-20:00'
            // ],
            // [
            //     'program_id' => '2',
            //     'beginning' => '2023-12-13',
            //     'schedule' => 'Mañanas 09:00-14:00'
            // ],
            // [
            //     'program_id' => '3',
            //     'beginning' => '2023-11-17',
            //     'schedule' => 'Tardes 15:00-20:00'
            // ],
            // [
            //     'program_id' => '4',
            //     'beginning' => '2024-04-15',
            //     'schedule' => 'Mañanas 09:00-14:00'
            // ],
            // [
            //     'program_id' => '5',
            //     'beginning' => '2024-04-09',
            //     'schedule' => 'Mañanas 09:00-14:00'
            // ],
            // [
            //     'program_id' => '6',
            //     'beginning' => '2024-01-12',
            //     'schedule' => 'Tardes 15:00-20:00'
            // ],
        ]);
    }
}
