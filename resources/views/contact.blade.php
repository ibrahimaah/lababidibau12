<!--------- This View is Deprecated --------------->
@extends('layouts.app')

<!--------- This View is Deprecated --------------->

@section('content')


<!-- ======= Header ======= -->
@include('partials._header')

<!--------- This View is Deprecated --------------->

@isset($contacts)
  @include('partials._footer',['contacts',$contacts])
@else
  @include('partials._footer')
@endisset
<!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  


@endsection