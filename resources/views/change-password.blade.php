

@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Change Password</h2>
<hr class="my-4">

        
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            @if(Session::has('success'))
                <h4 class="text-success">{{ session()->get('success') }}</h4>
            @else
                <h4 class="text-danger">{{ session()->get('faild') }}</h4>
            @endif
            <form method="POST" action="{{ route('update-password') }}">
                @csrf
                <div class="form-group">
                    <label>New Password :</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password :</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
       
               
    </div>
</div>
       

@endsection



  