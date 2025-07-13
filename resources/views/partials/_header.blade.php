  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="{{ route('main') }}" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/images/logo.jpg') }}"
             class="rounded-circle"
             alt="logo"> 
        <h1>Lababidi Bau</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          
          <li><a href="{{ route('main') }}" class="{{ request()->routeIs('main') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ route('main') }}#leistungen">Leistungen</a></li>
          
          <li class="dropdown"><a href="#"><span>Fotogalerie</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
          @if($categories->isNotEmpty())
            <ul>
            @foreach($categories as $category)
              <li><a href="/Fotogalerie/<?=$category->id?>">{{ $category->name }}</a></li> 
            @endforeach
            </ul>
          @endif
          </li>
          <li><a href="{{ route('portfolio-video') }}" class="{{ request()->routeIs('portfolio-video') ? 'active' : '' }}">Videogalerie</a></li>
          <li><a href="{{ route('main') }}#Kontakt">Kontakt</a></li> 
        </ul>
      </nav>
      <!-- .navbar -->

      <div class="header-social-links">
      @if($social_media->isNotEmpty())
        @foreach($social_media as $social)
          @if($social->active)
            @if(!$social->icon)
              <a href="<?=$social->link?>"><i class="bi bi-<?=$social->name?>"></i></a>
            @else 
              <a href="{{ $social->link }}">
                <img src="{{ asset('storage/images/social_media_icons/'.$social->icon) }}"
                    alt="{{ $social->name }}" style="width:40px;height:40px">
              </a>
            @endif
          @endif
        @endforeach
      @endif
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
