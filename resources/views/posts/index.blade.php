@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <ul>
                    <table class="table table-striped">
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <a href = "/posts/{{$post->id}}">
                                    <ul>{{$post -> title}}</ul>
                                    <ul>{{$post -> user_id}}</ul>
                                    <ul>{{$post -> content}}</ul>
                                    </a>
                                </td>
                                
                            </tr>
                        @endforeach
                    </table>
                </ul>
                <a href="{{ route('posts.create') }}">Create Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
