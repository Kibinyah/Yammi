@extends('layouts.app')

@section('title','User Details')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <a href="{{ route('admin.users.index')}} "><button type="button" class="btn btn-info">Go Back</button></a>
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class=" float-right">
                            <label for="profile_image" class=" col-form-label"><b>Profile Image:</b></label>
                            <br>
                            <span >
                                <img style="width: 125px; height: 125px; border-radius: 80%;" class="float-right" src="/storage/profile_images/{{$user->profile_image}}">
                            </span>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-12" >
                                        @csrf
                                        <div class="form-group row">
                                            <label for="username" class="col-md-4 col-form-label  text-md-left"><b>Username: </b> 
                                                <span style="padding-left:20px">{{$user->username}}</span>
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-left"><b>Name: </b>
                                            <span style="padding-left:20px">
                                                    @if($user->profile)
                                                        {{ $user->profile->name}}
                                                    @else
                                                        {{$user->name}}
                                                    @endif
                                            </span>
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-left"><b>Email:</b>
                                            <span style="padding-left:20px">
                                                <label>{{$user->email}}</label>
                                            </span>
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dateOfBirth" class="col-md-4 col-form-label text-md-left"><b>Date Of Birth:</b>
                                            <span style="padding-left:20px">
                                                    @if($user->profile)
                                                        {{ $user->profile->dateOfBirth}}
                                                    @else
                                                        {{$user->name}}
                                                    @endif
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bio" class="col-md-4 col-form-label text-md-left"><b>Bio:</b>
                                            <span style="padding-left:20px">
                                                    @if($user->profile)
                                                        {{ $user->profile->bio}}
                                                    @else
                                                        {{$user->name}}
                                                    @endif
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                        <label for="roles" class="col-md-4 col-form-label text-md-left"><b>Roles:</b>
                                            <span style="padding-left:20px">
                                                    {{implode(',',$user-> roles()->get()->pluck('name')->toArray())}}
                                                </span>
                                            </label>
                                        </div>
                                       
                                        <div class="form-group row mb-0 mt-5">
                                            <h5> Comments: <span class="comment-count float-right badge ">{{ count($user->comments) }}</span> </h5>
                                            <ul><h5> Posts: <span class="comment-count float-right badge ">{{ count($user->posts) }}</span> </h5></ul>
                                        </div>
                                </div>
                            </div>
                        </div>
                       
                            <div style="text-align:center">
                                <a href="{{route('admin.users.edit',$user)}}"><button type="button" class="btn btn-warning  btn-lg">Edit</button></a>
                                <form action="{{route('admin.users.destroy',$user)}}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection