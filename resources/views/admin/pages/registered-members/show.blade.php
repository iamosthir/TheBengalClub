@extends('admin.layouts.master')

@section('title', 'Member Details')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Member Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.registered-members.index') }}">Registered Members</a></li>
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

        @if($user->profile?->membership_start_at)
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-id-card mr-2"></i> Membership Period</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-warning"
                                data-toggle="modal" data-target="#extend-modal">
                                <i class="fas fa-calendar-plus mr-1"></i> Extend Membership
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon"><i class="fas fa-play-circle text-success"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text text-muted">Start Date</span>
                                        <span class="info-box-number text-success">
                                            {{ $user->profile->membership_start_at->format('d M Y') }}
                                        </span>
                                        <span class="progress-description text-muted small">
                                            {{ $user->profile->membership_start_at->format('h:i A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon"><i class="fas fa-stop-circle text-danger"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text text-muted">End Date</span>
                                        <span class="info-box-number text-danger">
                                            {{ $user->profile->membership_end_at?->format('d M Y') ?? '—' }}
                                        </span>
                                        <span class="progress-description text-muted small">
                                            {{ $user->profile->membership_end_at?->format('h:i A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon"><i class="fas fa-layer-group text-info"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text text-muted">Category</span>
                                        <span class="info-box-number text-info">
                                            {{ $user->profile->membershipCategory->title }}
                                        </span>
                                        <span class="progress-description text-muted small">
                                            {{ $user->profile->membershipCategory->duration }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <td><strong>{{ $user->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $user->profile->date_of_birth->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <th>NID / Passport</th>
                                <td>{{ $user->profile->nid_passport }}</td>
                            </tr>
                            <tr>
                                <th>Profession / Organization</th>
                                <td>{{ $user->profile->profession_organization }}</td>
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
                                <th style="width: 200px;">Mobile</th>
                                <td>{{ $user->profile->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $user->profile->address }}</td>
                            </tr>
                            <tr>
                                <th>Registration Date</th>
                                <td>{{ $user->created_at->format('F j, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $user->updated_at->format('F j, Y h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Social Media Links -->
                @php
                    $hasSocial = $user->profile->facebook_url || $user->profile->instagram_url
                              || $user->profile->linkedin_url || $user->profile->twitter_url
                              || $user->profile->youtube_url;
                @endphp
                @if($hasSocial)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-share-alt mr-2"></i> Social Media</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            @if($user->profile->facebook_url)
                                <a href="{{ $user->profile->facebook_url }}" target="_blank"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook-f mr-1"></i> Facebook
                                </a>
                            @endif
                            @if($user->profile->instagram_url)
                                <a href="{{ $user->profile->instagram_url }}" target="_blank"
                                   class="btn btn-outline-danger btn-sm">
                                    <i class="fab fa-instagram mr-1"></i> Instagram
                                </a>
                            @endif
                            @if($user->profile->linkedin_url)
                                <a href="{{ $user->profile->linkedin_url }}" target="_blank"
                                   class="btn btn-outline-info btn-sm">
                                    <i class="fab fa-linkedin-in mr-1"></i> LinkedIn
                                </a>
                            @endif
                            @if($user->profile->twitter_url)
                                <a href="{{ $user->profile->twitter_url }}" target="_blank"
                                   class="btn btn-outline-info btn-sm">
                                    <i class="fab fa-twitter mr-1"></i> Twitter / X
                                </a>
                            @endif
                            @if($user->profile->youtube_url)
                                <a href="{{ $user->profile->youtube_url }}" target="_blank"
                                   class="btn btn-outline-danger btn-sm">
                                    <i class="fab fa-youtube mr-1"></i> YouTube
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <!-- Membership Information -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title"><i class="fas fa-id-card mr-2"></i> Membership Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Membership Category:</strong><br>
                            <span class="badge badge-info badge-lg">{{ $user->profile->membershipCategory->title }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Membership Fee:</strong><br>
                            <h4>৳{{ number_format($user->profile->membershipCategory->price, 2) }}</h4>
                        </div>

                        <div class="mb-3">
                            <strong>Duration:</strong><br>
                            {{ $user->profile->membershipCategory->duration }}
                        </div>

                        @if($user->profile->membershipCategory->features)
                            <div class="mb-3">
                                <strong>Features:</strong>
                                <ul class="pl-3">
                                    @foreach($user->profile->membershipCategory->features as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Suspension Status -->
                <div class="card card-outline {{ $user->isSuspended() ? 'card-danger' : 'card-success' }}">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas {{ $user->isSuspended() ? 'fa-ban' : 'fa-check-circle' }} mr-2"></i>
                            Membership Status
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($user->isSuspended())
                            <div class="alert alert-danger mb-3">
                                <strong><i class="fas fa-ban mr-1"></i> Suspended</strong><br>
                                <small class="d-block mt-1">
                                    Since: {{ $user->suspended_at->format('d M Y, h:i A') }}
                                </small>
                                @if($user->suspendedByAdmin)
                                    <small class="d-block">By: {{ $user->suspendedByAdmin->name }}</small>
                                @endif
                                @if($user->suspension_reason)
                                    <small class="d-block mt-1"><em>"{{ $user->suspension_reason }}"</em></small>
                                @endif
                            </div>
                            <form action="{{ route('admin.registered-members.unsuspend', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Lift suspension for {{ $user->name }}?');">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-check-circle mr-1"></i> Lift Suspension
                                </button>
                            </form>
                        @else
                            <p class="text-success mb-3"><i class="fas fa-check-circle mr-1"></i> Active — member can log in</p>
                            <button type="button" class="btn btn-warning btn-block"
                                    data-toggle="modal" data-target="#suspend-modal">
                                <i class="fas fa-ban mr-1"></i> Suspend Member
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title"><i class="fas fa-tasks mr-2"></i> Actions</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.registered-members.edit', $user->id) }}"
                           class="btn btn-info btn-block mb-2">
                            <i class="fas fa-edit"></i> Edit Member
                        </a>

                        <form action="{{ route('admin.registered-members.destroy', $user->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this member? This will also delete their profile data and cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block mb-2">
                                <i class="fas fa-trash"></i> Delete Member
                            </button>
                        </form>

                        <a href="{{ route('admin.registered-members.index') }}"
                           class="btn btn-secondary btn-block">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Installment Timeline --}}
        @if($user->profile && $user->profile->installments->isNotEmpty())
            @php
                $installments   = $user->profile->installments;
                $completedCount = $installments->where('status', 'completed')->count();
                $totalCount     = $installments->count();
            @endphp

            <div class="row" id="installments">
                <div class="col-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list-ol mr-2"></i> Installment Schedule</h3>
                            <div class="card-tools">
                                <span class="badge badge-success mr-1">{{ $completedCount }} Paid</span>
                                <span class="badge badge-warning">{{ $totalCount - $completedCount }} Pending</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                @php $prevMonth = null; @endphp
                                @foreach($installments as $inst)
                                    @php
                                        $monthLabel = $inst->due_date->format('F Y');
                                        $isOverdue  = $inst->isPending() && $inst->due_date->isPast();
                                    @endphp

                                    @if($monthLabel !== $prevMonth)
                                        <div class="time-label">
                                            <span class="bg-{{ $inst->isCompleted() ? 'success' : ($isOverdue ? 'danger' : 'info') }}">
                                                {{ $monthLabel }}
                                            </span>
                                        </div>
                                        @php $prevMonth = $monthLabel; @endphp
                                    @endif

                                    <div>
                                        @if($inst->isCompleted())
                                            <i class="fas fa-check-circle bg-success"></i>
                                        @elseif($isOverdue)
                                            <i class="fas fa-exclamation-circle bg-danger"></i>
                                        @else
                                            <i class="fas fa-clock bg-warning"></i>
                                        @endif

                                        <div class="timeline-item">
                                            <span class="time">
                                                <i class="fas fa-calendar-alt"></i>
                                                Due: {{ $inst->due_date->format('d M Y') }}
                                                @if($inst->isCompleted() && $inst->paid_at)
                                                    &nbsp;|&nbsp;<i class="fas fa-check text-success"></i>
                                                    Paid: {{ $inst->paid_at->format('d M Y') }}
                                                @endif
                                            </span>

                                            <h3 class="timeline-header">
                                                Installment #{{ $inst->installment_number }}
                                                &nbsp;
                                                @if($inst->isCompleted())
                                                    <span class="badge badge-success">Completed</span>
                                                @elseif($isOverdue)
                                                    <span class="badge badge-danger">Overdue</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                                @if($inst->payment_method)
                                                    &nbsp;<span class="badge badge-secondary">{{ $inst->payment_method }}</span>
                                                @endif
                                            </h3>

                                            <div class="timeline-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <h4 class="mb-0 text-primary">৳{{ number_format($inst->amount, 2) }}</h4>
                                                    </div>
                                                    @if($inst->note)
                                                        <div class="col">
                                                            <span class="text-muted"><i class="fas fa-sticky-note mr-1"></i>{{ $inst->note }}</span>
                                                        </div>
                                                    @endif
                                                    @if($inst->isCompleted() && $inst->completedByAdmin)
                                                        <div class="col-auto">
                                                            <small class="text-muted">
                                                                <i class="fas fa-user-shield mr-1"></i>
                                                                By {{ $inst->completedByAdmin->name ?? 'Admin' }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="timeline-footer">
                                                <button type="button"
                                                    class="btn btn-sm {{ $inst->isCompleted() ? 'btn-outline-warning' : 'btn-outline-primary' }} btn-update-installment"
                                                    data-toggle="modal"
                                                    data-target="#installment-modal"
                                                    data-id="{{ $inst->id }}"
                                                    data-number="{{ $inst->installment_number }}"
                                                    data-status="{{ $inst->status }}"
                                                    data-payment-method="{{ $inst->payment_method ?? '' }}"
                                                    data-note="{{ $inst->note ?? '' }}">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    {{ $inst->isCompleted() ? 'Revert / Edit' : 'Mark as Paid' }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div><i class="fas fa-flag bg-gray"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Installment Update Modal --}}
            <div class="modal fade" id="installment-modal" tabindex="-1" role="dialog" aria-labelledby="installmentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="installmentModalLabel">
                                <i class="fas fa-edit mr-2"></i>Update Installment #<span id="modal-installment-number"></span>
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="installment-form">
                                @csrf
                                <div class="form-group">
                                    <label for="modal-status"><i class="fas fa-toggle-on mr-1"></i> Status <span class="text-danger">*</span></label>
                                    <select name="status" id="modal-status" class="form-control" required>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="modal-payment-method"><i class="fas fa-wallet mr-1"></i> Payment Method</label>
                                    <select name="payment_method" id="modal-payment-method" class="form-control">
                                        <option value="">— Select Method —</option>
                                        <option value="Bkash">Bkash</option>
                                        <option value="Nagad">Nagad</option>
                                        <option value="Rocket">Rocket</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <small class="form-text text-muted">Optional — leave blank if unknown.</small>
                                </div>

                                <div class="form-group">
                                    <label for="modal-note"><i class="fas fa-sticky-note mr-1"></i> Remark / Note</label>
                                    <textarea name="note" id="modal-note" class="form-control" rows="3" placeholder="Any remark or note about this payment..."></textarea>
                                </div>
                            </form>

                            <div id="modal-alert" class="alert d-none mt-2"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </button>
                            <button type="button" class="btn btn-primary" id="modal-save-btn">
                                <i class="fas fa-save mr-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Extend Membership Modal --}}
        @if($user->profile?->membership_end_at)
        @php $minExtendDate = $user->profile->membership_end_at->copy()->addDay()->format('Y-m-d'); @endphp
        <div class="modal fade" id="extend-modal" tabindex="-1" role="dialog" aria-labelledby="extendModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="extendModalLabel">
                            <i class="fas fa-calendar-plus mr-2"></i> Extend Membership
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.registered-members.extend-membership', $user->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-1"></i>
                                Current membership ends on
                                <strong>{{ $user->profile->membership_end_at->format('d M Y') }}</strong>.
                                New installments will be created from that date onwards.
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-calendar-alt mr-1"></i> New End Date <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="new-end-date" name="new_end_date" class="form-control" placeholder="Select new end date" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Must be after {{ $user->profile->membership_end_at->format('d M Y') }}.
                                    Installments (৳{{ number_format($user->profile->membershipCategory->price, 2) }} each) will be created monthly up to this date.
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-calendar-plus mr-1"></i> Extend & Create Installments
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        {{-- Suspend Member Modal --}}
        @if(!$user->isSuspended())
        <div class="modal fade" id="suspend-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">
                            <i class="fas fa-ban mr-2"></i> Suspend Member
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.registered-members.suspend', $user->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                <strong>{{ $user->name }}</strong> will be immediately logged out and blocked from logging in.
                            </div>
                            <div class="form-group">
                                <label for="suspension_reason"><strong>Reason for Suspension <span class="text-danger">*</span></strong></label>
                                <textarea name="suspension_reason" id="suspension_reason" rows="3"
                                          class="form-control @error('suspension_reason') is-invalid @enderror"
                                          placeholder="Enter the reason for suspending this member..."
                                          required>{{ old('suspension_reason') }}</textarea>
                                @error('suspension_reason')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-ban mr-1"></i> Confirm Suspension
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>
@endsection

@push('scripts')
<script>
// Extend membership datepicker
@if($user->profile?->membership_end_at)
$('#new-end-date').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minDate: '{{ $user->profile->membership_end_at->copy()->addDay()->format('Y-m-d') }}',
    startDate: '{{ $user->profile->membership_end_at->copy()->addDay()->format('Y-m-d') }}',
    locale: { format: 'YYYY-MM-DD' },
});
@endif

// Installment modal
(function () {
    var currentInstallmentId = null;
    var updateBaseUrl = '{{ rtrim(route("admin.membership-installments.update", ["installment" => "__ID__"]), "") }}';

    $(document).on('click', '.btn-update-installment', function () {
        var btn = $(this);
        currentInstallmentId = btn.data('id');
        $('#modal-installment-number').text(btn.data('number'));
        $('#modal-status').val(btn.data('status'));
        $('#modal-payment-method').val(btn.data('payment-method') || '');
        $('#modal-note').val(btn.data('note') || '');
        $('#modal-alert').addClass('d-none').removeClass('alert-success alert-danger').text('');
    });

    $('#modal-save-btn').on('click', function () {
        if (!currentInstallmentId) return;
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');

        var url = updateBaseUrl.replace('__ID__', currentInstallmentId);

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _method: 'PATCH',
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: $('#modal-status').val(),
                payment_method: $('#modal-payment-method').val() || null,
                note: $('#modal-note').val() || null,
            },
            success: function (response) {
                $('#modal-alert')
                    .removeClass('d-none alert-danger')
                    .addClass('alert-success')
                    .text(response.message);
                setTimeout(function () {
                    $('#installment-modal').modal('hide');
                    window.location.reload();
                }, 800);
            },
            error: function (xhr) {
                var msg = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                $('#modal-alert')
                    .removeClass('d-none alert-success')
                    .addClass('alert-danger')
                    .text(msg);
                $btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Save Changes');
            }
        });
    });

    $('#installment-modal').on('hidden.bs.modal', function () {
        currentInstallmentId = null;
        $('#modal-save-btn').prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Save Changes');
        $('#modal-alert').addClass('d-none');
    });
})();
</script>
@endpush
