@extends("admin.layouts.master")

@section("title", "Tan Samiti Payments")

@section("content")

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

{{-- Filters --}}
<div class="card card-outline card-primary mb-3">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-filter mr-2"></i>Filters</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body pb-1">
        <form method="GET" action="{{ route('admin.tan-samiti.payment-requests') }}">
            <div class="row">

                {{-- Status --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="small font-weight-bold">Status</label>
                        @php $activeStatus = request('status', 'submitted'); @endphp
                        <select name="status" class="form-control form-control-sm">
                            <option value="">All</option>
                            <option value="submitted"  {{ $activeStatus === 'submitted'  ? 'selected' : '' }}>Submitted (Awaiting)</option>
                            <option value="completed"  {{ $activeStatus === 'completed'  ? 'selected' : '' }}>Approved / Paid</option>
                            <option value="rejected"   {{ $activeStatus === 'rejected'   ? 'selected' : '' }}>Rejected</option>
                            <option value="pending"    {{ $activeStatus === 'pending'    ? 'selected' : '' }}>Pending (Not Submitted)</option>
                            <option value="overdue"    {{ $activeStatus === 'overdue'    ? 'selected' : '' }}>Overdue</option>
                        </select>
                    </div>
                </div>

                {{-- Samiti --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="small font-weight-bold">Samiti</label>
                        <select name="samiti_id" class="form-control form-control-sm">
                            <option value="">All Samitis</option>
                            @foreach($samitis as $samiti)
                                <option value="{{ $samiti->id }}" {{ request('samiti_id') == $samiti->id ? 'selected' : '' }}>
                                    {{ $samiti->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- User search --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="small font-weight-bold">Member (name / email)</label>
                        <input type="text" name="user" value="{{ request('user') }}"
                               class="form-control form-control-sm" placeholder="Search member…">
                    </div>
                </div>

                {{-- Date from --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="small font-weight-bold">Due Date From</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="form-control form-control-sm">
                    </div>
                </div>

                {{-- Date to --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="small font-weight-bold">Due Date To</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="form-control form-control-sm">
                    </div>
                </div>

            </div>
            <div class="row mb-2">
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search mr-1"></i> Apply Filters
                    </button>
                    <a href="{{ route('admin.tan-samiti.payment-requests') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-times mr-1"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Results --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0">
            <i class="fas fa-coins mr-2 text-warning"></i>
            Investment Plan — Payments
        </h3>
        <span class="badge badge-secondary">{{ $requests->total() }} record(s)</span>
    </div>

    <div class="card-body p-0">
        @forelse($requests as $req)
        @php
            $isSubmitted = $req->status === 'pending' && $req->member_submitted_at && ! $req->rejected_at;
            $isCompleted = $req->status === 'completed';
            $isRejected  = (bool) $req->rejected_at;
            $isOverdue   = $req->status === 'pending' && $req->due_date < now()->startOfDay();
        @endphp
        <div class="p-4 border-bottom">
            <div class="row align-items-start">

                {{-- Member --}}
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        @if($req->user->profile?->photo)
                            <img src="{{ asset('storage/' . $req->user->profile->photo) }}"
                                 class="img-circle mr-3" style="width:42px;height:42px;object-fit:cover;">
                        @else
                            <div class="img-circle mr-3 bg-secondary d-flex align-items-center justify-content-center text-white font-weight-bold"
                                 style="width:42px;height:42px;font-size:16px;">
                                {{ strtoupper(substr($req->user->name ?? '?', 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-weight-bold">{{ $req->user->name ?? '—' }}</div>
                            <div class="text-muted small">{{ $req->user->email ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                {{-- Samiti + Cycle --}}
                <div class="col-md-2">
                    <div class="text-muted small text-uppercase">Samiti / Cycle</div>
                    <div class="font-weight-bold">{{ $req->tanSamiti->name }}</div>
                    <span class="badge badge-warning">Cycle #{{ $req->cycle_number }}</span>
                    <div class="text-muted small mt-1">Due: {{ $req->due_date->format('M j, Y') }}</div>
                    <div class="font-weight-bold text-success mt-1">৳{{ number_format($req->amount, 2) }}</div>
                </div>

                {{-- Status badge --}}
                <div class="col-md-2">
                    <div class="text-muted small text-uppercase mb-1">Status</div>
                    @if($isCompleted)
                        <span class="badge badge-success badge-lg"><i class="fas fa-check mr-1"></i>Paid</span>
                        @if($req->paid_at)
                            <div class="text-muted small mt-1">{{ $req->paid_at->format('M j, Y H:i') }}</div>
                        @endif
                    @elseif($isRejected)
                        <span class="badge badge-danger badge-lg"><i class="fas fa-times mr-1"></i>Rejected</span>
                        <div class="text-muted small mt-1">{{ $req->rejected_at->format('M j, Y H:i') }}</div>
                        @if($req->rejection_reason)
                            <div class="text-danger small mt-1" title="{{ $req->rejection_reason }}">
                                <i class="fas fa-info-circle"></i> {{ Str::limit($req->rejection_reason, 40) }}
                            </div>
                        @endif
                    @elseif($isSubmitted)
                        <span class="badge badge-warning badge-lg"><i class="fas fa-clock mr-1"></i>Awaiting Approval</span>
                        <div class="text-muted small mt-1">{{ $req->member_submitted_at->format('M j, Y H:i') }}</div>
                    @elseif($isOverdue)
                        <span class="badge badge-danger badge-lg"><i class="fas fa-exclamation-circle mr-1"></i>Overdue</span>
                    @else
                        <span class="badge badge-secondary badge-lg"><i class="fas fa-hourglass-half mr-1"></i>Pending</span>
                    @endif
                </div>

                {{-- Payment Info --}}
                <div class="col-md-2">
                    @if($req->memberPaymentMethod || $req->member_txn_id)
                        <div class="text-muted small text-uppercase">Payment Info</div>
                        @if($req->memberPaymentMethod)
                            <div class="d-flex align-items-center mt-1 mb-1">
                                @if($req->memberPaymentMethod->logo_path)
                                    <img src="{{ asset('storage/' . $req->memberPaymentMethod->logo_path) }}"
                                         style="width:20px;height:20px;object-fit:contain;" class="mr-1">
                                @endif
                                <span class="font-weight-bold small">{{ $req->memberPaymentMethod->name }}</span>
                            </div>
                        @endif
                        @if($req->member_txn_id)
                            <div class="text-muted small">TXN:</div>
                            <code class="small">{{ $req->member_txn_id }}</code>
                        @endif
                    @else
                        <span class="text-muted small">—</span>
                    @endif
                </div>

                {{-- Proof --}}
                <div class="col-md-1 text-center">
                    @if($req->member_proof_path)
                        <a href="{{ asset('storage/' . $req->member_proof_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $req->member_proof_path) }}"
                                 class="img-thumbnail"
                                 style="max-width:60px;max-height:55px;object-fit:cover;"
                                 title="Click to view full size">
                        </a>
                    @else
                        <span class="text-muted small">—</span>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="col-md-2 text-right">
                    @if($isSubmitted)
                        {{-- Approve --}}
                        <form action="{{ route('admin.tan-samiti.approve-installment', $req->id) }}"
                              method="POST" class="mb-1"
                              onsubmit="return confirm('Approve this payment?')">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm btn-block">
                                <i class="fas fa-check-circle mr-1"></i> Approve
                            </button>
                        </form>
                        {{-- Reject with reason --}}
                        <button type="button" class="btn btn-danger btn-sm btn-block"
                                onclick="openRejectModal({{ $req->id }})">
                            <i class="fas fa-times-circle mr-1"></i> Reject
                        </button>
                    @elseif($isCompleted)
                        <span class="text-success small"><i class="fas fa-lock mr-1"></i>Approved</span>
                    @elseif($isRejected)
                        {{-- Allow re-approval if member resubmits --}}
                        <span class="text-muted small">Awaiting resubmission</span>
                    @else
                        <span class="text-muted small">No action needed</span>
                    @endif
                </div>

            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <p class="text-muted font-weight-bold mb-0">No records found</p>
            <p class="text-muted small">Try adjusting your filters.</p>
        </div>
        @endforelse
    </div>

    @if($requests->hasPages())
    <div class="card-footer">
        {{ $requests->links() }}
    </div>
    @endif
</div>

{{-- Reject Modal --}}
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white py-2">
                <h6 class="modal-title mb-0"><i class="fas fa-times-circle mr-2"></i>Reject Payment</h6>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <label class="small font-weight-bold">Reason for rejection <span class="text-muted font-weight-normal">(optional)</span></label>
                        <textarea name="rejection_reason" rows="3"
                                  class="form-control form-control-sm mt-1"
                                  placeholder="e.g. Invalid transaction ID, unclear proof…"></textarea>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openRejectModal(installmentId) {
    const base = "{{ rtrim(route('admin.tan-samiti.reject-installment', ['installment' => '__ID__']), '') }}";
    document.getElementById('rejectForm').action = base.replace('__ID__', installmentId);
    document.getElementById('rejectModal').querySelector('textarea').value = '';
    $('#rejectModal').modal('show');
}
</script>
@endpush
