@extends('admin')

@use(App\Enums\PageFeatureEnum)

@section('admin-content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Counters Management</h1>
                    <p class="text-muted mb-0">Manage statistics and counters displayed on your website</p>
                </div>
                <!-- Counters Toggle -->
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-medium">Counters Status:</span>
                        <form action="{{ route('toggle-counters') }}" method="POST" id="countersToggleForm" class="d-inline">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="countersToggle"
                                    name="counters_status" {{ PageFeatureEnum::HOME_COUNTERS->is_enabled() ? 'checked' : '' }}
                                onchange="document.getElementById('countersToggleForm').submit()">
                                <label class="form-check-label" for="countersToggle">
                                    <span id="sliderStatusText">
                                        {{ PageFeatureEnum::HOME_COUNTERS->is_enabled() ? 'ON' : 'OFF' }}
                                    </span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Status Alert -->
    @if(session('counters_toggle_status'))
    <div class="row">
        <div class="col-12">
            <div class="alert {{ session('counters_toggle_status') == 'enabled' ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show mb-4">
                <i class="fas {{ session('counters_toggle_status') == 'enabled' ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>
                Counters section has been {{ session('counters_toggle_status') == 'enabled' ? 'enabled' : 'disabled' }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Success/Error Messages -->
    <div class="row">
        <div class="col-12">
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
        </div>
    </div>

    <div class="row">
        <!-- Update Counters Form -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chart-line fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Update Counters</h5>
                            <p class="card-text small mb-0 opacity-75">Modify your statistics and achievements</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-counter') }}">
                        @csrf

                        <!-- Status Indicator -->
                        <div class="alert alert-info mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-3"></i>
                                <div>
                                    <small>Counters are currently: 
                                        <span class="badge bg-{{ PageFeatureEnum::HOME_COUNTERS->is_enabled() ? 'success' : 'secondary' }}">
                                            {{ PageFeatureEnum::HOME_COUNTERS->is_enabled() ? 'ACTIVE' : 'INACTIVE' }}
                                        </span>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Clients Counter -->
                        <div class="mb-4">
                            <label for="clientInput" class="form-label fw-bold">
                                <i class="fas fa-user-group me-2 text-primary"></i>Happy Clients
                            </label>
                            <input type="number" 
                                   id="clientInput" 
                                   name="client" 
                                   class="form-control form-control-lg" 
                                   placeholder="Enter number of clients"
                                   min="0"
                                   step="1"
                                   required
                                   value="{{ old('client', isset($counters) ? $counters->clients : '') }}">
                            <div class="form-text">Total number of satisfied clients</div>
                            @error('client')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Projects Counter -->
                        <div class="mb-4">
                            <label for="projectInput" class="form-label fw-bold">
                                <i class="fas fa-briefcase me-2 text-primary"></i>Projects Completed
                            </label>
                            <input type="number" 
                                   id="projectInput" 
                                   name="project" 
                                   class="form-control form-control-lg" 
                                   placeholder="Enter number of projects"
                                   min="0"
                                   step="1"
                                   required
                                   value="{{ old('project', isset($counters) ? $counters->projects : '') }}">
                            <div class="form-text">Total projects successfully delivered</div>
                            @error('project')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Years of Experience -->
                        <div class="mb-4">
                            <label for="yearInput" class="form-label fw-bold">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>Years of Experience
                            </label>
                            <input type="number" 
                                   id="yearInput" 
                                   name="year" 
                                   class="form-control form-control-lg" 
                                   placeholder="Enter years of experience"
                                   min="0"
                                   max="100"
                                   step="1"
                                   required
                                   value="{{ old('year', isset($counters) ? $counters->years : '') }}">
                            <div class="form-text">Years of professional experience in the industry</div>
                            @error('year')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="enableImmediately" name="enable_immediately" value="1">
                                <label class="form-check-label" for="enableImmediately">
                                    Enable counters immediately
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Update Counters
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Current Counters Display -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chart-bar fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Current Statistics</h5>
                            <p class="card-text small mb-0 opacity-75">Live view of your current counters</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @isset($counters)
                    <!-- Stats Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-4">
                                    <div class="mb-3">
                                        <i class="fas fa-user-group fa-2x text-primary"></i>
                                    </div>
                                    <h2 class="display-6 fw-bold text-primary">{{ number_format($counters->clients) }}+</h2>
                                    <p class="text-muted mb-0">Happy Clients</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-4">
                                    <div class="mb-3">
                                        <i class="fas fa-briefcase fa-2x text-success"></i>
                                    </div>
                                    <h2 class="display-6 fw-bold text-success">{{ number_format($counters->projects) }}+</h2>
                                    <p class="text-muted mb-0">Projects</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-4">
                                    <div class="mb-3">
                                        <i class="fas fa-calendar-alt fa-2x text-warning"></i>
                                    </div>
                                    <h2 class="display-6 fw-bold text-warning">{{ $counters->years }}+</h2>
                                    <p class="text-muted mb-0">Years Experience</p>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-chart-pie fa-4x text-muted"></i>
                        </div>
                        <h5 class="text-muted mb-3">No Counters Data</h5>
                        <p class="text-muted mb-4">Start by adding your first counters using the form on the left.</p>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Once added, counters will appear here in an attractive format
                        </div>
                    </div>
                    @endisset
                </div>

              
            </div>
        </div>
    </div>
 
</div>

@endsection