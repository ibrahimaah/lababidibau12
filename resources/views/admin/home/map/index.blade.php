@extends('admin')

@section('admin-content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Google Maps Management</h1>
                <div class="d-flex align-items-center gap-3">
                    <!-- Map Toggle -->
                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-medium">Map Status:</span>
                        <form action="{{ route('admin.map.toggle', $mapSetting) }}" method="POST" id="mapToggleForm" class="d-inline">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="mapToggle"
                                    name="is_active" {{ $mapSetting->is_active ? 'checked' : '' }}
                                    onchange="document.getElementById('mapToggleForm').submit()">
                                <label class="form-check-label" for="mapToggle">
                                    <span id="mapStatusText">
                                        {{ $mapSetting->is_active ? 'ON' : 'OFF' }}
                                    </span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p class="text-muted mb-0">Manage Google Maps embed settings for your homepage</p>

            <!-- Status Alert -->
            {{-- @if(session('toggle_status'))
            <div class="alert {{ session('toggle_status') == 'enabled' ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show mt-3">
                <i class="fas {{ session('toggle_status') == 'enabled' ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>
                Map has been {{ session('toggle_status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif --}}
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

        <!-- Left Column: Map Preview -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marked-alt fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Live Preview</h5>
                            <p class="card-text small mb-0 opacity-75">How your map will appear on the homepage</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($mapSetting->is_active)
                    <div class="p-3 border-bottom bg-light">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                          
                            <span class="badge bg-success">
                                <i class="fas fa-eye me-1"></i>Visible
                            </span>
                        </div> 
                    </div>
                    <iframe 
                        style="border:0; width: 100%; height: {{ $mapSetting->height }}px;"
                        src="{{ $mapSetting->embed_url }}"
                        frameborder="0"
                        allowfullscreen
                        loading="lazy">
                    </iframe>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-map-marked-alt fa-4x text-muted opacity-25"></i>
                        </div>
                        <h5 class="text-muted mb-2">Map is Currently Disabled</h5>
                        <p class="text-muted small mb-4">Enable the map to see the preview here</p>
                        <div class="alert alert-warning mx-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            The map will not be visible on the homepage while disabled
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">
                                <i class="fas fa-ruler-vertical me-1"></i>
                                Height: {{ $mapSetting->height }}px
                            </small>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Updated: {{ $mapSetting->updated_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Map Settings Form -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-cogs fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Map Settings</h5>
                            <p class="card-text small mb-0 opacity-75">Configure your Google Maps embed</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.map.update', $mapSetting) }}">
                        @csrf
                        @method('PUT')

                        <!-- Embed URL -->
                        <div class="mb-4">
                            <label for="embed_url" class="form-label fw-bold">
                                <i class="fas fa-code me-2 text-primary"></i>Google Maps Embed URL
                            </label>
                            <textarea id="embed_url" 
                                      name="embed_url" 
                                      class="form-control" 
                                      rows="7"
                                      placeholder="Paste your Google Maps embed iframe URL here"
                                      required>{{ old('embed_url', $mapSetting->embed_url) }}</textarea>
                            <div class="form-text">
                                <a href="https://www.google.com/maps" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    Get embed code from Google Maps
                                </a>
                            </div>
                            <div class="alert alert-info mt-2">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Copy the entire "src" URL from the Google Maps embed iframe code</small>
                            </div>
                        </div>

                        <!-- Height -->
                        <div class="mb-4">
                            <label for="height" class="form-label fw-bold">
                                <i class="fas fa-ruler-vertical me-2 text-primary"></i>Map Height (px)
                            </label>
                            <input type="number" 
                                   id="height" 
                                   name="height" 
                                   value="{{ old('height', $mapSetting->height) }}"
                                   class="form-control" 
                                   min="200" 
                                   max="500"
                                   required>
                            <div class="form-text">Set the height in pixels (200-500px recommended)</div>
                        </div>

                        <!-- Instructions Card -->
                        <div class="card border-info mb-4">
                            <div class="card-header bg-info bg-opacity-10 border-info">
                                <h6 class="mb-0">
                                    <i class="fas fa-graduation-cap me-2"></i>How to Get Google Maps Embed URL
                                </h6>
                            </div>
                            <div class="card-body">
                                <ol class="mb-0 small">
                                    <li>Go to <a href="https://www.google.com/maps" target="_blank">Google Maps</a></li>
                                    <li>Find your desired location</li>
                                    <li>Click the "Share" button</li>
                                    <li>Select "Embed a map" tab</li>
                                    <li>Copy the entire iframe code</li>
                                    <li>Paste only the "src" URL (content between quotes) into the field above</li>
                                </ol>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Update Map Settings
                            </button>
                            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary">
                                <i class="fas fa-external-link-alt me-2"></i>View on Homepage
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .card {
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
</style>

<script>
    // Update toggle text in real-time
    document.getElementById('mapToggle').addEventListener('change', function() {
        const statusText = document.getElementById('mapStatusText');
        statusText.textContent = this.checked ? 'ON' : 'OFF';
        statusText.classList.toggle('text-success', this.checked);
        statusText.classList.toggle('text-muted', !this.checked);
    });

    // Height preview
    document.getElementById('height').addEventListener('input', function() {
        const previewIframe = document.querySelector('iframe');
        if (previewIframe) {
            previewIframe.style.height = this.value + 'px';
        }
    });
</script>
@endsection