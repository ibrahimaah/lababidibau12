@extends('admin')


@section('admin-content')
<style>
.preview{
    text-decoration: underline;
    color: #00F;
}
</style>

<h2 class="text-center mt-4">Jobs</h2>
<hr class="my-4">

<div class="container">
    <div class="row">
        <div class="col-sm">
            <a href="{{ route('admin-job-create') }}" class="btn btn-primary">Create New Job</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            @if(Session::has('success-removed'))
                <h4 class="text-success">{{ session()->get('success-removed') }}</h4>
            @endif
            
            @if(Session::has('faild-removed'))
                <h4 class="text-danger">{{ session()->get('faild-removed') }}</h4>
            @endif

            @isset($jobs)
            <table class="table table-bordered mt-4">
                <thead class="text-center">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">contact</th>
                    <th scope="col">image</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($jobs as $job)
                        <tr>
                            <th scope="row">{{ $job->id }}</th>
                            <td>{{ strlen($job->title) > 20 ? substr($job->title,0,20)."..." : $job->title }}</td>
                            <td>{{ strlen($job->desc) > 50 ? substr($job->desc,0,50)."..." : $job->desc }}</td>
                            <td>{{ strlen($job->contact) > 20 ? substr($job->contact,0,20)."..." : $job->contact }}</td>
                            <td><a href="{{ asset('storage/images/jobs/'.$job->img) }}" class="preview" target="_blank"> preview </a></td>
                            <td>
                                <a href="{{ route('admin-job-edit',$job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                            <td>
                            
                            <form action="{{ route('admin-job-destroy', $job->id) }}" method="POST">
                                @csrf
                                <input type="submit" value="Remove" class="btn btn-sm btn-danger">
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else 
                <h4 class="text-warning">No Jobs Yet !!</h4>
            @endisset

        </div>
    </div>
</div>



@endsection



  