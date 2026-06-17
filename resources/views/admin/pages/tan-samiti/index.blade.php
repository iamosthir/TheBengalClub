@extends("admin.layouts.master")

@section("title", "Investment Plans")

@section("content")
<div class="row">
    <div class="col-12">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">All Investment Plans</h3>
                <a href="{{ route('admin.tan-samiti.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> New Investment Plan
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Monthly Amount</th>
                            <th>Cycles</th>
                            <th>Members</th>
                            <th>Lottery</th>
                            <th>Draws Done</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($samitis as $samiti)
                        <tr>
                            <td>{{ $samiti->id }}</td>
                            <td><strong>{{ $samiti->name }}</strong></td>
                            <td>৳{{ number_format($samiti->monthly_amount, 2) }}</td>
                            <td>{{ $samiti->total_cycles }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $samiti->active_members_count }}@if($samiti->hasMemberLimit()) / {{ $samiti->member_limit }}@endif
                                </span>
                            </td>
                            <td>
                                @if($samiti->lotteryEnabled())
                                    <span class="badge badge-success">Enabled</span>
                                @else
                                    <span class="badge badge-secondary">Disabled</span>
                                @endif
                            </td>
                            <td>
                                @if($samiti->lotteryEnabled())
                                    <span class="badge badge-{{ $samiti->draws_count >= $samiti->total_cycles ? 'success' : 'secondary' }}">
                                        {{ $samiti->draws_count }} / {{ $samiti->total_cycles }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($samiti->isActive())
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tan-samiti.show', $samiti) }}" class="btn btn-sm btn-info" title="Manage">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($samiti->lotteryEnabled())
                                    <a href="{{ route('admin.tan-samiti.draw.show', $samiti) }}" class="btn btn-sm btn-warning" title="Lottery Draw">
                                        <i class="fas fa-random"></i>
                                    </a>
                                @endif
                                <a href="{{ route('admin.tan-samiti.edit', $samiti) }}" class="btn btn-sm btn-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tan-samiti.destroy', $samiti) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this Investment Plan? All data will be lost.')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No Investment Plan found. <a href="{{ route('admin.tan-samiti.create') }}">Create one</a>.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($samitis->hasPages())
            <div class="card-footer">
                {{ $samitis->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
