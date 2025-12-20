@extends('admin')

@section('admin-content')
@use(App\Enums\PageFeatureEnum)

<div class="container-fluid py-4">
    <!-- Page Header with Toggle -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Categories Management</h1>
                    <p class="text-muted mb-0">Manage service categories for your portfolio</p>
                </div>
                <!-- Categories Toggle -->
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-medium">Categories Status:</span>
                        <form action="{{ route('toggle-categories') }}" method="POST" id="categoriesToggleForm" class="d-inline">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="categoriesToggle"
                                    name="categories_status" {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'checked' : '' }}
                                onchange="document.getElementById('categoriesToggleForm').submit()">
                                <label class="form-check-label" for="categoriesToggle">
                                    <span id="sliderStatusText">
                                        {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'ON' : 'OFF' }}
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
    @if(session('categories_toggle_status'))
    <div class="row">
        <div class="col-12">
            <div class="alert {{ session('categories_toggle_status') == 'enabled' ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show mb-4">
                <i class="fas {{ session('categories_toggle_status') == 'enabled' ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>
                Categories section has been {{ session('categories_toggle_status') == 'enabled' ? 'enabled' : 'disabled' }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Success/Error Messages -->
    <div class="row">
        <div class="col-12">
            @if(Session::has('success-removed'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-lg me-3"></i>
                    <div>
                        <h6 class="mb-1">Success!</h6>
                        <p class="mb-0">{{ session()->get('success-removed') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(Session::has('faild-removed'))
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle fa-lg me-3"></i>
                    <div>
                        <h6 class="mb-1">Error!</h6>
                        <p class="mb-0">{{ session()->get('faild-removed') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
        </div>
    </div>

    <!-- Actions Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-{{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'success' : 'secondary' }} me-2">
                                {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'ACTIVE' : 'INACTIVE' }}
                            </span>
                            <small class="text-muted">
                                <i class="fas {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'fa-eye text-success' : 'fa-eye-slash text-secondary' }} me-1"></i>
                                {{ PageFeatureEnum::HOME_CATEGORIES->is_enabled() ? 'Visible on website' : 'Hidden from website' }}
                            </small>
                        </div>
                        <div>
                            <a href="{{ route('create-category') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Create New Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="row">
        <div class="col-12">
            @if($categories->isNotEmpty())
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list-alt fa-lg me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">All Categories</h5>
                            <p class="card-text small mb-0 opacity-75">Manage your service categories</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="60" class="text-center">#</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th class="text-center">Icon</th>
                                    <th width="150" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="text-center fw-bold align-middle">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            @if($category->hasMedia('icons'))
                                            <div class="me-3">
                                                <img src="{{ $category->getFirstMediaUrl('icons', 'thumb') }}" 
                                                     alt="{{ $category->name }}" 
                                                     class="rounded-circle border"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $category->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($category->description)
                                        <p class="mb-0 text-truncate" style="max-width: 200px;" 
                                           title="{!! $category->description !!}">
                                            {!! $category->description !!}
                                        </p>
                                        @else
                                        <span class="text-muted">No description</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($category->hasMedia('icons'))
                                        <a href="{{ $category->getFirstMediaUrl('icons') }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank"
                                           title="View full size icon">
                                            <i class="fas fa-image me-1"></i>Preview
                                        </a>
                                        @else
                                        <span class="badge bg-secondary">No Icon</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('edit-category', $category->id) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('remove-category', $category->id) }}" 
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-layer-group me-1"></i>
                            Total: {{ $categories->count() }} categories
                        </small>
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Icons are managed via Spatie Media Library
                        </small>
                    </div>
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="card border-0 shadow-sm">
                <div class="card-body py-5">
                    <div class="text-center">
                        <div class="mb-4">
                            <i class="fas fa-layer-group fa-4x text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-3">No Categories Yet</h4>
                        <p class="text-muted mb-4">Start by creating your first service category.</p>
                        <a href="{{ route('create-category') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Create First Category
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection