<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;

class UserController extends Controller
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
        $users = User::all();
        return view('users.index',['users' => $users]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$user = User::findOrFail($id);
        if(($user->profile) == false){
            Profile::Create([
                'name' => NULL,
                'bio' => NULL,
                'dateOfBirth' => NULL,
                'user_id' => $user->id,
            ]);
        }
        
        return view('users.show',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        if(auth()->user() != $user){
            return redirect()->back();
        }
        return view('users.edit',['user' => $user]);
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
        $request->validate([
            'email' => 'string|required',
            'name' => 'string|nullable',
            'dateOfBirth' => 'date|nullable',
            'bio' => 'string|nullable',
        ]);
        //Handle file upload
        if($request->hasFile('profile_image')){
            //Get filename with extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('profile_image')->storeAs('public/profile_images',$fileNameToStore);
        }else{
            $fileNameToStore = "noimage.png";
        }

        $user = User::findOrFail($id);
        $user->email = NULL;
        $user->email = $request->input('email');
        $user->profile_image = $fileNameToStore;
        $user->save();

        if(($user->profile) == true){
            $profile = $user->profile;
        }else{
            $profile = new Profile();
            $profile->user_id = $id;
        }
        $profile->name = $request->input('name');
        $profile->dateOfBirth = $request->input('dateOfBirth');
        $profile->bio = $request->input('bio');
        $profile->save();

        return redirect()->route('users.show',$user)->with(['success' => 'Profile successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
