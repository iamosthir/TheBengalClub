@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Announcement</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $announcement->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message <span class="text-muted">(optional)</span></label>
                        <textarea name="message" id="message" rows="4"
                                  class="form-control @error('message') is-invalid @enderror">{{ old('message', $announcement->message) }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Banner Image</label>

                        @if($announcement->image_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $announcement->image_path) }}"
                                     alt="Current image"
                                     style="max-width: 300px; max-height: 200px; border-radius: 6px; border: 1px solid #dee2e6;">
                                <div class="mt-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remove_image" name="remove_image" value="1">
                                        <label class="custom-control-label text-danger" for="remove_image">Remove current image</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="custom-file">
                            <input type="file" name="image" id="image"
                                   class="custom-file-input @error('image') is-invalid @enderror"
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            <label class="custom-file-label" for="image">
                                {{ $announcement->image_path ? 'Replace image...' : 'Choose image...' }}
                            </label>
                        </div>
                        @error('image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <div id="image-preview" class="mt-2" style="display: none;">
                            <img id="preview-img" src="" alt="Preview"
                                 style="max-width: 300px; max-height: 200px; border-radius: 6px; border: 1px solid #dee2e6;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" id="start_date"
                                       class="form-control @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', $announcement->start_date->toDateString()) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" id="end_date"
                                       class="form-control @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date', $announcement->end_date->toDateString()) }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="custom-control-input" id="is_active"
                                   name="is_active" value="1"
                                   {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Active (visible to visitors)</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Announcement
                    </button>
                    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const img     = document.getElementById('preview-img');
    const label   = input.nextElementSibling;

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src      = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
        label.textContent = input.files[0].name;
    }
}
</script>
@endsection
