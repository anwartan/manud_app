@extends('public.master-public')
@section('title', 'Profile Organization')

@section('content')

    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="owl-carousel main-carousel position-relative">

                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{ URL::to('/') . '/files/' . $profile->image_url }}"
                            style="object-fit: cover;">
                        <div class="overlay">
                            {{-- <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="">Press</a>
                                <a class="text-white" href="">{{ date('M d, Y', strtotime($item->created_at)) }}</a>
                            </div> --}}
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                                href="">{{ $profile->name }}</a>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <!-- Main News Slider End -->
    <div class="container-fluid bg-dark py-3 mb-3">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    {{-- <div class="d-flex justify-content-between">
                        <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">
                            Breaking News</div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 170px); padding-right: 90px;">
                            <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold"
                                    href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante
                                    tincidunt, sed faucibus nisl sodales</a></div>
                            <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold"
                                    href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante
                                    tincidunt, sed faucibus nisl sodales</a></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Profile</h4>

                            </div>
                        </div>
                        <div class="col-12">
                            <p>{{ $profile->description }}</p>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@stop
