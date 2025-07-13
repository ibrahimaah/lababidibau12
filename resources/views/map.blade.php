

@extends('admin')


@section('admin-content')

<!--This View Is Deprecated -->

<h2 class="text-center mt-4">Update Social Media Links</h2>
<hr class="my-4">

<!--This View Is Deprecated -->


<div class="container">
    <div class="row">
        <div class="col-sm"><!--This View Is Deprecated -->
            @if(Session::has('success'))
                <h4 class="text-success">{{ session()->get('success') }}</h4>
            @else
                <h4 class="text-danger">{{ session()->get('faild') }}</h4>
            @endif
            <form method="POST" action="{{ route('update-map') }}">
                @csrf <!--This View Is Deprecated -->
                <div class="form-group">
                    <label>Google Map Link :</label>
                    <textarea name="map" class="form-control" rows="4" cols="100" required>
                    </textarea> 
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    @isset($map)
    <div class="row mt-5">
        <div class="col-sm">
              <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Google Map Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $map->map }}</td>
                    </tr>
                </tbody>
              </table>
        </div>
        @endisset
               
    </div>
</div>
       

@endsection



  