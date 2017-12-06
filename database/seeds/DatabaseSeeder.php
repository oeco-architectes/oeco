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
        if (App::environment() === 'production') {
            throw new RuntimeError('Seeding is forbidden in production environment');
        }

        $this->call(UsersTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}
