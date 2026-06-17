<!-- Contact Section -->
<section id="contact" class="contact-section py-24 lg:py-32 relative overflow-hidden">
    <div class="contact-bg-shape"></div>
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20">
            <!-- Contact Info -->
            <div class="contact-info reveal-left">
                <span class="section-caption">Get in Touch</span>
                <h2 class="section-title">Contact Us</h2>
                <p class="section-text mb-10">
                    Have questions about membership or our facilities? We'd love to hear from you.
                    Reach out to us through any of the channels below.
                </p>

                <div class="contact-details">
                    @if($siteSetting && ($siteSetting->address || $siteSetting->city || $siteSetting->country))
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Visit Us</h4>
                                <p>
                                    {{ $siteSetting->address }}
                                    @if($siteSetting->city || $siteSetting->state || $siteSetting->zip_code)
                                        <br>
                                    @endif
                                    {{ $siteSetting->city }}@if($siteSetting->state), {{ $siteSetting->state }}@endif @if($siteSetting->zip_code){{ $siteSetting->zip_code }}@endif
                                    @if($siteSetting->country)
                                        <br>{{ $siteSetting->country }}
                                    @endif
                                </p>
                                @if($siteSetting->google_maps_url)
                                    <a href="{{ $siteSetting->google_maps_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-accent hover:text-accent/80 transition-colors mt-2 text-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                        </svg>
                                        Get Directions
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($siteSetting && $siteSetting->email)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Email Us</h4>
                                <p>
                                    <a href="mailto:{{ $siteSetting->email }}" class="hover:text-accent transition-colors">{{ $siteSetting->email }}</a>
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($siteSetting && ($siteSetting->phone || $siteSetting->phone_secondary))
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Call Us</h4>
                                <p>
                                    @if($siteSetting->phone)
                                        <a href="tel:{{ $siteSetting->phone }}" class="hover:text-accent transition-colors">{{ $siteSetting->phone }}</a>
                                    @endif
                                    @if($siteSetting->phone && $siteSetting->phone_secondary)
                                        <br>
                                    @endif
                                    @if($siteSetting->phone_secondary)
                                        <a href="tel:{{ $siteSetting->phone_secondary }}" class="hover:text-accent transition-colors">{{ $siteSetting->phone_secondary }}</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Social Links -->
                @if($siteSetting && ($siteSetting->facebook_url || $siteSetting->twitter_url || $siteSetting->instagram_url || $siteSetting->linkedin_url || $siteSetting->youtube_url || $siteSetting->whatsapp_url))
                    <div class="contact-socials">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            @if($siteSetting->facebook_url)
                                <a href="{{ $siteSetting->facebook_url }}" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Facebook">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                            @endif
                            @if($siteSetting->twitter_url)
                                <a href="{{ $siteSetting->twitter_url }}" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Twitter">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </a>
                            @endif
                            @if($siteSetting->instagram_url)
                                <a href="{{ $siteSetting->instagram_url }}" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Instagram">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                            @endif
                            @if($siteSetting->linkedin_url)
                                <a href="{{ $siteSetting->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="LinkedIn">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </a>
                            @endif
                            @if($siteSetting->youtube_url)
                                <a href="{{ $siteSetting->youtube_url }}" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="YouTube">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            @endif
                            @if($siteSetting->whatsapp_url)
                                <a href="{{ $siteSetting->whatsapp_url }}" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="WhatsApp">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper reveal-right">
                <div id="form-messages" style="display: none; margin-bottom: 1rem;"></div>
                <form class="contact-form" id="contact-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name <span style="color: #ef4444;">*</span></label>
                            <input type="text" id="name" name="name" placeholder="John Doe" required>
                            <span class="error-message" id="name-error" style="color: #ef4444; font-size: 0.875rem; display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span style="color: #ef4444;">*</span></label>
                            <input type="email" id="email" name="email" placeholder="john@example.com" required>
                            <span class="error-message" id="email-error" style="color: #ef4444; font-size: 0.875rem; display: none;"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+880 1234-567890">
                            <span class="error-message" id="phone-error" style="color: #ef4444; font-size: 0.875rem; display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject <span style="color: #ef4444;">*</span></label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="Membership Inquiry">Membership Inquiry</option>
                                <option value="Event Information">Event Information</option>
                                <option value="Facilities Booking">Facilities Booking</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="error-message" id="subject-error" style="color: #ef4444; font-size: 0.875rem; display: none;"></span>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="message">Your Message <span style="color: #ef4444;">*</span></label>
                        <textarea id="message" name="message" rows="5" placeholder="How can we help you?" required></textarea>
                        <span class="error-message" id="message-error" style="color: #ef4444; font-size: 0.875rem; display: none;"></span>
                    </div>

                    <button type="submit" class="btn-primary submit-btn" id="submit-btn">
                        <span id="submit-text">Send Message</span>
                        <span id="submit-loader" style="display: none;">Sending...</span>
                        <svg class="w-5 h-5" id="submit-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    const submitLoader = document.getElementById('submit-loader');
    const submitArrow = document.getElementById('submit-arrow');
    const formMessages = document.getElementById('form-messages');

    // Clear all error messages
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
            el.textContent = '';
        });
        formMessages.style.display = 'none';
        formMessages.textContent = '';
        formMessages.className = '';
    }

    // Show error message
    function showError(field, message) {
        const errorEl = document.getElementById(field + '-error');
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.style.display = 'block';
        }
    }

    // Show form message
    function showFormMessage(message, type) {
        formMessages.textContent = message;
        formMessages.style.display = 'block';
        formMessages.style.padding = '1rem';
        formMessages.style.borderRadius = '0.5rem';
        formMessages.style.marginBottom = '1rem';

        if (type === 'success') {
            formMessages.style.backgroundColor = '#d1fae5';
            formMessages.style.color = '#065f46';
            formMessages.style.border = '1px solid #6ee7b7';
        } else {
            formMessages.style.backgroundColor = '#fee2e2';
            formMessages.style.color = '#991b1b';
            formMessages.style.border = '1px solid #fca5a5';
        }

        // Scroll to message
        formMessages.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Handle form submission
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        clearErrors();

        // Disable submit button
        submitBtn.disabled = true;
        submitText.style.display = 'none';
        submitLoader.style.display = 'inline';
        submitArrow.style.display = 'none';

        // Get form data
        const formData = new FormData(contactForm);

        // Send AJAX request
        fetch('{{ route("contact.submit") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => {
            return response.json().then(data => ({
                status: response.status,
                ok: response.ok,
                data: data
            }));
        })
        .then(({status, ok, data}) => {
            if (ok && data.success) {
                showFormMessage(data.message, 'success');
                contactForm.reset();

                // Hide success message after 5 seconds
                setTimeout(() => {
                    formMessages.style.display = 'none';
                }, 5000);
            } else {
                // Handle validation errors
                if (status === 422 && data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        showError(field, data.errors[field][0]);
                    });
                } else {
                    showFormMessage(data.message || 'An error occurred. Please try again.', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showFormMessage('An error occurred. Please try again later.', 'error');
        })
        .finally(() => {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitText.style.display = 'inline';
            submitLoader.style.display = 'none';
            submitArrow.style.display = 'inline';
        });
    });
});
</script>
