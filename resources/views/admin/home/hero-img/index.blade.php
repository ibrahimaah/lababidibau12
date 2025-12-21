@extends('admin')

@section('admin-content')

@use(App\Enums\PageFeatureEnum)

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-2">Hero Image Management</h1>
                    <p class="text-muted mb-0">Manage the homepage hero image display</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    @php
                        $heroMedia = $heroImage ? $heroImage->getFirstMedia('hero') : null;
                        $heroEnabled = PageFeatureEnum::HOME_HERO_IMG->is_enabled();
                    @endphp
                    
                  
                    
                    <!-- Hero Image Toggle -->
                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-medium">Display Status:</span>
                        <form action="{{ route('admin.hero-image.toggle') }}" method="POST" id="heroToggleForm" class="d-inline">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                       id="heroToggle" name="hero_enabled" 
                                       {{ $heroEnabled ? 'checked' : '' }}
                                       {{ !$heroMedia ? 'disabled' : '' }}
                                       onchange="document.getElementById('heroToggleForm').submit()">
                                <label class="form-check-label" for="heroToggle">
                                    <span id="heroStatusText">
                                        {{ $heroEnabled ? 'ON' : 'OFF' }}
                                    </span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Toggle Status Alert -->
            @if(session('hero_toggle_status'))
                <div class="alert {{ session('hero_toggle_status') == 'enabled' ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show mt-3">
                    <i class="fas {{ session('hero_toggle_status') == 'enabled' ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>
                    Hero image has been {{ session('hero_toggle_status') == 'enabled' ? 'enabled' : 'disabled' }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Current Hero Image -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-image me-2"></i>Current Hero Image
                    </h5>
                    <div>
                        @if(!$heroEnabled && $heroMedia)
                        <span class="badge bg-warning text-dark me-2">
                            <i class="fas fa-eye-slash me-1"></i>Hidden
                        </span>
                        @endif
                        @if($heroMedia)
                        <form action="{{ route('admin.hero-image.destroy') }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to remove the hero image?');"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-trash-alt me-1"></i>Remove
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if($heroMedia)
                    <div class="text-center">
                        <div class="mb-3">
                            <img src="{{ $heroMedia->getUrl() }}" 
                                 alt="Current Hero Image" 
                                 class="img-fluid rounded border"
                                 style="max-height: 300px;">
                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="text-start">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-file me-1"></i>
                                            {{ $heroMedia->mime_type }}
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-weight me-1"></i>
                                            {{ round($heroMedia->size / 1024) }} KB
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="text-start">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-calendar me-1"></i>
                                            Uploaded: {{ $heroMedia->created_at->format('M d, Y') }}
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-clock me-1"></i>
                                            Last updated: {{ $heroMedia->updated_at->format('h:i A') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-image fa-4x text-muted"></i>
                        </div>
                        <h5 class="text-muted mb-2">No Hero Image Set</h5>
                        <p class="text-muted">Upload your hero image using the form on the right.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upload Form -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-upload me-2"></i>Upload New Hero Image
                    </h5>
                    @if(!$heroEnabled && $heroMedia)
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-exclamation-triangle me-1"></i>Uploaded but hidden
                    </span>
                    @endif
                </div>
                <div class="card-body">
                    <!-- Success Message -->
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <h6 class="alert-heading mb-2">
                            <i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors
                        </h6>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <i class="fas fa-times-circle me-2"></i>
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Upload Form -->
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.hero-image.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Select Image</label>
                            <input type="file" 
                                   name="hero_image" 
                                   class="form-control" 
                                   accept="image/*" 
                                   required
                                   id="heroImageInput">
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Recommended size: 1920x1080px (16:9 aspect ratio). Max file size: 5MB
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div class="mb-4 d-none" id="imagePreviewContainer">
                            <label class="form-label fw-bold">Preview</label>
                            <div class="border rounded p-3 text-center">
                                <img id="imagePreview" 
                                     src="#" 
                                     alt="Image Preview" 
                                     class="img-fluid rounded"
                                     style="max-height: 200px; display: none;">
                                <p class="text-muted mt-2 mb-0" id="previewText">
                                    Image preview will appear here
                                </p>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="alert alert-info mb-4">
                            <h6 class="alert-heading mb-2">
                                <i class="fas fa-lightbulb me-2"></i>Important Notes
                            </h6>
                            <ul class="mb-0 ps-3">
                                <li>This will replace the current hero image</li>
                                <li>Only one hero image can be set at a time</li>
                                <li>After upload, you can toggle visibility using the switch above</li>
                                <li>Supported formats: JPG, PNG, WebP, GIF</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary" id="resetBtn">
                                <i class="fas fa-redo me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Hero Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('heroImageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewText = document.getElementById('previewText');
    const resetBtn = document.getElementById('resetBtn');
    const heroToggle = document.getElementById('heroToggle');

    // Image preview functionality
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validate file size (5MB = 5 * 1024 * 1024 bytes)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                previewText.style.display = 'none';
                previewContainer.classList.remove('d-none');
            }
            
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
            previewText.style.display = 'block';
            previewContainer.classList.add('d-none');
        }
    });

    // Reset button functionality
    resetBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.style.display = 'none';
        previewText.style.display = 'block';
        previewContainer.classList.add('d-none');
    });

    // Update toggle switch text
    if (heroToggle) {
        heroToggle.addEventListener('change', function() {
            const statusText = document.getElementById('heroStatusText');
            statusText.textContent = this.checked ? 'ON' : 'OFF';
        });
    }
});
</script>

@endsection