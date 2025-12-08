@extends('layouts.admin_layout')


@section('content')


    @include('partials._navbar_admin')
	<style>

	</style>

    <div class="container">
        @yield('admin-content')
    </div>

	
@endsection



  