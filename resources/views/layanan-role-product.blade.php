@extends('public.master-public')
@section('title', 'Role Product')

@section('content')

    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="owl-carousel main-carousel position-relative">
                    @foreach ($carousel as $item)
                        <div class="position-relative overflow-hidden" style="height: 500px;">
                            <img class="img-fluid h-100" src="{{ URL::to('/') . '/files/' . $item->image_url }}"
                                style="object-fit: cover">
                            <div class="overlay"
                                style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0), grey);">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="">Product Role</a>
                                    <a class="text-white"
                                        href="">{{ date('M d, Y', strtotime($item->created_at)) }}</a>
                                </div>
                                <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                                    href="{{ $item->link_url }}">{{ $item->title }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Rule Product</h4>
                                {{-- <a class="text-secondary font-weight-medium text-decoration-none" href="">View
                                    All</a> --}}
                            </div>
                        </div>
                        @foreach ($product_roles as $item)
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="{{ URL::to('/') . '/files/' . $item->image_url }}"
                                        style="object-fit: cover; height:200px">
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                href="">Rule Product</a>
                                            <a class="text-body"
                                                href=""><small>{{ date('M d, Y', strtotime($item->created_at)) }}</small></a>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                            href="{{ url('/information-role-product') . '/' . $item->id }}">{{ $item->title }}</a>
                                        <p class="m-0 text-ellipsis">{{ $item->description }}</p>
                                        <div class="row">
                                            <div class="col-12">
                                                @if (!empty($item->link_url))
                                                    <a target="_blank" href="{{ $item->link_url }}"
                                                        class="badge badge-primary text-uppercase float-right font-weight-semi-bold p-2 mr-2">
                                                        <i class="fa fa-globe "></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
