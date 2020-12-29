@extends('layouts.app')

@section('title','User Details')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                        @csrf
                                        <div class="form-group row">
                                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                            <div class="col-md-6">
                                                <label>{{$user->username}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                            <div class="col-md-6">
                                                <label>
                                                    @if($user->profile)
                                                        {{ $user->profile->name}}
                                                    @else
                                                        {{$user->name}}
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                            <div class="col-md-6">
                                                <label>{{$user->email}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dateOfBirth" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                                            <div class="col-md-6">
                                                <label>
                                                    @if($user->profile)
                                                        {{ $user->profile->dateOfBirth}}
                                                    @else
                                                        {{$user->name}}
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio</label>
                                            <div class="col-md-6">
                                                <label>
                                                    @if($user->profile)
                                                        {{ $user->profile->bio}}
                                                    @else
                                                        {{$user->name}}
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
                                            <div class="col-md-6">
                                                <div class="col-md-4 col-sm-4">
                                                    <img style="width:50%" src="/storage/profile_images/{{$user->profile_image}}">
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">

                                                <button type="submit" class="btn"><a href="/users/{{$user->id}}/edit">Edit Profile</a></button>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection