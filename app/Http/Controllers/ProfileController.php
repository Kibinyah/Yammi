<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

use Auth;

class ProfileController extends Controller
{

    use UploadTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return view('auth.profile');
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
    public function show()
    {
       
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
        return view('profiles.edit',['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string|nullable',
            'dateOfBirth' => 'string|nullable',
            'bio' => 'string|nullable',
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

        $profile = User::find(1)
        $profile->user_id = Auth::id();
        $profile->name = $request->input('name');
        #$user->email = $request->input('email');
        $profile->dateOfBirth = $request->input('dateOfBirth');
        $profile->bio = $request->input('bio');
        

        if($request->has('profile_image')){
            $image = $request->file('profile_image');
            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image,$folder,'public',$name);
            $profile->profile_image = $filePath;
        }

        $profile->save();



        return redirect()->back()->with(['success' => 'Profile successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
