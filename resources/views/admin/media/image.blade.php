@extends('admin')


@section('admin-content')

<style>
.preview{
    text-decoration: underline;
    color: #00F;
}
</style>

<h2 class="text-center mt-4">Images</h2>
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

        @if($images->isNotEmpty())
        <table class="table table-bordered mt-4">
            <thead class="text-center">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($images as $image)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>
                            {{ $image->category->name }}
                        </td>
                        <td>
                            <a href="{{ asset('storage/images/'.$image->name) }}" class="preview" target="_blank"> preview </a>
                        </td>
                        <td>
                         <form action="{{ route('remove-image',$image->id) }}" method="POST">
                            @csrf
                            <input type="submit" value="Remove" class="btn btn-sm btn-danger">
                         </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else 
            <h4 class="text-primary">No Images Yet !!</h4>
        @endif
    </div>
    <div class="col-sm-12 col-md-6">
        <form method="post" enctype="multipart/form-data" action="{{ route('store-image') }}" style="padding-top:40px">
            @csrf 
            <div class="form-group mb-3">
                <label>Choose an image</label>
                <input type="file" name="image" class="form-control-file" accept="image/*" required>
            </div>
            <div class="form-group mb-3">
                <select class="form-control" name="category" required>
                    <option value="">Choose Category</option>
                    @isset($categories)
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success col-md-3">Add Image</button>
            </div>
        </form>
        <p class="invisible">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla praesentium eveniet hic commodi vitae corporis quia qui, reiciendis omnis cupiditate corrupti unde quos impedit, molestias ipsum labore alias perspiciatis velit!</p>
    </div>
</div>


@endsection



  