@use(App\Enums\PageFeatureEnum)

@if(PageFeatureEnum::HOME_ABOUT->is_enabled())

<section id="about" class="about section-bg">
    <div class="container" data-aos="fade-up">

        @isset($about_us)
        <div class="section-title">
            <h2 style="text-decoration: underline;">{{ $about_us->title }}</h2>
            <p>{{ $about_us->desc }}</p>
            <p>Wir bieten Ihnen folgende Leistungen:</p>
        </div>
        @endisset

        <div class="row content about-section">
            @if($services->isNotEmpty())
            @foreach($services as $service)
            <div class="col-sm-6">
                <ul>
                    <li><i class="ri-check-double-line"></i> {{ $service->name }} </li>
                </ul>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
@endif