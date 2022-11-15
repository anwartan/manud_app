<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::all()->take(1);
        return view('pages.report',['reports'=>$report]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-report');
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
            'description' => 'required',
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
        $report = new Report();
        $report->title = $request->title;
        $report->description = $request->description;
        $report->attachments=collect($data)->implode(";");
        $report->save();
        return redirect('/report')
                        ->with('success','Report created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return view('pages.edit-report',compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'attachments.*'=>'max:5120',
        ]);
        
        $data = $request->old_attachments;
       
        if($request->hasfile('attachments'))
        {
            foreach($request->file('attachments') as $file)
            {
                 $name = FileUpload::upload($file);
                 $data[] = $name;  
            }
        }
        $report->title = $request->title;
        $report->description = $request->description;
        $report->attachments=collect($data)->implode(";");
        $report->save();
        return redirect('/report')
            ->with('success','Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect('/report')
            ->with('success','Report deleted successfully.');
    }
}
