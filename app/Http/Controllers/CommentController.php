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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$post_id)
    {
        $validateData = $request->validate([
            'comment' => 'required|string',
        ]);
        $post = Post::find($post_id);

        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $validateData['comment'];
        $comment->post()->associate($post);
        $comment->save();

        $stats = new Stats;
        $stats->views = 0;
        $stats->likes = 0;
        $stats->statable_id = $comment->id;
        $stats->statable_type = "Comment";
        $stats->save();

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
}
