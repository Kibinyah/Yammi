<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Stats;
use Illuminate\Http\Request;
use Session;
use Auth;
use Gate;

class CommentController extends Controller
{
    public function apiIndex()
    {
        $post = substr(url()->previous(),26);
        $comments = Comment::findOrFail($post);
        return $comments;
    }

    public function apiStore(Request $request)
    {
        $validateData = $request->validate([
            'comment' => 'required|string',
        ]);

        $post = substr(url()->previous(),24);
        
        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $validateData['comment'];
        $comment->post()->associate($post);
        $comment->save();
        
        $comment = Comment::where('id', $comment->id)->with('user')->first();

        $stats = new Stats;
        $stats->views = 0;
        $stats->likes = 0;
        $stats->statable_id = $comment->id;
        $stats->statable_type = "App\Comment";
        $stats->save();
        
        return $comment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post)
    {
        $validateData = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $validateData['comment'];
        $comment->post()->associate($post);
        $comment->save();
        
        $comment = Comment::where('id', $comment->id)->with('user')->first();

        $stats = new Stats;
        $stats->views = 0;
        $stats->likes = 0;
        $stats->statable_id = $comment->id;
        $stats->statable_type = "App\Comment";
        $stats->save();

        #return $comment->toJson();
        return back()
            ->with('response','Comment Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        
        if(Gate::denies('isAdmin')){
            if(auth()->user()->id !== $comment->user_id){
                return redirect()->route('posts.show',['post'=>$comment->post])->with('error','Unauthorised');
            }
        }

        return view('comments.edit')->withComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        #dd($request);
        $comment = Comment::find($id);
        $request->validate([
            'comment' => 'required|string'
        ]);

        $comment->comment = $request->input('comment');
        $comment->save();
      
        

        Session::flash('success','Comment updated');
        return redirect()->route('posts.show',['post' => $comment->post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        if(Gate::denies('isAdmin')){
            if(auth()->user()->id !== $comment->user_id){
                return redirect()->route('posts.show',['post'=>$comment->post])->with('error','Unauthorised');
            }
        }

        $post = $comment->post;
        $comment -> delete();
        return redirect()->route('posts.show',['post' => $post]);
    }

    public function addLike(Request $request, Comment $comment)
    {
        $loggedin_user = Auth::user()->id;
        $comment->stats->likes += 1;
        $comment->post->stats->views -= 1;
        $comment->stats->save();

        return redirect()->back();
    }
}
