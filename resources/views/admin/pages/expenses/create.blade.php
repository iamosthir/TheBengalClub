@extends('admin.layouts.master')
@section('title', 'Add Expense')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Add Expense</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.expenses.index') }}">Expenses</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Expense Details</h3></div>
                    <form action="{{ route('admin.expenses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label>Category</label>
                                <select name="donation_category_id"
                                        class="form-control @error('donation_category_id') is-invalid @enderror">
                                    <option value="">— No Category —</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('donation_category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('donation_category_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" rows="3"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="What was this expense for?"
                                          required>{{ old('description') }}</textarea>
                                @error('description')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label>Amount (BDT) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold">৳</span>
                                    </div>
                                    <input type="number" name="amount" step="0.01" min="0.01"
                                           class="form-control @error('amount') is-invalid @enderror"
                                           placeholder="0.00" value="{{ old('amount') }}" required>
                                    @error('amount')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Attachment <span class="text-muted">(optional)</span></label>
                                <div class="custom-file">
                                    <input type="file" name="attachment" id="attachment-input"
                                           class="custom-file-input @error('attachment') is-invalid @enderror"
                                           accept="image/jpg,image/jpeg,image/png,application/pdf">
                                    <label class="custom-file-label" for="attachment-input">Choose file...</label>
                                </div>
                                <small class="text-muted">JPG, PNG or PDF, max 5MB</small>
                                @error('attachment')<span class="text-danger small">{{ $message }}</span>@enderror
                                <div id="attachment-preview" class="mt-2 d-none">
                                    <img id="preview-img" src="" alt="Preview"
                                         class="img-thumbnail" style="max-height:140px;">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer d-flex">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Save Expense
                            </button>
                            <a href="{{ route('admin.expenses.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('attachment-input').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    this.nextElementSibling.textContent = file.name;
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('attachment-preview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('attachment-preview').classList.add('d-none');
    }
});
</script>
@endpush
