<style>
@media only screen 
      and (min-device-width : 320px) 
      and (max-device-width : 800px){
        .about-section {
          padding-left:60px;
        }
  }
</style>

 


<footer id="footer">

  <div class="footer-top">
    <div class="container">
      <div class="row">
<!--
        <div class="col-sm footer-contact">
          <h3>LABABIDI BAU</h3>
          <p>
          {{-- isset($contacts->location) ? $contacts->location : 'Not Set Yet' --}}<br>
            
            Deutschland <br><br>
            <strong>Phone:</strong> + {{-- isset($contacts->call) ? $contacts->call : 'Not Set Yet' --}}<br>
            <strong>Email:</strong>  {{-- isset($contacts->email) ? $contacts->email : 'Not Set Yet' --}}<br>
          </p>
        </div>
-->
        <div class="col-sm text-center">
        <h3><a href="{{ route('main') }}">LABABIDI BAU</a></h3>
        <a href="{{ route('main') }}">
           <img src="{{ asset('assets/img/images/logo.jpg') }}" alt="" style="width:150px;height:150px">
        </a>
        </div>
        <div class="col-sm footer-links">
          <h4>NÜTZLICH</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i><a href="{{ route('main') }}">Home</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="{{ route('portfolio-image') }}">Fotogalerie</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="{{ route('portfolio-video') }}">Videogalerie</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="{{ route('job') }}">Jobs</a></li>
          </ul>
        </div>
        @isset($categories)
        <div class="col-lg-3 col-md-12 footer-links">
          <h4>SERVICES</h4>
          <ul>
            @foreach($categories as $category)
            <li><i class="bx bx-chevron-right"></i><a href="{{ route('portfolio-image-category',$category->id) }}#bildergaleries">{{ $category->name }}</a></li>
            @endforeach
          </ul>
        </div>
        @endisset
        <div class="col-sm footer-links">
          <h4>WICHTIG</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacy_policy') }}">Datenschutz</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('imprint') }}">Impressum</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="{{ route('main') }}#Kontakt">Kontakt</a></li>
            
          </ul>
        </div>

        <!-- <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4>Join Our Newsletter</h4>
          <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          <form action="" method="post">
            <input type="email" name="email"><input type="submit" value="Subscribe">
          </form>
        </div> -->

      </div>
    </div>
  </div>
@include('partials._footer_bottom')
</footer>