<?php

namespace App\Http\Controllers;

use App\Budget;
use App\FileUpload;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::all();
        return view('pages.budget',['budgets'=>$budgets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-budget');
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
        
             $request->validate([
                'budget_date' => 'required|date_format:d/m/Y',
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'attachments.*'=>'max:2048',
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
            $budget = new Budget();
            $budget->title = $request->title;
            
            $budget->budget_date=Carbon::createFromFormat('d/m/Y', $request->budget_date)->format('Y-m-d');
            $budget->description = $request->description;
            $budget->attachments=collect($data)->implode(";");
            $budget->save();
            return redirect('/budget')
            ->with('success','Budget created successfully.');
        }catch(Exception $ex){
            return redirect('/budget')
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
    public function edit(Budget $budget)
    {
        return view('pages.edit-budget',compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Budget $budget)
    {
        $request->validate([
            'title' => 'required|max:255',
            'budget_date' => 'required|date_format:d/m/Y',
            'description' => 'required|max:255',
            'attachments.*'=>'max:2048',
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
        $budget->title = $request->title;
        $budget->description = $request->description;
        $budget->budget_date=Carbon::createFromFormat('d/m/Y', $request->budget_date)->format('Y-m-d');
        $budget->attachments=collect($data)->implode(";");
        $budget->save();
        return redirect('/budget')
            ->with('success','Budget updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect('/budget')
            ->with('success','Budget deleted successfully.');
    }
}
