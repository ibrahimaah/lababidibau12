@extends('layouts.app')
@section('title','Videogalerie')
@section('meta_keywords', 'Videogalerie')
@section('content')


@push('styles')
    <!-- Add these to your head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
@endpush
{{-- @isset($social)
@include('partials._header',['social',$social])
@else
@include('partials._header')
@endisset --}}

@include('partials.main-page._hero_img')

<div class="container py-5">
    <div class="section-title">
        <h2 data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000"
            style="text-decoration: underline;">Videogalerie</h2>
        <!-- <p data-aos="zoom-in" data-aos-delay="200">Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
    </div>
    <div class="row">
        @foreach($videos as $video)
        <div class="card-deck col-md-3 mb-4" data-aos="fade-up">
            <div class="card">
                @if($video->hasMedia('videos'))
                    <!-- Video thumbnail click triggers fancybox -->
                    <a href="{{ $video->getFirstMediaUrl('videos') }}" 
                       data-fancybox="video-gallery"
                       data-type="video"
                       data-caption="{{ $video->title }}"
                       @if($video->hasMedia('thumbnails'))
                       data-thumb="{{ $video->getFirstMediaUrl('thumbnails') }}"
                       @endif>
                        @if($video->hasMedia('thumbnails'))
                            <img class="card-img-top img-fluid" 
                                 src="{{ $video->getFirstMediaUrl('thumbnails') }}"  
                                 style="height:200px; object-fit: cover;"
                                 alt="{{ $video->title }}">
                        @else
                            <!-- Fallback if no thumbnail -->
                            <div class="bg-dark text-center" style="height:200px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-video text-white fa-3x"></i>
                            </div>
                        @endif
                    </a>
                @endif
    
                <div class="card-body">
                    <p class="card-text">{{ $video->title }}</p>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        {{ $video->created_at->format('M d, Y') }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<a href="https://api.whatsapp.com/send?phone=<?=$contacts->call  ?? '491711172776'?>&text=&source=&data="
    class="whatsApp" target="_blank"><i class="fa fa-whatsapp my-whatsApp"></i></a>

@isset($categories)
@include('partials._footer',['categories',$categories])
@else
@include('partials._footer')
@endisset
<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

@endsection

@push('scripts')
    <!-- Add this before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    // Initialize Fancybox
    Fancybox.bind("[data-fancybox]", {
        // Optional configuration
        Thumbs: false,
        Toolbar: {
            display: {
                left: [],
                middle: [],
                right: ["close"],
            },
        },
        // Auto-play videos
        on: {
            reveal: (fancybox, slide) => {
                // Auto-play video when opened
                const video = slide.$el.querySelector("video");
                if (video) {
                    video.play().catch(e => console.log("Video autoplay prevented"));
                }
            },
            close: (fancybox) => {
                // Pause all videos when closing
                document.querySelectorAll("video").forEach(video => {
                    video.pause();
                    video.currentTime = 0;
                });
            }
        }
    });
</script>
@endpush