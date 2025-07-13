@extends('admin')


@section('admin-content')
<style>
    .preview{
        text-decoration: underline;
        color: #00F;
    }
</style>

<h2 class="text-center mt-4 text-secondary">Social Medial Links</h2>
<hr class="my-4">

<div class="container">
    <div class="row">
        <div class="col-sm">
            <a href="{{ route('admin-social-media-link-create') }}" class="btn btn-primary">Create New Social Media Link</a>
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
            


            
            <?php if($social_media_links->isNotEmpty()): ?>

                <table class="table table-bordered mt-4">
                    <thead class="text-center">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">social media</th>
                        <th scope="col">link</th>
                        <th scope="col">icon</th>
                        <th scope="col">active</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($social_media_links as $social_media_link)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $social_media_link->name }}</td>
                                <td><a href="{{ $social_media_link->link }}" class="preview">{{ $social_media_link->link }}</a></td>
                                @if($social_media_link->icon)
                                <td>
                                    <a href="{{ asset('storage/images/social_media_icons/'.$social_media_link->icon) }}" 
                                     class="preview" target="_blank"> preview </a>
                                </td>
                                @else 
                                <td>
                                    <span class="text-primary">Default Icon</span>
                                </td>
                                @endif
                                <td>
                                    <form action="{{ route('admin-social-media-link-activate', $social_media_link->id) }}" method="POST">
                                        @csrf
                                        <label class="switch">
                                            
                                            <input 
                                                type="checkbox" 
                                                <?=$social_media_link->active == '1' ? 'checked' : '' ?> 
                                                onChange="this.form.submit()">

                                            <span class="sliderswitch roundswitch"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class='d-flex align-items-baseline justify-content-center'>
                                    <a href="{{ route('admin-social-media-link-edit',$social_media_link->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <form action="{{ route('admin-social-media-link-destroy', $social_media_link->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" value="Remove" class="btn btn-sm btn-danger ms-3">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <?php else: ?> 
                <h4 class="text-primary text-center">No Social Media Links Yet !!</h4>
            <?php endif; ?>

        </div>
    </div>
</div>



@endsection



  