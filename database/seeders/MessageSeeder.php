<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('messages')->insert([
            // [
            //     'user_id' => '3',
            //     'program_id' => '1',
            //     'message' => 'Excelente equipo, muy rápido la inscripción, ya estoy finalizando el curso..',
            //     'date' => now(),
            // ],
            // [
            //     'user_id' => '4',
            //     'program_id' => '2',
            //     'message' => 'Muy buen programa, recomendado.',
            //     'date' => now(),
            // ],
            // [
            //     'user_id' => '5',
            //     'program_id' => '3',
            //     'message' => 'Justo lo que estaba buscando, busco colegas para hacer grupo de estudio.',
            //     'date' => now(),
            // ],
            // [
            //     'user_id' => '6',
            //     'program_id' => '4',
            //     'message' => 'Fantástico!',
            //     'date' => now(),
            // ],
        ]);
    }
}
