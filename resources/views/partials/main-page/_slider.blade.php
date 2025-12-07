@if(setting('slider_enabled', false))
@if($sliders->isNotEmpty())
<div class="container d-none d-md-block">
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            @foreach($sliders as $image)
            <li data-target="#demo" data-slide-to="<?=$loop->first ? '0' : $loop->index;?>"
                class="<?=$loop->first ? 'active' :'';?>"></li>
            @endforeach
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner" style="border-radius: 50px;">
            @foreach($sliders as $slider)
            @foreach($slider->getMedia('slider-images') as $media)
            <div class="carousel-item {{ $loop->parent->first && $loop->first ? 'active' : '' }}">
                <img src="{{ $media->getUrl() }}" alt="Slider Image" class="d-block w-100">
            </div>
            @endforeach
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>

    </div>
</div>
@endif
@endif