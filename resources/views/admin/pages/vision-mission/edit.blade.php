@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Vision & Mission</h3>
            </div>
            <form action="{{ route('admin.vision-mission.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="vision">Vision</label>
                        <textarea name="vision" id="vision"
                                  class="form-control @error('vision') is-invalid @enderror"
                                  rows="6"
                                  placeholder="Enter your organization's vision">{{ old('vision', $visionMission->vision) }}</textarea>
                        @error('vision')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Describe where you see the organization in the future</small>
                    </div>

                    <div class="form-group">
                        <label for="mission">Mission</label>
                        <textarea name="mission" id="mission"
                                  class="form-control @error('mission') is-invalid @enderror"
                                  rows="8"
                                  placeholder="Enter your organization's mission">{{ old('mission', $visionMission->mission) }}</textarea>
                        @error('mission')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Describe your organization's purpose and objectives. You can use line breaks for bullet points.</small>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Vision & Mission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
