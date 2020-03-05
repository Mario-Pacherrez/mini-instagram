<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'image_path'  => 'foto.png',
                'description' => 'Descripción de Prueba 1.',
                'created_at'  => Carbon::now(),
                'fk_user'     => 1
            ],
            [
                'image_path'  => 'foto.png',
                'description' => 'Descripción de Prueba 2.',
                'created_at'  => Carbon::now(),
                'fk_user'     => 1
            ],
            [
                'image_path'  => 'foto.png',
                'description' => 'Descripción de Prueba 3.',
                'created_at'  => Carbon::now(),
                'fk_user'     => 1
            ],
            [
                'image_path'  => 'foto.png',
                'description' => 'Descripción de Prueba 4.',
                'created_at'  => Carbon::now(),
                'fk_user'     => 3
            ]
        ]);
    }
}