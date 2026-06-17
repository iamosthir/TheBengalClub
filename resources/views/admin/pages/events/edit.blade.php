@extends("admin.layouts.master")

@push('styles')
<link rel="stylesheet" href="{{ asset('css/summernote-dark.css') }}">
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Event</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
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
                        <label for="title">Event Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter event title"
                               value="{{ old('title', $event->title) }}"
                               required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Event Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="date" id="date"
                                       class="form-control @error('date') is-invalid @enderror"
                                       value="{{ old('date', $event->date->format('Y-m-d\TH:i')) }}"
                                       required>
                                @error('date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venue">Venue <span class="text-danger">*</span></label>
                                <input type="text" name="venue" id="venue"
                                       class="form-control @error('venue') is-invalid @enderror"
                                       placeholder="Enter venue location"
                                       value="{{ old('venue', $event->venue) }}"
                                       required>
                                @error('venue')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description"
                                  class="form-control summernote @error('description') is-invalid @enderror"
                                  rows="6">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">
                            Use the rich text editor to format your event description. You can add images, links, and formatting.
                        </small>
                    </div>

                    @if($event->thumbnail_path)
                        <div class="form-group">
                            <label>Current Thumbnail</label>
                            <div class="border rounded p-2 mb-2">
                                <img src="{{ asset('storage/' . $event->thumbnail_path) }}"
                                     alt="Event Thumbnail"
                                     class="img-fluid"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="thumbnail">{{ $event->thumbnail_path ? 'Change Thumbnail' : 'Upload Thumbnail' }}</label>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" id="thumbnail"
                                   class="custom-file-input @error('thumbnail') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png"
                                   onchange="previewThumbnail(event)">
                            <label class="custom-file-label" for="thumbnail">Choose image</label>
                            @error('thumbnail')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Formats: JPG, JPEG, PNG. Max: 5MB.
                            {{ $event->thumbnail_path ? 'Leave empty to keep current thumbnail.' : '' }}
                        </small>
                    </div>

                    <div class="form-group" id="thumbnail-preview-container" style="display: none;">
                        <label>New Thumbnail Preview</label>
                        <div class="border rounded p-2">
                            <img id="thumbnail-preview" src="" alt="Preview" class="img-fluid" style="max-height: 300px;">
                        </div>
                    </div>

                    @if($event->gallery_images && count($event->gallery_images) > 0)
                        <div class="form-group">
                            <label>Current Gallery Images ({{ count($event->gallery_images) }})</label>
                            <div class="border rounded p-2">
                                <div class="row">
                                    @foreach($event->gallery_images as $image)
                                        <div class="col-md-3 mb-2">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                 alt="Gallery Image"
                                                 class="img-thumbnail"
                                                 style="width: 100%; height: 150px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="gallery_images">{{ $event->gallery_images ? 'Replace Gallery Images' : 'Upload Gallery Images' }}</label>
                        <div class="custom-file">
                            <input type="file" name="gallery_images[]" id="gallery_images"
                                   class="custom-file-input @error('gallery_images.*') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png"
                                   multiple
                                   onchange="previewGalleryImages(event)">
                            <label class="custom-file-label" for="gallery_images">Choose images</label>
                            @error('gallery_images.*')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Select multiple images for the event gallery. Formats: JPG, JPEG, PNG. Max: 5MB each.
                            {{ $event->gallery_images ? 'Note: Uploading new images will replace all current gallery images.' : '' }}
                        </small>
                    </div>

                    <div class="form-group" id="gallery-preview-container" style="display: none;">
                        <label>New Gallery Preview</label>
                        <div class="border rounded p-2" id="gallery-preview-grid">
                            <!-- Gallery previews will be added here -->
                        </div>
                    </div>

                    <!-- Fee Settings -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="is_free" id="is_free"
                                           class="custom-control-input"
                                           {{ old('is_free', $event->is_free) ? 'checked' : '' }}
                                           onchange="toggleFeeField(this)">
                                    <label class="custom-control-label" for="is_free">
                                        Free Event
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    Toggle off to set a registration fee.
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6" id="fee-field" style="{{ old('is_free', $event->is_free) ? 'display:none;' : '' }}">
                            <div class="form-group">
                                <label for="fee">Registration Fee (BDT) <span class="text-danger">*</span></label>
                                <input type="number" name="fee" id="fee"
                                       class="form-control @error('fee') is-invalid @enderror"
                                       placeholder="e.g. 500"
                                       value="{{ old('fee', $event->fee) }}"
                                       min="0" step="0.01">
                                @error('fee')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" id="status"
                                           class="custom-control-input"
                                           {{ old('status', $event->status) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status">
                                        Active Status
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    Inactive events won't be visible to members.
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="notify_members" id="notify_members"
                                           class="custom-control-input"
                                           {{ old('notify_members') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="notify_members">
                                        Notify All Members via Email
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    Send email notification to all registered users about this updated event.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Event
                    </button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
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
function toggleFeeField(checkbox) {
    const feeField = document.getElementById('fee-field');
    feeField.style.display = checkbox.checked ? 'none' : 'block';
    if (checkbox.checked) {
        document.getElementById('fee').value = '';
    }
}

// Initialize Summernote
$(document).ready(function() {
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

// Thumbnail preview
function previewThumbnail(event) {
    const input = event.target;
    const preview = document.getElementById('thumbnail-preview');
    const previewContainer = document.getElementById('thumbnail-preview-container');
    const fileLabel = input.parentElement.querySelector('.custom-file-label');

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Update file label
        fileLabel.textContent = file.name;

        // Check file size (5MB)
        if (file.size > 5120 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'Thumbnail file size must be less than 5MB.',
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

// Gallery images preview
function previewGalleryImages(event) {
    const input = event.target;
    const previewContainer = document.getElementById('gallery-preview-container');
    const previewGrid = document.getElementById('gallery-preview-grid');
    const fileLabel = input.parentElement.querySelector('.custom-file-label');

    if (input.files && input.files.length > 0) {
        // Update file label
        fileLabel.textContent = `${input.files.length} image(s) selected`;

        // Clear previous previews
        previewGrid.innerHTML = '';

        // Create previews
        Array.from(input.files).forEach((file, index) => {
            // Check file size
            if (file.size > 5120 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: `Image "${file.name}" is too large. Max: 5MB.`,
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Check file type
            if (!file.type.match('image/(jpeg|jpg|png)')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: `"${file.name}" is not a valid image file.`,
                    confirmButtonText: 'OK'
                });
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const imgDiv = document.createElement('div');
                imgDiv.className = 'd-inline-block m-2';
                imgDiv.innerHTML = `
                    <img src="${e.target.result}"
                         alt="Gallery ${index + 1}"
                         class="img-thumbnail"
                         style="width: 150px; height: 150px; object-fit: cover;">
                `;
                previewGrid.appendChild(imgDiv);
            };
            reader.readAsDataURL(file);
        });

        previewContainer.style.display = 'block';
    }
}
</script>
@endpush
