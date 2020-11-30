@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')

    <p>Home:</p>
    <ul>
        @foreach($posts as $post)
            <li>
                <a href = "/posts/{{$post->id}}">
                    {{$post -> title}}
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('posts.create') }}">Create Post</a>

@endsection