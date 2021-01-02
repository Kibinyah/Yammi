@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session('response'))
                        <div class="alert alert-success">
                            {{session('response')}}
                        </div>
                @endif
                <div class="card-header">{{ __('Post') }}</div>

                <div class="card-body">
                <ul>
                    <tbody>
                        <td>
                            <h2>Title: {{$post->title}}</h2>
                            @if($post->cover_image !== NULL)
                                <div class="col-md-4 col-sm-4">
                                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                                </div>
                            @endif
                            <div class="col-md-8 col-sm-8">
                                <ul>{{$post->content}}</ul>
                                <small>Written on {{$post->created_at}} by {{$post->user->username}}</small>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="interaction">
                                <form method="POST" action="{{route('posts.like',$post)}}">
                                {{csrf_field()}}
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Like</button>
                                    </div>
                                </form>
                                </div>  
                            </div>
                            @if(($post->stats) == TRUE)
                            <div class="col-md-4 col-sm-8">
                                <ul>Likes: {{$post->stats->likes}}</ul>
                                <small>Views: {{$post->stats->views}}</small>
                            </div>
                            @endif
                            
                                <div class="col-md-4 col-sm-4">
                                    <h4>Tags: </h4>
                                    @foreach ($post->tags as $tags)
                                        <span class="label label-default">{{$tags->name}}</span>
                                    @endforeach
                                </div>
                            </hr>
                        </td>
                    </tbody>
                    <ul>
                        <a href="{{route('posts.edit',$post)}}"><button type="button" class="btn btn-warning ">Edit</button></a>
                        <form method="POST"  action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('posts.index')}} "><button type="button" class="btn">Back</button></a>
                    </ul>
                    <ul>
                </div>
                <div class="row">
                    <tr>
                        <h3> Comments </h3>
                    </tr>
                    <tr>
                    <div class="col-md-8">
                        @foreach($post->comments as $comment)
                            <div class="comment">
                                <p><strong>Name:</strong> {{$comment->user->username}}</p>
                                <p><strong>Comment:</strong><br/>{{$comment->comment}}</p>

                                <form method="POST" action="{{route('comments.like',$comment)}}">
                                    {{csrf_field()}}
                                        <div class="form-group">
                                        <button type="submit" class="btn btn-success">Like</button>
                                        </div>
                                    </form>
                                </div>
                                @if(($comment->stats) == TRUE)
                                    <ul>Likes: {{$comment->stats->likes}}</ul>
                                @endif
                                @if((Auth::user() == $comment->user) || 'isAdmin' == TRUE)
                                    <a href="{{route('comments.edit',$comment)}}"><button type="button" class="btn btn-warning ">Edit</button></a>
                                    <form method="POST"  action="{{ route('comments.destroy', ['comment' => $comment->id] ) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </tr>
                    </div>
                    <div class = row>
                        <form method="POST" action="{{ route('comments.store', ['post' => $post->id] ) }}">
                        {{csrf_field()}}
                            <div class="form-group">
                                <textarea id="comment" rows="6" class="form-control" name="comment" required autofocus></textarea>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Post Comment</button>
                            </div>
                        </form>
                    </div>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
