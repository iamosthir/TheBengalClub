@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Member</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.registered-members.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.registered-members.store') }}" method="POST">
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
                                       value="{{ old('name') }}" required>
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
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Email must be unique (used for login)</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                               class="form-control @error('date_of_birth') is-invalid @enderror"
                                               value="{{ old('date_of_birth') }}" required>
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
                                               value="{{ old('nid_passport') }}" required>
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
                                               value="{{ old('profession_organization') }}" required>
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
                                       value="{{ old('mobile') }}" required>
                                @error('mobile')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Mobile number must be unique</small>
                            </div>

                            <div class="form-group">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="address" rows="3"
                                          class="form-control @error('address') is-invalid @enderror"
                                          placeholder="Enter full address" required>{{ old('address') }}</textarea>
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
                                                data-installment-price="{{ $category->installment_price }}"
                                                data-duration="{{ $category->duration }}"
                                                {{ old('membership_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }} - ৳{{ number_format($category->installment_price, 2) }} ({{ $category->duration }})
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

                            <!-- Subscription Period (shown for Monthly/Yearly) -->
                            <div id="subscription-period-wrap" style="display: none;">
                                <div class="form-group">
                                    <label for="subscription_period">Subscription Period <span class="text-danger">*</span></label>
                                    <select name="subscription_period" id="subscription_period"
                                            class="form-control @error('subscription_period') is-invalid @enderror">
                                        <option value="">-- Select Period --</option>
                                    </select>
                                    @error('subscription_period')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="custom-period-wrap" style="display: none;" class="form-group">
                                    <label for="custom_period_value">Custom Period <span class="text-danger">*</span></label>
                                    <input type="number" id="custom_period_value" min="1"
                                           class="form-control"
                                           placeholder="Enter number of months/years">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Information -->
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        <strong>Password Information:</strong> A random 6-digit password will be auto-generated and sent to the member's email address.
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Member & Send Welcome Email
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
const monthlyOptions = [
    {value: '1', label: '1 Month'},
    {value: '3', label: '3 Months'},
    {value: '6', label: '6 Months'},
    {value: '12', label: '12 Months'},
    {value: '16', label: '16 Months'},
    {value: '24', label: '24 Months'},
    {value: 'custom', label: 'Custom'},
];
const yearlyOptions = [
    {value: '1', label: '1 Year'},
    {value: '2', label: '2 Years'},
    {value: '3', label: '3 Years'},
    {value: '4', label: '4 Years'},
    {value: 'custom', label: 'Custom'},
];

document.getElementById('membership_category_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const categoryDetails = document.getElementById('category-details');
    const categoryInfo = document.getElementById('category-info');
    const subscriptionWrap = document.getElementById('subscription-period-wrap');
    const periodSelect = document.getElementById('subscription_period');
    const customWrap = document.getElementById('custom-period-wrap');
    const customInput = document.getElementById('custom_period_value');

    if (this.value) {
        const price = selectedOption.getAttribute('data-price');
        const installmentPrice = selectedOption.getAttribute('data-installment-price');
        const duration = selectedOption.getAttribute('data-duration');
        const title = selectedOption.textContent.split(' - ')[0];

        let infoHtml = `<strong>Category:</strong> ${title}<br>
            <strong>Membership Fee:</strong> ৳${parseFloat(price).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}<br>
            <strong>Duration:</strong> ${duration}`;

        if (duration !== 'Lifetime') {
            infoHtml += `<br><strong>Installment Price:</strong> ৳${parseFloat(installmentPrice).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})} / ${duration === 'Yearly' ? 'year' : 'month'}`;
        }

        categoryInfo.innerHTML = infoHtml;
        categoryDetails.style.display = 'block';

        // Show/populate subscription period
        if (duration === 'Lifetime') {
            subscriptionWrap.style.display = 'none';
            periodSelect.required = false;
        } else {
            subscriptionWrap.style.display = 'block';
            periodSelect.required = true;
            const options = duration === 'Yearly' ? yearlyOptions : monthlyOptions;
            periodSelect.innerHTML = '<option value="">-- Select Period --</option>';
            options.forEach(opt => {
                periodSelect.innerHTML += `<option value="${opt.value}">${opt.label}</option>`;
            });
            customWrap.style.display = 'none';
            if (customInput) customInput.required = false;
        }
    } else {
        categoryDetails.style.display = 'none';
        subscriptionWrap.style.display = 'none';
        periodSelect.required = false;
    }
});

document.getElementById('subscription_period').addEventListener('change', function() {
    const customWrap = document.getElementById('custom-period-wrap');
    const customInput = document.getElementById('custom_period_value');
    if (this.value === 'custom') {
        customWrap.style.display = 'block';
        customInput.required = true;
    } else {
        customWrap.style.display = 'none';
        customInput.required = false;
    }
});

document.querySelector('form').addEventListener('submit', function(e) {
    const periodSelect = document.getElementById('subscription_period');
    const customInput = document.getElementById('custom_period_value');
    if (periodSelect.style.display !== 'none' && periodSelect.value === 'custom') {
        const val = parseInt(customInput.value);
        if (!val || val < 1) {
            alert('Please enter a valid custom period.');
            e.preventDefault();
            return;
        }
        periodSelect.value = val;
    }
});
</script>
@endpush
