<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        // aggiungo categories alla index per poterlo utilizzare nella view
        $categories = Category::all();
        return view('admin.posts.index', compact( 'posts', 'categories' ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $new_post = new Post();
        // visto che nel form create non posso inserire lo slug lo genero utilizzando la funzione generateSlug che importo dal Model
        $data['slug'] = Post::generateSlug($data['title']);
        $new_post->fill($data);
        $new_post->save();
        
        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
       }
        return redirect()->route( 'admin.posts.show', $new_post );
        

        // dd($new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      $post = Post::find($id);
           return view('admin.posts.show', compact( 'post' ));                 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit',compact( 'post', 'categories', 'tags' )) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {   
        $data = $request->all();
        $post->update($data);
        if($data['title'] != $post->title){
            
            $data['slug'] = Post::generateSlug($data['title']);
        }
        // 
        if(array_key_exists('tags', $data)){
            // se esiste l'array tags lo uso per sincronizzare i dati della tabella ponte
            $post->tags()->sync($data['tags']);
        }else{
            // cancello tutte le relazioni eventualmente presenti
            $post->tags()->sync([]);
        }
        return redirect()->route( 'admin.posts.show', $post );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route( 'admin.posts.index' );
    }
}
