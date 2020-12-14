@extends('layouts.app')

@section('title','Post')

@section('content')

    <ul>
        <li>Title: {{$post->title}}</li>
        <li>Content: {{$post->content}}</li>
        <li>User: {{$post->user_id}}</li>
    </ul>

    <form method="POST"  action="{{ route('posts.destroy', ['post' => $post->id] ) }}">
       
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    

    <p><a href="{{ route('posts.index')}}">Back</a></p>
@endsection