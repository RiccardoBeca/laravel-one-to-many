@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Sei nella index della CRUD</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Tags</th>
                <th scope="col">Actions</th>
               </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category ? $post->category->name : '-'}}</td>
                        <td>
                            @forelse ($post->tags as $tag)
                                    <span class="badge badge-pill badge-warning">{{ $tag->name }}</span>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">Show</a>
                            <a class="btn btn-success" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                            <form 
                            action="{{ route('admin.posts.destroy', $post) }}"
                            class="d-inline"
                            method="post">
                            @csrf
                            @method('DELETE')


                            <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
          </table>

          
          <h2 class="mb-5">I nostri Post divisi per Categoria:</h2>

          {{-- @dd($categories) --}}
            @foreach ($categories as $category )

                <h3>{{ $category->name }}:</h3>
         
                 <ul>
                    @forelse (  $category->posts as $post )
                    
                        <li>{{ $post->title }}</li>
                    @empty
                        <li>nessun post</li>
                        
                    @endforelse
                </ul> 
                
            @endforeach


    </div>

@endsection
