

@extends('admin')


@section('admin-content')


<h2 class="text-center mt-4">Update Advertisement Policy Page</h2>
<hr class="my-4">

        
<div class="container">
    <div class="row">
        <div class="col-sm">
            @if(Session::has('success'))
                <h4 class="text-success">{{ session()->get('success') }}</h4>
            @else
                <h4 class="text-danger">{{ session()->get('faild') }}</h4>
            @endif
            <form action="{{ route('update-advertisement') }}" method="POST">
            @csrf

                <textarea name="advertisement" rows="30">

                </textarea>

            
                <input type="submit" class="btn btn-primary my-4" value="Save">
                <a href="{{ route('show-advertisement') }}" class="btn btn-warning" target="_blank">Preview</a>
            
            </form>
        </div>          
    </div>
</div>
       
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'casechange  linkchecker autolink link image',
      toolbar: 'casechange forecolor backcolor fontsizeselect fontselect alignleft aligncenter alignright alignjustify',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name'
      
    });
</script>
@endsection



  