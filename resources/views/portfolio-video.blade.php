@extends('layouts.app')
@section('title','Videogalerie')
@section('meta_keywords', 'Videogalerie')
@section('content')



@isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset

<div class="top-img w-100">
    <img src="{{ asset('assets/img/images/a.jpg') }}" alt="top image" class="w-100">
</div>
<div class="container py-5">
    <div class="section-title">
        <h2 data-aos="flip-left"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="2000" style="text-decoration: underline;">Videogalerie</h2>
        <!-- <p data-aos="zoom-in" data-aos-delay="200">Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
    </div>
    <div class="row">
        @foreach($videos as $video)
        <div class="card-deck col-md-3 mb-4" data-aos="fade-up">
            <div class="card">

                <a data-fancybox href="#myVideo{{ $video->id }}">
                    <img class="card-img-top img-fluid" src="{{ asset('storage/videos/thumbnails/'.$video->thumb) }}"  style="height:200px"/>
                </a>

                <div class="card-body">
                    <p class="card-text">{{ $video->title }}</p>
                </div>

                <video width="800" height="500" controls id="myVideo{{ $video->id }}" style="display:none;">
                    <source src="{{ asset('storage/videos/'.$video->name) }}" type="video/mp4">
                    Your browser doesn't support HTML5 video tag.
                </video>
            </div>
        </div>
        @endforeach
    </div>
</div>
<a href="https://api.whatsapp.com/send?phone=<?=$contacts->call  ?? '491711172776'?>&text=&source=&data=" class="whatsApp" target="_blank"><i class="fa fa-whatsapp my-whatsApp"></i></a>

@isset($categories)
  @include('partials._footer',['categories',$categories])
@else
  @include('partials._footer')
@endisset
    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
    
@endsection