<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\PressRelease;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class PressReleaseController extends Controller
{
    public function index()
    {
        $press_release = PressRelease::all();
        return view('pages.press-release',['press_releases'=>$press_release]);
    }
    public function create()
    {
        return view('pages.create-press-release');
    }

    public function save(Request $request){
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|mimetypes:image/png,image/jpeg,image/svg|max:2048',
            'attachments.*'=>'max:2048',
        ]);
        $image = FileUpload::upload($request->file('image'));
        $data=[];
        if($request->hasfile('attachments'))
        {

           foreach($request->file('attachments') as $file)
           {
                $name = FileUpload::upload($file);
                $data[] = $name;  
           }
        }

        $press_release = new PressRelease();
        $press_release->title = $request->title;
        $press_release->description = $request->description;
        $press_release->image_url = $image;
        $press_release->attachments=collect($data)->implode(";");
        $press_release->save();
        return redirect('/press-release')
                        ->with('success','Press Release created successfully.');
        
    }
    public function edit(PressRelease $press_release){
        return view('pages.edit-press-release',compact('press_release'));
    }

    public function update(Request $request,PressRelease $press_release){
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'mimetypes:image/png,image/jpeg,image/svg|max:2048',
            'attachments.*'=>'max:2048',
        ]);
        $image="";
        if($request->hasfile('image'))
        {
            $image = FileUpload::upload($request->file('image'));
        }
        $data = $request->old_attachments;
       
        if($request->hasfile('attachments'))
        {
            foreach($request->file('attachments') as $file)
            {
                 $name = FileUpload::upload($file);
                 $data[] = $name;  
            }
        }
        $press_release->title = $request->title;
        $press_release->description = $request->description;
        if(!empty($image)){
            $press_release->image_url=$image;
        }
        $press_release->attachments=collect($data)->implode(";");
        $press_release->save();
        return redirect('/press-release')
            ->with('success','Press Release updated successfully.');

    }

    public function destroy(PressRelease $press_release)
    {   
        $press_release->delete();
        return redirect('/press-release')
            ->with('success','Press Release deleted successfully.');
    }
}
