@extends('layouts.app')

@section('title')
    Edit Comment
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Comment</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <form method="POST" action="{{ route('comments.update', $comment) }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">Comment:</label>
                                            <div class="col-md-6">
                                                <input id="comment" type="text" class="form-control" name="comment" 
                                                value="{{ old('comment', $comment->comment) }}"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary {{ session('success') ? 'is-valid': ''}} ">Save</button>
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