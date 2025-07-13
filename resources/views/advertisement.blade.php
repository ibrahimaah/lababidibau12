@extends('layouts.app')


@section('content')


@isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset

       <div class="top-img w-100">
        <img src="{{ asset('assets/img/images/a.jpg') }}" alt="top image" class="w-100">
       </div>
       <div class="container">
          <div class="row">
            <div class="col-sm">
               @isset($advertisement)
                  {!! $advertisement->advertisement !!}
                @else
                <h2 class="text-center">This Page is Empty</h2>
                @endisset
            </div>
          </div>
            
       </div>
    

<!-- ======= Footer ======= -->
@isset($categories)
  @include('partials._footer',['categories',$categories])
@else
  @include('partials._footer')
@endisset
<!-- End Footer -->
@endsection



  