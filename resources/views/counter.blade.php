

@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Update Counters</h2>
<hr class="my-4">

        
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            @if(Session::has('success'))
                <h4 class="text-success">{{ session()->get('success') }}</h4>
            @else
                <h4 class="text-danger">{{ session()->get('faild') }}</h4>
            @endif
            <form method="POST" action="{{ route('update-counter') }}">
                @csrf
                <div class="form-group">
                    <label>Clients :</label>
                    <input type="number" name="client" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Projects :</label>
                    <input type="number" name="project" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Years Of Experience :</label>
                    <input type="number" name="year" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        @isset($counters)
        <div class="col-md-6 pt-4 col-sm-12">
              <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Happy Clients</th>
                        <th>Project</th>
                        <th>Years Of Experience</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $counters->clients }}</td>
                        <td>{{ $counters->projects }}</td>
                        <td>{{ $counters->years }}</td>
                    </tr>
                </tbody>
              </table>
        </div>
        @endisset
               
    </div>
</div>
       

@endsection



  