@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="seo-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="basic-seo-tab" data-toggle="pill" href="#basic-seo" role="tab">
                            <i class="fas fa-search"></i> Basic SEO
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="open-graph-tab" data-toggle="pill" href="#open-graph" role="tab">
                            <i class="fab fa-facebook"></i> Open Graph (Facebook)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="twitter-card-tab" data-toggle="pill" href="#twitter-card" role="tab">
                            <i class="fab fa-twitter"></i> Twitter Card
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="analytics-tab" data-toggle="pill" href="#analytics" role="tab">
                            <i class="fas fa-chart-line"></i> Analytics & Tracking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="advanced-tab" data-toggle="pill" href="#advanced" role="tab">
                            <i class="fas fa-cog"></i> Advanced
                        </a>
                    </li>
                </ul>
            </div>
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

                <form action="{{ route('admin.seo-settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="tab-content" id="seo-tabContent">
                        <!-- Basic SEO Tab -->
                        <div class="tab-pane fade show active" id="basic-seo" role="tabpanel">
                            <h5 class="mb-3">Basic SEO Settings</h5>
                            <p class="text-muted">These meta tags will be used across your website</p>

                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title"
                                       class="form-control @error('meta_title') is-invalid @enderror"
                                       value="{{ old('meta_title', $settings->meta_title) }}"
                                       placeholder="BengalClub - Premier Club in Bangladesh"
                                       maxlength="60">
                                @error('meta_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Recommended: 50-60 characters</small>
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" rows="3"
                                          class="form-control @error('meta_description') is-invalid @enderror"
                                          placeholder="Experience luxury and exclusivity at BengalClub..."
                                          maxlength="160">{{ old('meta_description', $settings->meta_description) }}</textarea>
                                @error('meta_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Recommended: 150-160 characters</small>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                       class="form-control @error('meta_keywords') is-invalid @enderror"
                                       value="{{ old('meta_keywords', $settings->meta_keywords) }}"
                                       placeholder="club, bengal, membership, facilities, events">
                                @error('meta_keywords')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Separate keywords with commas</small>
                            </div>

                            <div class="form-group">
                                <label for="meta_author">Author</label>
                                <input type="text" name="meta_author" id="meta_author"
                                       class="form-control @error('meta_author') is-invalid @enderror"
                                       value="{{ old('meta_author', $settings->meta_author) }}"
                                       placeholder="BengalClub">
                                @error('meta_author')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="canonical_url">Canonical URL</label>
                                <input type="url" name="canonical_url" id="canonical_url"
                                       class="form-control @error('canonical_url') is-invalid @enderror"
                                       value="{{ old('canonical_url', $settings->canonical_url) }}"
                                       placeholder="https://www.bengalclub.com">
                                @error('canonical_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">The preferred URL for your homepage</small>
                            </div>
                        </div>

                        <!-- Open Graph Tab -->
                        <div class="tab-pane fade" id="open-graph" role="tabpanel">
                            <h5 class="mb-3">Open Graph (Facebook) Settings</h5>
                            <p class="text-muted">Control how your website appears when shared on Facebook and other social platforms</p>

                            <div class="form-group">
                                <label for="og_title">OG Title</label>
                                <input type="text" name="og_title" id="og_title"
                                       class="form-control @error('og_title') is-invalid @enderror"
                                       value="{{ old('og_title', $settings->og_title) }}"
                                       placeholder="BengalClub - Premier Club">
                                @error('og_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="og_description">OG Description</label>
                                <textarea name="og_description" id="og_description" rows="3"
                                          class="form-control @error('og_description') is-invalid @enderror"
                                          placeholder="Experience luxury and exclusivity...">{{ old('og_description', $settings->og_description) }}</textarea>
                                @error('og_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="og_image">OG Image</label>
                                <div class="custom-file">
                                    <input type="file" name="og_image" id="og_image"
                                           class="custom-file-input @error('og_image') is-invalid @enderror"
                                           accept="image/png,image/jpg,image/jpeg"
                                           onchange="previewImage(event, 'og-image-preview')">
                                    <label class="custom-file-label" for="og_image">Choose image</label>
                                    @error('og_image')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Recommended: 1200x630px. Max: 2MB</small>
                                @if($settings->og_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings->og_image) }}"
                                             alt="Current OG Image"
                                             id="og-image-preview"
                                             class="img-thumbnail"
                                             style="max-height: 200px;">
                                    </div>
                                @else
                                    <img id="og-image-preview" class="img-thumbnail mt-2" style="max-height: 200px; display: none;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="og_url">OG URL</label>
                                <input type="url" name="og_url" id="og_url"
                                       class="form-control @error('og_url') is-invalid @enderror"
                                       value="{{ old('og_url', $settings->og_url) }}"
                                       placeholder="https://www.bengalclub.com">
                                @error('og_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="og_type">OG Type</label>
                                        <select name="og_type" id="og_type" class="form-control @error('og_type') is-invalid @enderror">
                                            <option value="website" {{ old('og_type', $settings->og_type) == 'website' ? 'selected' : '' }}>Website</option>
                                            <option value="article" {{ old('og_type', $settings->og_type) == 'article' ? 'selected' : '' }}>Article</option>
                                            <option value="business.business" {{ old('og_type', $settings->og_type) == 'business.business' ? 'selected' : '' }}>Business</option>
                                        </select>
                                        @error('og_type')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="og_site_name">OG Site Name</label>
                                        <input type="text" name="og_site_name" id="og_site_name"
                                               class="form-control @error('og_site_name') is-invalid @enderror"
                                               value="{{ old('og_site_name', $settings->og_site_name) }}"
                                               placeholder="BengalClub">
                                        @error('og_site_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fb_app_id">Facebook App ID</label>
                                <input type="text" name="fb_app_id" id="fb_app_id"
                                       class="form-control @error('fb_app_id') is-invalid @enderror"
                                       value="{{ old('fb_app_id', $settings->fb_app_id) }}"
                                       placeholder="123456789012345">
                                @error('fb_app_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Optional: For Facebook Insights</small>
                            </div>
                        </div>

                        <!-- Twitter Card Tab -->
                        <div class="tab-pane fade" id="twitter-card" role="tabpanel">
                            <h5 class="mb-3">Twitter Card Settings</h5>
                            <p class="text-muted">Control how your website appears when shared on Twitter</p>

                            <div class="form-group">
                                <label for="twitter_card">Twitter Card Type</label>
                                <select name="twitter_card" id="twitter_card" class="form-control @error('twitter_card') is-invalid @enderror">
                                    <option value="summary" {{ old('twitter_card', $settings->twitter_card) == 'summary' ? 'selected' : '' }}>Summary</option>
                                    <option value="summary_large_image" {{ old('twitter_card', $settings->twitter_card) == 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                                </select>
                                @error('twitter_card')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="twitter_site">Twitter Site Handle</label>
                                <input type="text" name="twitter_site" id="twitter_site"
                                       class="form-control @error('twitter_site') is-invalid @enderror"
                                       value="{{ old('twitter_site', $settings->twitter_site) }}"
                                       placeholder="@bengalclub">
                                @error('twitter_site')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Your Twitter username with @</small>
                            </div>

                            <div class="form-group">
                                <label for="twitter_creator">Twitter Creator Handle</label>
                                <input type="text" name="twitter_creator" id="twitter_creator"
                                       class="form-control @error('twitter_creator') is-invalid @enderror"
                                       value="{{ old('twitter_creator', $settings->twitter_creator) }}"
                                       placeholder="@bengalclub">
                                @error('twitter_creator')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="twitter_title">Twitter Title</label>
                                <input type="text" name="twitter_title" id="twitter_title"
                                       class="form-control @error('twitter_title') is-invalid @enderror"
                                       value="{{ old('twitter_title', $settings->twitter_title) }}"
                                       placeholder="BengalClub - Premier Club">
                                @error('twitter_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="twitter_description">Twitter Description</label>
                                <textarea name="twitter_description" id="twitter_description" rows="3"
                                          class="form-control @error('twitter_description') is-invalid @enderror"
                                          placeholder="Experience luxury and exclusivity...">{{ old('twitter_description', $settings->twitter_description) }}</textarea>
                                @error('twitter_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="twitter_image">Twitter Image</label>
                                <div class="custom-file">
                                    <input type="file" name="twitter_image" id="twitter_image"
                                           class="custom-file-input @error('twitter_image') is-invalid @enderror"
                                           accept="image/png,image/jpg,image/jpeg"
                                           onchange="previewImage(event, 'twitter-image-preview')">
                                    <label class="custom-file-label" for="twitter_image">Choose image</label>
                                    @error('twitter_image')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Recommended: 1200x628px (Large Image) or 120x120px (Summary). Max: 2MB</small>
                                @if($settings->twitter_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings->twitter_image) }}"
                                             alt="Current Twitter Image"
                                             id="twitter-image-preview"
                                             class="img-thumbnail"
                                             style="max-height: 200px;">
                                    </div>
                                @else
                                    <img id="twitter-image-preview" class="img-thumbnail mt-2" style="max-height: 200px; display: none;">
                                @endif
                            </div>
                        </div>

                        <!-- Analytics Tab -->
                        <div class="tab-pane fade" id="analytics" role="tabpanel">
                            <h5 class="mb-3">Analytics & Tracking</h5>
                            <p class="text-muted">Add tracking codes for analytics and marketing platforms</p>

                            <div class="form-group">
                                <label for="google_analytics_id">Google Analytics Measurement ID</label>
                                <input type="text" name="google_analytics_id" id="google_analytics_id"
                                       class="form-control @error('google_analytics_id') is-invalid @enderror"
                                       value="{{ old('google_analytics_id', $settings->google_analytics_id) }}"
                                       placeholder="G-XXXXXXXXXX or UA-XXXXXXXXX-X">
                                @error('google_analytics_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Google Analytics 4 or Universal Analytics ID</small>
                            </div>

                            <div class="form-group">
                                <label for="google_site_verification">Google Site Verification</label>
                                <input type="text" name="google_site_verification" id="google_site_verification"
                                       class="form-control @error('google_site_verification') is-invalid @enderror"
                                       value="{{ old('google_site_verification', $settings->google_site_verification) }}"
                                       placeholder="abcdefghijklmnopqrstuvwxyz123456">
                                @error('google_site_verification')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Verification code from Google Search Console</small>
                            </div>

                            <div class="form-group">
                                <label for="facebook_pixel_id">Facebook Pixel ID</label>
                                <input type="text" name="facebook_pixel_id" id="facebook_pixel_id"
                                       class="form-control @error('facebook_pixel_id') is-invalid @enderror"
                                       value="{{ old('facebook_pixel_id', $settings->facebook_pixel_id) }}"
                                       placeholder="123456789012345">
                                @error('facebook_pixel_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">For Facebook advertising tracking</small>
                            </div>
                        </div>

                        <!-- Advanced Tab -->
                        <div class="tab-pane fade" id="advanced" role="tabpanel">
                            <h5 class="mb-3">Advanced Settings</h5>
                            <p class="text-muted">Custom code and advanced SEO options</p>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="index_page" id="index_page"
                                           class="custom-control-input"
                                           {{ old('index_page', $settings->index_page) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="index_page">
                                        Allow Search Engines to Index this Site
                                    </label>
                                </div>
                                <small class="form-text text-muted">Uncheck to add noindex meta tag</small>
                            </div>

                            <div class="form-group">
                                <label for="custom_head_code">Custom HEAD Code</label>
                                <textarea name="custom_head_code" id="custom_head_code" rows="6"
                                          class="form-control @error('custom_head_code') is-invalid @enderror"
                                          placeholder="<!-- Custom meta tags, scripts, or styles -->">{{ old('custom_head_code', $settings->custom_head_code) }}</textarea>
                                @error('custom_head_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Code will be inserted in the &lt;head&gt; section</small>
                            </div>

                            <div class="form-group">
                                <label for="custom_body_code">Custom BODY Code</label>
                                <textarea name="custom_body_code" id="custom_body_code" rows="6"
                                          class="form-control @error('custom_body_code') is-invalid @enderror"
                                          placeholder="<!-- Custom scripts or tracking codes -->">{{ old('custom_body_code', $settings->custom_body_code) }}</textarea>
                                @error('custom_body_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Code will be inserted before the closing &lt;/body&gt; tag</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save SEO Settings
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
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
