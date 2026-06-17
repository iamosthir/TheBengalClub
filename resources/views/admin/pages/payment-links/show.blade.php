@extends("admin.layouts.master")

@php
    $publicUrl = route('payment-link.show', $paymentLink->token);

    // WhatsApp needs an international number (no +). Default BD: a leading 0 → 880.
    $waNumber = preg_replace('/\D+/', '', (string) $paymentLink->phone);
    if ($waNumber !== '' && str_starts_with($waNumber, '0')) {
        $waNumber = '880' . substr($waNumber, 1);
    }

    $shareText = 'Hi ' . $paymentLink->name . ', please complete your payment of ৳'
        . number_format($paymentLink->amount, 2) . ' here: ' . $publicUrl;

    $waUrl = $waNumber !== ''
        ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($shareText)
        : 'https://wa.me/?text=' . rawurlencode($shareText);
    $tgUrl = 'https://t.me/share/url?url=' . rawurlencode($publicUrl) . '&text=' . rawurlencode($shareText);
    $mailUrl = 'mailto:' . $paymentLink->email . '?subject=' . rawurlencode('Payment Request')
        . '&body=' . rawurlencode($shareText);
@endphp

@section("content")
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Payment Link</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.payment-links.index') }}">Payment Links</a></li>
                    <li class="breadcrumb-item active">View</li>
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

        <div class="row">
            {{-- Share panel --}}
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-share-alt mr-2"></i>Share Payment Link</h3>
                    </div>
                    <div class="card-body">
                        <label class="small font-weight-bold">Payment URL</label>
                        <div class="input-group mb-3">
                            <input type="text" id="payment-url" class="form-control" value="{{ $publicUrl }}" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" id="copy-url-btn">
                                    <i class="fas fa-copy"></i> Copy
                                </button>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap" style="gap:.5rem;">
                            <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn btn-success">
                                <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                            </a>
                            <a href="{{ $tgUrl }}" target="_blank" rel="noopener" class="btn btn-info">
                                <i class="fab fa-telegram-plane mr-1"></i> Telegram
                            </a>
                            @if($paymentLink->email)
                            <a href="{{ $mailUrl }}" class="btn btn-secondary">
                                <i class="fas fa-envelope mr-1"></i> Email
                            </a>
                            @endif
                        </div>
                        <small class="form-text text-muted mt-2">
                            Anyone with this link can open the payment page and pay the fixed amount.
                        </small>
                    </div>
                </div>
            </div>

            {{-- Details panel --}}
            <div class="col-md-6">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-receipt mr-2"></i>Details</h3>
                        <div class="card-tools">
                            @switch($paymentLink->status)
                                @case('pending')   <span class="badge badge-secondary">Pending</span> @break
                                @case('submitted') <span class="badge badge-warning">Submitted — Awaiting Review</span> @break
                                @case('verified')  <span class="badge badge-success">Verified</span> @break
                                @case('canceled')  <span class="badge badge-danger">Canceled</span> @break
                            @endswitch
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm mb-0">
                            <tr><th style="width:40%">Recipient</th><td>{{ $paymentLink->name }}</td></tr>
                            <tr><th>Amount</th><td class="font-weight-bold text-accent">৳{{ number_format($paymentLink->amount, 2) }}</td></tr>
                            <tr><th>Phone</th><td>{{ $paymentLink->phone ?? '—' }}</td></tr>
                            <tr><th>Email</th><td>{{ $paymentLink->email ?? '—' }}</td></tr>
                            <tr><th>Purpose</th><td>{{ $paymentLink->purpose ?? '—' }}</td></tr>
                            <tr><th>Created</th><td>{{ $paymentLink->created_at->format('M j, Y H:i') }}{{ $paymentLink->createdByAdmin ? ' by ' . $paymentLink->createdByAdmin->name : '' }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submitted payment --}}
        @if($paymentLink->transaction_id)
        <div class="card card-outline {{ $paymentLink->isVerified() ? 'card-success' : 'card-warning' }}">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-money-check-alt mr-2"></i>Submitted Payment</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-sm">
                            <tr>
                                <th style="width:30%">Payment Method</th>
                                <td>
                                    @if($paymentLink->paymentMethod?->logo_path)
                                        <img src="{{ asset('storage/' . $paymentLink->paymentMethod->logo_path) }}"
                                             style="width:24px;height:24px;object-fit:contain;" class="mr-2">
                                    @endif
                                    {{ $paymentLink->paymentMethod->name ?? '—' }}
                                </td>
                            </tr>
                            <tr><th>Transaction ID</th><td><code>{{ $paymentLink->transaction_id }}</code></td></tr>
                            <tr><th>Submitted At</th><td>{{ $paymentLink->submitted_at?->format('M j, Y H:i') ?? '—' }}</td></tr>
                            @if($paymentLink->isVerified())
                            <tr><th>Verified At</th><td class="text-success">{{ $paymentLink->verified_at?->format('M j, Y H:i') }}{{ $paymentLink->verifiedByAdmin ? ' by ' . $paymentLink->verifiedByAdmin->name : '' }}</td></tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-4 text-center">
                        @if($paymentLink->payment_proof_path)
                            <label class="small font-weight-bold d-block">Payment Proof</label>
                            <a href="{{ asset('storage/' . $paymentLink->payment_proof_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $paymentLink->payment_proof_path) }}"
                                     class="img-thumbnail" style="max-height:160px;object-fit:cover;">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                @if($paymentLink->isSubmitted())
                    <form action="{{ route('admin.payment-links.verify', $paymentLink) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Mark this payment as verified?');">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-circle mr-1"></i> Verify Payment
                        </button>
                    </form>
                @elseif($paymentLink->isVerified())
                    <span class="text-success font-weight-bold"><i class="fas fa-lock mr-1"></i> Verified</span>
                @endif
            </div>
        </div>
        @else
            <div class="alert alert-light border">
                <i class="fas fa-hourglass-half mr-1 text-muted"></i>
                No payment has been submitted against this link yet.
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.payment-links.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
            @if(! $paymentLink->isVerified() && ! $paymentLink->isCanceled())
                <form action="{{ route('admin.payment-links.cancel', $paymentLink) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Cancel this payment link? It will stop accepting payments.');">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-ban mr-1"></i> Cancel Link
                    </button>
                </form>
            @endif
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('copy-url-btn').addEventListener('click', function () {
    const input = document.getElementById('payment-url');
    input.select();
    input.setSelectionRange(0, 99999);

    const done = () => {
        const btn = this;
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Copied';
        setTimeout(() => { btn.innerHTML = original; }, 1500);
    };

    if (navigator.clipboard) {
        navigator.clipboard.writeText(input.value).then(done).catch(() => { document.execCommand('copy'); done(); });
    } else {
        document.execCommand('copy');
        done();
    }
});
</script>
@endpush
