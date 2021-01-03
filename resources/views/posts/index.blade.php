@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Home 
                    <a href="{{ route('posts.create') }}"> <button type="button" class="btn btn-primary btn-sm button1 float-right">Create Post</button></a>
                </div>
                <table class="table table-striped ">
                    <tbody class="items">
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                        <tr>
                            <h3><a href="/posts/{{$post->id}}">{{$post -> title}}</a></h3> 
                            @if(($post->cover_image) != NULL)
                                <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                            @endif
                            <p>{{$post -> content}}</p>
                            @if($post->stats)
                                <h6>Likes: {{$post->stats->likes}}</h6>
                                <h6>Views: {{$post->stats->views}}</h6>
                            @endif
                            <small>Written on {{$post->created_at}} by {{$post->user->username}}</small>
                            <hr>
                        </tr>
                        @endforeach
                        {{$posts->links()}}
                    @else 
                        <p>No posts found</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
