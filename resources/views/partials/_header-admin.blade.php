
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('main') }}">Lababidi Bau</a>
    <button class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Home Page
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('admin-slider') }}">
                Slider
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('edit-admin-about') }}">
                About
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-about-services') }}">
                About Us - Services
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-counter') }}">
                Counters
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-category') }}">
                Categories
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-contact') }}">
                Contact
              </a>
            </li>
            
          </ul>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Media
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('admin-image') }}">
                Images
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-video') }}">
                Videos
              </a>
            </li>
          
          </ul>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin-social-media-links') }}">SocialMediaLinks</a>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Ads
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('admin-popup') }}">
                Popup
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-popup-img-link') }}">
                Popup Image Link
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-advertisement') }}">
                Advertisement Page
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ route('admin-tinymce-img') }}">
                Tinymce Images
              </a>
            </li>
          
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Important Links
          </a>
          <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route('admin-imprint') }}">Imprint</a>
            </li>

            <li>
                <a class="dropdown-item"href="{{ route('admin-privacy') }}">PrivacyPolicy</a>
            </li>

            <li>
                <a class="dropdown-item" href="{{ route('admin-job') }}">Jobs</a>
            </li>

            <li>
                <a class="dropdown-item" href="{{ route('admin-job-create') }}">Add Job</a>
            </li>
          
          </ul>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Welcome Admin
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('admin-password') }}">Change Password</a>
            </li>

            <li>
              <a class="dropdown-item" href="#">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <input type="submit" value="Logout" class="btn btn-outline-danger w-100">
              </form>
              </a>
            </li>
          
          </ul>
        </li> 
      </ul> 
    </div>
  </div>
</nav>

 