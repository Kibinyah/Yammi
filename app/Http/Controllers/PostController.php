<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Stats;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
use Gate;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #$posts = Auth::Post()->get();
        /*
         ->withCount('visits')
            ->with('latest_visit')
            ->get()
        */
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
        $tags = Tag::all();
        return view('posts.create')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #dd($request);
        $validateData = $request->validate([
            'title' => 'required|max:255|string',
            'content' => 'required|max:255|string',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.png';
        }


        $p = new Post;
        $p->title = $validateData['title'];
        $p->content = $validateData['content'];
        $p->user_id = Auth::id();
        $p->cover_image = $fileNameToStore;
        $p->save();

        $p->tags()->sync($request->tags, false); 

        $stats = new Stats;
        $stats->views = 0;
        $stats->likes = 0;
        $stats->statable_id = $p->id;
        $stats->statable_type = "Post";
        $stats->save();

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
        if(Gate::denies('isAdmin')){
            if(auth()->user()->id !== $post->user_id){
                return redirect('/posts')->with('error','Unauthorised Page');
            }
        }


        $tags = Tag::all();
        $tags2 = array();
        foreach($tags as $tag){
            $tags2[$tag->id] = $tag->name;
        }
        return view('posts.edit',['post' => $post])->withTags($tags2);
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
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        /*$post->update($request->only([
               'title',
               'content',
        ]));
        */
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        $post->tags()->sync($request->tags); 

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

        //Check correct user
        if(Gate::denies('isAdmin')){
            if(auth()->user()->id !== $post->user_id){
                return redirect('/posts')->with('error','Unauthorised Page');
            }
        }


        if($post->cover_image != NULL){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->tags()->detach();

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
