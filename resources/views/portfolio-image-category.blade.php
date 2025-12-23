@extends('layouts.app')


@section('content')
 
  
{{-- @isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset --}}
 
	
<link rel="stylesheet" href="{{ asset('assets/css/portfolio-image-category-styles.css') }}">

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

              <img src="{{ $image->getFirstMediaUrl('images') }}" class="img-fluid">

              <div class="portfolio-info w-100 h-100">
                
                <h4 class="invisible"><?=$current_category->name?></h4>
                
                <div class="portfolio-links w-100 h-100">
                  <a 
                    href="{{ $image->getFirstMediaUrl('images') }}" 
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



  