@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Facility</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

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
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter facility name"
                               value="{{ old('name', $facility->name) }}"
                               required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tag_line">Tag Line</label>
                        <input type="text" name="tag_line" id="tag_line"
                               class="form-control @error('tag_line') is-invalid @enderror"
                               placeholder="Enter tag line"
                               value="{{ old('tag_line', $facility->tag_line) }}">
                        @error('tag_line')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="short_bio">Short Bio</label>
                        <textarea name="short_bio" id="short_bio"
                                  class="form-control @error('short_bio') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Enter short bio">{{ old('short_bio', $facility->short_bio) }}</textarea>
                        @error('short_bio')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    @if($facility->image_path)
                        <div class="form-group">
                            <label>Current Image</label>
                            <div class="border rounded p-2 mb-2">
                                <img src="{{ asset('storage/' . $facility->image_path) }}"
                                     alt="Facility Image"
                                     class="img-fluid"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="image">{{ $facility->image_path ? 'Change Image' : 'Upload Image' }}</label>
                        <div class="custom-file">
                            <input type="file" name="image" id="image"
                                   class="custom-file-input @error('image') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png"
                                   onchange="previewImage(event)">
                            <label class="custom-file-label" for="image">Choose image</label>
                            @error('image')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Formats: JPG, JPEG, PNG. Max: 10MB.
                            {{ $facility->image_path ? 'Leave empty to keep current image.' : '' }}
                        </small>
                    </div>

                    <div class="form-group" id="image-preview-container" style="display: none;">
                        <label>New Image Preview</label>
                        <div class="border rounded p-2">
                            <img id="image-preview" src="" alt="Preview" class="img-fluid" style="max-height: 300px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Features</label>
                        <div id="features-container">
                            @php
                                $oldFeatures = old('features', $facility->features ?? []);
                                $hasFeatures = is_array($oldFeatures) && count($oldFeatures) > 0;
                            @endphp

                            @if($hasFeatures)
                                @foreach($oldFeatures as $feature)
                                    <div class="feature-item mb-2">
                                        <div class="input-group">
                                            <input type="text" name="features[]" class="form-control"
                                                   placeholder="Enter feature" value="{{ $feature }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-feature">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="feature-item mb-2">
                                    <div class="input-group">
                                        <input type="text" name="features[]" class="form-control"
                                               placeholder="Enter feature">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-feature">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-success btn-sm mt-2" id="add-feature">
                            <i class="fas fa-plus"></i> Add Feature
                        </button>
                        <small class="form-text text-muted">
                            Add multiple features for this facility. Each feature will be displayed as a list item.
                        </small>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Facility
                    </button>
                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">
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
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('image-preview-container');
    const fileLabel = document.querySelector('.custom-file-label');

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Update file label
        fileLabel.textContent = file.name;

        // Check file size (10MB)
        if (file.size > 10240 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'File size must be less than 10MB.',
                confirmButtonText: 'OK'
            });
            input.value = '';
            fileLabel.textContent = 'Choose image';
            previewContainer.style.display = 'none';
            return;
        }

        // Check file type
        if (!file.type.match('image/(jpeg|jpg|png)')) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid File Type',
                text: 'Please select a valid image file (JPG, JPEG, or PNG).',
                confirmButtonText: 'OK'
            });
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

// Features management
document.addEventListener('DOMContentLoaded', function() {
    const featuresContainer = document.getElementById('features-container');
    const addFeatureBtn = document.getElementById('add-feature');

    // Add new feature
    addFeatureBtn.addEventListener('click', function() {
        const featureItem = document.createElement('div');
        featureItem.className = 'feature-item mb-2';
        featureItem.innerHTML = `
            <div class="input-group">
                <input type="text" name="features[]" class="form-control" placeholder="Enter feature">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-feature">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        `;
        featuresContainer.appendChild(featureItem);
    });

    // Remove feature
    featuresContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature') || e.target.closest('.remove-feature')) {
            const featureItem = e.target.closest('.feature-item');
            if (featuresContainer.querySelectorAll('.feature-item').length > 1) {
                featureItem.remove();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cannot Remove',
                    text: 'At least one feature field must remain.',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});
</script>
@endpush
