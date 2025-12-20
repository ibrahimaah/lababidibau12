@use(App\Enums\PageFeatureEnum)

@if(PageFeatureEnum::HOME_COUNTERS->is_enabled())
@isset($counters)

<section id="counts" class="counts">
    <div class="container">

        <div class="row justify-content-end">

            <div class="col-sm d-md-flex align-items-md-stretch">
                <div class="count-box">
                    <span data-toggle="counter-up">{{ $counters->clients }}</span>
                    <p>Zufriedene Kunden</p>
                </div>
            </div>

            <div class="col-sm d-md-flex align-items-md-stretch">
                <div class="count-box">
                    <span data-toggle="counter-up" class="text-primary">{{ $counters->projects }}</span>
                    <p>Projekte</p>
                </div>
            </div>

            <div class="col-sm d-md-flex align-items-md-stretch">
                <div class="count-box">
                    <span data-toggle="counter-up">{{ $counters->years }}</span>
                    <p>Jahre Erfahrung</p>
                </div>
            </div>

            <!-- <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <span data-toggle="counter-up">15</span>
              <p>Awards</p>
            </div>
          </div> -->

        </div>

    </div>
</section>
@endisset
@endif