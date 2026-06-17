@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Announcements</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New
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
                                <th style="width: 50px">#</th>
                                <th style="width: 90px">Image</th>
                                <th>Title</th>
                                <th style="width: 120px">Start Date</th>
                                <th style="width: 120px">End Date</th>
                                <th style="width: 90px">Status</th>
                                <th style="width: 90px">Visible</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($announcements as $announcement)
                                @php
                                    $today    = now()->toDateString();
                                    $isLive   = $announcement->is_active
                                                && $announcement->start_date->toDateString() <= $today
                                                && $announcement->end_date->toDateString()   >= $today;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($announcement->image_path)
                                            <img src="{{ asset('storage/' . $announcement->image_path) }}"
                                                 alt="{{ $announcement->title }}"
                                                 style="width: 70px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                                                 style="width: 70px; height: 50px; border-radius: 4px; font-size: 11px;">
                                                No image
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $announcement->title }}</strong>
                                        @if($announcement->message)
                                            <br><small class="text-muted">{{ Str::limit($announcement->message, 80) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $announcement->start_date->format('d M Y') }}</td>
                                    <td>{{ $announcement->end_date->format('d M Y') }}</td>
                                    <td>
                                        @if($announcement->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($isLive)
                                            <span class="badge badge-info"><i class="fas fa-broadcast-tower"></i> Live</span>
                                        @elseif($announcement->start_date->toDateString() > $today)
                                            <span class="badge badge-warning">Upcoming</span>
                                        @else
                                            <span class="badge badge-light">Expired</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                                               class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Delete this announcement?');">
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
                                    <td colspan="8" class="text-center">
                                        <p class="text-muted mb-0">No announcements found.</p>
                                        <a href="{{ route('admin.announcements.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add First Announcement
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($announcements->hasPages())
                    <div class="mt-3">
                        {{ $announcements->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
