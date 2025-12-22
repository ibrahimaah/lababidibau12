@use(App\Enums\PageFeatureEnum)

@if(PageFeatureEnum::HOME_CONTACT->is_enabled())
<section id="Kontakt" class="container contact bg-primary pt-5 pb-3">
    <div class="container" data-aos="fade-up">


        <h2 class="text-center text-light" style="text-decoration: underline;">KONTAKT</h2>
        <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->




        <div class="row mt-5">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="info">
                            <div class="address">
                                <i class="icofont-google-map"></i>
                                <h4>Adresse:</h4>
                                @isset($contacts->location)
                                <p>{{ $contacts->location }}</p>
                                @else
                                <p>Not Set Yet</p>
                                @endisset
                            </div>

                            <div class="email">
                                <i class="icofont-envelope"></i>
                                <h4>E-Mail:</h4>
                                @isset($contacts->email)
                                <p>{{ $contacts->email }}</p>
                                @else
                                <p>Not Set Yet</p>
                                @endisset
                            </div>

                            <div class="phone">
                                <i class="icofont-phone"></i>
                                <h4>Telefon:</h4>
                                @isset($contacts->call)
                                <p>+{{ $contacts->call }}</p>
                                @else
                                <p>Not Set Yet</p>
                                @endisset
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-6 demo-bg">
                        <div class="business-hours">
                            <h3 class="title">Öffnungszeiten</h3>
                            {{-- Open / Closed status --}}
                            @if($openingHours->isOpenAt(now()))
                            <span class="badge bg-success">Jetzt geöffnet</span>
                            @else
                            <span class="badge bg-danger">Jetzt geschlossen</span>
                            @endif
                            @php
                            $dayLabels = [
                            'monday' => 'Mo',
                            'tuesday' => 'Di',
                            'wednesday' => 'Mi',
                            'thursday' => 'Do',
                            'friday' => 'Fr',
                            'saturday' => 'Sa',
                            'sunday' => 'So',
                            ];
                            @endphp

                            <ul class="list-unstyled opening-hours">
                                @foreach($workingHours->hours as $day => $periods)
                                <li>
                                    {{ $dayLabels[$day] }}
                                    <span class="pull-right">
                                        @empty($periods)
                                        Geschlossen
                                        @else
                                        {{ implode(', ', $periods) }} Uhr
                                        @endempty
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                            {{-- <ul class="list-unstyled opening-hours">
                                <!-- <li>So <span class="pull-right">Closed</span></li> -->
                                <li>Mo <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                                <li>Di <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                                <li>Mi <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                                <li>Do <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                                <li>Fr <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                                <li>Sa <span class="pull-right">8:00 - 15:00 Uhr</span></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</section>
@endif