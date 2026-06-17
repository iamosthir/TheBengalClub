@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Inquiry Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <!-- Inquiry Information -->
                    <div class="col-md-8">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-envelope"></i> Message Details
                                </h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-3">Subject:</dt>
                                    <dd class="col-sm-9">
                                        <h5>{{ $inquiry->subject }}</h5>
                                    </dd>

                                    <dt class="col-sm-3">Message:</dt>
                                    <dd class="col-sm-9">
                                        <div class="border rounded p-3 bg-light">
                                            {!! nl2br(e($inquiry->message)) !!}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card card-outline card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-tasks"></i> Quick Actions
                                </h3>
                            </div>
                            <div class="card-body">
                                <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ $inquiry->subject }}"
                                   class="btn btn-primary">
                                    <i class="fas fa-reply"></i> Reply via Email
                                </a>

                                @if($inquiry->phone)
                                <a href="tel:{{ $inquiry->phone }}" class="btn btn-success">
                                    <i class="fas fa-phone"></i> Call
                                </a>
                                @endif

                                <button type="button" class="btn btn-danger float-right" id="delete-btn">
                                    <i class="fas fa-trash"></i> Delete
                                </button>

                                @if($inquiry->is_viewed)
                                <button type="button" class="btn btn-warning" id="mark-unread-btn">
                                    <i class="fas fa-envelope"></i> Mark as Unread
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sender Information -->
                    <div class="col-md-4">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user"></i> Sender Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">Name:</dt>
                                    <dd class="col-sm-8">
                                        <strong>{{ $inquiry->name }}</strong>
                                    </dd>

                                    <dt class="col-sm-4">Email:</dt>
                                    <dd class="col-sm-8">
                                        <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                                    </dd>

                                    <dt class="col-sm-4">Phone:</dt>
                                    <dd class="col-sm-8">
                                        @if($inquiry->phone)
                                            <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">IP Address:</dt>
                                    <dd class="col-sm-8">
                                        <code>{{ $inquiry->ip_address }}</code>
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <div class="card card-outline card-warning">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-clock"></i> Timeline
                                </h3>
                            </div>
                            <div class="card-body">
                                <dl class="row mb-0">
                                    <dt class="col-sm-5">Received:</dt>
                                    <dd class="col-sm-7">
                                        <small>{{ $inquiry->created_at->format('M d, Y') }}</small><br>
                                        <small class="text-muted">{{ $inquiry->created_at->format('h:i A') }}</small><br>
                                        <small class="text-info">{{ $inquiry->created_at->diffForHumans() }}</small>
                                    </dd>

                                    <dt class="col-sm-5">Status:</dt>
                                    <dd class="col-sm-7">
                                        @if($inquiry->is_viewed)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check"></i> Read
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="fas fa-envelope"></i> Unread
                                            </span>
                                        @endif
                                    </dd>

                                    @if($inquiry->is_viewed && $inquiry->updated_at->ne($inquiry->created_at))
                                    <dt class="col-sm-5">Read at:</dt>
                                    <dd class="col-sm-7">
                                        <small>{{ $inquiry->updated_at->format('M d, Y') }}</small><br>
                                        <small class="text-muted">{{ $inquiry->updated_at->format('h:i A') }}</small>
                                    </dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
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
    // Delete inquiry
    $('#delete-btn').on('click', function() {
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
                    'action': '{{ route("admin.inquiries.destroy", $inquiry) }}'
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

    // Mark as unread
    $('#mark-unread-btn').on('click', function() {
        $.ajax({
            url: '{{ route("admin.inquiries.mark-unread", $inquiry) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
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
                    text: 'Failed to update status.'
                });
            }
        });
    });
});
</script>
@endpush
