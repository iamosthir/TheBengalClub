@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Archive List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.archive.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Item
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
                                <th style="width: 60px">Order</th>
                                <th style="width: 120px">Image</th>
                                <th>Title</th>
                                <th style="width: 120px">Added On</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($archives as $archive)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">{{ $archive->order }}</span>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $archive->image_path) }}"
                                             alt="{{ $archive->title ?? 'Archive' }}"
                                             class="img-thumbnail"
                                             style="max-width: 90px; max-height: 65px; object-fit: cover;">
                                    </td>
                                    <td>{{ $archive->title ?? '<span class="text-muted">— No title —</span>' }}</td>
                                    <td>{{ $archive->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.archive.edit', $archive->id) }}"
                                               class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.archive.destroy', $archive->id) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Delete this archive item?');">
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
                                        <p class="text-muted mb-0">No archive items found.</p>
                                        <a href="{{ route('admin.archive.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add First Item
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
