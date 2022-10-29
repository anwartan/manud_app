<?php

namespace App\Http\Controllers;

use App\Layanan;
use App\Lowongan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Layanan::all();
        return view('pages.layanan',['layanans'=>$layanan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-layanan');
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
            'name' => 'required|max:255',
            'schedule' => 'required|date_format:d/m/Y h:i A',
        ]);

        $layanan = new Layanan();
        $layanan->name = $request->name;
        $layanan->schedule = Carbon::createFromFormat('d/m/Y h:i A',$request->schedule)->format('Y-m-d H:i:s');
        $layanan->save();
        return redirect('/layanan')
                        ->with('success','Layanan created successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan $layanan)
    {
        return view('pages.edit-layanan',compact('layanan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'name' => 'required|max:255',
            'schedule' => 'required|date_format:d/m/Y h:i A',
        ]);
        $layanan->name = $request->name;
        $layanan->schedule = Carbon::createFromFormat('d/m/Y h:i A',$request->schedule)->format('Y-m-d H:i:s');
        $layanan->save();
        return redirect('/layanan')
                        ->with('success','Layanan updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        
        $layanan->delete();
        return redirect('/layanan')
            ->with('success','Layanan deleted successfully.');
    
        
    }
}
