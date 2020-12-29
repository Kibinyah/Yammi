@extends('layouts.app')

@section('title','Tag Details ')

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
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h1>{{$tag->name}} Tag</h1>
                                                <h3> <small>{{$tag->posts()->count()}} Posts</small>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="/tags/{{$tag->id}}/edit" class="btn btn-primary btn-block pull-right">Edit Tag</a>

                                                <form method="POST"  action="{{ route('tags.destroy', ['tag' => $tag->id] ) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-block pull-right" >Delete</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Tags</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($tag->posts as $post)
                                                            <tr>
                                                                <th>{{$post->id}}</th>
                                                                <td>{{$post->title}}</td>
                                                                <td>@foreach ($post->tags as $tag)
                                                                        <span class="label label-default">{{$tag->name}},</span>
                                                                    @endforeach
                                                                </td>
                                                                <td><a href="{{ route('posts.show',$post) }}" class="btn btn-primary pull-right">View</a></td>
                                                            </tr>
                                                        @endforeach
                                                </table>
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