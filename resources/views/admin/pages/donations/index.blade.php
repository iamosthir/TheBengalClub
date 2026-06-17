@extends('admin.layouts.master')
@section('title', 'Donations')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Donations</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Donations</li>
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

        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner"><h3>{{ $pendingCount }}</h3><p>Pending</p></div>
                    <div class="icon"><i class="fas fa-clock"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-success">
                    <div class="inner"><h3>{{ $verifiedCount }}</h3><p>Verified</p></div>
                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-danger">
                    <div class="inner"><h3>{{ $canceledCount }}</h3><p>Canceled</p></div>
                    <div class="icon"><i class="fas fa-times-circle"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-info">
                    <div class="inner"><h3>৳{{ number_format($totalAmount, 2) }}</h3><p>Total Verified</p></div>
                    <div class="icon"><i class="fas fa-donate"></i></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Donations</h3>
                <div class="card-tools d-flex" style="gap:8px;">
                    <form method="GET" class="d-flex" style="gap:6px;">
                        <input type="text" name="search" class="form-control form-control-sm"
                               placeholder="Search name/email/txn..." value="{{ request('search') }}">
                        <select name="status" class="form-control form-control-sm">
                            <option value="">All Status</option>
                            <option value="pending"  {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ request('status') === 'verified'  ? 'selected' : '' }}>Verified</option>
                            <option value="canceled" {{ request('status') === 'canceled'  ? 'selected' : '' }}>Canceled</option>
                        </select>
                        <button class="btn btn-sm btn-primary">Filter</button>
                        @if(request('search') || request('status'))
                            <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-secondary">Clear</a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Donor</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td>{{ $donation->id }}</td>
                            <td>
                                <div class="font-weight-bold">{{ $donation->full_name }}</div>
                                <small class="text-muted">{{ $donation->email }}</small>
                            </td>
                            <td>{{ $donation->donationCategory?->name ?? '—' }}</td>
                            <td class="font-weight-bold">৳{{ number_format($donation->amount, 2) }}</td>
                            <td>{{ $donation->paymentMethod?->name ?? '—' }}</td>
                            <td>{{ $donation->created_at->format('d M Y') }}</td>
                            <td>
                                @if($donation->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($donation->status === 'verified')
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-danger">Canceled</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.donations.show', $donation) }}" class="btn btn-xs btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this donation record?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center text-muted py-3">No donations yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($donations->hasPages())
            <div class="card-footer">{{ $donations->links() }}</div>
            @endif
        </div>
    </div>
</section>
@endsection
