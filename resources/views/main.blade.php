@extends('layouts.app')
@section('meta_keywords', 'Dekor Von Decken Und Wänden,Trockenbau,Bodensysteme,3D Paneele für Wand und Decke,Laminat,Garten')

@section('content')


  <!-- ======= Header ======= -->
@isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset



  <!-- End Header -->

  <style>
    /** About Us Services */
    .double-true{
      font-size: 17px;
      color: #ee1a36;
      line-height: 2;
    }
    .card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }

    /** Working Hours */
    @media (max-width: 991.98px) { 
      .demo-bg{
        margin-top: 60px;
      }
    }
    
    .business-hours {
    padding: 15px 14px;
    margin-top: -15px;
    position: relative;
    width: 60%;
    }
  
    .business-hours .title {
    font-size: 20px;
    color: #fff;
    text-transform: uppercase;
    padding-left: 5px;
    border-left: 4px solid #ee1a36; 
    }
    .business-hours li {
    color: #fff;
    line-height: 30px;
    border-bottom: 1px solid #888; 
    }
    .business-hours li:last-child {
    border-bottom: none; 
    }
    .business-hours .opening-hours li.today {
    color: #ee1a36; 
    }
    .pull-right{ float:right !important }
    .float{
        position:fixed;
        width:60px;
        height:60px;
        bottom:40px;
        right:40px;
        background-color:#25d366;
        color:#FFF;
        border-radius:50px;
        text-align:center;
        font-size:30px;
        box-shadow: 2px 2px 3px #999;
        z-index:100;
      }

    .my-float{
        margin-top:16px;
      }


      /* Contact Form*/
      .form-group{
        margin-bottom: 2rem;
      }
      /* Checkbox in Contact Form */
      .preview
      {
          text-decoration: underline;
          color: lightblue;
      }

      .bg-gradient
      {
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(121,9,9,1) 100%, rgba(0,212,255,1) 100%) !important;
      }
      @media (min-width:801px)  {
        .about-section {
          padding-left:170px;
        }
        /** Popup */
        .modal-dialog-centered.popo {

          width: 400px;
          margin:auto

        }
      }
      @media only screen 
      and (min-device-width : 320px) 
      and (max-device-width : 800px){
        .about-section {
          padding-left:60px;
        }
          /** Popup */
        .modal-dialog-centered.popo {
          width: 300px;
          margin:auto
        }
      }
      /* Increase Carousel speed */
      /*.carousel-item {
        transition:transform 0.1s ease-in-out;
       }*/
  </style>


  <div class="top-img w-100">
    <img src="{{ asset('assets/img/images/a.jpg') }}" alt="top image" class="w-100">
  </div>
  @if($images->isNotEmpty())
  <div class="container d-none d-md-block">
    <div id="demo" class="carousel slide" data-ride="carousel">

      <!-- Indicators -->
      <ul class="carousel-indicators">
        @foreach($images as $image)
          <li data-target="#demo" data-slide-to="<?=$loop->first ? '0' : $loop->index;?>" class="<?=$loop->first ? 'active' :'';?>"></li>
        @endforeach
      </ul>

      <!-- The slideshow -->
      <div class="carousel-inner" style="border-radius: 50px;">

        
        @foreach($images as $image)
          <div class="carousel-item <?=$loop->first ? 'active' :'';?>">
            <img src="{{ asset('storage/images/slider/'.$image->img_name) }}" alt="Image<?=$image->id?>">
          </div>
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
  <main id="main">



   
    <!-- ======= About Section ======= -->
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
    
    <!-- End About Section -->
    











    @isset($counters)

    <!-- ======= Counts Section ======= -->
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
              <span data-toggle="counter-up">{{ $counters->projects }}</span>
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
    </section><!-- End Counts Section -->
    @endisset
 

    <!-- ======= Services Section ======= -->
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
               <img class="card-img-top" src="{{ asset('storage/images/icons/'.$category->icon) }}" alt="Category Icon">
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
    </section><!-- End Sevices Section -->



     <!-- ======= Portfolio Section ======= -->
     
    <!-- End Portfolio Section -->
			

    
    <!-- ======= Contact Section ======= -->
<div class="container px-0 mb-4">

    <iframe style="border:0; width: 100%; height: 270px;"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2530.6109694272823!2d7.047321315162549!3d50.63434338197923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bee2b513b9f14d%3A0x18de3272a28c82b9!2sZypressenweg%203%2C%2053340%20Meckenheim%2C%20Germany!5e0!3m2!1sen!2sus!4v1615403481751!5m2!1sen!2sus" frameborder="0" allowfullscreen></iframe>
</div>

<section id="Kontakt" class="container contact bg-gradient pt-5 pb-3">
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
              <ul class="list-unstyled opening-hours">
                <!-- <li>So <span class="pull-right">Closed</span></li> -->
                <li>Mo <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                <li>Di <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                <li>Mi <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                <li>Do <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                <li>Fr <span class="pull-right">8:00 - 17:00 Uhr</span></li>
                <li>Sa <span class="pull-right">8:00 - 15:00 Uhr</span></li>
              </ul>
              </div>
            </div>
          </div>
      </div>
   

    </div>

  </div>
</section>

    
    <!-- End Contact Section -->
 
  </main><!-- End #main -->

<!------ WhatsApp Icon ---->

<a href="https://api.whatsapp.com/send?phone=<?=$contacts->call  ?? '491711172776'?>&text=&source=&data=" class="whatsApp" target="_blank"><i class="fa fa-whatsapp my-whatsApp"></i></a>
<!---------------------------------------->


<!------------------------------ Popup --------------------------->
@isset($popup)


  <div class="container">     
    <div class="row">
      <div class="col-sm">

        <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-active="<?=$popup->active?>">

          <div class="modal-dialog modal-dialog-centered popo" role="document">
            <div class="modal-content" style="position: relative;">
              <div class="modal-header p-0">
                <button type="button" onclick="close_popup()" class="close rounded-circle" data-dismiss="modal" aria-label="Close"  style="position: absolute;right:25px;top:25px;z-index:999;font-size:45px;opacity:1;background:white;line-height:.5">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body p-0">
                <div class="card">
                  @isset($popup->img)
                    <a href="{{ $popup->link }}" target="_blank">
                      <img class="card-img-top" src="{{ asset('storage/images/popup/'.$popup->img) }}" alt="Card image cap">
                    </a>
                  @endisset

                  @isset($popup->desc)
                    <div class="card-body">
                      
                    @if(!isset($popup->img))
                      <p class="card-text" style="word-wrap: break-word;padding-right:40px">{{ $popup->desc }}</p>
                    @else 
                      <p class="card-text">{{ $popup->desc }}</p>
                    @endif
                    </div>
                  @endisset
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
  
@endisset

<!-- ======= Footer ======= -->
@isset($categories)
  @include('partials._footer',['categories',$categories])
@else
  @include('partials._footer')
@endisset
<!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  



@endsection