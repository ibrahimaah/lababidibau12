@extends('admin')


@section('admin-content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">
                                <i class="bi bi-images me-2"></i>Image Gallery Management
                            </h4>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                <i class="bi bi-plus-circle me-1"></i>Upload Image
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Alerts -->
                    @include('partials._alerts')
                    
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Validation Error!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($images->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-muted">No Images Found</h4>
                        <p class="text-muted mb-4">Start by uploading your first image</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                            <i class="bi bi-upload me-1"></i>Upload Image
                        </button>
                    </div>
                    @else
                    <div class="row g-3">
                        @foreach($images as $image)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card h-100 border">
                                <div class="card-body p-3 text-center">
                                    <!-- Image Thumbnail -->
                                    @if($image->hasMedia('images'))
                                    <div class="mb-3 position-relative" style="height: 150px; overflow: hidden;">
                                        <img src="{{ $image->getFirstMediaUrl('images', 'thumbnail') }}" 
                                             class="img-fluid rounded" 
                                             style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;"
                                             alt="Image thumbnail"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#previewModal"
                                             data-image-url="{{ $image->getFirstMediaUrl('images') }}"
                                             data-image-name="{{ $image->name ?? 'Image' }}">
                                    </div>
                                    @endif
                                    
                                    <!-- Image Info -->
                                    <div class="text-start">
                                        <h6 class="mb-2 text-truncate">{{ $image->name ?? 'Unnamed Image' }}</h6>
                                        <div class="small text-muted mb-2">
                                            <i class="bi bi-folder me-1"></i>
                                            {{ $image->category->name ?? 'Uncategorized' }}
                                        </div>
                                        @if($image->hasMedia('images'))
                                        <div class="small text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            {{ strtoupper($image->getFirstMedia('images')->extension) }}
                                            •
                                            {{ round($image->getFirstMedia('images')->size / 1024, 2) }} KB
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="card-footer bg-transparent border-top">
                                    <div class="d-flex justify-content-between">
                                        <!-- Preview Button -->
                                        <button type="button" class="btn btn-outline-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#previewModal"
                                                data-image-url="{{ $image->getFirstMediaUrl('images') }}"
                                                data-image-name="{{ $image->name ?? 'Image' }}">
                                            <i class="bi bi-eye me-1"></i>Preview
                                        </button>
                                        
                                        <!-- Delete Form -->
                                        <form action="{{ route('remove-image', $image->id) }}" method="POST" 
                                              class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($images->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                @if($images->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $images->previousPageUrl() }}">Previous</a>
                                </li>
                                @endif
                                
                                @foreach(range(1, $images->lastPage()) as $page)
                                <li class="page-item {{ $images->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $images->url($page) }}">{{ $page }}</a>
                                </li>
                                @endforeach
                                
                                @if($images->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $images->nextPageUrl() }}">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-upload me-2"></i>Upload New Image
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" enctype="multipart/form-data" action="{{ route('store-image') }}" id="uploadForm">
                @csrf
                <div class="modal-body">
                    <!-- File Input -->
                    <div class="mb-3">
                        <label for="imageInput" class="form-label">Select Image</label>
                        <input type="file" name="image" id="imageInput" 
                               class="form-control" 
                               accept="image/*" 
                               required>
                        <div class="form-text">
                            Supported formats: JPG, PNG, GIF, WebP. Max size: 5MB
                        </div>
                    </div>
                    
                    <!-- Category Selection -->
                    <div class="mb-3">
                        <label for="categorySelect" class="form-label">Category</label>
                        <select class="form-select" name="category" id="categorySelect" required>
                            <option value="">Choose Category</option>
                            @isset($categories)
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    
                    <!-- Image Name -->
                    <div class="mb-3">
                        <label for="imageName" class="form-label">Image Name (Optional)</label>
                        <input type="text" name="name" id="imageName" 
                               class="form-control" 
                               placeholder="Enter a descriptive name">
                    </div>
                    
                    <!-- Image Preview -->
                    <div class="mb-3 d-none" id="imagePreviewContainer">
                        <label class="form-label">Preview</label>
                        <div class="border rounded p-3 text-center">
                            <img id="imagePreview" src="" 
                                 class="img-fluid rounded" 
                                 style="max-height: 200px;"
                                 alt="Image preview">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="uploadBtn">
                        <i class="bi bi-upload me-1"></i>Upload Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalTitle">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <div class="position-relative">
                    <img id="previewImage" src="" 
                         class="img-fluid" 
                         alt="Preview"
                         style="max-height: 70vh; object-fit: contain;">
                    <div class="position-absolute top-0 end-0 m-3">
                        <a id="downloadLink" href="#" class="btn btn-primary btn-sm" download>
                            <i class="fa fa-download"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="me-auto">
                    <small class="text-muted" id="imageInfo"></small>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="bi bi-trash text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="lead">Are you sure you want to delete this image?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete Image
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview for upload
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        
        if (imageInput) {
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.classList.remove('d-none');
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreviewContainer.classList.add('d-none');
                }
            });
        }
        
        // Form submission loading state
        const uploadForm = document.getElementById('uploadForm');
        const uploadBtn = document.getElementById('uploadBtn');
        
        if (uploadForm && uploadBtn) {
            uploadForm.addEventListener('submit', function() {
                uploadBtn.disabled = true;
                uploadBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Uploading...';
            });
        }
        
        // Preview modal handler
        const previewModal = document.getElementById('previewModal');
        if (previewModal) {
            previewModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const imageUrl = button.getAttribute('data-image-url');
                const imageName = button.getAttribute('data-image-name');
                
                const modalTitle = previewModal.querySelector('.modal-title');
                const modalImage = previewModal.querySelector('#previewImage');
                const downloadLink = previewModal.querySelector('#downloadLink');
                const imageInfo = previewModal.querySelector('#imageInfo');
                
                modalTitle.textContent = imageName;
                modalImage.src = imageUrl;
                downloadLink.href = imageUrl;
                downloadLink.download = imageName;
                
                // Get image dimensions
                modalImage.onload = function() {
                    imageInfo.textContent = 
                        `${modalImage.naturalWidth} × ${modalImage.naturalHeight} pixels`;
                };
            });
        }
        
        // Delete confirmation handler
        const deleteModal = document.getElementById('deleteModal');
        const deleteForms = document.querySelectorAll('.delete-form');
        
        if (deleteModal) {
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const deleteFormModal = deleteModal.querySelector('#deleteForm');
                    deleteFormModal.action = this.action;
                    
                    const modal = new bootstrap.Modal(deleteModal);
                    modal.show();
                    
                    // Handle final delete submission
                    deleteFormModal.addEventListener('submit', function() {
                        this.querySelector('button[type="submit"]').innerHTML = 
                            '<span class="spinner-border spinner-border-sm me-1"></span>Deleting...';
                        this.querySelector('button[type="submit"]').disabled = true;
                    });
                });
            });
        }
        
        // Auto-dismiss alerts
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>

@endsection