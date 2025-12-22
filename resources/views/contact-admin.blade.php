@extends('admin')

@section('admin-content')
@use(App\Enums\PageFeatureEnum)
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">Contact Information</h1>
                    <p class="text-muted mb-0">Update your contact details and location information</p>
                </div>
                <div class="d-flex align-items-center gap-3"> 
                    <!-- Contact Toggle -->
                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-medium">Contact Status:</span>
                        <form action="{{ route('toggle-contact') }}" method="POST" id="contactToggleForm" class="d-inline">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                       id="contactToggle" name="contact_status" 
                                       {{ PageFeatureEnum::HOME_CONTACT->is_enabled() ? 'checked' : '' }}
                                       onchange="document.getElementById('contactToggleForm').submit()">
                                <label class="form-check-label" for="contactToggle">
                                    <span id="contactStatusText">
                                        {{ PageFeatureEnum::HOME_CONTACT->is_enabled() ? 'ON' : 'OFF' }}
                                    </span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

         <!-- Slider Status Alert -->
    @if(session('contact_toggle_status'))
         <div class="alert {{ session('contact_toggle_status') == 'enabled' ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show mt-3">
             <i class="fas {{ session('contact_toggle_status') == 'enabled' ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>
             Contact Section has been {{ session('contact_toggle_status') == 'enabled' ? 'enabled' : 'disabled' }}
             <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
         </div>
     @endif

    <!-- Success/Error Messages -->
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
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
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
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

    <div class="row">
        <!-- Form Column -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Update Contact Information</h5>
                            <p class="card-text small mb-0 opacity-75">Edit your contact details below</p>
                        </div>
                        
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-contact') }}" id="contactForm">
                        @csrf

                        <div class="mb-4">
                            <label for="locationInput" class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>Location
                            </label>
                            <input type="text" id="locationInput" name="location" class="form-control form-control-lg"
                                placeholder="Enter your location/address"
                                value="{{ old('location', $contacts->location ?? '') }}" required>
                            <div class="form-text">Enter your complete address or location</div>
                        </div>

                        <div class="mb-4">
                            <label for="emailInput" class="form-label fw-bold">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                            </label>
                            <input type="email" id="emailInput" name="email" class="form-control form-control-lg"
                                placeholder="Enter email address" value="{{ old('email', $contacts->email ?? '') }}"
                                required>
                            <div class="form-text">This will be your primary contact email</div>
                        </div>

                        <div class="mb-4">
                            <label for="phoneInput" class="form-label fw-bold">
                                <i class="fas fa-phone me-2 text-primary"></i>Phone Number
                            </label>
                            <input type="text" id="phoneInput" name="call" class="form-control form-control-lg"
                                placeholder="Enter phone number" value="{{ old('call', $contacts->call ?? '') }}"
                                required>
                            <div class="form-text">Include country code if applicable</div>
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-clock fa-lg me-2"></i>
                        <span class="card-title mb-0">Working Hours</span>
                    </div>
                    <div>
                        @if($isOpenNow)
                        <span class="badge bg-success">Jetzt geöffnet</span>
                        @else
                        <span class="badge bg-danger">Jetzt geschlossen</span>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.working-hours.update') }}">
                        @csrf
 

                        @foreach(['monday','tuesday','wednesday','thursday','friday','saturday','sunday'] as $day)
                        @php
                        $start = $workingHoursData[$day][0] ?? '';
                        $end = $workingHoursData[$day][1] ?? '';
                        @endphp

                        <div class="row align-items-center mb-3">
                            <div class="col-2 fw-bold">{{ ucfirst(substr($day,0,2)) }}</div>

                            <div class="col-4">
                                <input type="time" class="form-control" name="hours[{{ $day }}][start]"
                                    value="{{ explode('-', $start)[0] ?? '' }}">
                            </div>

                            <div class="col-4">
                                <input type="time" class="form-control" name="hours[{{ $day }}][end]"
                                    value="{{ explode('-', $start)[1] ?? '' }}">
                            </div>

                            <div class="col-2">
                                <input type="checkbox" class="form-check-input" name="hours[{{ $day }}][closed]" {{
                                    empty($start) ? 'checked' : '' }}>
                                <label class="form-check-label">Closed</label>
                            </div>
                        </div>
                        @endforeach


                        <div class="d-flex justify-content-end pt-3 border-top">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>Save Working Hours
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pre-fill form with old input values if validation fails
        const form = document.getElementById('contactForm');
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            if(input.value === '' && input.name in @json(old())) {
                input.value = @json(old())[input.name];
            }
        });
    });
</script>
@endif
@endsection