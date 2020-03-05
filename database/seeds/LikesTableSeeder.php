<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            [
                'fk_user'    => 1,
                'fk_image'   => 4,
                'created_at' => Carbon::now()
            ],
            [
                'fk_user'    => 2,
                'fk_image'   => 4,
                'created_at' => Carbon::now()
            ],
            [
                'fk_user'    => 3,
                'fk_image'   => 1,
                'created_at' => Carbon::now()
            ],
            [
                'fk_user'    => 3,
                'fk_image'   => 2,
                'created_at' => Carbon::now()
            ],
            [
                'fk_user'    => 2,
                'fk_image'   => 1,
                'created_at' => Carbon::now()
            ]
        ]);
    }
}