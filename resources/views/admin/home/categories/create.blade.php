@extends('admin')

@section('admin-content')
@use(App\Enums\PageFeatureEnum)

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Create New Category</h1>
                    <p class="text-muted mb-0">Add a new service category to your portfolio</p>
                </div>
                <!-- Status Indicator -->
                <div class="d-flex align-items-center">
                    <span class="badge bg-{{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'success' : 'secondary' }} me-2">
                        {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'ACTIVE' : 'INACTIVE' }}
                    </span>
                    <small class="text-muted">
                        <i class="fas {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'fa-eye text-success' : 'fa-eye-slash text-secondary' }} me-1"></i>
                        {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'Visible on website' : 'Hidden from website' }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
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

            <!-- Create Category Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-plus-circle fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Category Details</h5>
                            <p class="card-text small mb-0 opacity-75">Fill in the category information</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store-category') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="nameInput" class="form-label fw-bold">
                                <i class="fas fa-tag me-2 text-primary"></i>Category Name
                            </label>
                            <input type="text" 
                                   id="nameInput" 
                                   name="name" 
                                   class="form-control form-control-lg" 
                                   placeholder="Enter category name"
                                   value="{{ old('name') }}"
                                   required>
                            <div class="form-text">This will be the main title of your service category</div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="mb-4">
                            <label for="descriptionInput" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2 text-primary"></i>Description
                            </label>
                            <textarea id="descriptionInput" 
                                      name="description" 
                                      class="form-control" 
                                      rows="4"
                                      placeholder="Describe this category..."
                                      >{{ old('description') }}</textarea>
                            <div class="form-text">Optional: Provide details about this service category</div>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Icon Upload with Preview -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-image me-2 text-primary"></i>Category Icon
                            </label>
                            
                            <!-- File Input -->
                            <div class="mb-3">
                                <input type="file" 
                                       name="icon" 
                                       id="iconInput"
                                       class="form-control"
                                       accept="image/*"
                                       required
                                       onchange="previewIcon(event)">
                                <div class="form-text">
                                    Upload an icon image (JPG, PNG, SVG). Recommended size: 100x100px
                                </div>
                                @error('icon')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview Area -->
                            <div class="border rounded p-3 text-center" id="iconPreviewContainer" style="display: none;">
                                <h6 class="text-muted mb-3">Icon Preview</h6>
                                <img id="iconPreview" class="img-thumbnail" style="max-width: 150px;">
                                <div class="mt-2">
                                    <small class="text-muted" id="fileInfo"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Spatie Media Library Info -->
                        <div class="alert alert-info mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-3"></i>
                                <div>
                                    <small>
                                        Icons are managed via Spatie Media Library. 
                                        Uploaded images will be automatically optimized and stored.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('admin-category') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Categories
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Guidelines Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb me-2 text-warning"></i>Best Practices
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Use clear, descriptive names for categories
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Upload high-quality icons with transparent backgrounds
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Keep descriptions concise but informative
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Use consistent icon styles across all categories
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Icon Preview -->
<script>
function previewIcon(event) {
    const input = event.target;
    const previewContainer = document.getElementById('iconPreviewContainer');
    const previewImage = document.getElementById('iconPreview');
    const fileInfo = document.getElementById('fileInfo');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const file = input.files[0];
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
            fileInfo.textContent = `${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
        };
        
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
        previewImage.src = '';
        fileInfo.textContent = '';
    }
}

// Initialize preview if there's already a value (for edit scenarios)
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('iconInput');
    if (iconInput.files && iconInput.files[0]) {
        const event = new Event('change');
        iconInput.dispatchEvent(event);
    }
});
</script>

@endsection