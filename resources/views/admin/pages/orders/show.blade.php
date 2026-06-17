@extends("admin.layouts.master")

@section("content")
<div class="row">

    {{-- Left Column --}}
    <div class="col-md-8">

        {{-- Order Items --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order #{{ $order->id }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($item->product?->image_path)
                                            <img src="{{ asset('storage/' . $item->product->image_path) }}"
                                                 style="width:40px;height:40px;object-fit:cover;border-radius:4px;"
                                                 alt="">
                                        @endif
                                        {{ $item->product?->title ?? 'Deleted product' }}
                                    </div>
                                </td>
                                <td>৳{{ number_format($item->unit_price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>৳{{ number_format($item->lineTotal(), 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Subtotal</td>
                            <td>৳{{ number_format($order->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Delivery Charge</td>
                            <td>৳{{ number_format($order->delivery_charge, 2) }}</td>
                        </tr>
                        <tr class="table-active">
                            <td colspan="3" class="text-right font-weight-bold">Total</td>
                            <td class="font-weight-bold">৳{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Payment Info --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Payment Information</h3></div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Method</dt>
                    <dd class="col-sm-8">{{ $order->paymentMethod?->name ?? '—' }}</dd>

                    <dt class="col-sm-4">Transaction ID</dt>
                    <dd class="col-sm-8"><code>{{ $order->transaction_id }}</code></dd>

                    <dt class="col-sm-4">Payment Proof</dt>
                    <dd class="col-sm-8">
                        @if($order->payment_proof_path)
                            <a href="{{ asset('storage/' . $order->payment_proof_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $order->payment_proof_path) }}"
                                     style="max-height:120px;border-radius:6px;border:1px solid #dee2e6;">
                            </a>
                        @else
                            <span class="text-muted">None uploaded</span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>

    </div>

    {{-- Right Column --}}
    <div class="col-md-4">

        {{-- Customer --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Customer</h3></div>
            <div class="card-body">
                <dl class="row mb-0" style="font-size:.9rem;">
                    <dt class="col-5">Name</dt>
                    <dd class="col-7">{{ $order->full_name }}</dd>

                    <dt class="col-5">Email</dt>
                    <dd class="col-7">{{ $order->email }}</dd>

                    <dt class="col-5">Phone</dt>
                    <dd class="col-7">{{ $order->phone }}</dd>

                    @if($order->user)
                        <dt class="col-5">Member</dt>
                        <dd class="col-7">
                            <a href="{{ route('admin.registered-members.show', $order->user_id) }}">
                                #{{ $order->user_id }}
                            </a>
                        </dd>
                    @endif
                </dl>
            </div>
        </div>

        {{-- Addresses --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Addresses</h3></div>
            <div class="card-body" style="font-size:.9rem;">
                <p class="font-weight-bold mb-1">Billing</p>
                <p class="text-muted mb-3">{{ $order->billing_address }}</p>
                <p class="font-weight-bold mb-1">Shipping</p>
                <p class="text-muted mb-0">{{ $order->shipping_address }}</p>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Update Status</h3></div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @foreach(\App\Models\Order::STATUSES as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Admin Notes <small class="text-muted">(optional)</small></label>
                        <textarea name="admin_notes" class="form-control" rows="3"
                                  placeholder="Internal notes for this order">{{ $order->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Save
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
