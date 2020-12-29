@extends('layouts.app')

@section('title')
    Users
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">    
                <div class="card-header">{{ __('User List') }}</div>
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="well">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <img style="width:20% " src="/storage/profile_images/{{$user->profile_image}}">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <a href = "/users/{{$user->id}}">
                                        {{$user -> username}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else 
                    <p>No posts found</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
