@extends('layouts.app')

@section('title')
    Create Post
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card-title">Create a new Post</h2>
                <form method="POST" action="{{ route('posts.store') }}",  enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6"> 
                            <div class="form-group">
                                <label for="title">Post Title:</label>
                                <input type="text" name="title" class="form-control">

                                <label for="content">Content:</label>
                                <input type="text" name="content" class="form-control">

                                <label for="tags">Tags:</label>
                                <select name="tags[]" multiple class="form-control">
                                    @foreach($tags as $tag)
                                        <option value='{{$tag->id}}'>
                                            {{$tag->name}}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="cover_image">Image:</label>
                                <input id="cover_image" type="file" class="form-control" name="cover_image">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Submit">
                    <a href="{{ route('posts.index')}}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
