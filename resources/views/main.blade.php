@extends('layouts.app')

@section('meta_keywords', 'Dekor Von Decken Und Wänden,Trockenbau,Bodensysteme,3D Paneele für Wand und Decke,Laminat,Garten')

@section('content')


  <!-- ======= Header ======= -->
{{-- @isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset --}}

{{-- @include('partials._navbar') --}}

  <!-- End Header -->

  <style>
    /** About Us Services */
    /* .double-true{
      font-size: 17px;
      color: #ee1a36;
      line-height: 2;
    } */
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
    border-left: 4px solid var(--bs-secondary); 
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

  @include('partials.main-page._hero_img')

  @include('partials.main-page._slider')

  <main id="main">

    <!-- ======= About Section ======= -->
    @include('partials.main-page._about')    
    <!-- End About Section -->
    
    <!-- ======= Counts Section ======= -->
    @include('partials.main-page._counters')  
    <!-- End Counts Section -->
    
    <!-- ======= Categories Services Section ======= -->
    @include('partials.main-page._services')  
    <!-- End Categories Sevices Section -->
    
    <!-- ======= Google Map Section ======= -->
    @include('partials.main-page._map')  
    <!-- EndGoogle Map Section -->

    <!-- ======= Contact Section ======= -->
    @include('partials.main-page._contact')  
    <!-- End Contact Section -->
 
  </main>
  <!-- End #main -->

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