@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <!-- Event Info Card -->
        <div class="card card-primary card-outline mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Registrations for: {{ $event->title }}
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Events
                    </a>
                </div>
            </div>
            <div class="card-body py-2">
                <div class="row text-sm">
                    <div class="col-md-4">
                        <i class="fas fa-calendar text-muted mr-1"></i>
                        <strong>Date:</strong> {{ $event->date->format('l, F j, Y') }}
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-map-marker-alt text-muted mr-1"></i>
                        <strong>Venue:</strong> {{ $event->venue }}
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-tag text-muted mr-1"></i>
                        <strong>Fee:</strong>
                        @if($event->is_free)
                            <span class="badge badge-success">Free</span>
                        @else
                            <span class="badge badge-warning text-dark">BDT {{ number_format($event->fee, 2) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $counts['pending'] }}</h3>
                        <p>Pending</p>
                    </div>
                    <div class="icon"><i class="fas fa-hourglass-half"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $counts['approved'] }}</h3>
                        <p>Approved</p>
                    </div>
                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $counts['cancelled'] }}</h3>
                        <p>Cancelled</p>
                    </div>
                    <div class="icon"><i class="fas fa-times-circle"></i></div>
                </div>
            </div>
        </div>

        <!-- Registrations Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registration List</h3>
            </div>
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                            <tr>
                                <td>{{ $registration->id }}</td>
                                <td>{{ $registration->full_name }}</td>
                                <td>{{ $registration->email }}</td>
                                <td>{{ $registration->phone ?? '—' }}</td>
                                <td>
                                    @if($registration->is_member)
                                        <span class="badge badge-primary">Member</span>
                                    @else
                                        <span class="badge badge-secondary">Guest</span>
                                    @endif
                                </td>
                                <td>
                                    @if($event->is_free)
                                        <span class="badge badge-success">Free</span>
                                    @elseif($registration->payment_proof_path)
                                        <span class="badge badge-info">Proof Uploaded</span>
                                    @else
                                        <span class="badge badge-warning text-dark">No Proof</span>
                                    @endif
                                </td>
                                <td>
                                    @if($registration->status === 'pending')
                                        <span class="badge badge-warning text-dark">Pending</span>
                                    @elseif($registration->status === 'approved')
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $registration->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.event-registrations.show', [$event, $registration]) }}"
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if($registration->status === 'pending')
                                        <form action="{{ route('admin.event-registrations.approve', [$event, $registration]) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"
                                                    title="Approve"
                                                    onclick="return confirm('Approve this registration and send invitation email?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if($registration->status !== 'cancelled')
                                        <button type="button" class="btn btn-sm btn-danger"
                                                title="Cancel"
                                                onclick="openCancelModal({{ $registration->id }}, '{{ addslashes($registration->full_name) }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">No registrations yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($registrations->hasPages())
                <div class="card-footer">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="cancelForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Cancel Registration</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel registration for <strong id="cancelName"></strong>?</p>
                    <p class="text-muted small">A cancellation notification email will be sent to the registrant.</p>
                    <div class="form-group">
                        <label>Reason / Note <span class="text-muted">(optional)</span></label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Optional reason for cancellation..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Cancel Registration</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openCancelModal(registrationId, name) {
    document.getElementById('cancelName').textContent = name;
    document.getElementById('cancelForm').action =
        '{{ url("admin/events/" . $event->id . "/registrations") }}/' + registrationId + '/cancel';
    $('#cancelModal').modal('show');
}
</script>
@endpush
