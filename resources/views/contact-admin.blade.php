

@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Update Contacts Info</h2>
<hr class="my-4">

        
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            @if(Session::has('success'))
                <h4 class="text-success">{{ session()->get('success') }}</h4>
            @else
                <h4 class="text-danger">{{ session()->get('faild') }}</h4>
            @endif
            <form method="POST" action="{{ route('update-contact') }}">
                @csrf
                <div class="form-group">
                    <label>Location :</label>
                    <input type="text" name="location" class="form-control" placeholder="Enter Location" required>
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <label>Phone number :</label>
                    <input type="text" name="call" class="form-control" placeholder="Enter Phone Number" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        @isset($contacts)
        <div class="col-md-6 pt-4 col-sm-12">
                <div>
                    <h4>Location:</h4>
                    <p>{{ $contacts->location }}</p>
                </div>

                <div>
                    <h4>Email:</h4>
                    <p>{{ $contacts->email }}</p>
                </div>

                <div>
                    <h4>Call:</h4>
                    <p>{{ $contacts->call }}</p>
                </div>
        </div>
        @endisset
               
    </div>
</div>
       

@endsection



  