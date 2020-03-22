@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="h2">Edit</h2>
        <hr>
        <form action="{{ route('posts.update', ['post' => $post]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter your title here" value="{{ old('title', $post->title) }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body" rows="10" placeholder="Enter body here">{{ old('body', $post->body) }}</textarea>
                @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-dark" href="{{ route('posts.show', ['post' => $post]) }}">Cancel</a>
        </form>
    </div>
@endsection
