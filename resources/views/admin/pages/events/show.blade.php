@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Event Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.event-registrations.index', $event) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-users"></i> Registrations
                        <span class="badge badge-light ml-1">{{ $event->registrations()->count() }}</span>
                    </a>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Edit Event
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mb-3">{{ $event->title }}</h2>

                        <div class="mb-4">
                            <p class="mb-2">
                                <i class="fas fa-calendar-alt text-primary mr-2"></i>
                                <strong>Date:</strong> {{ $event->date->format('l, F j, Y') }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-map-marker-alt text-danger mr-2"></i>
                                <strong>Venue:</strong> {{ $event->venue }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-info-circle text-info mr-2"></i>
                                <strong>Status:</strong>
                                @if($event->status)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-tag text-warning mr-2"></i>
                                <strong>Registration Fee:</strong>
                                @if($event->is_free)
                                    <span class="badge badge-success">Free</span>
                                @else
                                    <span class="badge badge-warning text-dark">BDT {{ number_format($event->fee, 2) }}</span>
                                @endif
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-clock text-warning mr-2"></i>
                                <strong>Created:</strong> {{ $event->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <h4>Description</h4>
                            <div class="border rounded p-3 bg-light">
                                {!! $event->description !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        @if($event->thumbnail_path)
                            <div class="mb-4">
                                <h5>Event Thumbnail</h5>
                                <img src="{{ asset('storage/' . $event->thumbnail_path) }}"
                                     alt="{{ $event->title }}"
                                     class="img-fluid rounded shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>

                @if($event->gallery_images && count($event->gallery_images) > 0)
                    <hr>
                    <div class="mt-4">
                        <h4 class="mb-3">Event Gallery ({{ count($event->gallery_images) }} images)</h4>

                        <!-- Bootstrap Carousel -->
                        <div id="eventGalleryCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($event->gallery_images as $index => $image)
                                    <li data-target="#eventGalleryCarousel"
                                        data-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($event->gallery_images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image) }}"
                                             class="d-block w-100"
                                             alt="Gallery Image {{ $index + 1 }}"
                                             style="height: 500px; object-fit: contain; background-color: #000;">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#eventGalleryCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#eventGalleryCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <!-- Gallery Thumbnail Grid -->
                        <div class="mt-3">
                            <div class="row">
                                @foreach($event->gallery_images as $index => $image)
                                    <div class="col-md-2 col-sm-3 col-4 mb-2">
                                        <img src="{{ asset('storage/' . $image) }}"
                                             alt="Gallery Thumbnail {{ $index + 1 }}"
                                             class="img-thumbnail cursor-pointer"
                                             style="width: 100%; height: 100px; object-fit: cover; cursor: pointer;"
                                             onclick="goToSlide({{ $index }})">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-info">
                    <i class="fas fa-edit"></i> Edit Event
                </a>
                <form action="{{ route('admin.events.destroy', $event->id) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete Event
                    </button>
                </form>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('scripts')
<script>
// Function to jump to specific slide in carousel
function goToSlide(index) {
    $('#eventGalleryCarousel').carousel(index);
}
</script>
@endpush
