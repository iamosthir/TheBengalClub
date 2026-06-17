@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Slideshow Banner</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.slideshow-banner.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.slideshow-banner.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter banner title"
                               value="{{ old('title') }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle"
                               class="form-control @error('subtitle') is-invalid @enderror"
                               placeholder="Enter banner subtitle"
                               value="{{ old('subtitle') }}">
                        @error('subtitle')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="extra_text">Extra Text</label>
                        <textarea name="extra_text" id="extra_text"
                                  class="form-control @error('extra_text') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Enter additional text">{{ old('extra_text') }}</textarea>
                        @error('extra_text')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="enable_action_button" id="enable_action_button"
                                   class="custom-control-input"
                                   {{ old('enable_action_button') ? 'checked' : '' }}
                                   onchange="toggleActionFields()">
                            <label class="custom-control-label" for="enable_action_button">
                                Enable Action Button
                            </label>
                        </div>
                    </div>

                    <div id="action-fields" style="display: {{ old('enable_action_button') ? 'block' : 'none' }};">
                        <div class="form-group">
                            <label for="button_text">Button Text</label>
                            <input type="text" name="button_text" id="button_text"
                                   class="form-control @error('button_text') is-invalid @enderror"
                                   placeholder="Enter button text"
                                   value="{{ old('button_text') }}">
                            @error('button_text')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="action_link">Action Link</label>
                            <input type="url" name="action_link" id="action_link"
                                   class="form-control @error('action_link') is-invalid @enderror"
                                   placeholder="Enter action link URL"
                                   value="{{ old('action_link') }}">
                            @error('action_link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="order">Display Order <span class="text-danger">*</span></label>
                        <input type="number" name="order" id="order"
                               class="form-control @error('order') is-invalid @enderror"
                               placeholder="Enter display order"
                               value="{{ old('order', 0) }}"
                               min="0" required>
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Lower numbers will be displayed first</small>
                    </div>

                    <div class="form-group">
                        <label for="image">Banner Image (PNG, JPG, JPEG) <span class="text-danger">*</span></label>
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
                        <small class="form-text text-muted">Accepted formats: PNG, JPG, JPEG. Max size: 2MB</small>
                    </div>

                    <div class="form-group" id="image-preview-container" style="display: none;">
                        <label>Image Preview</label>
                        <div class="border rounded p-2">
                            <img id="image-preview" src="" alt="Preview" class="img-fluid" style="max-height: 300px;">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Banner
                    </button>
                    <a href="{{ route('admin.slideshow-banner.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleActionFields() {
    const checkbox = document.getElementById('enable_action_button');
    const actionFields = document.getElementById('action-fields');
    actionFields.style.display = checkbox.checked ? 'block' : 'none';
}

function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('image-preview-container');
    const fileLabel = document.querySelector('.custom-file-label');

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Update file label
        fileLabel.textContent = file.name;

        // Check if file is PNG
        if (!file.type.match('image/(png|jpe?g)')) {
            alert('Please select a PNG, JPG, or JPEG image file.');
            input.value = '';
            fileLabel.textContent = 'Choose image';
            previewContainer.style.display = 'none';
            return;
        }

        // Create preview
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
