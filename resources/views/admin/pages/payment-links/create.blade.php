@extends("admin.layouts.master")

@section("content")
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Payment Link</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.payment-links.index') }}">Payment Links</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Payment Link Details</h3>
                    </div>
                    <form action="{{ route('admin.payment-links.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="name">Recipient Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Who is this payment for?"
                                       value="{{ old('name') }}" required>
                                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount (BDT) <span class="text-danger">*</span></label>
                                <input type="number" name="amount" id="amount"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       placeholder="e.g. 1500" min="1" step="0.01"
                                       value="{{ old('amount') }}" required>
                                @error('amount')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone <span class="text-muted">(optional)</span></label>
                                        <input type="text" name="phone" id="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               placeholder="e.g. 01XXXXXXXXX"
                                               value="{{ old('phone') }}">
                                        @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                        <small class="form-text text-muted">Used to pre-fill the WhatsApp share.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-muted">(optional)</span></label>
                                        <input type="email" name="email" id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="name@example.com"
                                               value="{{ old('email') }}">
                                        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="purpose">Purpose / Note <span class="text-muted">(optional)</span></label>
                                <input type="text" name="purpose" id="purpose"
                                       class="form-control @error('purpose') is-invalid @enderror"
                                       placeholder="e.g. Annual membership fee, Event ticket…"
                                       value="{{ old('purpose') }}">
                                @error('purpose')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                <small class="form-text text-muted">Shown to the payer on the payment page.</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-link mr-1"></i> Create & Get Share Link
                            </button>
                            <a href="{{ route('admin.payment-links.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <h5><i class="fas fa-info-circle text-info mr-1"></i> How it works</h5>
                        <ol class="pl-3 mb-0 small text-muted">
                            <li>Create a link with the amount.</li>
                            <li>Share the URL via WhatsApp, Telegram or copy it.</li>
                            <li>The payer opens it and pays using your existing manual payment methods (bKash, Nagad, etc.).</li>
                            <li>They submit the transaction ID + screenshot.</li>
                            <li>You verify the payment from the link's page.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
