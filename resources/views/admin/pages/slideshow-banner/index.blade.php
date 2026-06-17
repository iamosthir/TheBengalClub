@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Slideshow Banner List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.slideshow-banner.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Banner
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
                                <th style="width: 100px">Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th style="width: 100px">Action Button</th>
                                <th style="width: 120px">Created At</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $banner)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">{{ $banner->order }}</span>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $banner->image_path) }}"
                                             alt="{{ $banner->title }}"
                                             class="img-thumbnail"
                                             style="max-width: 80px; max-height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $banner->title }}</strong>
                                    </td>
                                    <td>{{ $banner->subtitle ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        @if($banner->enable_action_button)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check"></i> Enabled
                                            </span>
                                            @if($banner->button_text)
                                                <br>
                                                <small class="text-muted">{{ $banner->button_text }}</small>
                                            @endif
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-times"></i> Disabled
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $banner->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.slideshow-banner.edit', $banner->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.slideshow-banner.destroy', $banner->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this banner?');">
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
                                        <p class="text-muted mb-0">No slideshow banners found.</p>
                                        <a href="{{ route('admin.slideshow-banner.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add Your First Banner
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
