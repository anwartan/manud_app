<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\PressRelease;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index(){
        $press_release = PressRelease::orderBy('created_at')->get();
        $carousel = PressRelease::orderBy('created_at')->take(3)->get();
        return view('welcome',['press_release'=>$press_release,'carousel'=>$carousel]);
    }

    public function profileOrganization(){
    
        return view('organization');

    }
}
