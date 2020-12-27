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
                        <td>
                            <ul>Title: {{$post->title}}</ul>
                            <ul>Content: {{$post->content}}</ul>
                            <ul>User: {{$post->user_id}}</ul>
                        </td>
                    </table>
                    <ul>
                        <form method="POST"  action="{{ route('posts.destroy', ['post' => $post->id] ) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <p><a href="{{ route('posts.index')}}">Back</a></p>
                    </ul>
                </ul>
                <ul>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
