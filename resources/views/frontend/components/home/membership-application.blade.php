<!-- Membership Application Section -->
<section id="application" class="py-24 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: linear-gradient(45deg, rgba(15, 112, 191, 0.1) 25%, transparent 25%, transparent 75%, rgba(15, 112, 191, 0.1) 75%), linear-gradient(45deg, rgba(15, 112, 191, 0.1) 25%, transparent 25%, transparent 75%, rgba(15, 112, 191, 0.1) 75%); background-size: 60px 60px; background-position: 0 0, 30px 30px;"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-up">
            <span class="section-caption">Join Us</span>
            <h2 class="section-title">Membership Application</h2>
            <p class="section-text">
                Begin your journey towards becoming a valued member of The Bengal Club's distinguished community
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-dark-700 border border-accent/20 rounded-2xl p-8 lg:p-12 reveal-up">
                <form id="membership-application-form" class="space-y-6">
                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Applicant Information
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="full_name" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="full_name" name="full_name"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       placeholder="Enter your full name" required>
                            </div>

                            <div class="form-group">
                                <label for="dob" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Date of Birth <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="dob" name="dob"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="nationality" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Nationality <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nationality" name="nationality"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       placeholder="Your nationality" required>
                            </div>

                            <div class="form-group">
                                <label for="profession" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Profession/Designation <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="profession" name="profession"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       placeholder="Your profession" required>
                            </div>

                            <div class="form-group md:col-span-2">
                                <label for="organization" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Organization <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="organization" name="organization"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       placeholder="Your organization/company" required>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contact Details
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="contact_number" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Contact Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="contact_number" name="contact_number"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       placeholder="+880 1234-567890" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       placeholder="your.email@example.com" required>
                            </div>

                            <div class="form-group md:col-span-2">
                                <label for="address" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Present Address <span class="text-red-500">*</span>
                                </label>
                                <textarea id="address" name="address" rows="3"
                                          class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                          placeholder="Your current address" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Membership Category -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            Membership Category
                        </h3>

                        <div class="grid md:grid-cols-3 gap-4">
                            <label class="relative flex items-center p-4 bg-dark-800 border-2 border-accent/20 rounded-lg cursor-pointer hover:border-accent/40 transition-colors group">
                                <input type="radio" name="membership_category" value="founder" class="peer sr-only" required>
                                <div class="flex items-center w-full">
                                    <div class="w-5 h-5 rounded-full border-2 border-accent/40 mr-3 peer-checked:border-accent peer-checked:bg-accent transition-all"></div>
                                    <span class="text-white font-semibold">Founder Member</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-accent rounded-lg opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </label>

                            <label class="relative flex items-center p-4 bg-dark-800 border-2 border-accent/20 rounded-lg cursor-pointer hover:border-accent/40 transition-colors group">
                                <input type="radio" name="membership_category" value="general" class="peer sr-only" required>
                                <div class="flex items-center w-full">
                                    <div class="w-5 h-5 rounded-full border-2 border-accent/40 mr-3 peer-checked:border-accent peer-checked:bg-accent transition-all"></div>
                                    <span class="text-white font-semibold">General Member</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-accent rounded-lg opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </label>

                            <label class="relative flex items-center p-4 bg-dark-800 border-2 border-accent/20 rounded-lg cursor-pointer hover:border-accent/40 transition-colors group">
                                <input type="radio" name="membership_category" value="corporate" class="peer sr-only" required>
                                <div class="flex items-center w-full">
                                    <div class="w-5 h-5 rounded-full border-2 border-accent/40 mr-3 peer-checked:border-accent peer-checked:bg-accent transition-all"></div>
                                    <span class="text-white font-semibold">Corporate Member</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-accent rounded-lg opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Reference -->
                    <div class="mb-8">
                        <label for="reference" class="block text-sm font-semibold text-gray-300 mb-2">
                            Reference (if any)
                        </label>
                        <input type="text" id="reference" name="reference"
                               class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                               placeholder="Name of reference person (optional)">
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="mb-8 bg-dark-800 border border-accent/20 rounded-lg p-6">
                        <h4 class="text-lg font-bold text-white mb-4">Terms & Conditions</h4>
                        <div class="space-y-2 text-sm text-gray-300 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                            <p>• Membership is subject to approval by the Executive Committee of The Bengal Club.</p>
                            <p>• Membership fees are non-refundable unless otherwise decided by the Club.</p>
                            <p>• Members must comply with all rules, policies, and codes of conduct of the Club.</p>
                            <p>• Misconduct, non-payment of dues, or reputational harm to the Club may result in suspension or termination.</p>
                            <p>• Membership privileges are non-transferable.</p>
                            <p>• The Club reserves the right to amend its policies, rules, and fee structure at any time.</p>
                            <p>• All disputes shall be governed by the laws of Bangladesh.</p>
                        </div>

                        <label class="flex items-start mt-6 cursor-pointer group">
                            <input type="checkbox" name="accept_terms" class="peer sr-only" required>
                            <div class="w-5 h-5 rounded border-2 border-accent/40 mr-3 flex items-center justify-center peer-checked:bg-accent peer-checked:border-accent transition-all flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-300 text-sm">
                                I have read and agree to the membership terms and conditions <span class="text-red-500">*</span>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 btn-primary inline-flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Submit Application
                        </button>
                        <button type="reset" class="flex-1 px-8 py-4 bg-dark-800 border border-accent/20 text-white rounded-lg hover:border-accent/40 transition-all duration-300 font-semibold">
                            Reset Form
                        </button>
                    </div>
                </form>

                <!-- Success Message (Hidden by default) -->
                <div id="success-message" class="hidden mt-8 p-6 bg-green-500/10 border border-green-500/30 rounded-lg">
                    <div class="flex items-center text-green-400">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">Application submitted successfully! We will review your application and contact you shortly.</span>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center reveal-up">
                <p class="text-gray-400 mb-4">
                    For any queries regarding membership, please contact us
                </p>
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <a href="mailto:membership@thebengal.club" class="text-accent hover:text-accent-light transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        membership@thebengal.club
                    </a>
                    <a href="tel:+1234567890" class="text-accent hover:text-accent-light transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        +880 1234-567890
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(15, 112, 191, 0.1);
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(15, 112, 191, 0.4);
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(15, 112, 191, 0.6);
}
</style>

<script>
document.getElementById('membership-application-form')?.addEventListener('submit', function(e) {
    e.preventDefault();

    // Here you would normally send the form data to your backend
    // For now, we'll just show a success message

    const form = this;
    const successMessage = document.getElementById('success-message');

    // Simulate form submission
    setTimeout(() => {
        successMessage.classList.remove('hidden');
        form.reset();

        // Scroll to success message
        successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Hide success message after 5 seconds
        setTimeout(() => {
            successMessage.classList.add('hidden');
        }, 5000);
    }, 500);
});
</script>
