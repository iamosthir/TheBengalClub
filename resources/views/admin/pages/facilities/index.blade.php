@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Facilities List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Facility
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

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 80px">Image</th>
                                <th>Name</th>
                                <th>Tag Line</th>
                                <th>Features</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($facilities as $facility)
                                <tr>
                                    <td>
                                        @if($facility->image_path)
                                            <img src="{{ asset('storage/' . $facility->image_path) }}"
                                                 alt="{{ $facility->name }}"
                                                 class="img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image fa-2x"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $facility->name }}</strong>
                                    </td>
                                    <td>{{ $facility->tag_line ?? 'N/A' }}</td>
                                    <td>
                                        @if($facility->features && count($facility->features) > 0)
                                            <span class="badge badge-info">{{ count($facility->features) }} features</span>
                                        @else
                                            <span class="text-muted">No features</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.facilities.edit', $facility->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.facilities.destroy', $facility->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this facility?');">
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
                                    <td colspan="5" class="text-center">
                                        <p class="text-muted mb-0">No facilities found.</p>
                                        <a href="{{ route('admin.facilities.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add Your First Facility
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($facilities->hasPages())
                    <div class="mt-3">
                        {{ $facilities->links() }}
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
