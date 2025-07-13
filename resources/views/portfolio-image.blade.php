@extends('layouts.app')
@section('title', 'Fotogalerie')
@section('meta_keywords', 'Fotogalerie')
@section('content')


  
@isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset

	
  <style>
   

     
      @media only screen and (min-width: 768px) 
      {
        /* img.vbox-figlio
        {
          object-fit: contain;
          width: auto;
          height: 600px;
        } */
      }
      @media only screen and (max-width: 767px) 
      {
        /* img.vbox-figlio
        {
          object-fit: cover;
          width: auto;
          height: 700px;
        } */
      }

      
      img.vbox-figlio
      {
        object-fit: contain;
        width: 100%;
        height: 600px;
      }

  
      .img-show{
          object-fit: contain;
          width: 100%;
          height: 200px;
      }
      a.vbox-next,a.vbox-prev{
        display: none !important;
      }
      /* .category-name
      {
        padding:30px;
        font-size: 2em;
      } */
      .category-name
      {
        display: inline-block;
        background-color:#F8FBFE;
        padding:5px;
        color:#333;
        font-weight:800;
        margin-bottom:15px;
        font-size: 20px;

      }

     


      
    

  </style>
  <div class="top-img w-100">
    <img src="{{ asset('assets/img/images/a.jpg') }}" alt="top image" class="w-100">
  </div>


	<section id="portfolio" class="portfolio py-5" >
    <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 data-aos="flip-left"
          data-aos-easing="ease-out-cubic"
          data-aos-duration="2000" style="text-decoration: underline;" id="bildergaleries">Bildergaleries</h2>
          
        </div>




        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li>
                <a href="{{ route('portfolio-image-category') }}#bildergaleries">All</a>
              </li>
              @isset($categories)
            
                @foreach($categories as $category)
                  <li><a href="{{ route('portfolio-image-category',$category->id) }}#bildergaleries"><?=$category->name?></a></li>
                @endforeach
					  	@endisset
            </ul>
          </div>
        </div>

        <hr>




      @foreach($categories as $category)
        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-lg-12 d-flex justify-content-center">
             <span class="category-name"><?=$category->name?></span>   
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="300">
          @foreach($category->images as $image)
            @if($loop->index == 3)
              @break
            @endif
          <div class="col-lg-4 col-md-6 portfolio-item">
            <div class="portfolio-wrap">

              <img src="{{ asset('storage/images/'.$image->name) }}" class="img-fluid img-show">

              <div class="portfolio-info">
                
                <h4 class="invisible"><?=$image->category->name?></h4>
                <div class="portfolio-links">

                  <a href="{{ asset('storage/images/'.$image->name) }}" 
                     data-gall="portfolioGallery" 
                     class="venobox" title="<?=$image->category->name?>">

                     <div style="width:800px;height:600px"></div>

                  </a>  
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        <a href="{{ route('portfolio-image-category',$category->id) }}#bildergaleries" 
          style="text-decoration: underline;color:#BD2528;font-size:25px">mehr...</a>
        <hr>
        @endforeach

    </div>


    <!------------------------------------------------>
  

  
    <!------------------------------------------------>

  </section>

    <a href="https://api.whatsapp.com/send?phone=<?=$contacts->call  ?? '491711172776'?>&text=&source=&data=" class="whatsApp" target="_blank"><i class="fa fa-whatsapp my-whatsApp"></i></a>

    
@isset($categories)
  @include('partials._footer',['categories',$categories])
@else
  @include('partials._footer')
@endisset
    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  
@endsection



  