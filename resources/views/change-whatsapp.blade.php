
<!--------- This View is Deprecated --------------->
@extends('admin')

<!--------- This View is Deprecated --------------->
@section('admin-content')

<!--------- This View is Deprecated --------------->
<h2 class="text-center mt-4">Change WhatsApp Number : </h2>
<hr class="my-4">

<!--------- This View is Deprecated --------------->
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
                    <label>New Whatsapp Number :</label>
                    <input type="text" name="whatsapp" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
       
               
    </div>
</div>
       

@endsection



  