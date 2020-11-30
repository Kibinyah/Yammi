@extends('layouts.app')

@section('title','User Details')

@section('content')

    <ul>
        <li>Username: {{$user->username}}</li>
        <li>Real Name: {{$user->realName}}</li>
        <li>Date of Birth: {{$user->dateOfBirth}}</li>
        <li>bio: {{$user->bio}}</li>
        <li>Number of Posts: {{$user->numberOfPosts}}</li>
    </ul>

@endsection