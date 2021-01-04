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
                <div class="card-body">
                    <table class="table">
                        <tbody class="items">
                        @if(count($posts) > 0)
                            @foreach($posts as $post)
                            <tr>
                                <h3><a href="/posts/{{$post->id}}">{{$post -> title}}</a></h3> 
                                @if(($post->cover_image) != NULL)
                                    <img style="max-width:700px;" src="/storage/cover_images/{{$post->cover_image}}">
                                @endif
                                <br><br>
                                <p>{{$post -> content}}</p>
                                @if($post->stats)
                                    <h6><b>Likes:</b> {{$post->stats->likes}}</h6>
                                    <h6><b>Views:</b> {{$post->stats->views}}</h6>
                                @endif
                                @if($post->user->profile_image)
                                    <img style="width: 75px; height: 75px; border-radius: 50%;" src="/storage/profile_images/{{$post->user->profile_image}}">
                                @endif 
                                <br>
                                <small>Written on {{$post->created_at}} by <b>{{$post->user->username}}</b></small>
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
</div>
@endsection
