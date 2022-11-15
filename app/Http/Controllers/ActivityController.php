<?php

namespace App\Http\Controllers;

use App\Activity;
use App\FileUpload;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        return view('pages.activity',['activities'=>$activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-activity');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        
           $validate= $request->validate([
               'title' => 'required|max:255',
               'description' => 'required|max:255',
               'attachments.*'=>'max:5120',
           ]);
           
           $data=[];
           if($request->hasfile('attachments'))
           {
   
              foreach($request->file('attachments') as $file)
              {
                   $name = FileUpload::upload($file);
                   $data[] = $name;  
              }
           }
           $activity = new Activity();
           $activity->title = $request->title;
           $activity->description = $request->description;
           $activity->attachments=collect($data)->implode(";");
           $activity->save();
           return redirect('/activity')
           ->with('success','Activity created successfully.');
       }catch(Exception $ex){
        dd($ex);
           return redirect('/activity')
           ->with('failed',$ex->getMessage());
       }
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
    public function edit(Activity $activity)
    {
        return view('pages.edit-activity',compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Activity $activity)
    {
        try{
        
            $request->validate([
               'title' => 'required|max:255',
               'description' => 'required|max:255',
               'attachments.*'=>'max:5120',
           ]);
           $data=[];
           if($request->hasfile('attachments'))
           {
   
              foreach($request->file('attachments') as $file)
              {
                   $name = FileUpload::upload($file);
                   $data[] = $name;  
              }
           }
           $activity->title = $request->title;
           $activity->description = $request->description;
           $activity->attachments=collect($data)->implode(";");
           $activity->save();
           return redirect('/activity')
           ->with('success','Activity updated successfully.');
       }catch(Exception $ex){
           return redirect('/activity')
           ->with('failed',$ex->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect('/activity')
            ->with('success','Activity deleted successfully.');
    }
}
