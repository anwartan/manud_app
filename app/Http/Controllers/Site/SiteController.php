<?php

namespace App\Http\Controllers\Site;

use App\Activity;
use App\Event;
use App\Http\Controllers\Controller;
use App\Layanan;
use App\Lowongan;
use App\Pengaduan;
use App\PressRelease;
use App\ProductRole;
use App\Profile;
use App\Report;
use App\TourismAttraction;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index(){
        $press_release = PressRelease::orderBy('created_at')->get();
        $carousel = PressRelease::orderBy('created_at')->take(3)->get();
        return view('welcome',['press_release'=>$press_release,'carousel'=>$carousel]);
    }

    public function pressView(PressRelease $press_release){
        
        return view('press-release-detail',['press_release'=>$press_release]);
    }

    public function profileOrganization(){
        $profile = Profile::all()->take(1);
      
        return view('organization',['profile'=>$profile[0]]);

    }

    public function layananPekerjaan()
    {
        $pekerjaan = Lowongan::all();
        $carousel = Lowongan::orderBy('created_at')->take(3)->get();
        return view('layanan-pekerjaan',['pekerjaans'=>$pekerjaan,'carousel'=>$carousel]);
    }

    public function layananKesehatan()
    {
        $layanan = Layanan::all();
        $carousel = Layanan::orderBy('created_at')->take(3)->get();
        return view('layanan-kesehatan',['layanans'=>$layanan,'carousel'=>$carousel]);
    }
    public function layananPengaduan()
    {
        $pengaduan = Pengaduan::all()->take(1);
        return view('layanan-pengaduan',['pengaduan'=>$pengaduan[0]]);
    }

    public function information(Request $request)
    {   
        $tag = $request->query('tag');
        $event = Event::where("tag",$tag)->get();
        $carousel = Event::where("tag",$tag)->orderBy('created_at')->take(3)->get();
        return view('event',['events'=>$event,'carousel'=>$carousel,'tag'=>$tag]);
    }
    public function informationDetailView(Event $event)
    {   

        return view('event-detail',['event'=>$event]);
    }
    public function layananWisata()
    {   
        $wisatas = TourismAttraction::all();
        $carousel = TourismAttraction::orderBy('created_at')->take(3)->get();

        return view('layanan-wisata',['wisatas'=>$wisatas,'carousel'=>$carousel]);
    }
    public function layananAktivitas()
    {   
        $activities = Activity::all();
        $carousel = Activity::orderBy('created_at')->take(3)->get();

        return view('layanan-aktivitas',['activities'=>$activities,'carousel'=>$carousel]);
    }
    public function layananLaporan()
    {   
        $laporan = Report::all();
        $carousel = Report::orderBy('created_at')->take(3)->get();

        return view('layanan-laporan',['laporans'=>$laporan,'carousel'=>$carousel]);
    }

    public function layananRulesProduct()
    {   
        $product_roles = ProductRole::all();
        $carousel = ProductRole::orderBy('created_at')->take(3)->get();
        return view('layanan-role-product',['product_roles'=>$product_roles,'carousel'=>$carousel]);
    }
    public function layananRulesProductView(ProductRole $role_product)
    {   

        return view('role-product-detail',['role_product'=>$role_product]);
    }
    public function layananAktivitasView(Activity $activity)
    {   

        return view('aktivitas-detail',['activity'=>$activity]);
    }
    public function layananLaporanDetail(Report $report)
    {   

        return view('laporan-detail',['report'=>$report]);
    }
}
