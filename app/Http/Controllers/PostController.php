<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;

use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #$posts = Auth::Post()->get();
        $posts = Post::all();
        return view('posts.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$posts = Post::all();
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request['user_id']);
        $validateData = $request->validate([
            'title' => 'required|max:255|string',
            'content' => 'required|max:255|string',
        ]);

        $p = new Post;
        $p->title = $validateData['title'];
        $p->content = $validateData['content'];
        $p->user_id = Auth::id();
        $p->save();

        session()->flash('message','Post is created.');
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //$post = Post::findOrFail($id);
        return view('posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('posts.edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            'title' => 'required|max:255|string',
            'content' => 'required|max:255|string'
        ]);

        $post->update($request->only([
               'title',
                'content'
        ]));
       
        session()->flash('message','Post is updated.');
        return redirect()->route('posts.index');
            #->with(['success' => 'All changes successfully saved']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //$post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('message','Post was deleted.');
    }

    /**
     * 
     */
    public function comment(Request $request,  $post)
    {
        $validateData = $request->validate([
            'comment' => 'required|string',
        ]);
        $comment = new comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $validateData['comment'];
        $comment->save();

        return redirect('/post/{$post}')
            ->with('response','Comment Added Successfully');
            
    }
}
