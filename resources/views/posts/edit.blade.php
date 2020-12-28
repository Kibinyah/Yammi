@extends('layouts.app')

@section('title')
    Edit Post
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card-title">Edit Post</h2>
                <form method="POST" action="{{ route('posts.update', $post) }}" enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6"> 
                            <div class="form-group">
                                <label for="title">Post Title:</label>
                                <input type="text" name="title" class="form-control" value="{{ $post->title}}">

                                <label for="content">Content:</label>
                                <input type="text" name="content" class="form-control" value="{{ $post->content}}">

                                <label for="cover_image">Image:</label>
                                <input id="cover_image" type="file" class="form-control" name="cover_image">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary {{ session('success') ? 'is-valid': ''}} ">Save</button>
                    @if(session('success'))
                        <div class="valid-feedback">{{ session('success')}}</div>
                    @endif

                </form>
                <a href="{{ route('posts.index')}}">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection