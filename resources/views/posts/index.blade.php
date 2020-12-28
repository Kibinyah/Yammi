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
                            <h3><a href="/posts/{{$post->id}}">{{$post -> title}}</a></h3>
                            <small>Written on {{$post->created_at}} by {{$post->user->username}}</small>
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
