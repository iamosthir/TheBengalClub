@extends("admin.layouts.master")

@section("title", "Edit Investment Plan")

@section("content")
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">Edit: {{ $tanSamiti->name }}</h3>
                <a href="{{ route('admin.tan-samiti.show', $tanSamiti) }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
            <form action="{{ route('admin.tan-samiti.update', $tanSamiti) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $tanSamiti->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $tanSamiti->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Monthly Amount (৳) <span class="text-danger">*</span></label>
                                <input type="number" name="monthly_amount" step="0.01" min="1"
                                       class="form-control @error('monthly_amount') is-invalid @enderror"
                                       value="{{ old('monthly_amount', $tanSamiti->monthly_amount) }}">
                                @error('monthly_amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Cycles (Months) <span class="text-danger">*</span></label>
                                <input type="number" name="total_cycles" min="2" max="500"
                                       class="form-control @error('total_cycles') is-invalid @enderror"
                                       value="{{ old('total_cycles', $tanSamiti->total_cycles) }}">
                                <small class="text-muted">Missing installments will be auto-generated for all active members.</small>
                                @error('total_cycles') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date (First Installment Due) <span class="text-danger">*</span></label>
                                <input type="date" name="start_date"
                                       class="form-control @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', optional($tanSamiti->start_date)->toDateString()) }}">
                                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Member Limit</label>
                                <input type="number" name="member_limit" min="1" max="10000"
                                       class="form-control @error('member_limit') is-invalid @enderror"
                                       value="{{ old('member_limit', $tanSamiti->member_limit) }}"
                                       placeholder="Leave blank for unlimited">
                                <small class="text-muted">
                                    Currently {{ $tanSamiti->activeMembers()->count() }} active member(s).
                                    Leave blank for no limit.
                                </small>
                                @error('member_limit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-lg">
                            <input type="checkbox" class="custom-control-input" id="enable_lottery_draw"
                                   name="enable_lottery_draw" value="1"
                                   {{ old('enable_lottery_draw', $tanSamiti->enable_lottery_draw) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="enable_lottery_draw">
                                <strong>Enable Lottery Draw</strong>
                            </label>
                        </div>
                        <small class="text-muted d-block mt-1">
                            If unchecked, the lottery draw feature will be disabled for this plan.
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status', $tanSamiti->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $tanSamiti->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
