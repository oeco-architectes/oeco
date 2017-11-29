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
        $this->call(UsersTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}
