@extends('admin.layouts.master')

@section('title', 'Application Details')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Application Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.membership-applications.index') }}">Applications</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <!-- Personal Information -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user mr-2"></i> Personal Information</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px;">Full Name</th>
                                <td>{{ $membershipApplication->name }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $membershipApplication->date_of_birth->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <th>NID / Passport</th>
                                <td>{{ $membershipApplication->nid_passport }}</td>
                            </tr>
                            <tr>
                                <th>Profession / Organization</th>
                                <td>{{ $membershipApplication->profession_organization }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-address-book mr-2"></i> Contact Information</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px;">Email</th>
                                <td>{{ $membershipApplication->email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $membershipApplication->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $membershipApplication->address }}</td>
                            </tr>
                            <tr>
                                <th>IP Address</th>
                                <td>{{ $membershipApplication->ip_address ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Applicant Photo & NID Photo -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-camera mr-2"></i> Photos</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <strong>Applicant Photo</strong><br>
                            @if($membershipApplication->photo)
                                <img src="{{ asset('storage/' . $membershipApplication->photo) }}" alt="Applicant Photo" class="img-fluid img-thumbnail mt-2" style="max-height: 200px;">
                            @else
                                <p class="text-muted mt-2">No photo uploaded</p>
                            @endif
                        </div>
                        <hr>
                        <div class="mb-3">
                            <strong>NID / Passport Photo</strong><br>
                            @if($membershipApplication->nid_photo)
                                <img src="{{ asset('storage/' . $membershipApplication->nid_photo) }}" alt="NID/Passport Photo" class="img-fluid img-thumbnail mt-2" style="max-height: 200px;">
                            @else
                                <p class="text-muted mt-2">No NID/Passport photo uploaded</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="card">
                    <div class="card-header {{ $membershipApplication->isPaymentVerified() ? 'bg-success' : 'bg-warning' }}">
                        <h3 class="card-title">
                            <i class="fas fa-money-bill-wave mr-2"></i> Payment Information
                            @if($membershipApplication->isPaymentVerified())
                                <span class="badge badge-light ml-2"><i class="fas fa-check-circle mr-1"></i>Verified</span>
                            @else
                                <span class="badge badge-light ml-2"><i class="fas fa-clock mr-1"></i>Pending Verification</span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($membershipApplication->paymentMethod)
                            <div class="d-flex align-items-center mb-3">
                                @if($membershipApplication->paymentMethod->logo_path)
                                    <img src="{{ asset('storage/' . $membershipApplication->paymentMethod->logo_path) }}"
                                         alt="{{ $membershipApplication->paymentMethod->name }}"
                                         style="width:40px;height:40px;object-fit:contain;" class="mr-3">
                                @endif
                                <div>
                                    <div class="text-muted small">Payment Method</div>
                                    <strong>{{ $membershipApplication->paymentMethod->name }}</strong>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">Transaction ID</div>
                                <strong class="font-monospace">{{ $membershipApplication->transaction_id ?? '—' }}</strong>
                            </div>

                            @if($membershipApplication->payment_proof_path)
                                <div class="mb-3">
                                    <div class="text-muted small mb-1">Payment Proof</div>
                                    <a href="{{ asset('storage/' . $membershipApplication->payment_proof_path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $membershipApplication->payment_proof_path) }}"
                                             alt="Payment Proof"
                                             class="img-fluid img-thumbnail"
                                             style="max-height:180px;">
                                    </a>
                                    <div class="mt-1">
                                        <a href="{{ asset('storage/' . $membershipApplication->payment_proof_path) }}" target="_blank" class="btn btn-xs btn-outline-secondary">
                                            <i class="fas fa-external-link-alt"></i> Open full size
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="mb-3 text-muted small">No payment proof screenshot uploaded.</div>
                            @endif

                            @if($membershipApplication->isPaymentVerified())
                                <div class="alert alert-success py-2 mb-0">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Verified on {{ $membershipApplication->payment_verified_at->format('F j, Y h:i A') }}
                                    @if($membershipApplication->paymentVerifiedByAdmin)
                                        by <strong>{{ $membershipApplication->paymentVerifiedByAdmin->name }}</strong>
                                    @endif
                                </div>
                            @elseif($membershipApplication->status === 'pending')
                                <form action="{{ route('admin.membership-applications.verify-payment', $membershipApplication) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm btn-block"
                                            onclick="return confirm('Mark this payment as verified?');">
                                        <i class="fas fa-check-double mr-1"></i> Mark Payment as Verified
                                    </button>
                                </form>
                            @endif
                        @else
                            <p class="text-muted mb-0">No payment information provided.</p>
                        @endif
                    </div>
                </div>

                <!-- Reference -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-friends mr-2"></i> Reference</h3>
                    </div>
                    <div class="card-body">
                        {{ $membershipApplication->reference ?? 'N/A' }}
                    </div>
                </div>

                <!-- Application Status -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i> Application Status</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Status:</strong><br>
                            @if($membershipApplication->status === 'pending')
                                <span class="badge badge-warning badge-lg">Pending</span>
                            @elseif($membershipApplication->status === 'accepted')
                                <span class="badge badge-success badge-lg">Accepted</span>
                            @else
                                <span class="badge badge-danger badge-lg">Rejected</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <strong>Membership Type:</strong><br>
                            <span class="badge badge-info badge-lg">{{ $membershipApplication->membershipCategory->title }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Membership Fee:</strong><br>
                            <h4>৳{{ number_format($membershipApplication->membershipCategory->price, 2) }}</h4>
                        </div>

                        <div class="mb-3">
                            <strong>Duration:</strong><br>
                            {{ $membershipApplication->membershipCategory->duration }}
                        </div>

                        <div class="mb-3">
                            <strong>Applied Date:</strong><br>
                            {{ $membershipApplication->created_at->format('F j, Y h:i A') }}
                        </div>

                        <div class="mb-3">
                            <strong>Terms Accepted:</strong><br>
                            @if($membershipApplication->is_tos_accepted)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                @if($membershipApplication->status === 'pending')
                    @php $category = $membershipApplication->membershipCategory; @endphp
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fas fa-tasks mr-2"></i> Actions</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.membership-applications.update-status', $membershipApplication) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="accepted">

                                @if($category->duration !== 'Lifetime')
                                {{-- Hidden input carries the resolved numeric value to the server --}}
                                <input type="hidden" name="subscription_period" id="subscription_period_value"
                                       value="{{ old('subscription_period') }}">

                                <div class="form-group">
                                    <label for="subscription_period_select"><strong>Subscription Period <span class="text-danger">*</span></strong></label>
                                    <select id="subscription_period_select" class="form-control @error('subscription_period') is-invalid @enderror">
                                        <option value="">-- Select Period --</option>
                                        @if($category->duration === 'Monthly')
                                            <option value="1"  {{ old('subscription_period') == '1'  ? 'selected' : '' }}>1 Month</option>
                                            <option value="3"  {{ old('subscription_period') == '3'  ? 'selected' : '' }}>3 Months</option>
                                            <option value="6"  {{ old('subscription_period') == '6'  ? 'selected' : '' }}>6 Months</option>
                                            <option value="12" {{ old('subscription_period') == '12' ? 'selected' : '' }}>12 Months</option>
                                            <option value="16" {{ old('subscription_period') == '16' ? 'selected' : '' }}>16 Months</option>
                                            <option value="24" {{ old('subscription_period') == '24' ? 'selected' : '' }}>24 Months</option>
                                            <option value="custom">Custom</option>
                                        @elseif($category->duration === 'Yearly')
                                            <option value="1" {{ old('subscription_period') == '1' ? 'selected' : '' }}>1 Year</option>
                                            <option value="2" {{ old('subscription_period') == '2' ? 'selected' : '' }}>2 Years</option>
                                            <option value="3" {{ old('subscription_period') == '3' ? 'selected' : '' }}>3 Years</option>
                                            <option value="4" {{ old('subscription_period') == '4' ? 'selected' : '' }}>4 Years</option>
                                            <option value="custom">Custom</option>
                                        @endif
                                    </select>
                                    @error('subscription_period')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="custom-period-wrap" style="display:none;" class="form-group">
                                    <label for="custom_period_value">
                                        Custom {{ $category->duration === 'Yearly' ? 'Years' : 'Months' }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" id="custom_period_value" min="1"
                                           class="form-control"
                                           placeholder="Enter number of {{ $category->duration === 'Yearly' ? 'years' : 'months' }}">
                                </div>
                                @endif

                                <button type="submit" class="btn btn-success btn-block mb-2"
                                        onclick="return confirmApproval(event);">
                                    <i class="fas fa-check-circle"></i> Approve Application
                                </button>
                            </form>

                            <form action="{{ route('admin.membership-applications.update-status', $membershipApplication) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to reject this application?');">
                                    <i class="fas fa-times-circle"></i> Reject Application
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                @if($membershipApplication->status === 'accepted')
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title"><i class="fas fa-user-check mr-2"></i> User Account Created</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-success">
                                <i class="fas fa-check-circle"></i> This application has been approved and a user account has been created.
                            </p>
                            <p class="text-muted small">
                                An email with login credentials has been sent to the applicant.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const periodSelect  = document.getElementById('subscription_period_select');
    const hiddenInput   = document.getElementById('subscription_period_value');
    const customWrap    = document.getElementById('custom-period-wrap');
    const customInput   = document.getElementById('custom_period_value');

    if (!periodSelect) return;

    periodSelect.addEventListener('change', function () {
        if (this.value === 'custom') {
            customWrap.style.display = 'block';
            hiddenInput.value = '';        // clear until user types
        } else {
            customWrap.style.display = 'none';
            hiddenInput.value = this.value; // sync non-custom value immediately
        }
    });

    if (customInput) {
        customInput.addEventListener('input', function () {
            hiddenInput.value = this.value; // keep hidden input in sync while typing
        });
    }
});

function confirmApproval(e) {
    const periodSelect = document.getElementById('subscription_period_select');
    const customInput  = document.getElementById('custom_period_value');
    const hiddenInput  = document.getElementById('subscription_period_value');

    if (!periodSelect) {
        return confirm('Approve this application? A user account will be created and an email will be sent.');
    }

    if (!periodSelect.value) {
        alert('Please select a subscription period before approving.');
        e.preventDefault();
        return false;
    }

    if (periodSelect.value === 'custom') {
        const val = parseInt(customInput ? customInput.value : '');
        if (!val || val < 1) {
            alert('Please enter a valid custom period.');
            e.preventDefault();
            return false;
        }
        hiddenInput.value = val; // write the number into the hidden field
    }

    return confirm('Approve this application? A user account will be created and an email will be sent.');
}
</script>
@endpush
