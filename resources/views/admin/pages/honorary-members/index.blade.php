@extends('admin.layouts.master')
@section('title', 'Honorary Members')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Honorary Members Gallery</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Honorary Members</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Honorary Members</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.honorary-members.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Member
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="60">Photo</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                        <tr>
                            <td>
                                @if($member->photo_path)
                                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}"
                                         class="img-circle" style="width:40px;height:40px;object-fit:cover;">
                                @else
                                    <span class="badge badge-secondary">No Photo</span>
                                @endif
                            </td>
                            <td>{{ $member->name }}</td>
                            <td>
                                @if(!empty($member->designation))
                                    {{ implode(', ', (array) $member->designation) }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $member->order }}</td>
                            <td>
                                @if($member->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.honorary-members.edit', $member) }}" class="btn btn-xs btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.honorary-members.destroy', $member) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this member?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted">No honorary members yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($members->hasPages())
            <div class="card-footer">{{ $members->links() }}</div>
            @endif
        </div>
    </div>
</section>
@endsection
