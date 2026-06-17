@extends('admin.layouts.master')
@section('title', 'Donation Details')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Donation #{{ $donation->id }}</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></li>
                    <li class="breadcrumb-item active">#{{ $donation->id }}</li>
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

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-user mr-2"></i>Donor Information</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr><th width="180">Full Name</th><td>{{ $donation->full_name }}</td></tr>
                            <tr><th>Email</th><td>{{ $donation->email }}</td></tr>
                            <tr><th>Amount</th><td><h4 class="mb-0 text-success">৳{{ number_format($donation->amount, 2) }}</h4></td></tr>
                            <tr><th>Category</th><td>{{ $donation->donationCategory?->name ?? '—' }}</td></tr>
                            <tr><th>Payment Method</th><td>{{ $donation->paymentMethod?->name ?? '—' }}</td></tr>
                            <tr><th>Transaction ID</th><td><code>{{ $donation->transaction_id ?? '—' }}</code></td></tr>
                            <tr><th>IP Address</th><td>{{ $donation->ip_address ?? '—' }}</td></tr>
                            <tr><th>Submitted At</th><td>{{ $donation->created_at->format('F j, Y h:i A') }}</td></tr>
                        </table>
                    </div>
                </div>

                @if($donation->payment_proof_path)
                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-image mr-2"></i>Payment Proof</h3></div>
                    <div class="card-body text-center">
                        <a href="{{ asset('storage/' . $donation->payment_proof_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $donation->payment_proof_path) }}"
                                 alt="Payment Proof" class="img-fluid img-thumbnail" style="max-height:300px;">
                        </a>
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $donation->payment_proof_path) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-external-link-alt"></i> Open Full Size
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <!-- Status Card -->
                <div class="card">
                    <div class="card-header
                        @if($donation->status === 'verified') bg-success
                        @elseif($donation->status === 'canceled') bg-danger
                        @else bg-warning @endif">
                        <h3 class="card-title text-white">
                            <i class="fas fa-info-circle mr-2"></i>Status:
                            <span class="font-weight-bold">{{ ucfirst($donation->status) }}</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($donation->note)
                            <div class="alert alert-info py-2">
                                <strong>Note:</strong> {{ $donation->note }}
                            </div>
                        @endif

                        <form action="{{ route('admin.donations.update-status', $donation) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Admin Note <span class="text-muted">(optional)</span></label>
                                <textarea name="note" class="form-control" rows="2"
                                          placeholder="Leave a note...">{{ old('note', $donation->note) }}</textarea>
                            </div>
                            <button type="submit" name="status" value="verified"
                                    class="btn btn-success btn-block mb-2 {{ $donation->status === 'verified' ? 'disabled' : '' }}"
                                    onclick="return confirm('Mark this donation as verified?');">
                                <i class="fas fa-check-circle mr-1"></i> Mark as Verified
                            </button>
                            <button type="submit" name="status" value="canceled"
                                    class="btn btn-danger btn-block {{ $donation->status === 'canceled' ? 'disabled' : '' }}"
                                    onclick="return confirm('Cancel this donation?');">
                                <i class="fas fa-times-circle mr-1"></i> Cancel Donation
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
