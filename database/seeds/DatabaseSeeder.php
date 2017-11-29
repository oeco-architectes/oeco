<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the news table.
     * @return void
     */
    public function run()
    {
        $this->call(NewsTableSeeder::class);
    }
}
