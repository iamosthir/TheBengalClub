@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Site Settings</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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

                    <!-- Basic Information -->
                    <h5 class="mb-3"><i class="fas fa-info-circle"></i> Basic Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_name">Site Name <span class="text-danger">*</span></label>
                                <input type="text" name="site_name" id="site_name"
                                       class="form-control @error('site_name') is-invalid @enderror"
                                       value="{{ old('site_name', $settings->site_name) }}"
                                       required>
                                @error('site_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_tagline">Site Tagline</label>
                                <input type="text" name="site_tagline" id="site_tagline"
                                       class="form-control @error('site_tagline') is-invalid @enderror"
                                       value="{{ old('site_tagline', $settings->site_tagline) }}"
                                       placeholder="Your club's tagline">
                                @error('site_tagline')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <div class="custom-file">
                                    <input type="file" name="logo" id="logo"
                                           class="custom-file-input @error('logo') is-invalid @enderror"
                                           accept="image/png,image/jpg,image/jpeg,image/svg+xml"
                                           onchange="previewImage(event, 'logo-preview')">
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                    @error('logo')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">PNG, JPG, JPEG, SVG. Max: 2MB</small>
                                @if($settings->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings->logo) }}"
                                             alt="Current Logo"
                                             id="logo-preview"
                                             class="img-thumbnail"
                                             style="max-height: 100px;">
                                    </div>
                                @else
                                    <img id="logo-preview" class="img-thumbnail mt-2" style="max-height: 100px; display: none;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <div class="custom-file">
                                    <input type="file" name="favicon" id="favicon"
                                           class="custom-file-input @error('favicon') is-invalid @enderror"
                                           accept="image/png,image/x-icon,image/vnd.microsoft.icon"
                                           onchange="previewImage(event, 'favicon-preview')">
                                    <label class="custom-file-label" for="favicon">Choose file</label>
                                    @error('favicon')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">PNG, ICO. Max: 1MB. Recommended: 32x32px</small>
                                @if($settings->favicon)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings->favicon) }}"
                                             alt="Current Favicon"
                                             id="favicon-preview"
                                             class="img-thumbnail"
                                             style="max-height: 50px;">
                                    </div>
                                @else
                                    <img id="favicon-preview" class="img-thumbnail mt-2" style="max-height: 50px; display: none;">
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Contact Information -->
                    <h5 class="mb-3"><i class="fas fa-address-book"></i> Contact Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $settings->email) }}"
                                       placeholder="info@bengalclub.com">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone">Primary Phone</label>
                                <input type="text" name="phone" id="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $settings->phone) }}"
                                       placeholder="+880 1234-567890">
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone_secondary">Secondary Phone</label>
                                <input type="text" name="phone_secondary" id="phone_secondary"
                                       class="form-control @error('phone_secondary') is-invalid @enderror"
                                       value="{{ old('phone_secondary', $settings->phone_secondary) }}"
                                       placeholder="+880 1234-567891">
                                @error('phone_secondary')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" rows="2"
                                          class="form-control @error('address') is-invalid @enderror"
                                          placeholder="123 Club Avenue, Prestigious District">{{ old('address', $settings->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city"
                                       class="form-control @error('city') is-invalid @enderror"
                                       value="{{ old('city', $settings->city) }}"
                                       placeholder="Dhaka">
                                @error('city')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state">State/Region</label>
                                <input type="text" name="state" id="state"
                                       class="form-control @error('state') is-invalid @enderror"
                                       value="{{ old('state', $settings->state) }}"
                                       placeholder="Dhaka Division">
                                @error('state')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zip_code">ZIP/Postal Code</label>
                                <input type="text" name="zip_code" id="zip_code"
                                       class="form-control @error('zip_code') is-invalid @enderror"
                                       value="{{ old('zip_code', $settings->zip_code) }}"
                                       placeholder="1000">
                                @error('zip_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country"
                                       class="form-control @error('country') is-invalid @enderror"
                                       value="{{ old('country', $settings->country) }}"
                                       placeholder="Bangladesh">
                                @error('country')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Club Statistics -->
                    <h5 class="mb-3"><i class="fas fa-chart-bar"></i> Club Statistics</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_members">Total Members</label>
                                <input type="number" name="total_members" id="total_members"
                                       class="form-control @error('total_members') is-invalid @enderror"
                                       value="{{ old('total_members', $settings->total_members) }}"
                                       min="0"
                                       placeholder="500">
                                @error('total_members')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">This will be displayed on the website</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="application_fee">Application Fee (BDT)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">৳</span>
                                    </div>
                                    <input type="number" name="application_fee" id="application_fee"
                                           class="form-control @error('application_fee') is-invalid @enderror"
                                           value="{{ old('application_fee', $settings->application_fee) }}"
                                           min="0"
                                           step="0.01"
                                           placeholder="0.00">
                                    @error('application_fee')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Fee charged for membership applications</small>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Social Media Links -->
                    <h5 class="mb-3"><i class="fas fa-share-alt"></i> Social Media Links</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook_url">
                                    <i class="fab fa-facebook text-primary"></i> Facebook URL
                                </label>
                                <input type="url" name="facebook_url" id="facebook_url"
                                       class="form-control @error('facebook_url') is-invalid @enderror"
                                       value="{{ old('facebook_url', $settings->facebook_url) }}"
                                       placeholder="https://facebook.com/bengalclub">
                                @error('facebook_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter_url">
                                    <i class="fab fa-twitter text-info"></i> Twitter URL
                                </label>
                                <input type="url" name="twitter_url" id="twitter_url"
                                       class="form-control @error('twitter_url') is-invalid @enderror"
                                       value="{{ old('twitter_url', $settings->twitter_url) }}"
                                       placeholder="https://twitter.com/bengalclub">
                                @error('twitter_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instagram_url">
                                    <i class="fab fa-instagram text-danger"></i> Instagram URL
                                </label>
                                <input type="url" name="instagram_url" id="instagram_url"
                                       class="form-control @error('instagram_url') is-invalid @enderror"
                                       value="{{ old('instagram_url', $settings->instagram_url) }}"
                                       placeholder="https://instagram.com/bengalclub">
                                @error('instagram_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linkedin_url">
                                    <i class="fab fa-linkedin text-primary"></i> LinkedIn URL
                                </label>
                                <input type="url" name="linkedin_url" id="linkedin_url"
                                       class="form-control @error('linkedin_url') is-invalid @enderror"
                                       value="{{ old('linkedin_url', $settings->linkedin_url) }}"
                                       placeholder="https://linkedin.com/company/bengalclub">
                                @error('linkedin_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube_url">
                                    <i class="fab fa-youtube text-danger"></i> YouTube URL
                                </label>
                                <input type="url" name="youtube_url" id="youtube_url"
                                       class="form-control @error('youtube_url') is-invalid @enderror"
                                       value="{{ old('youtube_url', $settings->youtube_url) }}"
                                       placeholder="https://youtube.com/@bengalclub">
                                @error('youtube_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="whatsapp_url">
                                    <i class="fab fa-whatsapp text-success"></i> WhatsApp URL
                                </label>
                                <input type="url" name="whatsapp_url" id="whatsapp_url"
                                       class="form-control @error('whatsapp_url') is-invalid @enderror"
                                       value="{{ old('whatsapp_url', $settings->whatsapp_url) }}"
                                       placeholder="https://wa.me/8801234567890">
                                @error('whatsapp_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="google_maps_url">
                                    <i class="fas fa-map-marker-alt text-danger"></i> Google Maps URL
                                </label>
                                <input type="url" name="google_maps_url" id="google_maps_url"
                                       class="form-control @error('google_maps_url') is-invalid @enderror"
                                       value="{{ old('google_maps_url', $settings->google_maps_url) }}"
                                       placeholder="https://maps.google.com/...">
                                @error('google_maps_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Footer Settings -->
                    <h5 class="mb-3"><i class="fas fa-file-alt"></i> Footer Settings</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="footer_text">Footer Text</label>
                                <textarea name="footer_text" id="footer_text" rows="3"
                                          class="form-control @error('footer_text') is-invalid @enderror"
                                          placeholder="About your club...">{{ old('footer_text', $settings->footer_text) }}</textarea>
                                @error('footer_text')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="copyright_text">Copyright Text</label>
                                <input type="text" name="copyright_text" id="copyright_text"
                                       class="form-control @error('copyright_text') is-invalid @enderror"
                                       value="{{ old('copyright_text', $settings->copyright_text) }}"
                                       placeholder="© 2026 BengalClub. All rights reserved.">
                                @error('copyright_text')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('scripts')
<script>
// Update file input label with filename
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

// Image preview function
function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
