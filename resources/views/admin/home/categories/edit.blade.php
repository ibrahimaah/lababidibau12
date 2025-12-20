@extends('admin')

@section('admin-content')
@use(App\Enums\PageFeatureEnum)

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Edit Category</h1>
                    <p class="text-muted mb-0">Update category information</p>
                </div>
                <!-- Status Indicator -->
                <div class="d-flex align-items-center gap-3">
                    <div>
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

            <!-- Edit Category Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Edit Category: {{ $category->name }}</h5>
                            <p class="card-text small mb-0 opacity-75">Update category details</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" 
                          action="{{ route('update-category', $category->id) }}" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                      

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
                                   value="{{ old('name', $category->name) }}"
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
                                      >{{ old('description', $category->description) }}</textarea>
                            <div class="form-text">Optional: Provide details about this service category</div>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Icon Display -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-image me-2 text-primary"></i>Current Icon
                            </label>
                            
                            @if($category->hasMedia('icons'))
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <h6 class="text-muted mb-3">Current Icon</h6>
                                        <img src="{{ $category->getFirstMediaUrl('icons', 'thumb') }}" 
                                             alt="{{ $category->name }}"
                                             class="img-thumbnail mb-2"
                                             style="max-width: 150px;">
                                        <div class="mt-2">
                                            <a href="{{ $category->getFirstMediaUrl('icons') }}" 
                                               class="btn btn-sm btn-outline-primary"
                                               target="_blank">
                                                <i class="fas fa-expand me-1"></i>View Full Size
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-3">Icon Information</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2">
                                                <i class="fas fa-file-image text-info me-2"></i>
                                                <small>Type: {{ $category->getFirstMedia('icons')->mime_type }}</small>
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-weight-hanging text-info me-2"></i>
                                                <small>Size: {{ number_format($category->getFirstMedia('icons')->size / 1024, 2) }} KB</small>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                No icon has been uploaded for this category.
                            </div>
                            @endif
                        </div>

                        <!-- Icon Update Section -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-sync-alt me-2 text-primary"></i>Update Icon
                            </label>
                            
                            <div class="alert alert-warning">
                                <i class="fas fa-info-circle me-2"></i>
                                Leave blank if you don't want to change the current icon.
                            </div>

                            <!-- File Input -->
                            <div class="mb-3">
                                <input type="file" 
                                       name="icon" 
                                       id="iconInput"
                                       class="form-control"
                                       accept="image/*"
                                       onchange="previewIcon(event)">
                                <div class="form-text">
                                    Upload a new icon image (JPG, PNG, SVG). Recommended size: 100x100px
                                </div>
                                @error('icon')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Icon Preview -->
                            <div class="border rounded p-3 text-center" id="iconPreviewContainer" style="display: none;">
                                <h6 class="text-muted mb-3">New Icon Preview</h6>
                                <img id="iconPreview" class="img-thumbnail" style="max-width: 150px;">
                                <div class="mt-2">
                                    <small class="text-muted" id="fileInfo"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Remove Icon Option -->
                        @if($category->hasMedia('icons'))
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="removeIcon" 
                                       name="remove_icon" 
                                       value="1">
                                <label class="form-check-label text-danger fw-bold" for="removeIcon">
                                    <i class="fas fa-trash-alt me-2"></i>Remove current icon
                                </label>
                                <div class="form-text">
                                    Check this if you want to remove the existing icon
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Spatie Media Library Info -->
                        <div class="alert alert-info mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-database me-3"></i>
                                <div>
                                    <small>
                                        Icons are managed via Spatie Media Library. 
                                        Changes will update the media collection automatically.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div>
                                <a href="{{ route('admin-category') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Categories
                                </a>
                                <button type="button" 
                                        class="btn btn-outline-danger ms-2"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal">
                                    <i class="fas fa-trash-alt me-2"></i>Delete Category
                                </button>
                            </div>
                            <div>
                                <button type="reset" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-redo me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-warning px-4">
                                    <i class="fas fa-save me-2"></i>Update Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Guidelines Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb me-2 text-warning"></i>Editing Tips
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Update names for better clarity
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Keep descriptions up to date
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Use consistent icon styles
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Test changes on frontend
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Delete Category
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <h5 class="fw-bold">Are you sure?</h5>
                    <p class="text-muted">
                        You are about to delete the category "<strong>{{ $category->name }}</strong>". 
                        This action cannot be undone.
                    </p>
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Warning:</strong> This will also remove all associated media files.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form action="{{ route('remove-category', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i>Delete Category
                    </button>
                </form>
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

// Toggle remove icon confirmation
document.addEventListener('DOMContentLoaded', function() {
    const removeIconCheckbox = document.getElementById('removeIcon');
    const iconInput = document.getElementById('iconInput');
    
    if (removeIconCheckbox) {
        removeIconCheckbox.addEventListener('change', function() {
            if (this.checked) {
                iconInput.disabled = true;
                iconInput.value = '';
                document.getElementById('iconPreviewContainer').style.display = 'none';
            } else {
                iconInput.disabled = false;
            }
        });
    }
    
    // Initialize preview if there's already a value
    if (iconInput.files && iconInput.files[0]) {
        const event = new Event('change');
        iconInput.dispatchEvent(event);
    }
});
</script>

@endsection