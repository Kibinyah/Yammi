@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit User</div>
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
                                    <form action="{{ route('admin.users.update',$user) }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        {{method_field('PUT')}}
                                        <div class="form-group row">
                                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                            <div class="col-md-6">
                                                <label>{{$user->username}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" 
                                                value="{{ old('name', $user->profile->name) }}"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                            <div class="col-md-6">
                                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dateOfBirth" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                                            <div class="col-md-6">
                                                <input id="dateOfBirth" type="text" class="form-control" name="dateOfBirth" value="{{ old('dateOfBirth', $user->profile->dateOfBirth) }}" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio</label>
                                            <div class="col-md-6">
                                                <input id="bio" type="text" class="form-control" name="bio" value="{{ old('bio', $user->profile->bio) }}" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
                                            <div class="col-md-6">
                                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="roles" class="col-md-4 col-form-label text-md-right">Roles</label>
                                            @foreach($roles as $role)
                                                <div class="form-check">
                                                    <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                                    @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                    <label>{{$role->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection