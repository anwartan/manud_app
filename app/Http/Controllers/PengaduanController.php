<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::all()->take(1);
        return view('pages.edit-pengaduan',['pengaduan'=>$pengaduan[0]]);

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
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'link_url'=>'required|url',
                'image' => 'mimetypes:image/png,image/jpeg,image/svg|max:5120',
                'attachments.*'=>'max:5120',
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
            $pengaduan->title = $request->title;
            $pengaduan->description = $request->description;
            if(!empty($image)){
                $pengaduan->image_url=$image;
            }
            $pengaduan->link_url = $request->link_url;
            $pengaduan->attachments=collect($data)->implode(";");
            $pengaduan->save();
            return redirect('/pengaduan')
                ->with('success','Pengaduan updated successfully.');
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }
}
