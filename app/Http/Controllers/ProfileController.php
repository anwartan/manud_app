<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::all()->take(1);
        
        return view('pages.profile',['profile'=>$profile[0]]);
    }
    public function update(Request $request,Profile $profile){
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' =>'mimetypes:image/png,image/jpeg,image/svg|max:2048',
            'vision'=>'required',
            'mission'=>'required'
        ]);
        $image="";
        if($request->hasfile('image'))
        {
            $image = FileUpload::upload($request->file('image'));

        }
        $profile->name=$request->name;
        $profile->vision=$request->vision;
        $profile->mission=$request->mission;
        $profile->description=$request->description;
        if(!empty($image)){
            $profile->image_url=$image;
        }
       
        $profile->save();

        return redirect('/profile')->with('success','Profile updated successfully');
 
    }
}
