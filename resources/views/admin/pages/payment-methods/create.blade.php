@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Payment Method</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="name">Method Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="e.g. bKash, Nagad, Rocket"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="label">Display Name <span class="text-danger">*</span></label>
                        <input type="text" name="label" id="label"
                               class="form-control @error('label') is-invalid @enderror"
                               placeholder="e.g. Wallet Number, IBAN, Account Number"
                               value="{{ old('label') }}"
                               required>
                        @error('label')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <div class="custom-file">
                            <input type="file" name="logo" id="logo"
                                   class="custom-file-input @error('logo') is-invalid @enderror"
                                   accept="image/jpeg,image/jpg,image/png,image/svg+xml,image/webp"
                                   onchange="previewLogo(event)">
                            <label class="custom-file-label" for="logo">Choose logo</label>
                        </div>
                        @error('logo')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <div id="logo-preview-container" style="display:none;" class="mt-2">
                            <img id="logo-preview" src="" alt="Logo Preview"
                                 style="max-width: 120px; max-height: 80px; object-fit: contain; border: 1px solid #dee2e6; padding: 4px;">
                        </div>
                        <small class="form-text text-muted">Accepted: JPG, PNG, SVG, WebP. Max 2MB.</small>
                    </div>

                    <div class="form-group">
                        <label for="wallet_number">Wallet Number</label>
                        <input type="text" name="wallet_number" id="wallet_number"
                               class="form-control @error('wallet_number') is-invalid @enderror"
                               placeholder="e.g. 01712345678"
                               value="{{ old('wallet_number') }}">
                        @error('wallet_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="qr_image">QR Code Image</label>
                        <div class="custom-file">
                            <input type="file" name="qr_image" id="qr_image"
                                   class="custom-file-input @error('qr_image') is-invalid @enderror"
                                   accept="image/jpeg,image/jpg,image/png,image/webp"
                                   onchange="previewQr(event)">
                            <label class="custom-file-label" for="qr_image">Choose QR image</label>
                        </div>
                        @error('qr_image')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <div id="qr-preview-container" style="display:none;" class="mt-2">
                            <img id="qr-preview" src="" alt="QR Preview"
                                 style="max-width: 120px; max-height: 120px; object-fit: contain; border: 1px solid #dee2e6; padding: 4px;">
                        </div>
                        <small class="form-text text-muted">Accepted: JPG, PNG, WebP. Max 2MB.</small>
                    </div>

                    <div class="form-group">
                        <label for="instruction">Instruction</label>
                        <textarea name="instruction" id="instruction" rows="4"
                                  class="form-control @error('instruction') is-invalid @enderror"
                                  placeholder="Provide payment instructions for members...">{{ old('instruction') }}</textarea>
                        @error('instruction')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">
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
function previewQr(event) {
    const input = event.target;
    const preview = document.getElementById('qr-preview');
    const previewContainer = document.getElementById('qr-preview-container');
    const fileLabel = input.nextElementSibling;

    if (input.files && input.files[0]) {
        fileLabel.textContent = input.files[0].name;
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewLogo(event) {
    const input = event.target;
    const preview = document.getElementById('logo-preview');
    const previewContainer = document.getElementById('logo-preview-container');
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
