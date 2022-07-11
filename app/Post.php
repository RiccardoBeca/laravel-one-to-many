<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Post extends Model
{

    protected $fillable = [

        'title',
        'slug',
        'content'

    ];

    public  function category() {

        return $this->belongsTo('App\Category');

    }
    // relazione many to many
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public static function generateSlug($title){
        $slug = Str::slug($title, '-');
        $slug_base = $slug;
        // cerco l'esistenza dello "slug"
        $post_presente = Post::where('slug', $slug)->first();
        $c = 1;
        // se lo trovo, ne genero uno univoco con un contatore
        while($post_presente){
            $slug = $slug_base . '-' . $c;
            $c++;
            $post_presente = Post::where('slug', $slug)->first();
        }
        return $slug;
    }
}
