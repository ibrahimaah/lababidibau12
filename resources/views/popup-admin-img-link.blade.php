

@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Update Popup Image Link</h2>
<hr class="my-4">


<div class="container">
    <div class="row">
        
        <div class="col-sm">
                <div>
                    <span class="h4">Popup Image Link:     </span>
                    <span class="h5 text-primary">{{ $popup->link ?? 'Not Set Yet' }}</span>
                </div>
        </div>
    </div>
</div>



<hr>  

<div class="container">
    <div class="row">
        <div class="col-sm">
            @if(Session::has('success'))
                <h4 class="text-success">{{ session()->get('success') }}</h4>
            @else
                <h4 class="text-danger">{{ session()->get('faild') }}</h4>
            @endif
            <form method="POST" action="{{ route('update-popup-img-link') }}">
                @csrf
                <div class="form-group">
                    <label>Popup Image Link :</label>
                    <input type="text" name="link" class="form-control" placeholder="Enter Popup Image Link" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
               
    </div>
</div>
<hr>  


<div class="container">
    <div class="row">
        
        <div class="col-sm">
            <form method="POST" action="{{ route('reset-popup-img-link') }}">
                @csrf
                <button type="submit" name="link_default" class="btn btn-warning">Reset to Default</button>
            </form>
        </div>
    </div>
</div>

       

@endsection



  