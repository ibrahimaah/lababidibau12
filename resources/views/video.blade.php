@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Videos</h2>
<hr class="my-4">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(Session::has('success'))
    <h4 class="text-success">{{ session()->get('success') }}</h4>
@else
    <h4 class="text-danger">{{ session()->get('faild') }}</h4>
@endif

@if(Session::has('success-removed'))
    <h4 class="text-success">{{ session()->get('success-removed') }}</h4>
@endif

@if(Session::has('faild-removed'))
    <h4 class="text-danger">{{ session()->get('faild-removed') }}</h4>
@endif

<div class="row">
    <div class="col-sm-12 col-md-4">
        <form method="post" enctype="multipart/form-data" action="{{ route('store-video') }}" style="padding-top:40px">
            @csrf 
            <div class="form-group">
                <label>Choose a thumnnail</label>
                <input type="file" name="thumb" class="form-control-file" accept="image/*" required>
            </div>
            <div class="form-group">
                <label>Video Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Video Title" required>
            </div>
            <div class="form-group">
                <label>Choose a video</label>
                <input type="file" name="name" class="form-control-file" accept="video/*" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success col-md-3">Save</button>
            </div>
        </form>
    </div>
    <div class="col-sm-12 col-md-8">
        
        <div class="row">
            @foreach($videos as $video)
            <div class="card-deck col-md-6 mb-4">
                <div class="card">

                    <a data-fancybox href="#myVideo{{ $video->id }}">
                        <img class="card-img-top img-fluid" src="{{ asset('storage/videos/thumbnails/'.$video->thumb) }}"  style="height:200px"/>
                    </a>

                    <div class="card-body">
                        <p class="card-text">{{ $video->title }}</p>
                    </div>

                    <video width="800" height="500" controls id="myVideo{{ $video->id }}" style="display:none;">
                        <source src="{{ asset('storage/videos/'.$video->name) }}" type="video/mp4">
                        Your browser doesn't support HTML5 video tag.
                    </video>

                    <div>
                        <form class="text-center pb-2" action="{{ route('remove-video', $video->id) }}" method="POST">
                            @csrf
                            <input type="submit" value="Remove" class="btn btn-sm btn-danger">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
<hr class="my-4">
<p class="invisible">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto sit accusamus esse in quasi tempora molestias aperiam nam ex temporibus exercitationem assumenda velit deserunt maxime molestiae placeat quae, sed dicta.</p>
@endsection



  