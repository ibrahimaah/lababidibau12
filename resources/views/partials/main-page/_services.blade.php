@use(App\Enums\PageFeatureEnum)

@if(PageFeatureEnum::HOME_CATEGORIES->is_enabled())

<section id="leistungen" class="services">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2 style="text-decoration: underline;">services</h2>
        
      </div>

      <div class="row">
      @if($categories->isNotEmpty())
        @foreach($categories as $category)

        <div class="col-sm mt-4">
          <div class="card text-center m-auto px-2 pb-2 pt-3" style="width: 18rem;background-color:#f8fbfe" data-aos="zoom-in" data-aos-delay="100">
            <a href="{{ route('portfolio-image-category',$category->id) }}">
             <img class="card-img-top" src="{{ $category->getFirstMediaUrl('icons', 'thumb') }}" alt="Category Icon">
            </a>
            <div class="card-body" style="background-color:#f8fbfe">
              <p class="card-text">
               <a href="{{ route('portfolio-image-category',$category->id) }}">{{ $category->name }}</a>
              </p>
            </div>
          </div>
        </div>
        @endforeach
      @endif
      </div>

    </div>
  </section>

  @endif