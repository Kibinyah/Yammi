@extends('layouts.app')

@section('title')
    Post Details
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />


@section('scripts')
  <script>
      const app = new Vue({
          el: '#app',
          data: {
              comments: {},
              commentBox: '',
              post: {!! $post->toJson() !!},
              user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
          },
          mounted() {
              this.getComments();
          },
          methods: {
              getComments() 
                  axios.get('/api/posts/'+this.post.id+'/comments')
                       .then((response) => {
                           this.comments = response.data
                       })
                       .catch(function (error) {
                           console.log(error);
                       }
                  );
              },
              postComment() {
                  axios.post('/api/posts/'+this.post.id+'/comments', {
                      api_token: this.user.api_token,
                      body: this.commentBox
                  })
                  .then((response) => {
                      this.comments.unshift(response.data);
                      this.commentBox = '';
                  })
                  .catch((error) => {
                      console.log(error);
                  })
              }
          }
      })
  </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('posts.index')}} "><button type="button" class="btn btn-default">Go Back</button></a>
            <div class="card">
                <div class="card-header">{{ __('Post') }}</div>
                <div class="card-body">
                    <h1>{{$post->title}}</h1>
                    @if($post->cover_image != NULL)
                        
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    
                    @endif
                    <p>{{$post->content}}</p>
                    <hr>
                    @if((Auth::user() == $post->user) || 'isAdmin' == TRUE)
                        <a href="{{route('posts.edit',$post)}}"><button type="button" class="btn btn-warning float-left">Edit Post</button></a>
                        <form method="POST"  action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Post</button>
                        </form>
                        <hr>
                    @endif
                    <div class="float-right">
                        <small>Written on: {{$post->created_at}}</small>
                        <ul><small>By: {{$post->user->username}}</small></ul>
                    </div>
                    @if(($post->stats) == TRUE)
                        <div>
                            <form method="POST" class="float-left" action="{{route('posts.like',$post)}}">
                                {{csrf_field()}}
                                <div class="form-group float-left">
                                    <button type="submit" class="btn btn-success btn-small ">Like</button>
                                </div>
                            </form> 
                            <div class="xspacing">
                                <b>Likes:</b> {{$post->stats->likes}}
                                <b>Views:</b> {{$post->stats->views}}
                            </div>
                        </div>
                    @endif
                    <br>
                    <hr>
                    <div class="col-md-4 col-sm-4">
                        <b>Tags: </b>
                            @foreach ($post->tags as $tags)
                                <span class="label label-default">{{$tags->name}}, </span> 
                            @endforeach
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <h3> Comments: </h3>
                    <hr>
                    <div class="col-md-12">
                        @foreach($post->comments as $comment)
                            <div class="comment" id="commentTable">
                                <p><strong>Username:</strong>{{$comment->user->username}}</p>
                                <p><strong>Comment:</strong><br/>{{$comment->comment}}</p>
                                @if((Auth::user() == $comment->user) || 'isAdmin' == TRUE)
                                    <a href="{{route('comments.edit',$comment)}}"><button type="button" class="btn btn-warning float-right">Edit</button></a>
                                    <form method="POST"  action="{{ route('comments.destroy', ['comment' => $comment->id] ) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger float-right" >Delete</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{route('comments.like',$comment)}}">
                                    {{csrf_field()}}
                                    <div class="form-group float-left">
                                        <button type="submit" class="btn btn-success">Like</button>
                                    </div>
                                </form>
                                @if(($comment->stats) == TRUE)
                                    <div class="xspacing">
                                        <ul><b>Likes:</b> {{$comment->stats->likes}}</ul>
                                    </div>
                                @endif
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <hr>
                    <form id="commentForm"  method="POST" action="{{ route('comments.store', ['post' => $post->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea id="comment" rows="6" class="form-control" name="comment" required autofocus></textarea>
                        <button type="submit" class="btn btn-success btn-lg btn-block">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
        <h3>Comments:</h3>

        <div style="margin-bottom:50px;" v-if="user">
            <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
            <button @click.prevent="postComment">Save Comment</button>
        </div>

        <div class="media" style="margin-top:20px;" v-for="comment in comments">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="http://placeimg.com/80/80" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">@{{comment.user.username}} said...</h4>
                <p>
                @{{comment.comment}}
                </p>
                <span style="color: #aaa;">on</span>
            </div>
        </div>
    </div>
</div>



@endsection
