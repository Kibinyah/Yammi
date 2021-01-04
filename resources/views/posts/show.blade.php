@extends('layouts.app')

@section('title')
    Post Details

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <script defer src="{{ mix('js/app.js') }}"></script>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('posts.index')}} "><button type="button" class="btn btn-default">Go Back</button></a>
                </div>
                <div class="card-body">
                    <div class="float-right">
                            @if($post->user->profile_image)
                                <img style="width: 75px; height: 75px; border-radius: 50%;" class="float-right" src="/storage/profile_images/{{$post->user->profile_image}}">
                            @endif 
                    </div>
                    <h1>{{$post->title}}</h1>
                    <div class="row">
                        <small>Written on: {{$post->created_at}}</small>
                        <br>
                        <small style="padding-left:20px">By: {{$post->user->username}}</small>
                    </div>
                    @if($post->cover_image != NULL)
                        
                        <img style="width:100%; max-width:700px;" src="/storage/cover_images/{{$post->cover_image}}">
                    
                    @endif
                    <p>{{$post->content}}</p>
                    <hr>
                    @if((auth()->user() == $post->user)  || (auth()->user()->hasRole("admin")))
                        <a href="{{route('posts.edit',$post)}}"><button type="button" class="btn btn-warning float-left">Edit Post</button></a>
                        <form method="POST"  action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Post</button>
                        </form>
                        <hr>
                    @endif
    
                    @if(($post->stats) == TRUE)
                        <div>
                            <form method="POST" class="float-left" action="{{route('posts.like',$post)}}">
                                {{csrf_field()}}
                                <div class="form-group float-left">
                                    <button type="submit" class="btn btn-success btn-small ">Like</button>
                                </div>
                            </form> 
                            <div class="xspacing">
                                <b>Likes:</b> {{$post->stats->likes}}
                                <b>Views:</b> {{$post->stats->views}}
                            </div>
                        </div>
                    @endif
                    <br>
                    <hr>
                    <div class="col-md-4 col-sm-4">
                        <b>Tags: </b>
                            @foreach ($post->tags as $tags)
                                <span class="label label-default">{{$tags->name}}, </span> 
                            @endforeach
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <h3> Comments: <span class="comment-count float-right badge badge-info">{{ count($post->comments) }}</span> </h3>
                    <hr>
                    <div class="col-md-12">
                        @foreach($post->comments as $comment)
                            <div class="comment" id="commentTable">
                                @if($comment->user->profile_image)
                                    <img style="width: 75px; height: 75px; border-radius: 50%;" class="float-right" src="/storage/profile_images/{{$comment->user->profile_image}}">
                                @endif 
                                <p><strong>Username:</strong>{{$comment->user->username}}</p>
                                <p><strong>Comment:</strong><br/>{{$comment->comment}}</p>
                                @if((auth()->user()->id == $comment->user_id) || (auth()->user()->hasRole("admin")))
                                    <a href="{{route('comments.edit',$comment)}}"><button type="button" class="btn btn-warning float-right">Edit</button></a>
                                    <form method="POST"  action="{{ route('comments.destroy', ['comment' => $comment->id] ) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger float-right" >Delete</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{route('comments.like',$comment)}}">
                                    {{csrf_field()}}
                                    <div class="form-group float-left">
                                        <button type="submit" class="btn btn-success">Like</button>
                                    </div>
                                </form>
                                @if(($comment->stats) == TRUE)
                                    <div class="xspacing">
                                        <ul><b>Likes:</b> {{$comment->stats->likes}}</ul>
                                    </div>
                                @endif
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <hr>
                    <form id="commentForm"  method="POST" action="{{ route('comments.store', ['post' => $post->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea id="comment" rows="6" class="form-control" name="comment" required autofocus></textarea>
                        <button type="submit" class="btn btn-success btn-lg btn-block">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
