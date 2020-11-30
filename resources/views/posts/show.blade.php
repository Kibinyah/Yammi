@extends('layouts.app')

@section('title','Post')

@section('content')

    <ul>
        <li>Title: {{$post->content}}</li>
        <li>Content: {{$post->content}}</li>
    </ul>

@endsection