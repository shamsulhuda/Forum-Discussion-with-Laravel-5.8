<?php

use Illuminate\Database\Seeder;
use App\Discussion;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = 'Implimenting OAUTH with laravel passport';
        $t2 = 'pagination in vuejs not working';
        $t3 = 'Developing with laravel Framework';
        $t4 = 'Looking for javascript tutorial';


        $d1 = [
        	'title' => $t1,
        	'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
        	'channel_id' => 1,
        	'user_id' => 1,
        	'slug' => str_slug($t1)
        ];

         $d2 = [
        	'title' => $t2,
        	'content' => 'standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys ',
        	'channel_id' => 2,
        	'user_id' => 2,
        	'slug' => str_slug($t2)
        ];

        $d3 = [
        	'title' => $t3,
        	'content' => 'Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
        	'channel_id' => 3,
        	'user_id' => 1,
        	'slug' => str_slug($t3)
        ];

         $d4 = [
        	'title' => $t4,
        	'content' => 'printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the',
        	'channel_id' => 4,
        	'user_id' => 2,
        	'slug' => str_slug($t4)
        ];

        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);
        Discussion::create($d4);
    }
}
