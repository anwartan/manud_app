@extends('public.master-public')
@section('title', 'Profile Organization')

@section('content')

    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="owl-carousel main-carousel position-relative">

                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{ URL::to('/') . '/files/' . $event->image_url }}"
                            style="object-fit: cover;">
                        <div class="overlay" style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0), grey);">
                        </div>
                        {{-- <a class="h2 m-0 text-dark text-uppercase font-weight-bold"
                            href="">{{ $press_release->title }}</a> --}}
                    </div>


                </div>
            </div>

        </div>
    </div>

    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">{{ $event->title }}</h4>
                            @if (!empty($event->link_url))
                                <a target="_blank" href="{{ $event->link_url }}"
                                    class="badge badge-primary text-uppercase float-right font-weight-semi-bold p-2 mr-2">
                                    <i class="fa fa-globe "></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 text-justify">
                        <div class="bg-white border border-top-0 p-4">

                            <p class="text-dark">{{ $event->description }}</p>

                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
@stop
