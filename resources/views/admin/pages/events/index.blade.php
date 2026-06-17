@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Events List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Event
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
                                <th style="width: 80px">Thumbnail</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr>
                                    <td>
                                        @if($event->thumbnail_path)
                                            <img src="{{ asset('storage/' . $event->thumbnail_path) }}"
                                                 alt="{{ $event->title }}"
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
                                        <strong>{{ $event->title }}</strong>
                                    </td>
                                    <td>{{ $event->date->format('M d, Y') }}</td>
                                    <td>{{ $event->venue }}</td>
                                    <td>
                                        @if($event->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.event-registrations.index', $event) }}"
                                               class="btn btn-sm btn-success"
                                               title="Registrations">
                                                <i class="fas fa-users"></i>
                                            </a>
                                            <a href="{{ route('admin.events.show', $event->id) }}"
                                               class="btn btn-sm btn-primary"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.events.edit', $event->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.events.destroy', $event->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this event?');">
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
                                    <td colspan="6" class="text-center">
                                        <p class="text-muted mb-0">No events found.</p>
                                        <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Add Your First Event
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($events->hasPages())
                    <div class="mt-3">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
