@extends('admin.layouts.master')
@section('title', 'Add Honorary Member')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Add Honorary Member</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.honorary-members.index') }}">Honorary Members</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Member Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.honorary-members.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.honorary-members.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required>
                                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Designations / Titles</label>
                                <div id="designation-list">
                                    @foreach(old('designation', ['']) as $i => $des)
                                    <div class="designation-row input-group mb-2">
                                        <input type="text" name="designation[]"
                                               class="form-control"
                                               value="{{ $des }}"
                                               placeholder="e.g. CEO at Acme Corp">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger remove-designation"
                                                    title="Remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-designation" class="btn btn-outline-secondary btn-sm mt-1">
                                    <i class="fas fa-plus mr-1"></i> Add Designation
                                </button>
                                <small class="form-text text-muted">Add one entry per role/company.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Photo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('photo') is-invalid @enderror"
                                       id="photo" name="photo" accept="image/*" required>
                                <label class="custom-file-label" for="photo">Choose photo</label>
                            </div>
                        </div>
                        @error('photo')<small class="text-danger">{{ $message }}</small>@enderror
                        <small class="form-text text-muted">JPG, PNG or WebP, max 3MB. Recommended: square photo.</small>
                        <div class="mt-2">
                            <img id="photo-preview" src="" alt="" class="img-thumbnail d-none" style="max-height:120px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Bio / Note</label>
                        <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="3"
                                  placeholder="Short description about this honorary member">{{ old('bio') }}</textarea>
                        @error('bio')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Display Order</label>
                                <input type="number" name="order" min="0" class="form-control"
                                       value="{{ old('order', 0) }}">
                                <small class="form-text text-muted">Lower number = appears first</small>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center mt-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active (visible on website)</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Member</button>
                    <a href="{{ route('admin.honorary-members.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('photo').addEventListener('change', function () {
    const preview = document.getElementById('photo-preview');
    if (this.files[0]) {
        preview.src = URL.createObjectURL(this.files[0]);
        preview.classList.remove('d-none');
        document.querySelector('.custom-file-label').textContent = this.files[0].name;
    }
});

// Designation rows
function attachRemoveHandler(row) {
    row.querySelector('.remove-designation').addEventListener('click', function () {
        const list = document.getElementById('designation-list');
        if (list.querySelectorAll('.designation-row').length > 1) {
            row.remove();
        } else {
            row.querySelector('input').value = '';
        }
    });
}
document.querySelectorAll('.designation-row').forEach(attachRemoveHandler);

document.getElementById('add-designation').addEventListener('click', function () {
    const row = document.createElement('div');
    row.className = 'designation-row input-group mb-2';
    row.innerHTML = `
        <input type="text" name="designation[]" class="form-control" placeholder="e.g. CEO at Acme Corp">
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-danger remove-designation" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>`;
    document.getElementById('designation-list').appendChild(row);
    attachRemoveHandler(row);
    row.querySelector('input').focus();
});
</script>
@endpush
