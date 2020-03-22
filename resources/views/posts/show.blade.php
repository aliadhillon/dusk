@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.success')
        <h2 class="h2">{{ $post->title }}</h2>
        @if (Auth::user()->isAdmin())
            <span class="small text-danger">{{ $post->user->name }}</span>
        @endif
        <hr>
        <p>{{ $post->body }}</p>
        <br>
    </div>

    <div class="container">
        <a class="btn btn-info" href="{{ route('posts.edit', ['post' => $post]) }}">Edit Post</a>
        <br><br>
        <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete Post</button>
        </form>
    </div>
    
@endsection
