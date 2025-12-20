@extends('admin')

@section('admin-content')

@use(App\Enums\PageFeatureEnum)

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">About Us Management</h1>
                <div class="d-flex align-items-center gap-3">
                    <!-- About Toggle -->
                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-medium">About Status:</span>
                        <form action="{{ route('toggle-about') }}" method="POST" id="aboutToggleForm" class="d-inline">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="aboutToggle"
                                    name="about_status" {{ PageFeatureEnum::HOME_ABOUT->is_enabled() ? 'checked' : '' }}
                                onchange="document.getElementById('aboutToggleForm').submit()">
                                <label class="form-check-label" for="aboutToggle">
                                    <span id="sliderStatusText">
                                        {{ PageFeatureEnum::HOME_ABOUT->is_enabled() ? 'ON' : 'OFF' }}
                                    </span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p class="text-muted mb-0">Manage your about page content and information</p>

            <!-- About Status Alert -->
            @if(session('about_toggle_status'))
            <div
                class="alert {{ session('about_toggle_status') == 'enabled' ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show mt-3">
                <i
                    class="fas {{ session('about_toggle_status') == 'enabled' ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>
                About has been {{ session('about_toggle_status') == 'enabled' ? 'enabled' : 'disabled' }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Success/Error Messages -->
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-lg me-3"></i>
                <div>
                    <h6 class="mb-1">Success!</h6>
                    <p class="mb-0">{{ session()->get('success') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(Session::has('faild'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle fa-lg me-3"></i>
                <div>
                    <h6 class="mb-1">Error!</h6>
                    <p class="mb-0">{{ session()->get('faild') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                <div>
                    <h6 class="mb-2">Please fix the following errors:</h6>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <!-- Main Content Section -->
        <div class="col-lg-6 mb-4">


            <!-- About Us Form Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Edit About Us Content</h5>
                            <p class="card-text small mb-0 opacity-75">Update your about page title and description</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-admin-about', $about_us->id) }}">
                        @csrf

                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="titleInput" class="form-label fw-bold">
                                <i class="fas fa-heading me-2 text-primary"></i>Page Title
                            </label>
                            <input type="text" id="titleInput" name="title" value="{{ $about_us->title ?? '' }}"
                                class="form-control form-control-lg" placeholder="Enter about page title" required>
                            <div class="form-text">This will be the main heading of your about page</div>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-4">
                            <label for="descriptionInput" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2 text-primary"></i>Description
                            </label>
                            <textarea id="descriptionInput" name="desc" class="form-control" rows="8"
                                placeholder="Write your about us description here..."
                                required>{{ $about_us->desc ?? '' }}</textarea>
                            <div class="form-text">Provide detailed information about your company, mission, and values
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4 d-block ms-auto">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-concierge-bell fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">About Us - Services</h5>
                            <p class="card-text small mb-0 opacity-75">Manage services listed in about section</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Services Alert Messages -->
                    @if(Session::has('success-removed'))
                    <div class="alert alert-success alert-dismissible fade show mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3"></i>
                            <div>
                                <p class="mb-0">{{ session()->get('success-removed') }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(Session::has('faild-removed'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-3"></i>
                            <div>
                                <p class="mb-0">{{ session()->get('faild-removed') }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Services Table -->
                    @if($services->isNotEmpty())
                    <div class="table-responsive mb-4">
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50" class="text-center">#</th>
                                    <th>Service</th>
                                    <th width="100" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <td class="text-center fw-bold">{{ $service->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            {{ $service->name }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('remove-admin-about-service', $service->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to remove this service?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-concierge-bell fa-3x text-muted"></i>
                        </div>
                        <h6 class="text-muted mb-2">No Services Added</h6>
                        <p class="text-muted small">Add your first service using the form below</p>
                    </div>
                    @endif

                    <!-- Add Service Form -->
                    <div class="border-top pt-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Add New Service
                        </h6>
                        <form method="post" action="{{ route('store-admin-about-service') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Service Name</label>
                                <input type="text" name="service" class="form-control" placeholder="Enter service name"
                                    required>
                                <div class="form-text">Add a service to display in about section</div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Add Service
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-list-check me-1"></i>
                            Total: {{ $services->count() }} services
                        </small>
                        @if($services->count() > 0)
                        <small class="text-muted">
                            <i class="fas fa-lightbulb me-1"></i>
                            Services will appear in about section
                        </small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection