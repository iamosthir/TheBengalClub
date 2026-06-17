@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registered Members List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.registered-members.export', ['category' => request('category'), 'search' => request('search')]) }}"
                       class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="{{ route('admin.registered-members.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Member
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('admin.registered-members.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       placeholder="Search by name, email, mobile, or NID/Passport..."
                                       value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-control">
                                <option value="">All Membership Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.registered-members.index') }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 60px">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Membership Category</th>
                                <th>Registration Date</th>
                                <th style="width: 210px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->isSuspended())
                                            <span class="badge badge-danger ml-1">
                                                <i class="fas fa-ban"></i> Suspended
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fas fa-envelope text-muted"></i> {{ $user->email }}
                                    </td>
                                    <td>
                                        @if($user->profile && $user->profile->mobile)
                                            <i class="fas fa-phone text-muted"></i> {{ $user->profile->mobile }}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->profile && $user->profile->membershipCategory)
                                            <span class="badge badge-info">
                                                {{ $user->profile->membershipCategory->title }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.registered-members.show', $user->id) }}"
                                               class="btn btn-sm btn-primary"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.registered-members.download-qr', $user->id) }}"
                                               class="btn btn-sm btn-secondary"
                                               title="Download QR Code">
                                                <i class="fas fa-qrcode"></i>
                                            </a>
                                            @if($user->profile?->membership_start_at)
                                                <a href="{{ route('admin.registered-members.show', $user->id) }}#installments"
                                                   class="btn btn-sm btn-success"
                                                   title="View Installments">
                                                    <i class="fas fa-list-ol"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.registered-members.edit', $user->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.registered-members.impersonate', $user->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('You will be logged in as this member. Click Logout on their dashboard to return here.');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning" title="Get Access">
                                                    <i class="fas fa-sign-in-alt"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.registered-members.destroy', $user->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this member? This will also delete their profile data and cannot be undone.');">
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
                                        <p class="text-muted mb-0">No registered members found.</p>
                                        <a href="{{ route('admin.registered-members.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add Your First Member
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
