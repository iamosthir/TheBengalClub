@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registration Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.event-registrations.index', $event) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                <!-- Status Badge -->
                <div class="mb-4">
                    @if($registration->status === 'pending')
                        <span class="badge badge-warning badge-lg" style="font-size:1rem;padding:8px 16px;">Pending Review</span>
                    @elseif($registration->status === 'approved')
                        <span class="badge badge-success badge-lg" style="font-size:1rem;padding:8px 16px;">Approved</span>
                    @else
                        <span class="badge badge-danger badge-lg" style="font-size:1rem;padding:8px 16px;">Cancelled</span>
                    @endif
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th style="width:30%">Event</th>
                        <td>{{ $event->title }} ({{ $event->date->format('d M Y') }})</td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td>{{ $registration->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $registration->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $registration->phone ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $registration->address ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Registrant Type</th>
                        <td>
                            @if($registration->is_member)
                                <span class="badge badge-primary">Club Member</span>
                                @if($registration->user)
                                    &nbsp;
                                    <a href="{{ route('admin.registered-members.show', $registration->user_id) }}">
                                        View Profile
                                    </a>
                                @endif
                            @else
                                <span class="badge badge-secondary">Guest</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Registration Fee</th>
                        <td>
                            @if($event->is_free)
                                <span class="badge badge-success">Free</span>
                            @else
                                BDT {{ number_format($event->fee, 2) }}
                            @endif
                        </td>
                    </tr>
                    @if(!$event->is_free)
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ $registration->paymentMethod->name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $registration->transaction_id ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Payment Proof</th>
                        <td>
                            @if($registration->payment_proof_path)
                                <a href="{{ asset('storage/' . $registration->payment_proof_path) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $registration->payment_proof_path) }}"
                                         alt="Payment Proof"
                                         style="max-height:200px;border-radius:6px;border:1px solid #dee2e6;">
                                </a>
                            @else
                                <span class="text-muted">No proof uploaded</span>
                            @endif
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>Registered At</th>
                        <td>{{ $registration->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                    @if($registration->note)
                    <tr>
                        <th>Note</th>
                        <td>{{ $registration->note }}</td>
                    </tr>
                    @endif
                </table>

                <!-- Action Buttons -->
                @if($registration->status === 'pending')
                    <div class="mt-4 d-flex gap-2">
                        <form action="{{ route('admin.event-registrations.approve', [$event, $registration]) }}"
                              method="POST" class="d-inline mr-2">
                            @csrf
                            <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Approve this registration and send invitation email?')">
                                <i class="fas fa-check mr-1"></i> Approve & Send Invitation
                            </button>
                        </form>

                        <button type="button" class="btn btn-danger" onclick="$('#cancelModal').modal('show')">
                            <i class="fas fa-times mr-1"></i> Cancel Registration
                        </button>
                    </div>
                @elseif($registration->status === 'approved')
                    <div class="mt-4">
                        <button type="button" class="btn btn-danger" onclick="$('#cancelModal').modal('show')">
                            <i class="fas fa-times mr-1"></i> Cancel Registration
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.event-registrations.cancel', [$event, $registration]) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Cancel Registration</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Cancel registration for <strong>{{ $registration->full_name }}</strong>?</p>
                    <p class="text-muted small">A cancellation notification email will be sent to the registrant.</p>
                    <div class="form-group">
                        <label>Reason / Note <span class="text-muted">(optional)</span></label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Optional reason..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
