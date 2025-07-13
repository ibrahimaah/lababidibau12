@extends('layouts.app')


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
      /* .img-show{
          object-fit: contain;
          width: 100%;
          height: 300px;
      } */
      /* a.vbox-next,a.vbox-prev{
        display: none !important;
      } */
     


       /* Customizing the pagination view */

     .page-link{
        color: rgba(var(--bs-secondary-rgb),var(--bs-text-opacity))!important;
    }
    
    .page-item.active .page-link {
      background-color:var(--second-color) !important;
      color:#fff !important;
      border: none;
    } 
    #portfolio > div > nav > ul > li.page-item.active > span {
      border: none !important;
    }
    /*
    .active>.page-link, .page-link.active {
      border-color: var(--second-color) !important;
    } */
    
    #portfolio > div > div.row.d-flex.justify-content-center.mb-4 > div > ul > li > a.active{
      color: #fff !important;
      background-color: var(--second-color) !important;
    }
  </style>


	<section id="portfolio" class="portfolio py-5" >
    <div class="container" data-aos="fade-up">

  

        <div class="row d-flex justify-content-center mb-4">
          <div class="col-lg-12 text-center">
      
            @if($categories->isNotEmpty())
              <ul class="nav nav-pills nav-fill mb-3">
                @foreach($categories as $category)
                <li class="nav-item">
                  <a class="nav-link fw-bold text-secondary <?=$category->id == $current_category->id ? 'active' : ''?>"
                    href="{{ route('portfolio-image-category',['category_id'=>$category->id]) }}">{{ $category->name }}</a>
                </li>
                @endforeach
              </ul>
            @endif
            <p class="text-secondary">{{ $current_category->description }}</p>
          </div>
        </div>


        

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="300">
          @foreach($images as $image)
            
          <div class="col-md-4 portfolio-item">
            <div class="portfolio-wrap">

              <img src="{{ asset('storage/images/'.$image->name) }}" class="img-fluid">

              <div class="portfolio-info w-100 h-100">
                
                <h4 class="invisible"><?=$current_category->name?></h4>
                
                <div class="portfolio-links w-100 h-100">
                  <a 
                    href="{{ asset('storage/images/'.$image->name) }}" 
                    data-gall="portfolioGallery" 
                    class="venobox" 
                    title="<?=$current_category->name?>"
                  >
                    <div style="width:800px;height:600px"></div>
                  </a>  
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
        </div>
        
        <div class="row justify-content-center">
          <div class="col-xs-12">
            {{ $images->links() }}
          </div>
        </div>

    </div>

    

  </section>

    <a href="https://api.whatsapp.com/send?phone=<?=$contacts->call  ?? '491711172776'?>&text=&source=&data=" class="whatsApp" target="_blank"><i class="fa fa-whatsapp my-whatsApp"></i></a>

    
    @isset($categories)
      @include('partials._footer',['categories',$categories])
    @else
      @include('partials._footer')
    @endisset
    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  
@endsection



  