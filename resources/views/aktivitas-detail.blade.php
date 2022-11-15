@extends('public.master-public')
@section('title', 'Profile Organization')

@section('content')

    <!-- Main News Slider Start -->
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-lg-12 px-0">
                <div class="owl-carousel main-carousel position-relative">

                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{ URL::to('/') . '/files/' . $event->image_url }}"
                            style="object-fit: cover;">
                        <div class="overlay" style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0), grey);">
                        </div>
                        <a class="h2 m-0 text-dark text-uppercase font-weight-bold"
                            href="">{{ $press_release->title }}</a>
                    </div>


                </div>
            </div>

        </div> --}}
    </div>

    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">{{ $activity->title }}</h4>
                            @if (!empty($activity->link_url))
                                <a target="_blank" href="{{ $activity->link_url }}"
                                    class="badge badge-primary text-uppercase float-right font-weight-semi-bold p-2 mr-2">
                                    <i class="fa fa-globe "></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 text-justify">
                        <div class="bg-white border border-top-0 p-4">

                            <p class="text-dark">{{ $activity->description }}</p>
                            @php
                                $arrayAttachments = explode(';', $activity->attachments);
                            @endphp
                            <ul class="list-unstyled">
                                @foreach ($arrayAttachments as $key => $item)
                                    @php
                                        $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                                        
                                        $icon = 'fa-file';
                                        if ($ext == 'pdf') {
                                            $icon = 'fa-file-pdf';
                                        } elseif ($ext == 'word') {
                                            $icon = 'fa-file-word';
                                        } elseif (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                                            $icon = 'fa-file-image';
                                        }
                                    @endphp
                                    @if (!empty($item))
                                        <li class="list-attachment">
                                            <input type="hidden" name="old_attachments[{{ $key }}]"
                                                value="{{ $item }}" />
                                            <a target="_blank" href="{{ URL::to('/') . '/files/' . $item }}"
                                                class="btn-link text-secondary"><i
                                                    class="far fa-fw {{ $icon }}"></i>
                                                {{ $item }} </a>
                                            

                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
@stop
