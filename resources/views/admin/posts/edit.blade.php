@extends('layouts.app')

@section('content')
    <div class="container">

      <h1>Modifica il Post!</h1>
{{-- 
      @if ($errors->any())
        @foreach ($errors->all() as $error )
          <li>{{ $error }}</li>
        @endforeach
      @endif --}}

      <form action="{{ route('admin.posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text"
          value="{{ $post->title }}"
          name="title"
          class="form-control
          @error('title') is-invalid @enderror"
          id="title" placeholder="Titolo">
           @error('title')
             <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="content" class="form-label">Contenuto</label>
          <textarea name="content" 
            class="form-control
            @error('content') is-invalid @enderror" 
            id="content" placeholder="Contenuto">
          </textarea>
          @error('content')
             <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
       
        <button type="submit" class="btn btn-primary">Invia</button>
      </form>

      
       



    </div>

@endsection