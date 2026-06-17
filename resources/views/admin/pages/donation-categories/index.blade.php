@extends('admin.layouts.master')
@section('title', 'Donation Categories')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Donation Categories</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Donation Categories</li>
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
                <h3 class="card-title">All Categories</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.donation-categories.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Category
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Donations</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                @if($category->image_path)
                                    <img src="{{ asset('storage/' . $category->image_path) }}"
                                         alt="{{ $category->name }}"
                                         class="img-thumbnail" style="width:56px;height:42px;object-fit:cover;">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="font-weight-bold">{{ $category->name }}</td>
                            <td class="text-muted" style="max-width:260px;">
                                {{ Str::limit($category->description, 80) ?? '—' }}
                            </td>
                            <td>
                                @if($category->status === 'active')
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Disabled</span>
                                @endif
                            </td>
                            <td>{{ $category->donations()->count() }}</td>
                            <td>
                                {{-- Share Link --}}
                                <button type="button" class="btn btn-xs btn-info share-link-btn"
                                        data-category-id="{{ $category->id }}"
                                        data-category-name="{{ $category->name }}"
                                        title="Share Donation Link">
                                    <i class="fas fa-share-alt"></i>
                                </button>

                                <a href="{{ route('admin.donation-categories.edit', $category) }}"
                                   class="btn btn-xs btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.donation-categories.destroy', $category) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this category? Existing donations will not be deleted.');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
            <div class="card-footer">{{ $categories->links() }}</div>
            @endif
        </div>
    </div>
</section>

{{-- Share Link Modal --}}
<div class="modal fade" id="shareLinkModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">
                    <i class="fas fa-share-alt mr-2"></i>Share Donation Link
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3">Share the donation link for <strong id="share-category-name"></strong>:</p>

                {{-- Link Input --}}
                <div class="input-group mb-4">
                    <input type="text" id="share-link-input" class="form-control" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="copy-link-btn" type="button">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                    </div>
                </div>

                {{-- Social Share Icons --}}
                <p class="text-muted small mb-2 text-center">Or share via:</p>
                <div class="d-flex justify-content-center gap-3" style="gap:12px;">
                    <a id="share-facebook" href="#" target="_blank" rel="noopener"
                       class="btn btn-primary" style="background:#1877f2;border-color:#1877f2;width:120px;">
                        <i class="fab fa-facebook-f mr-1"></i> Facebook
                    </a>
                    <a id="share-twitter" href="#" target="_blank" rel="noopener"
                       class="btn btn-info" style="background:#1da1f2;border-color:#1da1f2;width:120px;">
                        <i class="fab fa-twitter mr-1"></i> Twitter
                    </a>
                    <a id="share-whatsapp" href="#" target="_blank" rel="noopener"
                       class="btn btn-success" style="background:#25d366;border-color:#25d366;width:120px;">
                        <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.share-link-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const catId   = this.dataset.categoryId;
        const catName = this.dataset.categoryName;
        const url     = '{{ url("/donate") }}?category=' + catId;

        document.getElementById('share-category-name').textContent = catName;
        document.getElementById('share-link-input').value = url;

        const encodedUrl  = encodeURIComponent(url);
        const encodedText = encodeURIComponent('Support ' + catName + ' — Donate to Bengal Club');

        document.getElementById('share-facebook').href =
            'https://www.facebook.com/sharer/sharer.php?u=' + encodedUrl;
        document.getElementById('share-twitter').href =
            'https://twitter.com/intent/tweet?url=' + encodedUrl + '&text=' + encodedText;
        document.getElementById('share-whatsapp').href =
            'https://wa.me/?text=' + encodedText + '%20' + encodedUrl;

        $('#shareLinkModal').modal('show');
    });
});

document.getElementById('copy-link-btn').addEventListener('click', function() {
    const input = document.getElementById('share-link-input');
    input.select();
    input.setSelectionRange(0, 99999);
    document.execCommand('copy');

    const btn = this;
    btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
    btn.classList.replace('btn-outline-secondary', 'btn-success');
    setTimeout(function() {
        btn.innerHTML = '<i class="fas fa-copy"></i> Copy';
        btn.classList.replace('btn-success', 'btn-outline-secondary');
    }, 2000);
});
</script>
@endpush
