<?php

use Illuminate\Database\Seeder;
use App\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        News::truncate();

        $faker = Faker\Factory::create();

        // And now, let's create a few articles in our database
        $position = 0;
        for ($i = 0; $i < 10; $i++) {
            News::create([
                'title' => $faker->sentence,
                'summary' => $faker->paragraph,
                'position' => $faker->boolean(80) ? $position++ : null
            ]);
        }
    }
}
