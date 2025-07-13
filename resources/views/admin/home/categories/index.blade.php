@extends('admin')


@section('admin-content')
<style>
    .preview{
        text-decoration: underline;
        color: #00F;
    }
</style>

<h2 class="text-center mt-4 text-secondary">Categories</h2>
<hr class="my-4">

<div class="container">
    <div class="row">
        <div class="col-sm">
            <a href="{{ route('create-category') }}" class="btn btn-primary">Create New Category</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-10">

            @if(Session::has('success-removed'))
                <h4 class="text-success">{{ session()->get('success-removed') }}</h4>
            @endif
            
            @if(Session::has('faild-removed'))
                <h4 class="text-danger">{{ session()->get('faild-removed') }}</h4>
            @endif
            


            
            <?php if($categories->isNotEmpty()): ?>

                <table class="table table-bordered mt-4">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ ++$loop->index }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? '...' }}</td>
                            <td><a href="{{ asset('storage/images/icons/'.$category->icon) }}" class="preview" target="_blank"> preview </a></td>
                            <td class='d-flex align-items-baseline justify-content-center'>
                                <a href="{{ route('edit-category',['id'=>$category->id]) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                <form action="{{ route('remove-category', $category->id) }}" method="POST">
                                    @csrf
                                    <input type="submit" value="Remove" class="btn btn-sm btn-danger">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <?php else: ?> 
                <h4 class="text-primary text-center">No Categories Yet !!</h4>
            <?php endif; ?>

        </div>
    </div>
</div>



@endsection



  