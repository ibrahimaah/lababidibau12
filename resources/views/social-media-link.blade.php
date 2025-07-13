

@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Update Social Media Links</h2>
<hr class="my-4">

        
<div class="container">
    <div class="row">
        <div class="col-sm">
            @if(Session::has('success'))
                <h4 class="text-success">{{ session()->get('success') }}</h4>
            @else
                <h4 class="text-danger">{{ session()->get('faild') }}</h4>
            @endif
            <form method="POST" action="{{ route('update-social-media-link') }}">
                @csrf
                <div class="form-group">
                    <label>Facebook :</label>
                    <input type="text" name="facebook" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Instagram :</label>
                    <input type="text" name="instagram" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Youtube :</label>
                    <input type="text" name="youtube" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tiktok :</label>
                    <input type="text" name="tiktok" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    @isset($social_media_links)
    <div class="row mt-5">
        <div class="col-sm">
              <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Facebook</th>
                        <th>Instagram</th>
                        <th>Youtube</th>
                        <th>Tiktok</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $social_media_links->facebook }}</td>
                        <td>{{ $social_media_links->instagram }}</td>
                        <td>{{ $social_media_links->youtube }}</td>
                        <td>{{ $social_media_links->tiktok }}</td>
                    </tr>
                </tbody>
              </table>
        </div>
        @endisset
               
    </div>
</div>
       

@endsection



  