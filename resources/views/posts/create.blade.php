@extends('layouts.app')

@section('title')
    Create Post
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-title items">Create a new Post</h2>
                <form method="POST" action="{{ route('posts.store') }}",  enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6"> 
                            <div class="form-group items">
                                <label for="title" >Post Title:</label>
                                <input type="text" name="title" class="form-control vspacing">

                                <label for="content">Content:</label>
                                <textarea type="text" name="content" class="form-control vspacing"></textarea>

                                <label for="tags">Tags:</label>
                                <select name="tags[]" multiple class="form-control vspacing">
                                    @foreach($tags as $tag)
                                        <option value='{{$tag->id}}'>
                                            {{$tag->name}}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="cover_image">Image:</label>
                                <input id="cover_image" type="file" class="form-control vspacing" name="cover_image">

                                
                                <button type="submit" class="form-control items vspacing" button="btn btn-primary btn-sm button1 btn-log">Submit</button>
                                <a href="{{ route('posts.index')}}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
