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
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->username}}</td>
                                <td>{{$user-> email}}</td>
                                <td>{{implode(',',$user-> roles()->get()->pluck('name')->toArray())}}</td>
                                <td>        
                                    <a href="{{route('admin.users.show',$user)}}"> <button type="button" class="btn btn-primary float-left">View</button></a>
                                    @can('edit-users')
                                        <a href="{{route('admin.users.edit',$user)}}"><button type="button" class="btn btn-warning ">Edit</button></a>
                                    @endcan
                                    @can('delete-users')
                                    <form action="{{route('admin.users.destroy',$user)}}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger ">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        {{$users->links()}}
                    @else 
                        <p>No users found</p>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
