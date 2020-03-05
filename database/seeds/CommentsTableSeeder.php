<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'fk_user'    => 1,
                'fk_image'   => 4,
                'content'    => 'Buena foto de familia !.',
                'created_at' => Carbon::now()
            ],
            [
                'fk_user'    => 2,
                'fk_image'   => 1,
                'content'    => 'Buena foto de playa !!.',
                'created_at' => Carbon::now()
            ],
            [
                'fk_user'    => 2,
                'fk_image'   => 4,
                'content'    => 'Que bueno !!',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}