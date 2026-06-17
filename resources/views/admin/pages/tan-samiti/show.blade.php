@extends("admin.layouts.master")

@section("title", $tanSamiti->name . " — Investment Plan")

@section("content")

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

{{-- Header --}}
<div class="card card-primary card-outline mb-3">
    <div class="card-body py-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h4 class="mb-0 font-weight-bold">{{ $tanSamiti->name }}</h4>
                @if($tanSamiti->description)
                    <p class="text-muted mb-0 mt-1">{{ $tanSamiti->description }}</p>
                @endif
            </div>
            <div class="d-flex gap-2">
                <span class="badge badge-{{ $tanSamiti->isActive() ? 'success' : 'secondary' }} p-2">
                    {{ ucfirst($tanSamiti->status) }}
                </span>
                @if($tanSamiti->lotteryEnabled())
                    <a href="{{ route('admin.tan-samiti.draw.show', $tanSamiti) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-random mr-1"></i> Lottery Draw
                    </a>
                @else
                    <span class="badge badge-light p-2" title="Lottery draw disabled for this plan">
                        <i class="fas fa-ban mr-1"></i> Lottery Disabled
                    </span>
                @endif
                <a href="{{ route('admin.tan-samiti.edit', $tanSamiti) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('admin.tan-samiti.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <div class="info-box bg-info">
                    <div class="info-box-content">
                        <span class="info-box-text">Monthly Amount</span>
                        <span class="info-box-number">৳{{ number_format($tanSamiti->monthly_amount, 2) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box bg-primary">
                    <div class="info-box-content">
                        <span class="info-box-text">Total Cycles</span>
                        <span class="info-box-number">{{ $tanSamiti->total_cycles }}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box bg-success">
                    <div class="info-box-content">
                        <span class="info-box-text">Active Members</span>
                        <span class="info-box-number">
                            {{ $members->count() }}@if($tanSamiti->hasMemberLimit()) / {{ $tanSamiti->member_limit }}@endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box bg-warning">
                    <div class="info-box-content">
                        <span class="info-box-text">Draws Done</span>
                        <span class="info-box-number">
                            @if($tanSamiti->lotteryEnabled())
                                {{ $draws->count() }} / {{ $tanSamiti->total_cycles }}
                            @else
                                <small>Disabled</small>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    {{-- Members Panel --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">Members</h3>
                @if($tanSamiti->hasMemberLimit())
                    <span class="badge badge-{{ $tanSamiti->isFull() ? 'danger' : 'info' }}">
                        {{ $members->count() }} / {{ $tanSamiti->member_limit }} slots filled
                    </span>
                @endif
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member</th>
                            <th>Joined</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $i => $member)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <strong>{{ $member->user->name }}</strong><br>
                                <small class="text-muted">{{ $member->user->email }}</small>
                            </td>
                            <td><small>{{ $member->joined_at?->format('d M Y') }}</small></td>
                            <td>
                                <form action="{{ route('admin.tan-samiti.remove-member', [$tanSamiti, $member]) }}" method="POST"
                                      onsubmit="return confirm('Remove this member?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger" title="Remove"><i class="fas fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">No members yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Add Member Form --}}
            <div class="card-footer">
                @if($tanSamiti->isFull())
                    <div class="alert alert-warning mb-0 py-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Member limit reached. Remove an existing member to add a new one.
                    </div>
                @else
                    <form action="{{ route('admin.tan-samiti.add-member', $tanSamiti) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <select name="user_id" class="form-control form-control-sm" required>
                            <option value="">-- Add Member --</option>
                            @foreach($allMembers as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary text-nowrap">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </form>
                    <small class="text-muted d-block mt-2">
                        Installments for all {{ $tanSamiti->total_cycles }} cycles will be auto-generated for the new member.
                    </small>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- Installments by Cycle --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Installments by Cycle</h3>
    </div>
    <div class="card-body p-0">
        @if($installmentsByCycle->isEmpty())
            <p class="text-center text-muted py-4">No installments generated yet.</p>
        @else
        <div id="accordion-cycles">
            @foreach($installmentsByCycle as $cycle => $installments)
            @php
                $paidCount = $installments->where('status', 'completed')->count();
                $pendingCount = $installments->where('status', 'pending')->count();
                $submittedCount = $installments->filter(fn($i) => $i->isPaymentSubmitted())->count();
            @endphp
            <div class="card card-secondary card-outline mb-0">
                <div class="card-header py-2" id="heading-{{ $cycle }}" style="cursor:pointer"
                     data-toggle="collapse" data-target="#cycle-{{ $cycle }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">Cycle #{{ $cycle }}</span>
                        <div>
                            @if($submittedCount > 0)
                                <span class="badge badge-warning mr-1">{{ $submittedCount }} Pending Approval</span>
                            @endif
                            <span class="badge badge-success mr-1">{{ $paidCount }} Paid</span>
                            <span class="badge badge-secondary">{{ $pendingCount }} Pending</span>
                            <i class="fas fa-angle-down ml-2"></i>
                        </div>
                    </div>
                </div>
                <div id="cycle-{{ $cycle }}" class="collapse">
                    <div class="card-body p-0">
                        <table class="table table-sm mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Member</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment Info</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($installments as $inst)
                                <tr>
                                    <td>{{ $inst->user->name }}</td>
                                    <td>{{ $inst->due_date->format('d M Y') }}</td>
                                    <td>৳{{ number_format($inst->amount, 2) }}</td>
                                    <td>
                                        @if($inst->isCompleted())
                                            <span class="badge badge-success">Paid</span>
                                        @elseif($inst->isPaymentSubmitted())
                                            <span class="badge badge-warning">Submitted</span>
                                        @elseif($inst->isOverdue())
                                            <span class="badge badge-danger">Overdue</span>
                                        @else
                                            <span class="badge badge-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($inst->isPaymentSubmitted())
                                            <small>
                                                <strong>{{ $inst->memberPaymentMethod?->name }}</strong><br>
                                                TXN: {{ $inst->member_txn_id }}<br>
                                                @if($inst->member_proof_path)
                                                    <a href="{{ asset('storage/'.$inst->member_proof_path) }}" target="_blank">View Proof</a>
                                                @endif
                                            </small>
                                        @elseif($inst->isCompleted())
                                            <small class="text-muted">{{ $inst->paid_at?->format('d M Y') }}</small>
                                        @else
                                            <small class="text-muted">—</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$inst->isCompleted())
                                        <form action="{{ route('admin.tan-samiti.approve-installment', $inst) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-xs btn-success" title="Approve Payment">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        @endif
                                        @if($inst->isPaymentSubmitted() && !$inst->isCompleted())
                                        <form action="{{ route('admin.tan-samiti.reject-installment', $inst) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-xs btn-danger" title="Reject Payment"
                                                    onclick="return confirm('Reject and reset this payment?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
