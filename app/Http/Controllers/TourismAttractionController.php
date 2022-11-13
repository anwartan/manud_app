<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\TourismAttraction;
use Illuminate\Http\Request;

class TourismAttractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourism_attraction = TourismAttraction::all();
        return view('pages.tourism-attraction',['tourism_attractions'=>$tourism_attraction]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-tourism-attraction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'link_url' =>'required|url',
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

        $tourism_attraction = new TourismAttraction();
        $tourism_attraction->title = $request->title;
        $tourism_attraction->description = $request->description;
        $tourism_attraction->link_url=$request->link_url;
        $tourism_attraction->image_url = $image;
        $tourism_attraction->attachments=collect($data)->implode(";");
        $tourism_attraction->save();
        return redirect('/tourism-attraction')
                        ->with('success','Tourism Attraction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TourismAttraction  $tourismAttraction
     * @return \Illuminate\Http\Response
     */
    public function show(TourismAttraction $tourismAttraction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TourismAttraction  $tourismAttraction
     * @return \Illuminate\Http\Response
     */
    public function edit(TourismAttraction $tourism_attraction)
    {
        return view('pages.edit-tourism-attraction',compact('tourism_attraction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TourismAttraction  $tourismAttraction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TourismAttraction $tourism_attraction)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'link_url' =>'required|url',
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
        $tourism_attraction->title = $request->title;
        $tourism_attraction->description = $request->description;
        $tourism_attraction->link_url=$request->link_url;
        if(!empty($image)){
            $tourism_attraction->image_url=$image;
        }
        $tourism_attraction->attachments=collect($data)->implode(";");
        $tourism_attraction->save();
        return redirect('/press-release')
            ->with('success','Product Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TourismAttraction  $tourismAttraction
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourismAttraction $tourism_attraction)
    {
        $tourism_attraction->delete();
        return redirect('/tourism-attraction')
            ->with('success','Tourism Attraction deleted successfully.');
    }
}
