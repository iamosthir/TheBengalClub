@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Board Director</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.board-directors.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.board-directors.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter director name"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" id="designation"
                               class="form-control @error('designation') is-invalid @enderror"
                               placeholder="e.g., President, Vice President, Secretary"
                               value="{{ old('designation') }}">
                        @error('designation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter email address"
                                       value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="e.g., +880 1234-567890"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
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
                                <small class="form-text text-muted">Lower numbers appear first</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="status" id="status"
                                           class="custom-control-input" value="1"
                                           {{ old('status', true) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status">
                                        Active Status
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <div class="custom-file">
                            <input type="file" name="photo" id="photo"
                                   class="custom-file-input @error('photo') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png"
                                   onchange="previewPhoto(event)">
                            <label class="custom-file-label" for="photo">Choose image</label>
                            @error('photo')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="form-text text-muted">Recommended size: 300x300px. Max: 2MB. Formats: JPG, JPEG, PNG</small>
                    </div>

                    <div class="form-group" id="photo-preview-container" style="display: none;">
                        <label>Photo Preview</label>
                        <div class="border rounded p-2">
                            <img id="photo-preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Social Media Links</label>
                        <div id="social-links-container">
                            <!-- Dynamic social links will be added here -->
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addSocialLink()">
                            <i class="fas fa-plus"></i> Add Social Link
                        </button>
                        <small class="form-text text-muted">Add social media profiles for this director</small>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Director
                    </button>
                    <a href="{{ route('admin.board-directors.index') }}" class="btn btn-secondary">
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
let socialLinkIndex = 0;

function previewPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('photo-preview');
    const previewContainer = document.getElementById('photo-preview-container');
    const fileLabel = document.querySelector('.custom-file-label');

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Update file label
        fileLabel.textContent = file.name;

        // Check file size (2MB)
        if (file.size > 2048 * 1024) {
            alert('File size must be less than 2MB.');
            input.value = '';
            fileLabel.textContent = 'Choose image';
            previewContainer.style.display = 'none';
            return;
        }

        // Check file type
        if (!file.type.match('image/(jpeg|jpg|png)')) {
            alert('Please select a valid image file (JPG, JPEG, or PNG).');
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

function addSocialLink() {
    const container = document.getElementById('social-links-container');
    const row = document.createElement('div');
    row.className = 'row mb-2 social-link-row';
    row.innerHTML = `
        <div class="col-md-4">
            <select name="social_links[${socialLinkIndex}][platform]" class="form-control">
                <option value="">Select Platform</option>
                <option value="Facebook">Facebook</option>
                <option value="Twitter">Twitter</option>
                <option value="LinkedIn">LinkedIn</option>
                <option value="Instagram">Instagram</option>
                <option value="YouTube">YouTube</option>
                <option value="Website">Website</option>
            </select>
        </div>
        <div class="col-md-7">
            <input type="url" name="social_links[${socialLinkIndex}][url]"
                   class="form-control" placeholder="Enter URL">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeSocialLink(this)">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    container.appendChild(row);
    socialLinkIndex++;
}

function removeSocialLink(button) {
    button.closest('.social-link-row').remove();
}
</script>
@endpush
