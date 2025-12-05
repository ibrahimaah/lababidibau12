 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <!-- Logo and Website Name -->
        <!-- Logo and Website Name with PNG Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('main') }}">
            <!-- PNG Logo Image -->
            <img src="{{ setting('logo') ? asset('storage/' . setting('logo')) : asset('assets/img/images/logo.jpg') }}" 
                 alt="Logo" 
                 width="60" 
                 height="60" 
                 class="d-inline-block align-text-top me-2">
            <span class="fw-bold">{{ setting('site_name', 'Lababidi Bau') }}</span>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links - Centered -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <!-- Home Link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('main') ? 'active' : '' }}" href="{{ route('main') }}">
                        {{-- <i class="bi bi-house-door me-1"></i>  --}}
                        Home
                    </a>
                </li>
                   
                <!-- Services Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{-- <i class="bi bi-gear me-1"></i>  --}}
                        Leistungen
                    </a>
                    <ul class="dropdown-menu">
                        @if($categories->isNotEmpty())
                            @foreach($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('portfolio-image-category',$category->id) }}">{{ $category->name }}</a>
                                </li> 
                            @endforeach
                        @endif
                    </ul>
                </li>

                
                <!-- Portfolio Video Link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('portfolio-video') ? 'active' : '' }}" href="{{ route('portfolio-video') }}">
                        Videogalerie
                    </a>
                </li>
               
                <!-- Contact Link -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main') }}#Kontakt">
                        Kontakt
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>