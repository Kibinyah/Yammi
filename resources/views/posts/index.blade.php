@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ route('posts.create') }}">Create Post</a>
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <div class="well">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h3><a href="/posts/{{$post->id}}">{{$post -> title}}</a></h3>
                                    <h6>Likes: {{$post->stats->likes}}</h6>
                                    <small>Written on {{$post->created_at}} by {{$post->user->username}}</small>
                                </div>
                        </div>
                    @endforeach
                @else 
                    <p>No posts found</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
