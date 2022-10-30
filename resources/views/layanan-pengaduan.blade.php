@extends('public.master-public')
@section('title', 'Pengaduan')

@section('content')

    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="owl-carousel main-carousel position-relative">

                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{ URL::to('/') . '/files/' . $pengaduan->image_url }}"
                            style="object-fit: cover;">
                        <div class="overlay" style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0), grey);">
                            {{-- <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="">Lowongan</a>
                                <a class="text-white"
                                    href="">{{ date('M d, Y', strtotime($item->created_at)) }}</a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                                href="{{ $item->link_url }}">{{ $item->title }}</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Pengaduan</h4>

                        </div>
                    </div>
                    <div class="col-12 text-justify">
                        <div class="bg-white border border-top-0 p-4">
                            <h5 class="m-0 text-uppercase font-weight-bold">{{ $pengaduan->title }}</h5>
                            <p class="text-dark">{{ $pengaduan->description }}</p>
                            <br>
                            <h5 class="m-0 text-uppercase font-weight-bold">Link Pengaduan</h5>
                            <a target="_blank" href="{{ $pengaduan->link_url }}"
                                class="text-dark">{{ $pengaduan->link_url }}</p>

                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
@stop
