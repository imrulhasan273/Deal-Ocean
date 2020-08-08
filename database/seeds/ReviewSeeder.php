<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->delete();

        DB::table('reviews')->insert(array(
            0 =>
            array(
                'id' => 1,
                'user_id' => 1,
                'product_id' => 2,
                'rating' => 5,
                'comment' => 'Comment1',
                'created_at' => '2020-08-06 11:38:59',
                'updated_at' => '2020-08-06 11:38:59',
            ),
            1 =>
            array(
                'id' => 2,
                'user_id' => 1,
                'product_id' => 1,
                'rating' => 3,
                'comment' => 'Comment2',
                'created_at' => '2020-08-06 11:39:08',
                'updated_at' => '2020-08-06 11:39:08',
            ),
            2 =>
            array(
                'id' => 3,
                'user_id' => 1,
                'product_id' => 3,
                'rating' => 3,
                'comment' => 'Comment3',
                'created_at' => '2020-08-06 11:39:20',
                'updated_at' => '2020-08-06 11:39:20',
            ),
            3 =>
            array(
                'id' => 4,
                'user_id' => 2,
                'product_id' => 1,
                'rating' => 4,
                'comment' => 'Comment4',
                'created_at' => '2020-08-06 11:39:34',
                'updated_at' => '2020-08-06 11:39:34',
            ),
            4 =>
            array(
                'id' => 5,
                'user_id' => 3,
                'product_id' => 12,
                'rating' => 1,
                'comment' => 'Comment5',
                'created_at' => '2020-08-06 11:39:43',
                'updated_at' => '2020-08-06 11:39:43',
            ),
            5 =>
            array(
                'id' => 6,
                'user_id' => 3,
                'product_id' => 14,
                'rating' => 3,
                'comment' => 'Comment6',
                'created_at' => '2020-08-06 11:39:54',
                'updated_at' => '2020-08-06 11:39:54',
            ),
        ));
    }
}
