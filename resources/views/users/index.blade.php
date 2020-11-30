@extends('layouts.app')

@section('title')
    Users
@endsection

@section('content')

    <p>Users List:</p>
    <ul>
        @foreach($users as $user)
            <li>
                <a href = "/users/{{$user->id}}">
                    {{$user -> username}}
                </a>
            </li>
        @endforeach
    </ul>

@endsection