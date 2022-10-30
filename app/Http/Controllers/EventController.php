<?php

namespace App\Http\Controllers;

use App\Event;
use App\FileUpload;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::all();
        return view('pages.event',['event'=>$event]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Event::tags();
      
        return view('pages.create-event',['tags'=>$tags]);
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
            'tag'=>'required',
            'link_url'=>'url',
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

        $event = new Event();
        $event->title = $request->title;
        $event->tag = $request->tag;
        $event->description = $request->description;
        $event->link_url=$request->link_url;
        $event->image_url = $image;
        $event->attachments=collect($data)->implode(";");
        $event->save();
        return redirect('/event')
                        ->with('success','Event created successfully.');
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
    public function edit(Event $event)
    {
        $tags = Event::tags();

        return view('pages.edit-event',['event'=>$event,'tags'=>$tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event $event)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'tag'=>'required',
            'link_url'=>'url',
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
        $event->title = $request->title;
        $event->description = $request->description;
        if(!empty($image)){
            $event->image_url=$image;
        }
        $event->link_url=$request->link_url;
        $event->tag = $request->tag;
        $event->attachments=collect($data)->implode(";");
        $event->save();
        return redirect('/event')
            ->with('success','Event updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect('/event')
            ->with('success','Event deleted successfully.');
    }
}
