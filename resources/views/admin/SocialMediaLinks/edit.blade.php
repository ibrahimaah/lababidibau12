@extends('admin')


@section('admin-content')



<h2 class="text-center mt-4 text-secondary">Edit Social Media Link</h2>
<hr class="my-4">

<div class="container">
    <div class="row">
        <div class="col-sm">
        
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
                action="{{ route('admin-social-media-link-update',$social_media->id) }}" 
                enctype="multipart/form-data">

                @csrf

                <div class="mb-2">
                    <label>Select Social Media : </label>
                    <select class="form-select" name="name" required>
                        <!-- <option selected>Open this select menu</option> -->
                        <option value="facebook" <?=$social_media->name == 'facebook' ? 'selected' : ''?>>Facebook</option>
                        <option value="whatsApp" <?=$social_media->name == 'whatsApp' ? 'selected' : ''?>>WhatsApp</option>
                        <option value="youtube" <?=$social_media->name == 'youTube' ? 'selected' : ''?>>YouTube</option>
                        <option value="instagram" <?=$social_media->name == 'instagram' ? 'selected' : ''?>>Instagram</option>
                        <option value="tikTok" <?=$social_media->name == 'tikTok' ? 'selected' : ''?>>TikTok</option>
                        <option value="twitter" <?=$social_media->name == 'twitter' ? 'selected' : ''?>>Twitter</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Social Media Link :</label>
                    <input type="text"
                     name="link"
                     value="{{ old('link') ?? $social_media->link }}"
                     class="form-control"
                     placeholder="Enter Social Media Link"
                     required>
                </div>

                <div class="form-group">
                    <label>Choose a Social Media Icon (256x256): </label>
                    <input type="file" name="icon" class="form-control-file" accept="image/*">
                    <p><small class="text-info">If you did not choose icon , then default will be used</small></p>
                </div>



                <div class="form-group mb-2">
                    <span>State: </span>
                    <label class="switch">
                        <input type="hidden" name='active' value='0'/>
                        <input type="checkbox"
                         name='active'
                         value="1"
                         <?=$social_media->active =='1' ? 'checked' : ''?>
                         />
                    </label>
                    <small class="text-info">(active / inactive)</small>
                </div>

             


                <div class="d-flex justify-content-start align-items-baseline">
                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                    <a href="{{route('admin-social-media-links')}}" class="btn btn-danger m-2">Back</a>
                </div>
            </form>

            
        </div>
    </div>
</div>

@endsection



  