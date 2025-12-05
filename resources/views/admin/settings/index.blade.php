@extends('admin')




@section('admin-content')

<div class="container mt-5">

    <h2 class="text-center mb-4">Website Settings</h2>

    {{-- Success Message --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="row">
            <!-- ===== General Settings ===== -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>General</strong>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Site Name</label>
                            <input type="text" name="site_name" class="form-control" value="{{ setting('site_name') }}">
                        </div>

                    </div>
                </div>
            </div>

            <!-- ===== Logos ===== -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <strong>Logos</strong>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Main Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if(setting('logo'))
                            <img src="{{ asset('storage/' . setting('logo')) }}" class="img-thumbnail mt-2"
                                style="max-width: 160px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Footer Logo</label>
                            <input type="file" name="logo_footer" class="form-control">
                            @if(setting('logo_footer'))
                            <img src="{{ asset('storage/' . setting('logo_footer')) }}" class="img-thumbnail mt-2"
                                style="max-width: 160px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                            @if(setting('favicon'))
                            <img src="{{ asset('storage/' . setting('favicon')) }}" class="img-thumbnail mt-2"
                                style="max-width: 60px;">
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- ===== Colors ===== -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <strong>Theme Colors</strong>
            </div>
            <div class="card-body row">

                <div class="col-md-4 mb-3">
                    <label class="form-label">Primary Color</label>
                    <input type="color" name="primary_color" class="form-control form-control-color"
                        value="{{ setting('primary_color', '#0d6efd') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Secondary Color</label>
                    <input type="color" name="secondary_color" class="form-control form-control-color"
                        value="{{ setting('secondary_color', '#6c757d') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Background Color</label>
                    <input type="color" name="background_color" class="form-control form-control-color"
                        value="{{ setting('background_color', '#ffffff') }}">
                </div>

            </div>
        </div>

        <!-- ===== Page Visibility ===== -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark">
                <strong>Page Visibility</strong>
            </div>
            <div class="card-body row">

                <div class="col-md-3 mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="page_home_enabled" value="1" id="pageHome" {{
                        setting('page_home_enabled', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="pageHome">Home Page</label>
                </div>

                <div class="col-md-3 mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="page_about_enabled" value="1" id="pageAbout"
                        {{ setting('page_about_enabled', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="pageAbout">About Page</label>
                </div>

                <div class="col-md-3 mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="page_contact_enabled" value="1"
                        id="pageContact" {{ setting('page_contact_enabled', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="pageContact">Contact Page</label>
                </div>

                <!-- Add more pages here as needed -->
            </div>
        </div>


        <!-- Submit Button -->
        <div class="text-end">
            <button class="btn btn-success px-4">
                Save Settings
            </button>
        </div>

    </form>
</div>

@endsection