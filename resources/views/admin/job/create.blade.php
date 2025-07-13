@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Create New Job</h2>
<hr class="my-4">

<div class="container">
    <div class="row">
        <div class="col-sm">
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

        
        </div>
    </div>
    <div class="row">
        <div class="col-sm">

            <form class="mt-4" method="POST" 
                action="{{ route('admin-job-store') }}" 
                enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label>Choose a Job Image</label>
                    <input type="file" name="img" class="form-control-file" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Job Title :</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Job Title" required>
                </div>

                <div class="form-group">
                    <textarea type="text" name="desc" rows="7" cols="100" class="form-control mb-2" placeholder="Job description">{{ old('desc') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Contacts Info :</label>
                    <input type="text" name="contact" value="{{ old('contact') }}" class="form-control" placeholder="Enter Contacts Info" required>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary mb-2">Add</button>
                </div>
            </form>

            <p class="invisible">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla praesentium eveniet hic commodi vitae corporis quia qui, reiciendis omnis cupiditate corrupti unde quos impedit, molestias ipsum labore alias perspiciatis velit!</p>
        </div>
    </div>
</div>

@endsection



  