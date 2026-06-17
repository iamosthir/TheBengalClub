@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Archive Item</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.archive.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.archive.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                        <label for="title">Title <span class="text-muted">(optional)</span></label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="e.g. Award Ceremony with John Doe"
                               value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="order">Display Order <span class="text-danger">*</span></label>
                        <input type="number" name="order" id="order"
                               class="form-control @error('order') is-invalid @enderror"
                               value="{{ old('order', 0) }}" min="0" required>
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Lower numbers appear first.</small>
                    </div>

                    <div class="form-group">
                        <label for="image">Image (PNG, JPG, JPEG) <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="image" id="image"
                                   class="custom-file-input @error('image') is-invalid @enderror"
                                   accept=".png,.jpg,.jpeg"
                                   onchange="previewImage(event)" required>
                            <label class="custom-file-label" for="image">Choose image</label>
                            @error('image')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="form-text text-muted">Max size: 2MB.</small>
                    </div>

                    <div class="form-group" id="image-preview-container" style="display: none;">
                        <label>Preview</label>
                        <div class="border rounded p-2">
                            <img id="image-preview" src="" alt="Preview" class="img-fluid" style="max-height: 300px;">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <a href="{{ route('admin.archive.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('image-preview-container');
    const fileLabel = document.querySelector('.custom-file-label');

    if (input.files && input.files[0]) {
        const file = input.files[0];
        fileLabel.textContent = file.name;

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
