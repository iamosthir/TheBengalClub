@extends("admin.layouts.master")

@section("content")
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pending Payment Requests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payment Requests</li>
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
                <form method="GET" action="{{ route('admin.payment-requests.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="small font-weight-bold">Status</label>
                                @php $activeStatus = request('status', 'submitted'); @endphp
                                <select name="status" class="form-control form-control-sm">
                                    <option value="all"       {{ $activeStatus === 'all'       ? 'selected' : '' }}>All</option>
                                    <option value="submitted" {{ $activeStatus === 'submitted' ? 'selected' : '' }}>Submitted (Awaiting)</option>
                                    <option value="completed" {{ $activeStatus === 'completed' ? 'selected' : '' }}>Approved / Paid</option>
                                    <option value="pending"   {{ $activeStatus === 'pending'   ? 'selected' : '' }}>Pending (Not Submitted)</option>
                                    <option value="overdue"   {{ $activeStatus === 'overdue'   ? 'selected' : '' }}>Overdue</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="small font-weight-bold">Member (name / email)</label>
                                <input type="text" name="user" value="{{ request('user') }}"
                                       class="form-control form-control-sm" placeholder="Search member…">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="small font-weight-bold">Due Date From</label>
                                <input type="date" name="date_from" value="{{ request('date_from') }}"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="small font-weight-bold">Due Date To</label>
                                <input type="date" name="date_to" value="{{ request('date_to') }}"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <div class="form-group w-100">
                                <label class="small d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-sm mr-1">
                                    <i class="fas fa-search mr-1"></i> Apply
                                </button>
                                <a href="{{ route('admin.payment-requests.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clock mr-2 text-warning"></i>
                    Payment Requests
                </h3>
                <div class="card-tools">
                    <span class="badge badge-warning badge-lg">{{ $requests->total() }} record(s)</span>
                </div>
            </div>
            <div class="card-body p-0">
                @forelse($requests as $req)
                @php
                    $isSubmitted = $req->status === 'pending' && $req->member_submitted_at !== null;
                    $isCompleted = $req->status === 'completed';
                @endphp
                    <div class="p-4 border-bottom">
                        <div class="row align-items-start">

                            {{-- Member Info --}}
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    @if($req->userProfile?->photo)
                                        <img src="{{ asset('storage/' . $req->userProfile->photo) }}"
                                             class="img-circle mr-3" style="width:42px;height:42px;object-fit:cover;">
                                    @else
                                        <div class="img-circle mr-3 bg-secondary d-flex align-items-center justify-content-center text-white"
                                             style="width:42px;height:42px;font-weight:700;font-size:16px;">
                                            {{ strtoupper(substr($req->user->name ?? '?', 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-weight-bold text-sm">{{ $req->user->name ?? '—' }}</div>
                                        <div class="text-muted small">{{ $req->user->email ?? '—' }}</div>
                                        @if($req->userProfile?->membershipCategory)
                                            <span class="badge badge-info badge-sm">{{ $req->userProfile->membershipCategory->title }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Installment Info --}}
                            <div class="col-md-2">
                                <div class="text-muted small text-uppercase">Installment</div>
                                <div class="font-weight-bold">#{{ $req->installment_number }}</div>
                                <div class="text-muted small">Due: {{ $req->due_date?->format('M j, Y') ?? '—' }}</div>
                                @if($isCompleted)
                                    <span class="badge badge-success">Paid</span>
                                @elseif($isSubmitted)
                                    <span class="badge badge-warning">Awaiting</span>
                                @elseif($req->isOverdue())
                                    <span class="badge badge-danger">Overdue</span>
                                @else
                                    <span class="badge badge-secondary">Pending</span>
                                @endif
                                <div class="mt-1 text-accent font-weight-bold">৳{{ number_format($req->amount, 2) }}</div>
                            </div>

                            {{-- Payment Method + TXN --}}
                            <div class="col-md-3">
                                <div class="text-muted small text-uppercase">Payment Info</div>
                                @if($req->memberPaymentMethod || $req->member_txn_id)
                                    @if($req->memberPaymentMethod)
                                        <div class="d-flex align-items-center mt-1 mb-1">
                                            @if($req->memberPaymentMethod->logo_path)
                                                <img src="{{ asset('storage/' . $req->memberPaymentMethod->logo_path) }}"
                                                     style="width:24px;height:24px;object-fit:contain;" class="mr-2">
                                            @endif
                                            <span class="font-weight-bold">{{ $req->memberPaymentMethod->name }}</span>
                                        </div>
                                    @endif
                                    @if($req->member_txn_id)
                                        <div class="text-muted small">TXN ID:</div>
                                        <code class="text-sm">{{ $req->member_txn_id }}</code>
                                    @endif
                                    @if($req->member_submitted_at)
                                        <div class="text-muted small mt-1">Submitted: {{ $req->member_submitted_at->format('M j, Y H:i') }}</div>
                                    @endif
                                    @if($isCompleted && $req->paid_at)
                                        <div class="text-success small mt-1">Approved: {{ $req->paid_at->format('M j, Y H:i') }}</div>
                                    @endif
                                @else
                                    <span class="text-muted small">No payment submitted</span>
                                @endif
                            </div>

                            {{-- Payment Proof --}}
                            <div class="col-md-2 text-center">
                                @if($req->member_proof_path)
                                    <div class="text-muted small text-uppercase mb-1">Proof</div>
                                    <a href="{{ asset('storage/' . $req->member_proof_path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $req->member_proof_path) }}"
                                             class="img-thumbnail"
                                             style="max-width:80px;max-height:70px;object-fit:cover;"
                                             title="Click to view full size">
                                    </a>
                                    <div class="mt-1">
                                        <a href="{{ asset('storage/' . $req->member_proof_path) }}" target="_blank"
                                           class="btn btn-xs btn-outline-secondary">
                                            <i class="fas fa-expand-alt"></i> Full
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted small">No proof</span>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="col-md-2 text-right">
                                @if($isSubmitted)
                                    <form action="{{ route('admin.payment-requests.approve', $req->id) }}" method="POST" class="mb-2"
                                          onsubmit="return confirm('Approve this payment and mark installment as completed?');">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm btn-block">
                                            <i class="fas fa-check-circle mr-1"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.payment-requests.reject', $req->id) }}" method="POST"
                                          onsubmit="return confirm('Reject this payment request? The member will need to resubmit.');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm btn-block">
                                            <i class="fas fa-times-circle mr-1"></i> Reject
                                        </button>
                                    </form>
                                @elseif($isCompleted)
                                    <span class="text-success small"><i class="fas fa-lock mr-1"></i>Approved</span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                                <form action="{{ route('admin.payment-requests.destroy', $req->id) }}" method="POST" class="mt-2"
                                      onsubmit="return confirm('Permanently delete this record? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-check-double fa-3x text-success mb-3"></i>
                        <p class="text-muted mb-0 font-weight-bold">No pending payment requests</p>
                        <p class="text-muted small">All caught up!</p>
                    </div>
                @endforelse
            </div>

            @if($requests->hasPages())
                <div class="card-footer">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>

    </div>
</section>
@endsection
