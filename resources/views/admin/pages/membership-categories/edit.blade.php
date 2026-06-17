@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Membership Category</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.membership-categories.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.membership-categories.update', $membershipCategory->id) }}" method="POST">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="Enter category title"
                                       value="{{ old('title', $membershipCategory->title) }}"
                                       required>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Membership Fee <span class="text-danger">*</span></label>
                                <input type="number" name="price" id="price" step="0.01" min="0"
                                       class="form-control @error('price') is-invalid @enderror"
                                       placeholder="One-time membership fee"
                                       value="{{ old('price', $membershipCategory->price) }}"
                                       required>
                                <small class="form-text text-muted">One-time fee paid after approval</small>
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration">Duration <span class="text-danger">*</span></label>
                                <select name="duration" id="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        required>
                                    <option value="">Select Duration</option>
                                    <option value="Monthly" {{ old('duration', $membershipCategory->duration) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="Yearly" {{ old('duration', $membershipCategory->duration) == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                    <option value="Lifetime" {{ old('duration', $membershipCategory->duration) == 'Lifetime' ? 'selected' : '' }}>Lifetime</option>
                                </select>
                                @error('duration')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="badge_text">Badge Text</label>
                                <input type="text" name="badge_text" id="badge_text"
                                       class="form-control @error('badge_text') is-invalid @enderror"
                                       placeholder="e.g., Popular, Recommended"
                                       value="{{ old('badge_text', $membershipCategory->badge_text) }}">
                                @error('badge_text')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="installment_price">Installment Price</label>
                                <input type="number" name="installment_price" id="installment_price" step="0.01" min="0"
                                       class="form-control @error('installment_price') is-invalid @enderror"
                                       placeholder="Recurring installment amount"
                                       value="{{ old('installment_price', $membershipCategory->installment_price) }}"
                                       {{ $membershipCategory->duration === 'Lifetime' ? 'disabled' : '' }}>
                                <small class="form-text text-muted">
                                    Monthly/yearly recurring fee. Auto-set to 0 for Lifetime.
                                </small>
                                @error('installment_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bio">Description</label>
                        <textarea name="bio" id="bio"
                                  class="form-control @error('bio') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Enter category description">{{ old('bio', $membershipCategory->bio) }}</textarea>
                        @error('bio')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_invite_only" id="is_invite_only"
                                   class="custom-control-input"
                                   value="1"
                                   {{ old('is_invite_only', $membershipCategory->is_invite_only) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_invite_only">
                                Invite Only Membership
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Check this if the membership is by invitation only
                        </small>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="optional_installment" id="optional_installment"
                                   class="custom-control-input"
                                   value="1"
                                   {{ old('optional_installment', $membershipCategory->optional_installment) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="optional_installment">
                                Optional Installment
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Members in this category are not required to pay monthly installments. They can donate voluntarily instead.
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Features</label>
                        <div id="features-container">
                            @if(old('features'))
                                @foreach(old('features') as $index => $feature)
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
                            @elseif($membershipCategory->features && count($membershipCategory->features) > 0)
                                @foreach($membershipCategory->features as $feature)
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
                            Add multiple features for this membership category. Each feature will be displayed as a list item.
                        </small>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Category
                    </button>
                    <a href="{{ route('admin.membership-categories.index') }}" class="btn btn-secondary">
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
document.addEventListener('DOMContentLoaded', function() {
    const durationSelect = document.getElementById('duration');
    const installmentPriceInput = document.getElementById('installment_price');

    function toggleInstallmentPrice() {
        if (durationSelect.value === 'Lifetime') {
            installmentPriceInput.value = 0;
            installmentPriceInput.disabled = true;
        } else {
            installmentPriceInput.disabled = false;
        }
    }

    durationSelect.addEventListener('change', toggleInstallmentPrice);
    toggleInstallmentPrice();

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
                alert('At least one feature field must remain.');
            }
        }
    });
});
</script>
@endpush
