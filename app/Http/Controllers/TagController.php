<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tag;
use App\Post;
use Gate;

class TagController extends Controller
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
        //
        if(Gate::denies('isAdmin')){
            return redirect()->back();
        }
        $tag = Tag::all();
        return view('tags.index',['tags' => $tag]);
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'max:255|required'
        ]);
        $tag = new Tag;
        $tag->name = $request->input('name');
        $tag->save();

        Session::flash('success','New Tag created successfully.');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
        if(Gate::denies('isAdmin')){
           return redirect()->back();
        }
        return view('tags.show',['tag'=>$tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(Gate::denies('isAdmin')){
            return redirect()->back();
        }
        $tag = Tag::find($id);
        return view('tags.edit',['tag' => $tag]);
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = $request->input('name');
        $tag->save();
        
        Session::flash('success','Tag saved!');

        return redirect()->route('tags.show',$tag)->with(['success' => 'Tag successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
        $tag->posts()->detach();

        $tag->delete();

        return redirect()->route('tags.index')->with('message','Tag was deleted.');
    }
}
