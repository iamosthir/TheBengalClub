@extends('admin.layouts.master')
@section('title', 'Edit Donation Category')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Edit Donation Category</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.donation-categories.index') }}">Donation Categories</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit: {{ $donationCategory->name }}</h3>
                    </div>
                    <form action="{{ route('admin.donation-categories.update', $donationCategory) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label>Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $donationCategory->name) }}" required>
                                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $donationCategory->description) }}</textarea>
                                @error('description')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label>Banner Image</label>
                                @if($donationCategory->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $donationCategory->image_path) }}"
                                             alt="Current" class="img-thumbnail" style="max-height:160px;">
                                        <p class="text-muted small mt-1">Current image. Upload a new one to replace it.</p>
                                    </div>
                                @endif
                                <div class="custom-file mb-1">
                                    <input type="file" name="image" id="image-input"
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           accept="image/jpg,image/jpeg,image/png,image/webp">
                                    <label class="custom-file-label" for="image-input">Choose new image...</label>
                                </div>
                                <small class="text-muted">JPG, PNG or WebP, max 3MB.</small>
                                @error('image')<span class="text-danger small">{{ $message }}</span>@enderror
                                <div id="image-preview" class="mt-2 d-none">
                                    <img id="preview-img" src="" alt="Preview"
                                         class="img-thumbnail" style="max-height:160px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active"   {{ old('status', $donationCategory->status) === 'active'   ? 'selected' : '' }}>Active</option>
                                    <option value="disabled" {{ old('status', $donationCategory->status) === 'disabled' ? 'selected' : '' }}>Disabled</option>
                                </select>
                                @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                        </div>
                        <div class="card-footer d-flex">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Update Category
                            </button>
                            <a href="{{ route('admin.donation-categories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('image-input').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    this.nextElementSibling.textContent = file.name;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('preview-img').src = e.target.result;
        document.getElementById('image-preview').classList.remove('d-none');
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
