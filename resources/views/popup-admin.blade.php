@extends('admin')


@section('admin-content')
<style>
.preview{
    text-decoration: underline;
    color: #00F;
}
</style>

<h2 class="text-center mt-4">Popup</h2>
<hr class="my-4">


<div class="row">

    <div class="col-sm-12 col-md-6">
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
       
        @isset($popup)
        <table class="table table-bordered mt-4">
            <thead class="text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">On/Off</th>
                </tr>
            </thead>
            <tbody class="text-center">
                
                    <tr>
                        <th scope="row"> 1 </th>
                        <td>
                            @isset($popup->img)
                            <a href="{{ asset('storage/images/popup/'.$popup->img) }}" class="preview" target="_blank"> preview </a>
                            @else 
                            <span>Not Set</span>
                            @endisset
                        </td>
                        <td>{{ $popup->desc ?? ' Not Set '}}</td>
                        <td>
                         
                         <form action="{{ route('toggle-popup') }}" method="POST">
                            @csrf
                            <input type="submit" value="<?=$popup->active == 1 ? 'On' : 'Off';?>" class="btn btn-sm btn-<?=$popup->active == 1 ? 'success' : 'danger';?>">
                         </form>
                        </td>
                    </tr>
                
            </tbody>
        </table>
        @else 
            <h4 class="text-warning">Popup is not set Yet !!</h4>
        @endisset
    </div>
    <div class="col-sm-12 col-md-6">

        <form class="mt-4" method="POST" 
              action="{{ route('update-popup') }}" 
              enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Choose an image</label>
                <input type="file" name="img" class="form-control-file" accept="image/*">
            </div>

            <div class="form-group">
                
                <textarea type="text" name="desc" rows="7" cols="100" class="form-control mb-2" placeholder="Popup description"></textarea>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="default_popup_img_link">
              <label class="form-check-label">
                Set Popup Image Link to default
              </label>
            </div>

            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary mb-2">Save</button>
            </div>
        </form>
        <p class="invisible">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla praesentium eveniet hic commodi vitae corporis quia qui, reiciendis omnis cupiditate corrupti unde quos impedit, molestias ipsum labore alias perspiciatis velit!</p>
    </div>



</div>



@endsection



  