
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

     
      
      <h1 class="logo mr-auto">
        @if($social_media->isNotEmpty())
          @foreach($social_media as $social)
            @if($social->active)
              <a href="{{ $social->link }}">
                <img src="{{ asset('storage/images/social_media_icons/'.$social->icon) }}"
                    alt="{{ $social->name }}">
              </a>
           @endif
          @endforeach 
        @endif
      </h1>


      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{ route('main') }}">Home</a></li>
          <li><a href="{{ route('main') }}#leistungen">Leistungen</a></li>
          
          {{-- <li><a href="{{ route('portfolio-image') }}"></a></li> --}}

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" 
               href="#" 
               id="navbarDropdown" 
               role="button" 
               data-toggle="dropdown">
              Fotogalerie
            </a>
            @if($categories->isNotEmpty())
              <div class="dropdown-menu">
                @foreach($categories as $category)
                  <a class="dropdown-item" href="/Fotogalerie/<?=$category->id?>">{{ $category->name }}</a>
                @endforeach
              </div>
            @endif
          </li>
          <li><a href="{{ route('portfolio-video') }}">Videogalerie</a></li>
          <li><a href="{{ route('main') }}#Kontakt">Kontakt</a></li> 
        </ul>
      </nav>
      
      
    </div>
  </header>