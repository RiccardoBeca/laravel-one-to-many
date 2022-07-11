<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;


class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) { 
            // estraggo un post random
            $post = Post::inRandomOrder()->first();
            // estraggo random l'id di un Tag
            $tag_id = Tag::inRandomOrder()->first()->id;
            // dump($post);
            $post->tags()->attach($tag_id);
        }
    }
}
