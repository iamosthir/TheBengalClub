@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Inquiries</h3>
                <div class="card-tools">
                    <span class="badge badge-info">
                        <i class="fas fa-envelope"></i> {{ $unreadCount }} Unread
                    </span>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if($inquiries->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">No inquiries yet</h5>
                        <p class="text-muted">Contact form submissions will appear here.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th width="5%">Status</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">Email</th>
                                    <th width="15%">Phone</th>
                                    <th width="15%">Subject</th>
                                    <th width="15%">Date</th>
                                    <th width="10%">IP Address</th>
                                    <th width="5%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquiries as $inquiry)
                                <tr class="{{ !$inquiry->is_viewed ? 'table-info' : '' }}">
                                    <td>
                                        <input type="checkbox" class="inquiry-checkbox" value="{{ $inquiry->id }}">
                                    </td>
                                    <td>
                                        @if($inquiry->is_viewed)
                                            <span class="badge badge-success" title="Read">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="badge badge-warning" title="Unread">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $inquiry->name }}</strong>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                                    </td>
                                    <td>
                                        @if($inquiry->phone)
                                            <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $inquiry->subject }}</td>
                                    <td>
                                        <small title="{{ $inquiry->created_at->format('Y-m-d H:i:s') }}">
                                            {{ $inquiry->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $inquiry->ip_address }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.inquiries.show', $inquiry) }}"
                                               class="btn btn-info btn-sm"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm delete-btn"
                                                    data-id="{{ $inquiry->id }}"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Actions -->
                    <div class="mt-3">
                        <button type="button" class="btn btn-danger btn-sm" id="bulk-delete-btn" disabled>
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $inquiries->links() }}
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Select all checkboxes
    $('#select-all').on('change', function() {
        $('.inquiry-checkbox').prop('checked', this.checked);
        toggleBulkDeleteButton();
    });

    // Individual checkbox change
    $('.inquiry-checkbox').on('change', function() {
        toggleBulkDeleteButton();
    });

    // Toggle bulk delete button
    function toggleBulkDeleteButton() {
        const checkedCount = $('.inquiry-checkbox:checked').length;
        $('#bulk-delete-btn').prop('disabled', checkedCount === 0);
    }

    // Single delete
    $('.delete-btn').on('click', function() {
        const inquiryId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create and submit form
                const form = $('<form>', {
                    'method': 'POST',
                    'action': '/admin/inquiries/' + inquiryId
                });

                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': '{{ csrf_token() }}'
                }));

                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_method',
                    'value': 'DELETE'
                }));

                $('body').append(form);
                form.submit();
            }
        });
    });

    // Bulk delete
    $('#bulk-delete-btn').on('click', function() {
        const selectedIds = $('.inquiry-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete ${selectedIds.length} inquiries!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete them!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.inquiries.bulk-delete") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: selectedIds
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message,
                            timer: 2000
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to delete inquiries.'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush
