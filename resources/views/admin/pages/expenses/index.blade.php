@extends('admin.layouts.master')
@section('title', 'Expenses')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Expenses</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Expenses</li>
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

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">All Expenses</h3>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <form method="GET" class="d-flex" style="gap:6px;">
                        <select name="category" class="form-control form-control-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-secondary">Filter</button>
                        @if(request('category'))
                            <a href="{{ route('admin.expenses.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
                        @endif
                    </form>
                    <a href="{{ route('admin.expenses.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Expense
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Attachment</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>
                                @if($expense->donationCategory)
                                    <span class="badge badge-info">{{ $expense->donationCategory->name }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $expense->description }}</td>
                            <td class="font-weight-bold text-danger">৳{{ number_format($expense->amount, 2) }}</td>
                            <td>
                                @if($expense->attachment_path)
                                    @php $ext = pathinfo($expense->attachment_path, PATHINFO_EXTENSION); @endphp
                                    @if(in_array(strtolower($ext), ['jpg','jpeg','png']))
                                        <a href="{{ asset('storage/'.$expense->attachment_path) }}" target="_blank">
                                            <img src="{{ asset('storage/'.$expense->attachment_path) }}"
                                                 style="height:36px;width:48px;object-fit:cover;border-radius:4px;">
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/'.$expense->attachment_path) }}" target="_blank"
                                           class="btn btn-xs btn-outline-secondary">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </a>
                                    @endif
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $expense->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.expenses.edit', $expense) }}" class="btn btn-xs btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.expenses.destroy', $expense) }}" method="POST"
                                      class="d-inline" onsubmit="return confirm('Delete this expense?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No expenses recorded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <span class="font-weight-bold text-danger">
                    Total: ৳{{ number_format(\App\Models\Expense::when(request('category'), fn($q) => $q->where('donation_category_id', request('category')))->sum('amount'), 2) }}
                </span>
                <div>{{ $expenses->appends(request()->query())->links() }}</div>
            </div>
        </div>

    </div>
</section>
@endsection
