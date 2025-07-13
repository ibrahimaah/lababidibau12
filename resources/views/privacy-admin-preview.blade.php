@extends('layouts.app')


@section('content')


@isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset

    <section class="py-5">
        <div class="container">
          <div class="section-title">
            <h2 style="text-decoration: underline;">Datenschutz</h2>
          </div>
            <div class="row">
              <div class="col-sm">
                @isset($privacy)
                  {!! $privacy->privacy !!}
                @else
                <h2 class="text-center">This Page is Empty</h2>
                @endisset
              </div>
            </div>
        </div>
    </section>
<!-- ======= Footer ======= -->
@isset($categories)
  @include('partials._footer',['categories',$categories])
@else
  @include('partials._footer')
@endisset
<!-- End Footer -->
@endsection



  