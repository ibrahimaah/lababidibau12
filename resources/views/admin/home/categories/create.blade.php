@extends('admin')


@section('admin-content')



<h2 class="text-center mt-4 text-secondary">Create New Category</h2>
<hr class="my-4">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-6">
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
    <div class="row justify-content-center">

        <div class="col-xs-12 col-md-6">

            <form class="mt-4" method="POST" 
                action="{{ route('store-category') }}" 
                enctype="multipart/form-data">

                @csrf

                 
                <div class="form-group">
                    <label>Enter Category Name :</label>
                    <input type="text" name="name" class="form-control mb-2 me-sm-2" required>
                </div>
                <div class="form-group">
                    <label>Enter Category Description :</label>
                    <textarea name="description" class="form-control mb-2 me-sm-2" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>Choose an icon</label>
                    <input type="file" name="icon" class="form-control-file mb-2" accept="image/*" required>
                </div>

                <div class="d-flex justify-content-start align-items-baseline">
                    <button type="submit" class="btn btn-primary mb-2">Add</button>
                    <a href="{{route('admin-category')}}" class="btn btn-danger m-2">Back</a>
                </div>
            </form>

            
        </div>
    </div>
</div>

@endsection



  