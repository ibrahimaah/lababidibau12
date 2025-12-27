@extends('layouts.dashboard')

@section('title', 'Website Settings')

@section('content')

@php
    use App\Models\Setting;

    $logoSetting = Setting::where('key', 'logo')->first();
    $footerLogoSetting = Setting::where('key', 'logo_footer')->first();
    $faviconSetting = Setting::where('key', 'favicon')->first();
@endphp


<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h1 class="h2 mb-0">Website Settings</h1>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    <div class="row mb-4">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                </div>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settings-form">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- ===== General Settings ===== -->
            <div class="col-xxl-8">
                <div class="row">
                    <!-- General Information -->
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary bg-gradient text-white py-3">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-cog me-2"></i>General Information
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="site_name" class="form-label fw-semibold">Site Name *</label>
                                        <input type="text" name="site_name" id="site_name"
                                            class="form-control @error('site_name') is-invalid @enderror"
                                            value="{{ old('site_name', setting('site_name', config('app.name'))) }}"
                                            required>
                                        @error('site_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">The name displayed in the browser title and header.</div>
                                    </div>
    
                                    <!-- Main Logo -->
                                    <div class="col-6">
                                        <label class="form-label fw-semibold d-block">Main Logo</label>
                                        <div class="image-upload-wrapper">
                                            <input type="file" name="logo"
                                                class="form-control @error('logo') is-invalid @enderror"
                                                accept="image/png,image/jpeg,image/svg+xml">
                                    
                                            @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    
                                            @if($logoSetting && $logoSetting->hasMedia('logo'))
                                                <div class="mt-3">
                                                    <p class="text-muted small mb-2">Current Logo:</p>
                                                    <img
                                                        src="{{ $logoSetting->getFirstMediaUrl('logo') }}"
                                                        id="logo-preview"
                                                        class="img-thumbnail bg-light p-2"
                                                        style="max-width: 200px; max-height: 80px; object-fit: contain;">
                                                </div>
                                            @endif
                                    
                                            <div class="form-text">Recommended: PNG/SVG, max 200x80px</div>
                                        </div>
                                    </div>
                                    
    
                                    <!-- Footer Logo -->
                                    <div class="col-6">
                                        <label class="form-label fw-semibold d-block">Footer Logo</label>
                                        <input type="file" name="logo_footer"
                                            class="form-control @error('logo_footer') is-invalid @enderror"
                                            accept="image/png,image/jpeg,image/svg+xml">
                                    
                                        @error('logo_footer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                        @if($footerLogoSetting && $footerLogoSetting->hasMedia('logo_footer'))
                                            <div class="mt-3">
                                                <p class="text-muted small mb-2">Current Footer Logo:</p>
                                                <img
                                                    src="{{ $footerLogoSetting->getFirstMediaUrl('logo_footer') }}"
                                                    class="img-thumbnail bg-light p-2"
                                                    style="max-width: 180px; max-height: 60px; object-fit: contain;">
                                            </div>
                                        @endif
                                    </div>
                                    
    
                                    <!-- Favicon -->
                                    <div class="col-6">
                                        <label class="form-label fw-semibold d-block">Favicon</label>
                                        <input type="file" name="favicon"
                                            class="form-control @error('favicon') is-invalid @enderror"
                                            accept="image/x-icon,image/png">
                                    
                                        @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                        @if($faviconSetting && $faviconSetting->hasMedia('favicon'))
                                            <div class="mt-3">
                                                <p class="text-muted small mb-2">Current Favicon:</p>
                                                <img
                                                    src="{{ $faviconSetting->getFirstMediaUrl('favicon') }}"
                                                    class="img-thumbnail bg-light p-2"
                                                    style="width: 32px; height: 32px;">
                                            </div>
                                        @endif
                                    
                                        <div class="form-text">Recommended: 32x32px ICO or PNG</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Theme Colors -->
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-info bg-gradient text-white py-3">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-palette me-2"></i>Theme Colors
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="color-picker-group">
                                            <label for="primary_color" class="form-label fw-semibold d-block">
                                                Primary Color
                                            </label>
                                            <div class="input-group">
                                                <input type="color" name="primary_color" id="primary_color"
                                                    class="form-control form-control-color color-picker"
                                                    value="{{ old('primary_color', setting('primary_color', '#0d6efd')) }}"
                                                    data-preview=".primary-color-preview">
                                                <input type="text" class="form-control color-hex"
                                                    value="{{ old('primary_color', setting('primary_color', '#0d6efd')) }}"
                                                    maxlength="7">
                                                <span class="input-group-text primary-color-preview"
                                                    style="width: 40px; background-color: {{ setting('primary_color', '#0d6efd') }}"></span>
                                            </div>
                                            <div class="form-text">Used for buttons, links, and primary actions.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="color-picker-group">
                                            <label for="secondary_color" class="form-label fw-semibold d-block">
                                                Secondary Color
                                            </label>
                                            <div class="input-group">
                                                <input type="color" name="secondary_color" id="secondary_color"
                                                    class="form-control form-control-color color-picker"
                                                    value="{{ old('secondary_color', setting('secondary_color', '#6c757d')) }}">
                                                <input type="text" class="form-control color-hex"
                                                    value="{{ old('secondary_color', setting('secondary_color', '#6c757d')) }}"
                                                    maxlength="7">
                                                <span class="input-group-text"
                                                    style="width: 40px; background-color: {{ setting('secondary_color', '#6c757d') }}"></span>
                                            </div>
                                            <div class="form-text">Used for secondary elements and borders.</div>
                                        </div>
                                    </div>

                                    {{--
                                    <div class="col-md-4">
                                        <div class="color-picker-group">
                                            <label for="background_color" class="form-label fw-semibold d-block">
                                                Background Color
                                            </label>
                                            <div class="input-group">
                                                <input type="color" name="background_color" id="background_color"
                                                    class="form-control form-control-color color-picker"
                                                    value="{{ old('background_color', setting('background_color', '#ffffff')) }}">
                                                <input type="text" class="form-control color-hex"
                                                    value="{{ old('background_color', setting('background_color', '#ffffff')) }}"
                                                    maxlength="7">
                                                <span class="input-group-text"
                                                    style="width: 40px; background-color: {{ setting('background_color', '#ffffff') }}"></span>
                                            </div>
                                            <div class="form-text">Main background color for the website.</div>
                                        </div>
                                    </div>
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== Page Visibility Sidebar ===== -->
            <div class="col-xxl-4 mb-4">
                <div class="card border-0 shadow-sm h-100 sticky-top" style="top: 20px;">
                    <div class="card-header bg-warning bg-gradient text-dark py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-eye me-2"></i>Page & Feature Toggles
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-4">
                            Enable or disable specific pages and features on your website.
                            Disabled pages will return a 404 error.
                        </p>

                        <div class="feature-toggles">
                            <!-- Page Toggles -->
                            <h6 class="fw-semibold mb-3 text-uppercase small text-muted">Pages</h6>
                            @foreach($pageFeatures as $feature)
                            @if(str_starts_with($feature->value, 'page-') && !str_contains($feature->value, 'home-'))
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input feature-toggle" type="checkbox"
                                    name="features[{{ $feature->value }}]" value="1" id="feature-{{ $feature->value }}"
                                    data-feature="{{ $feature->value }}" {{ $feature->is_enabled() ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between"
                                    for="feature-{{ $feature->value }}">
                                    <span>{{ Str::title(str_replace(['page-', '-'], ['', ' '], $feature->value))
                                        }}</span>
                                    <span
                                        class="badge bg-{{ $feature->is_enabled() ? 'success' : 'secondary' }} rounded-pill">
                                        {{ $feature->status() }}
                                    </span>
                                </label>
                            </div>
                            @endif
                            @endforeach

                            <!-- Home Page Features -->
                            <h6 class="fw-semibold mb-3 mt-4 text-uppercase small text-muted">Home Page Sections</h6>
                            @foreach($pageFeatures as $feature)
                            @if(str_starts_with($feature->value, 'page-home-'))
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input feature-toggle" type="checkbox"
                                    name="features[{{ $feature->value }}]" value="1" id="feature-{{ $feature->value }}"
                                    data-feature="{{ $feature->value }}" {{ $feature->is_enabled() ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between"
                                    for="feature-{{ $feature->value }}">
                                    <span>{{ Str::title(str_replace(['page-home-', '-'], ['', ' '], $feature->value))
                                        }}</span>
                                    <span
                                        class="badge bg-{{ $feature->is_enabled() ? 'success' : 'secondary' }} rounded-pill">
                                        {{ $feature->status() }}
                                    </span>
                                </label>
                            </div>
                            @endif
                            @endforeach

                            <!-- Special Features -->
                            <h6 class="fw-semibold mb-3 mt-4 text-uppercase small text-muted">Special Features</h6>
                            @foreach($pageFeatures as $feature)
                            @if(!str_starts_with($feature->value, 'page-'))
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input feature-toggle" type="checkbox"
                                    name="features[{{ $feature->value }}]" value="1" id="feature-{{ $feature->value }}"
                                    data-feature="{{ $feature->value }}" {{ $feature->is_enabled() ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between"
                                    for="feature-{{ $feature->value }}">
                                    <span>{{ Str::title(str_replace('-', ' ', $feature->value)) }}</span>
                                    <span
                                        class="badge bg-{{ $feature->is_enabled() ? 'success' : 'secondary' }} rounded-pill">
                                        {{ $feature->status() }}
                                    </span>
                                </label>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success w-100 py-2">
                                <i class="fas fa-save me-2"></i>Save All Settings
                            </button>
                            <p class="text-muted small text-center mt-2 mb-0">
                                Changes will take effect immediately
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('styles')
<style>
    .color-picker-group .input-group-text {
        transition: background-color 0.3s ease;
        cursor: default;
    }

    .feature-toggles .form-check-label {
        font-size: 0.95rem;
    }

    .feature-toggles .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }

    .image-upload-wrapper {
        position: relative;
    }

    .sticky-top {
        z-index: 1020;
    }

    .form-control-color {
        height: 38px;
        cursor: pointer;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Color picker with hex input sync
        document.querySelectorAll('.color-picker').forEach(picker => {
            const hexInput = picker.closest('.input-group').querySelector('.color-hex');
            const preview = picker.closest('.input-group').querySelector('.input-group-text');
            
            picker.addEventListener('input', function() {
                hexInput.value = this.value;
                if (preview) {
                    preview.style.backgroundColor = this.value;
                }
            });
            
            hexInput.addEventListener('input', function() {
                const color = this.value;
                if (/^#[0-9A-F]{6}$/i.test(color)) {
                    picker.value = color;
                    if (preview) {
                        preview.style.backgroundColor = color;
                    }
                }
            });
        });

        // Image preview for logo
        const logoInput = document.querySelector('input[name="logo"][data-preview-target]');
        if (logoInput) {
            logoInput.addEventListener('change', function() {
                const previewTarget = document.querySelector(this.dataset.previewTarget);
                if (this.files && this.files[0] && previewTarget) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewTarget.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        // Form submission confirmation
        const form = document.getElementById('settings-form');
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            
            // Optional: Add a small delay to show the loading state
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Save All Settings';
            }, 3000);
        });

        // Real-time toggle status update
        document.querySelectorAll('.feature-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const badge = this.closest('.form-check').querySelector('.badge');
                if (badge) {
                    badge.textContent = this.checked ? 'enabled' : 'disabled';
                    badge.className = this.checked 
                        ? 'badge bg-success rounded-pill' 
                        : 'badge bg-secondary rounded-pill';
                }
            });
        });
    });
</script>
@endpush