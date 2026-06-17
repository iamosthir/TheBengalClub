@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders</h3>
                <div class="card-tools d-flex gap-2">
                    <form method="GET" class="d-flex" style="gap:6px;">
                        <select name="status" class="form-control form-control-sm" style="width:140px;">
                            <option value="">All Statuses</option>
                            @foreach(\App\Models\Order::STATUSES as $s)
                                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-secondary" type="submit">
                            <i class="fas fa-filter"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <strong>{{ $order->full_name }}</strong><br>
                                        <small class="text-muted">{{ $order->email }}</small>
                                    </td>
                                    <td>
                                        @foreach($order->items as $item)
                                            <div>{{ $item->product?->title ?? 'Deleted product' }} &times;{{ $item->quantity }}</div>
                                        @endforeach
                                    </td>
                                    <td>৳{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        {{ $order->paymentMethod?->name ?? '—' }}<br>
                                        <small class="text-muted font-monospace">{{ $order->transaction_id }}</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $order->statusBadgeClass() }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('M j, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center text-muted">No orders yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
