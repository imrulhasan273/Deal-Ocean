<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->delete();

        DB::table('categories')->insert(array(
            0 =>
            array(
                'id' => 1,
                'parent_id' => 0,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'created_at' => '2020-08-06 11:38:59',
                'updated_at' => '2020-08-06 11:38:59',
            ),
            1 =>
            array(
                'id' => 2,
                'parent_id' => 0,
                'name' => 'Software',
                'slug' => 'software',
                'created_at' => '2020-08-06 11:39:08',
                'updated_at' => '2020-08-06 11:39:08',
            ),
            2 =>
            array(
                'id' => 3,
                'parent_id' => 1,
                'name' => 'Laptop',
                'slug' => 'laptop',
                'created_at' => '2020-08-06 11:39:20',
                'updated_at' => '2020-08-06 11:39:20',
            ),
            3 =>
            array(
                'id' => 4,
                'parent_id' => 1,
                'name' => 'Camera',
                'slug' => 'camera',
                'created_at' => '2020-08-06 11:39:34',
                'updated_at' => '2020-08-06 11:39:34',
            ),
            4 =>
            array(
                'id' => 5,
                'parent_id' => 3,
                'name' => 'Dell',
                'slug' => 'dell',
                'created_at' => '2020-08-06 11:39:43',
                'updated_at' => '2020-08-06 11:39:43',
            ),
            5 =>
            array(
                'id' => 6,
                'parent_id' => 3,
                'name' => 'HP',
                'slug' => 'hp',
                'created_at' => '2020-08-06 11:39:54',
                'updated_at' => '2020-08-06 11:39:54',
            ),
            6 =>
            array(
                'id' => 7,
                'parent_id' => 3,
                'name' => 'Asus',
                'slug' => 'asus',
                'created_at' => '2020-08-06 11:40:08',
                'updated_at' => '2020-08-06 11:40:08',
            ),
            7 =>
            array(
                'id' => 8,
                'parent_id' => 2,
                'name' => 'Antivirus',
                'slug' => 'antivirus',
                'created_at' => '2020-08-06 11:40:19',
                'updated_at' => '2020-08-06 11:40:19',
            ),
            8 =>
            array(
                'id' => 9,
                'parent_id' => 8,
                'name' => 'Avast',
                'slug' => 'avast',
                'created_at' => '2020-08-06 11:40:34',
                'updated_at' => '2020-08-06 11:40:34',
            ),
            9 =>
            array(
                'id' => 10,
                'parent_id' => 2,
                'name' => 'Windows 10',
                'slug' => 'windows_10',
                'created_at' => '2020-08-06 11:40:48',
                'updated_at' => '2020-08-06 11:40:48',
            ),
            10 =>
            array(
                'id' => 11,
                'parent_id' => 4,
                'name' => 'Canon',
                'slug' => 'canon',
                'created_at' => '2020-08-06 11:41:04',
                'updated_at' => '2020-08-06 11:41:04',
            ),
            11 =>
            array(
                'id' => 12,
                'parent_id' => 0,
                'name' => 'Book',
                'slug' => 'book',
                'created_at' => '2020-08-06 11:41:13',
                'updated_at' => '2020-08-06 11:41:13',
            ),
            12 =>
            array(
                'id' => 13,
                'parent_id' => 12,
                'name' => 'C++',
                'slug' => 'cpp',
                'created_at' => '2020-08-06 11:41:25',
                'updated_at' => '2020-08-06 11:41:25',
            ),
            13 =>
            array(
                'id' => 14,
                'parent_id' => 12,
                'name' => 'Java',
                'slug' => 'java',
                'created_at' => '2020-08-06 11:41:36',
                'updated_at' => '2020-08-06 11:41:36',
            ),
        ));
    }
}
