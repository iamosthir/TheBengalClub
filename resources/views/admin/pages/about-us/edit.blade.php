@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit About Us</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.about-us.update') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter about us title"
                               value="{{ old('title', $aboutUs->title) }}">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content"
                                  class="form-control @error('content') is-invalid @enderror"
                                  rows="10"
                                  placeholder="Enter about us content">{{ old('content', $aboutUs->content) }}</textarea>
                        @error('content')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Describe your organization, mission, and values</small>
                    </div>

                    @if($aboutUs->image_path)
                        <div class="form-group">
                            <label>Current Image</label>
                            <div class="border rounded p-2 mb-2">
                                <img src="{{ asset('storage/' . $aboutUs->image_path) }}"
                                     alt="About Us Image"
                                     class="img-fluid"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="image">{{ $aboutUs->image_path ? 'Change Image' : 'Upload Image' }}</label>
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
                            {{ $aboutUs->image_path ? 'Leave empty to keep current image.' : '' }}
                        </small>
                    </div>

                    <div class="form-group" id="image-preview-container" style="display: none;">
                        <label>New Image Preview</label>
                        <div class="border rounded p-2">
                            <img id="image-preview" src="" alt="Preview" class="img-fluid" style="max-height: 300px;">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
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
</script>
@endpush
