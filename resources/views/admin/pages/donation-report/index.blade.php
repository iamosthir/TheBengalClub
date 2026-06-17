@extends('admin.layouts.master')
@section('title', 'Donation Report')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Donation Report</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Donation Report</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        {{-- Filter Form --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter mr-1"></i> Filter Report</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.donation-report.index') }}" class="form-inline">
                    <div class="form-group mr-3 mb-2">
                        <label class="mr-2 font-weight-bold">Year</label>
                        <select name="year" class="form-control">
                            <option value="">All Years</option>
                            @foreach(array_reverse($years) as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-3 mb-2">
                        <label class="mr-2 font-weight-bold">Month</label>
                        <select name="month" class="form-control">
                            <option value="">All Months</option>
                            @foreach($months as $num => $name)
                                <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-search mr-1"></i> Apply Filter
                        </button>
                        <a href="{{ route('admin.donation-report.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Clear
                        </a>
                    </div>
                </form>
            </div>
            @if($selectedYear || $selectedMonth)
            <div class="card-footer py-2">
                <small class="text-muted">
                    <i class="fas fa-info-circle mr-1"></i>
                    Showing report for:
                    @if($selectedMonth) <strong>{{ $months[$selectedMonth] }}</strong> @endif
                    @if($selectedYear)  <strong>{{ $selectedYear }}</strong> @endif
                </small>
            </div>
            @endif
        </div>

        {{-- Grand Summary --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>৳{{ number_format($grandTotal, 2) }}</h3>
                        <p>Total Verified Collections</p>
                    </div>
                    <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>৳{{ number_format($grandExpenses, 2) }}</h3>
                        <p>Total Expenses</p>
                    </div>
                    <div class="icon"><i class="fas fa-file-invoice-dollar"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box {{ $grandBalance >= 0 ? 'bg-info' : 'bg-warning' }}">
                    <div class="inner">
                        <h3>৳{{ number_format(abs($grandBalance), 2) }}</h3>
                        <p>Net Balance {{ $grandBalance < 0 ? '(Deficit)' : '' }}</p>
                    </div>
                    <div class="icon"><i class="fas fa-balance-scale"></i></div>
                </div>
            </div>
        </div>

        {{-- Per-Category Cards --}}
        <div class="row">
            @foreach($categories as $cat)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    {{-- Card Header with image or color --}}
                    <div class="card-header p-0" style="height:120px;overflow:hidden;position:relative;">
                        @if($cat->image_path)
                            <img src="{{ asset('storage/'.$cat->image_path) }}"
                                 style="width:100%;height:100%;object-fit:cover;">
                            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.45);"></div>
                        @else
                            <div style="width:100%;height:100%;background:linear-gradient(135deg,#007bff,#0056b3);"></div>
                        @endif
                        <div style="position:absolute;inset:0;display:flex;align-items:center;padding:16px;">
                            <div>
                                <h5 class="text-white font-weight-bold mb-0">{{ $cat->name }}</h5>
                                <span class="badge {{ $cat->status === 'active' ? 'badge-success' : 'badge-secondary' }} mt-1">
                                    {{ ucfirst($cat->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        {{-- Collection row --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center" style="gap:8px;">
                                <div style="width:10px;height:10px;border-radius:50%;background:#28a745;flex-shrink:0;"></div>
                                <span class="text-muted small">Verified Collections</span>
                            </div>
                            <span class="font-weight-bold text-success">
                                ৳{{ number_format($cat->verified_total, 2) }}
                            </span>
                        </div>

                        {{-- Expense row --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center" style="gap:8px;">
                                <div style="width:10px;height:10px;border-radius:50%;background:#dc3545;flex-shrink:0;"></div>
                                <span class="text-muted small">Total Expenses</span>
                            </div>
                            <span class="font-weight-bold text-danger">
                                ৳{{ number_format($cat->expense_total, 2) }}
                            </span>
                        </div>

                        {{-- Progress bar: expenses vs collections --}}
                        @if($cat->verified_total > 0)
                        @php $pct = min(100, round(($cat->expense_total / $cat->verified_total) * 100)); @endphp
                        <div class="progress mb-3" style="height:6px;">
                            <div class="progress-bar bg-danger" style="width:{{ $pct }}%;"></div>
                        </div>
                        <p class="text-muted" style="font-size:11px;">{{ $pct }}% spent</p>
                        @endif

                        <hr class="mt-1 mb-2">

                        {{-- Net Balance --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold text-muted">Net Balance</span>
                            <span class="font-weight-bold h6 mb-0 {{ $cat->net_balance >= 0 ? 'text-primary' : 'text-warning' }}">
                                {{ $cat->net_balance < 0 ? '−' : '' }}৳{{ number_format(abs($cat->net_balance), 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent d-flex" style="gap:8px;">
                        <a href="{{ route('admin.donations.index', ['status' => 'verified']) }}"
                           class="btn btn-xs btn-outline-success flex-fill text-center">
                            <i class="fas fa-donate mr-1"></i>{{ $cat->verified_count }} Donations
                        </a>
                        <a href="{{ route('admin.expenses.index', ['category' => $cat->id]) }}"
                           class="btn btn-xs btn-outline-danger flex-fill text-center">
                            <i class="fas fa-receipt mr-1"></i>Expenses
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Uncategorized card --}}
            @if($uncategorizedDonations > 0 || $uncategorizedExpenses > 0)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 border-secondary">
                    <div class="card-header p-0" style="height:120px;overflow:hidden;position:relative;">
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#6c757d,#495057);"></div>
                        <div style="position:absolute;inset:0;display:flex;align-items:center;padding:16px;">
                            <div>
                                <h5 class="text-white font-weight-bold mb-0">Uncategorized</h5>
                                <span class="badge badge-light mt-1">No Category</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center" style="gap:8px;">
                                <div style="width:10px;height:10px;border-radius:50%;background:#28a745;flex-shrink:0;"></div>
                                <span class="text-muted small">Verified Collections</span>
                            </div>
                            <span class="font-weight-bold text-success">৳{{ number_format($uncategorizedDonations, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center" style="gap:8px;">
                                <div style="width:10px;height:10px;border-radius:50%;background:#dc3545;flex-shrink:0;"></div>
                                <span class="text-muted small">Total Expenses</span>
                            </div>
                            <span class="font-weight-bold text-danger">৳{{ number_format($uncategorizedExpenses, 2) }}</span>
                        </div>
                        <hr class="mt-1 mb-2">
                        @php $uncatBalance = $uncategorizedDonations - $uncategorizedExpenses; @endphp
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold text-muted">Net Balance</span>
                            <span class="font-weight-bold h6 mb-0 {{ $uncatBalance >= 0 ? 'text-primary' : 'text-warning' }}">
                                {{ $uncatBalance < 0 ? '−' : '' }}৳{{ number_format(abs($uncatBalance), 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($categories->isEmpty() && $uncategorizedDonations == 0)
            <div class="col-12">
                <div class="callout callout-info">
                    <h5>No data yet</h5>
                    <p>No verified donations or categories found. <a href="{{ route('admin.donation-categories.create') }}">Add a category</a> to get started.</p>
                </div>
            </div>
            @endif
        </div>

    </div>
</section>
@endsection
