@extends('layouts.app')


@section('content')

<style>
@media (min-width:801px)  
{
  .card.highlight 
  {
    flex-direction: row;
  }
 
  .card-img-top.highlight
  {
    width:25%
  }
}

</style>

@isset($social)
  @include('partials._header',['social',$social])
@else
  @include('partials._header')
@endisset

    <section class="py-5">
        <div class="container">
          <div class="section-title">
            <h2 style="text-decoration: underline;">JOBS SEITE</h2>
          </div>

          @isset($jobs)
            @foreach($jobs as $job)
            <div class="row mb-4">
              <div class="col-sm">
                <div class="card highlight w-100">
                  <img src="{{ asset('storage/images/jobs/'.$job->img) }}" class="card-img-top highlight" style="height:250px" alt="Job Image">
                  <div class="card-body">
                    <h2 class="card-title">{{ $job->title }}</h2>
                    <hr>
                    <p class="card-text lead">{{ strlen($job->desc) > 60 ? substr($job->desc,0,60)."..." : $job->desc }}</p>
                    <hr>
                    <p class="lead" style="font-weight:400">{{ strlen($job->contact) > 40 ? substr($job->contact,0,40)."..." : $job->contact }}</p>
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#details{{ $job->id }}">
                    mehr...
                    </button>

                  </div>
                </div>
              </div>
            </div>
            
            @endforeach
            @else
              <h2 class="text-center">There are No Jobs at the moment</h2>
            @endisset


            @isset($jobs)
              @foreach($jobs as $job)
              <div class="modal fade" id="details{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title" id="exampleModalLabel">{{ $job->title }}</h2>
                      
                    </div>
                    <div class="modal-body">
                      <div class="card">
                      <img class="card-img-top" src="{{ asset('storage/images/jobs/'.$job->img) }}" alt="Job image" style="height:300px">
                        <div class="card-body">
                          <p class="card-text lead">
                            {{ $job->desc }}
                          </p>
                          <hr>
                          <p class="lead" style="font-weight:400">
                            {{ $job->contact }}
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">schließen</button>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            @endisset

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



  