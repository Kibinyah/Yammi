<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use App\Role;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
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
        return view('admin.users.index')->with('users',$users);
    }

    /**
     * Show a user
     */
    public function show(User $user)
    {
        //$user = User::findOrFail($id);
        if(Gate::denies('manage-users')){
            return redirect()->back();
        }

        if(($user->profile) == false){
            Profile::Create([
                'name' => NULL,
                'bio' => NULL,
                'dateOfBirth' => NULL,
                'user_id' => $user->id,
            ]);
        }
        
        return view('admin.users.show',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user'=>$user,
            'roles'=> $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
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

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.show',$user)->with(['success' => 'User successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }

        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index')->with(['success' => 'User successfully deleted']);
    }
}
