@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Member: {{ $user->name }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.registered-members.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.registered-members.update', $user->id) }}" method="POST">
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

                    <!-- Personal Information Section -->
                    <div class="card card-outline card-primary mb-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user"></i> Personal Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter full name"
                                       value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter email address"
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">
                                            <i class="fas fa-exclamation-triangle text-warning"></i>
                                            Changing email will affect login credentials
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                               class="form-control @error('date_of_birth') is-invalid @enderror"
                                               value="{{ old('date_of_birth', $user->profile->date_of_birth->format('Y-m-d')) }}" required>
                                        @error('date_of_birth')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nid_passport">NID/Passport <span class="text-danger">*</span></label>
                                        <input type="text" name="nid_passport" id="nid_passport"
                                               class="form-control @error('nid_passport') is-invalid @enderror"
                                               placeholder="Enter NID or Passport number"
                                               value="{{ old('nid_passport', $user->profile->nid_passport) }}" required>
                                        @error('nid_passport')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession_organization">Profession/Organization <span class="text-danger">*</span></label>
                                        <input type="text" name="profession_organization" id="profession_organization"
                                               class="form-control @error('profession_organization') is-invalid @enderror"
                                               placeholder="Enter profession or organization"
                                               value="{{ old('profession_organization', $user->profile->profession_organization) }}" required>
                                        @error('profession_organization')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="card card-outline card-info mb-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-phone"></i> Contact Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" id="mobile"
                                       class="form-control @error('mobile') is-invalid @enderror"
                                       placeholder="e.g., +880 1234-567890"
                                       value="{{ old('mobile', $user->profile->mobile) }}" required>
                                @error('mobile')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Mobile number must be unique</small>
                            </div>

                            <div class="form-group">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="address" rows="3"
                                          class="form-control @error('address') is-invalid @enderror"
                                          placeholder="Enter full address" required>{{ old('address', $user->profile->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Membership Information Section -->
                    <div class="card card-outline card-success mb-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-id-card"></i> Membership Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="membership_category_id">Membership Category <span class="text-danger">*</span></label>
                                <select name="membership_category_id" id="membership_category_id"
                                        class="form-control @error('membership_category_id') is-invalid @enderror"
                                        required>
                                    <option value="">Select Membership Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                data-price="{{ $category->price }}"
                                                data-duration="{{ $category->duration }}"
                                                {{ old('membership_category_id', $user->profile->membership_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }} - ৳{{ number_format($category->price, 2) }} ({{ $category->duration }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('membership_category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div id="category-details" class="alert alert-info" style="display: none;">
                                <strong>Selected Category Details:</strong><br>
                                <span id="category-info"></span>
                            </div>

                            <div class="form-group">
                                <label for="manual_member_id">Manual Member ID</label>
                                <input type="text" name="manual_member_id" id="manual_member_id"
                                       class="form-control @error('manual_member_id') is-invalid @enderror"
                                       placeholder="Optional — overrides the auto-generated ID on public profile"
                                       value="{{ old('manual_member_id', $user->profile->manual_member_id) }}">
                                @error('manual_member_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    If set, this value is shown as the Member ID on the public profile instead of the auto-generated ID
                                    (currently <code>2025{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</code>). Leave blank to use the default.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Password Information -->
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        <strong>Note:</strong> Password cannot be changed from this form. Member password reset must be done separately.
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Member
                    </button>
                    <a href="{{ route('admin.registered-members.index') }}" class="btn btn-secondary">
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
document.getElementById('membership_category_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const categoryDetails = document.getElementById('category-details');
    const categoryInfo = document.getElementById('category-info');

    if (this.value) {
        const price = selectedOption.getAttribute('data-price');
        const duration = selectedOption.getAttribute('data-duration');
        const title = selectedOption.textContent.split(' - ')[0];

        categoryInfo.innerHTML = `
            <strong>Category:</strong> ${title}<br>
            <strong>Price:</strong> ৳${parseFloat(price).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}<br>
            <strong>Duration:</strong> ${duration}
        `;
        categoryDetails.style.display = 'block';
    } else {
        categoryDetails.style.display = 'none';
    }
});

// Trigger on page load if a category is already selected
window.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('membership_category_id');
    if (categorySelect.value) {
        categorySelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
