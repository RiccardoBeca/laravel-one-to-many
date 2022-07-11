<?php

use App\Category;
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
        $this->call(PostsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostsTagsTableSeeder::class);
    }
}
