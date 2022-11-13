<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\ProductRole;
use Illuminate\Http\Request;

class ProductRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_role = ProductRole::all();
        return view('pages.product-role',['product_roles'=>$product_role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-product-role');
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

        $product_role = new ProductRole();
        $product_role->title = $request->title;
        $product_role->description = $request->description;
        $product_role->link_url=$request->link_url;
        $product_role->image_url = $image;
        $product_role->attachments=collect($data)->implode(";");
        $product_role->save();
        return redirect('/product-role')
                        ->with('success','Product Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductRole  $productRole
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRole $productRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductRole  $productRole
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRole $product_role)
    {
        return view('pages.edit-product-role',compact('product_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductRole  $productRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRole $productRole)
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
        $productRole->title = $request->title;
        $productRole->description = $request->description;
        $productRole->link_url=$request->link_url;
        if(!empty($image)){
            $productRole->image_url=$image;
        }
        $productRole->attachments=collect($data)->implode(";");
        $productRole->save();
        return redirect('/press-release')
            ->with('success','Product Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductRole  $productRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRole $product_role)
    {
        $product_role->delete();
        return redirect('/product-role')
            ->with('success','Product Role deleted successfully.');
    }
}
