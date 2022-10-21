<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lowongan = Lowongan::all();
        return view('pages.lowongan',['lowongans'=>$lowongan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-lowongan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'link_url'=>'required|url',
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

        $lowongan = new Lowongan();
        $lowongan->title = $request->title;
        $lowongan->description = $request->description;
        $lowongan->link_url = $request->link_url;
        $lowongan->image_url = $image;
        $lowongan->attachments=collect($data)->implode(";");
        $lowongan->save();
        return redirect('/lowongan')
                        ->with('success','Lowongan created successfully.');
        
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
    public function edit(Lowongan $lowongan)
    {
        return view('pages.edit-lowongan',compact('lowongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Lowongan $lowongan)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'link_url'=>'required|url',
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
        $lowongan->title = $request->title;
        $lowongan->description = $request->description;
        if(!empty($image)){
            $lowongan->image_url=$image;
        }
        $lowongan->link_url = $request->link_url;
        $lowongan->attachments=collect($data)->implode(";");
        $lowongan->save();
        return redirect('/lowongan')
            ->with('success','Lowongan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return redirect('/lowongan')
            ->with('success','Lowongan deleted successfully.');
    }
}
