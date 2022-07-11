@extends('layouts.app')

@section('content')
    <div class="container">

      <h1>Sei nella SHOW della CRUD</h1>

      <h2>{{ $post->title }}</h2>

      @if ($post->tags)
        @foreach ($post->tags as $tag)
            <span class="badge badge-pill badge-warning">{{ $tag->name }}</span>
        @endforeach          
      @endif

      <p>

        {{ $post->content }}

      </p>

      <p>Categoria: {{ $post->category ? $post->category->name : '-' }}</p>



      <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Torna alla lista dei post</a>
       

      <a class="btn btn-success" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
      <form 
      action="{{ route('admin.posts.destroy', $post) }}"
      class="d-inline"
      method="post">
      @csrf
      @method('DELETE')


      <input class="btn btn-danger" type="submit" value="Delete">

    </div>

@endsection