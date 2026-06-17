@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payment Methods</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 70px">#</th>
                                <th style="width: 80px">Logo</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Wallet Number</th>
                                <th style="width: 80px">QR Code</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentMethods as $method)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($method->logo_path)
                                            <img src="{{ asset('storage/' . $method->logo_path) }}"
                                                 alt="{{ $method->name }}"
                                                 style="width: 50px; height: 50px; object-fit: contain;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-credit-card text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td><strong>{{ $method->name }}</strong></td>
                                    <td>{{ $method->label??'—' }}</td>
                                    <td>{{ $method->wallet_number ?? '—' }}</td>
                                    <td>
                                        @if($method->qr_image_path)
                                            <img src="{{ asset('storage/' . $method->qr_image_path) }}"
                                                 alt="QR Code"
                                                 style="width: 50px; height: 50px; object-fit: contain;">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($method->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.payment-methods.edit', $method->id) }}"
                                               class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.payment-methods.destroy', $method->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this payment method?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <p class="text-muted mb-0">No payment methods found.</p>
                                        <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add First Payment Method
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($paymentMethods->hasPages())
                    <div class="mt-3">
                        {{ $paymentMethods->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
