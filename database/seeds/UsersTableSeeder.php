<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role'       => 'user',
                'name'       => 'Mario',
                'surname'    => 'Pacherrez',
                'nick'       => 'MarioPch',
                'email'      => 'mario.pacherrez@gmail.com',
                'password'   => Hash::make('12345'),
                'image'      => 'foto',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'user',
                'name'       => 'Usuario',
                'surname'    => 'Uno',
                'nick'       => 'Usuario1',
                'email'      => 'usuario.uno@gmail.com',
                'password'   => Hash::make('12345'),
                'image'      => 'foto',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'user',
                'name'       => 'Usuario',
                'surname'    => 'Dos',
                'nick'       => 'Usuario2',
                'email'      => 'usuario.dos@gmail.com',
                'password'   => Hash::make('12345'),
                'image'      => 'foto',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}