@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">About Us Section</h2>
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

        
        </div>
    </div>
    <div class="row">
        <div class="col-sm">

            <form class="mt-4" method="POST" 
                action="{{ route('update-admin-about',$about_us->id) }}">

                @csrf

                <div class="form-group">
                    <label>Title :</label>
                    <input type="text" name="title" value="{{ $about_us->title ?? '' }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Description :</label>
                    <textarea type="text"
                              name="desc"
                              rows="7" 
                              cols="100"
                              class="form-control mb-2">{{ $about_us->desc ?? '' }}</textarea>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection



  