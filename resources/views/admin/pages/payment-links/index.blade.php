@extends("admin.layouts.master")

@section("content")
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Payment Links</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payment Links</li>
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
                    <a href="{{ route('admin.payment-links.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i> Create Payment Link
                    </a>
                </div>
            </div>
            <div class="card-body pb-1">
                <form method="GET" action="{{ route('admin.payment-links.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="small font-weight-bold">Status</label>
                                @php $activeStatus = request('status', ''); @endphp
                                <select name="status" class="form-control form-control-sm">
                                    <option value=""          {{ $activeStatus === ''          ? 'selected' : '' }}>All</option>
                                    <option value="pending"   {{ $activeStatus === 'pending'   ? 'selected' : '' }}>Pending (Awaiting Payment)</option>
                                    <option value="submitted" {{ $activeStatus === 'submitted' ? 'selected' : '' }}>Submitted (Awaiting Review)</option>
                                    <option value="verified"  {{ $activeStatus === 'verified'  ? 'selected' : '' }}>Verified</option>
                                    <option value="canceled"  {{ $activeStatus === 'canceled'  ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="small font-weight-bold">Search (name / phone / email)</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                       class="form-control form-control-sm" placeholder="Search…">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-group w-100">
                                <label class="small d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-sm mr-1">
                                    <i class="fas fa-search mr-1"></i> Apply
                                </button>
                                <a href="{{ route('admin.payment-links.index') }}" class="btn btn-secondary btn-sm">
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
                <h3 class="card-title"><i class="fas fa-link mr-2"></i> All Payment Links</h3>
                <div class="card-tools">
                    <span class="badge badge-primary badge-lg">{{ $links->total() }} link(s)</span>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Payment Info</th>
                            <th>Created</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($links as $link)
                        <tr>
                            <td>
                                <div class="font-weight-bold">{{ $link->name }}</div>
                                @if($link->phone)<div class="text-muted small"><i class="fas fa-phone-alt mr-1"></i>{{ $link->phone }}</div>@endif
                                @if($link->email)<div class="text-muted small"><i class="fas fa-envelope mr-1"></i>{{ $link->email }}</div>@endif
                            </td>
                            <td class="font-weight-bold text-accent">৳{{ number_format($link->amount, 2) }}</td>
                            <td><span class="text-muted small">{{ $link->purpose ?? '—' }}</span></td>
                            <td>
                                @switch($link->status)
                                    @case('pending')   <span class="badge badge-secondary">Pending</span> @break
                                    @case('submitted') <span class="badge badge-warning">Submitted</span> @break
                                    @case('verified')  <span class="badge badge-success">Verified</span> @break
                                    @case('canceled')  <span class="badge badge-danger">Canceled</span> @break
                                @endswitch
                            </td>
                            <td>
                                @if($link->transaction_id)
                                    <div class="small">{{ $link->paymentMethod->name ?? '—' }}</div>
                                    <code class="small">{{ $link->transaction_id }}</code>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $link->created_at->format('M j, Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.payment-links.show', $link) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i> View & Share
                                </a>
                                <form action="{{ route('admin.payment-links.destroy', $link) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Permanently delete this payment link?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-link fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-2 font-weight-bold">No payment links yet</p>
                                <a href="{{ route('admin.payment-links.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus mr-1"></i> Create your first payment link
                                </a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($links->hasPages())
                <div class="card-footer">
                    {{ $links->links() }}
                </div>
            @endif
        </div>

    </div>
</section>
@endsection
