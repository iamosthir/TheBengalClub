@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Membership Categories</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.membership-categories.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Category
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
                                <th>Title</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Badge</th>
                                <th>Invite Only</th>
                                <th>Features</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td><strong>{{ $category->title }}</strong></td>
                                    <td>${{ number_format($category->price, 2) }}</td>
                                    <td><span class="badge badge-secondary">{{ $category->duration }}</span></td>
                                    <td>{{ $category->badge_text ?? 'N/A' }}</td>
                                    <td>
                                        @if($category->is_invite_only)
                                            <span class="badge badge-warning">Yes</span>
                                        @else
                                            <span class="badge badge-success">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->features && count($category->features) > 0)
                                            <span class="badge badge-info">{{ count($category->features) }} features</span>
                                        @else
                                            <span class="text-muted">No features</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.membership-categories.edit', $category->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.membership-categories.destroy', $category->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this membership category?');">
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
                                        <p class="text-muted mb-0">No membership categories found.</p>
                                        <a href="{{ route('admin.membership-categories.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add Your First Category
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($categories->hasPages())
                    <div class="mt-3">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
