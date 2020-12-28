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
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <ul>
                    <tbody>
                        <td>
                            <ul>Title: {{$post->title}}</ul>
                            <ul>Content: {{$post->content}}</ul>
                            <ul>User: {{$post->user->username}}</ul>
                            <small>Written on {{$post->created_at}}</small>
                        </td>
                    </tbody>
                    <ul>
                        <a href="/posts/{{$post->id}}/edit" >Edit</a>

                        <form method="POST"  action="{{ route('posts.destroy', ['post' => $post->id] ) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <p><a href="{{ route('posts.index')}}">Back</a></p>
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
