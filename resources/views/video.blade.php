@extends('layouts.dashboard')

@section('title','Videos')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-video me-2 text-primary"></i>Video Management
        </h1>
        <span class="badge bg-primary rounded-pill fs-6">
            {{ $videos->count() }} Videos
        </span>
    </div>

    <!-- Flash Messages -->
    <div class="mb-4">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">
                <i class="fas fa-exclamation-circle me-2"></i>Validation Errors
            </h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2 fs-5"></i>
            <div>{{ Session::get('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('faild'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-triangle me-2 fs-5"></i>
            <div>{{ Session::get('faild') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('success-removed'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-trash-alt me-2 fs-5"></i>
            <div>{{ Session::get('success-removed') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('faild-removed'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-times-circle me-2 fs-5"></i>
            <div>{{ Session::get('faild-removed') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <div class="row g-4">
        <!-- Upload Form Card -->
        <div class="col-lg-4 col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-upload me-2"></i>Upload New Video
                    </h5>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('store-video') }}">
                        @csrf

                        <!-- Video Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">
                                <i class="fas fa-heading me-1 text-primary"></i>Video Title
                            </label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg"
                                placeholder="Enter video title" required>
                        </div>

                        <!-- Thumbnail Upload -->
                        <div class="mb-4">
                            <label for="thumb" class="form-label fw-semibold">
                                <i class="fas fa-image me-1 text-primary"></i>Thumbnail Image
                            </label>
                            <div class="input-group">
                                <input type="file" name="thumb" id="thumb" class="form-control" accept="image/*"
                                    required>
                            </div>
                            <small class="form-text text-muted">
                                Recommended: 1280x720px (16:9 ratio)
                            </small>
                        </div>

                        <!-- Video File Upload -->
                        <div class="mb-4">
                            <label for="video" class="form-label fw-semibold">
                                <i class="fas fa-file-video me-1 text-primary"></i>Video File
                            </label>
                            <div class="input-group">
                                <input type="file" name="name" id="video" class="form-control" accept="video/*"
                                    required>
                            </div>
                            <small class="form-text text-muted">
                                Maximum size: 100MB. Supported: MP4, MOV, AVI
                            </small>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Upload Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Videos Grid -->
        <div class="col-lg-8 col-md-12">
            @if($videos->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($videos as $video)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <!-- Video Thumbnail with Play Button -->
                        <div class="position-relative overflow-hidden rounded-top"
                            style="height: 180px; background: #f8f9fa;">
                            @if($video->hasMedia('thumbnails'))
                            <img src="{{ $video->getFirstMediaUrl('thumbnails') }}"
                                class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $video->title }}">
                            @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                <i class="fas fa-image fa-3x text-secondary"></i>
                            </div>
                            @endif
                            <div class="position-absolute top-50 start-50 translate-middle">
                                {{-- Fixed version --}}
                                @if($video->hasMedia('videos'))
                                <a data-fancybox href="{{ $video->getFirstMediaUrl('videos') }}"
                                    data-caption="{{ $video->title }}"
                                    class="btn btn-primary btn-lg rounded-circle shadow"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-play"></i>
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <h6 class="card-title text-truncate mb-2" title="{{ $video->title }}">
                                {{ $video->title }}
                            </h6>

                            <!-- Video Info -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $video->created_at->format('M d, Y') }}
                                </small>
                                @if($video->hasMedia('videos'))
                                <span class="badge bg-info">
                                    <i class="fas fa-hdd me-1"></i>
                                    {{ round($video->getFirstMedia('videos')->size / 1024 / 1024, 1) }}MB
                                </span>
                                @endif
                            </div>

                            <!-- Hidden Video Player -->
                            @if($video->hasMedia('videos'))
                            <video id="videoPlayer{{ $video->id }}" controls style="display: none;"
                                poster="{{ $video->hasMedia('thumbnails') ? $video->getFirstMediaUrl('thumbnails') : '' }}">
                                <source src="{{ $video->getFirstMediaUrl('videos') }}"
                                    type="{{ $video->getFirstMedia('videos')->mime_type }}">
                                Your browser doesn't support HTML5 video.
                            </video>
                            @endif
                        </div>

                        <!-- Card Footer with Delete Form -->
                        <div class="card-footer bg-transparent border-top-0 pt-0">
                            <form action="{{ route('remove-video', $video->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this video?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fas fa-trash-alt me-2"></i>Delete Video
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-video-slash fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">No Videos Uploaded Yet</h4>
                <p class="text-muted mb-4">Upload your first video using the form on the left</p>
            </div>
            @endif

            <!-- Pagination (if needed) -->
            @if($videos->hasPages())
            <div class="mt-4">
                {{ $videos->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Fancybox CSS (if not already included) -->
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

<!-- Fancybox JS -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    // Initialize Fancybox
    Fancybox.bind("[data-fancybox]", {
        // Options can be added here
    });
    
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endpush
@endsection