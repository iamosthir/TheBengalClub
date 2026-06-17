@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Board of Directors List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.board-directors.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Director
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
                                <th style="width: 60px">Order</th>
                                <th style="width: 80px">Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Contact</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($directors as $director)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">{{ $director->order }}</span>
                                    </td>
                                    <td>
                                        @if($director->photo_path)
                                            <img src="{{ asset('storage/' . $director->photo_path) }}"
                                                 alt="{{ $director->name }}"
                                                 class="img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-user fa-2x"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $director->name }}</strong>
                                    </td>
                                    <td>{{ $director->designation ?? 'N/A' }}</td>
                                    <td>
                                        @if($director->email)
                                            <div><i class="fas fa-envelope text-muted"></i> {{ $director->email }}</div>
                                        @endif
                                        @if($director->phone)
                                            <div><i class="fas fa-phone text-muted"></i> {{ $director->phone }}</div>
                                        @endif
                                        @if(!$director->email && !$director->phone)
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($director->status)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i> Active
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times-circle"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.board-directors.edit', $director->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.board-directors.destroy', $director->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this director?');">
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
                                        <p class="text-muted mb-0">No board directors found.</p>
                                        <a href="{{ route('admin.board-directors.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add Your First Director
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
