<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AddAdminToUserTable::class,
            UsersTableSeeder::class,
            TagsTableSeeder::class,
            PostTableSeeder::class,
            NewsTableSeeder::class,
            CommentsTableSeeder::class,
        ]);
    }
}