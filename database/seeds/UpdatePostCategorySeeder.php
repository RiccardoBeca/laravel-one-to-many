<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class UpdatePostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $getPosts = Post::all();
        // ciclando ogni singolo post, vado a popolare la colonna category_id utilizzando Category::inRandomOrder() che mi andra' a selezionare un oggetto di categoria random a cui poi estrappoliamo l'id
        foreach ($getPosts as $post) {

            $getCategory = Category::inRandomOrder()->first();
            // assegno alla colonna category_id di post l'id che mi arriva da $getCategory(categoria random);
            $post->category_id = $getCategory->id;
            $post->update();
        }

    }
}
