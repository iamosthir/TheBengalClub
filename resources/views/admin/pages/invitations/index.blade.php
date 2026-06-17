@extends("admin.layouts.master")

@section("title", "Send Invitation")

@section("content")
<div class="row">
    {{-- Send Invitation Form --}}
    <div class="col-lg-5 col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-paper-plane mr-2"></i>Send Invitation</h3>
            </div>
            <form action="{{ route('admin.invitations.send') }}" method="POST">
                @csrf
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

                    <div class="form-group">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="recipient@example.com"
                            required
                        >
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="membership_category_id">Membership Category <span class="text-danger">*</span></label>
                        <select
                            name="membership_category_id"
                            id="membership_category_id"
                            class="form-control @error('membership_category_id') is-invalid @enderror"
                            required
                        >
                            <option value="">— Select Category —</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('membership_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                    @if($category->is_invite_only)
                                        (Invite Only)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('membership_category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="application_fee">Application Fee (BDT) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">৳</span>
                            </div>
                            <input
                                type="number"
                                name="application_fee"
                                id="application_fee"
                                class="form-control @error('application_fee') is-invalid @enderror"
                                value="{{ old('application_fee') }}"
                                placeholder="0.00"
                                min="0"
                                step="0.01"
                                required
                            >
                            @error('application_fee')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-1"></i> Send Invite
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Sent Invitations List --}}
    <div class="col-lg-7 col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-2"></i>Sent Invitations</h3>
            </div>
            <div class="card-body p-0">
                @if ($invitations->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-envelope-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No invitations sent yet.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Invite ID</th>
                                    <th>Email</th>
                                    <th>Category</th>
                                    <th>Fee (BDT)</th>
                                    <th>Status</th>
                                    <th>Sent At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invitations as $invite)
                                    <tr>
                                        <td>
                                            <span class="badge badge-secondary font-monospace" style="font-size:13px; letter-spacing:2px;">
                                                {{ $invite->invite_id }}
                                            </span>
                                        </td>
                                        <td>{{ $invite->email }}</td>
                                        <td>{{ $invite->membershipCategory->title ?? '—' }}</td>
                                        <td>৳ {{ number_format($invite->application_fee, 2) }}</td>
                                        <td>
                                            @if ($invite->is_used)
                                                <span class="badge badge-success">Used</span>
                                            @else
                                                <span class="badge badge-warning">Unused</span>
                                            @endif
                                        </td>
                                        <td>{{ $invite->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <form action="{{ route('admin.invitations.destroy', $invite) }}" method="POST"
                                                onsubmit="return confirm('Delete invitation for {{ $invite->email }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-3 py-2">
                        {{ $invitations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
