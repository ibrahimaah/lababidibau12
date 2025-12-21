@extends('admin')

@section('admin-content')

@use(App\Enums\PageFeatureEnum)

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Slider Images Management</h1>
                <div class="d-flex align-items-center gap-3">
                    <div class="badge bg-primary fs-6">{{ $sliders->count() ?? 0 }} Images</div>
                    <!-- Slider Toggle -->
                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-medium">Slider Status:</span>
                        <form action="{{ route('toggle-slider') }}" method="POST" id="sliderToggleForm" class="d-inline">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                       id="sliderToggle" name="slider_status" 
                                       {{ PageFeatureEnum::HOME_SLIDER->is_enabled() ? 'checked' : '' }}
                                       onchange="document.getElementById('sliderToggleForm').submit()">
                                <label class="form-check-label" for="sliderToggle">
                                    <span id="sliderStatusText">
                                        {{ PageFeatureEnum::HOME_SLIDER->is_enabled() ? 'ON' : 'OFF' }}
                                    </span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p class="text-muted mb-0">Upload and manage slider images for your website</p>
            
            <!-- Slider Status Alert -->
            @if(session('slider_toggle_status'))
                <div class="alert {{ session('slider_toggle_status') == 'enabled' ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show mt-3">
                    <i class="fas {{ session('slider_toggle_status') == 'enabled' ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>
                    Slider has been {{ session('slider_toggle_status') == 'enabled' ? 'enabled' : 'disabled' }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Upload Form Column -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-upload me-2"></i>Upload New Image
                    </h5> 
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <h6 class="alert-heading mb-2">
                            <i class="fas fa-exclamation-triangle me-2"></i>Validation Errors
                        </h6>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(Session::has('faild'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-times-circle me-2"></i>{{ session()->get('faild') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form method="post" enctype="multipart/form-data" action="{{ route('store-slider-image') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">Select Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            <div class="form-text">Supported formats: JPG, PNG, GIF, WebP</div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-redo me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary" {{ !($slider_status ?? false) ? '' : '' }}>
                                <i class="fas fa-plus-circle me-2"></i>Upload Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Images List Column -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-images me-2"></i>Existing Images
                    </h5> 
                </div>
                <div class="card-body">
                    @isset($sliders)
                        @if($sliders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="80">ID</th>
                                            <th>Preview</th> 
                                            <th width="120">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sliders as $slider)
                                        @php $media = $slider->getFirstMedia('slider-images'); @endphp
                                        <tr>
                                            <td class="fw-bold">#{{ $slider->id }}</td>
                                            <td>
                                                @if($media)
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded p-2 me-3">
                                                        <i class="fas fa-image text-primary fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <a href="{{ $media->getUrl() }}" class="text-decoration-none" target="_blank">
                                                            <span class="d-block fw-medium">View Image</span>
                                                            <small class="text-muted">Click to preview</small>
                                                        </a>
                                                    </div>
                                                </div>
                                                @else
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-exclamation-circle me-1"></i>No Image
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('remove-slider-image',$slider->id) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to remove this image?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-images fa-4x text-muted"></i>
                                </div>
                                <h5 class="text-muted mb-3">No Slider Images Found</h5>
                                <p class="text-muted">Upload your first image using the form on the left.</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3 text-muted">Loading images...</p>
                        </div>
                    @endisset

                    @if(Session::has('success-removed'))
                    <div class="alert alert-success alert-dismissible fade show mt-3">
                        <i class="fas fa-check-circle me-2"></i>{{ session()->get('success-removed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(Session::has('faild-removed'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3">
                        <i class="fas fa-times-circle me-2"></i>{{ session()->get('faild-removed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection