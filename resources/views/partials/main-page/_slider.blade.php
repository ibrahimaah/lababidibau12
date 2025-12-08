@if(setting('slider_enabled', false) && $sliders->isNotEmpty())
<div class="container">
    <div id="slider" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <!-- Indicators -->
        <div class="carousel-indicators">
            @php $i = 0; @endphp
            @foreach($sliders as $slider)
            @foreach($slider->getMedia('slider-images') as $media)
            <button type="button" data-bs-target="#slider" data-bs-slide-to="{{ $i }}"
                class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $i + 1 }}">
            </button>
            @php $i++; @endphp
            @endforeach
            @endforeach
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            @php $i = 0; @endphp
            @foreach($sliders as $slider)
            @foreach($slider->getMedia('slider-images') as $media)
            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                <img src="{{ $media->getUrl() }}" class="d-block w-100" alt="Slide {{ $i + 1 }}">
            </div>
            @php $i++; @endphp
            @endforeach
            @endforeach
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#slider"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slider"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
</div>
@endif

@push('scripts')
<script>
    $(function(){
        var myCarousel = document.getElementById('slider');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 3000, // 3 seconds
            ride: 'carousel'
        });
    });
    </script>
    
@endpush