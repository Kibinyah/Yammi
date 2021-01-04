@extends('layouts.app')

@section('title')
    All Tags
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">    
                <div class="card-header">{{ __('Tag List') }}</div>
                @if(count($tags) > 0)
                    @foreach($tags as $tag)
                        <div class="well">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 xspacing">
                                    <a  href = "/tags/{{$tag->id}}">
                                        {{$tag -> name}}
                                    </a>                         
                                </div>
                               
                            </div>
                            <hr>  
                        </div>
                    @endforeach
                @else 
                    <p>No tags found</p>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('tags.store') }}">
        @csrf
        <div class="row">
            <div class=" col-md-8"> 
                <div class="form-group">
                    <h3>New Tag</h3>
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary {{ session('success') ? 'is-valid': ''}} ">Create New Tag</button>
            @if(session('success'))
                <div class="valid-feedback">{{ session('success')}}</div>
            @endif
        </div>
        </form>
    </div>
</div>
@endsection
