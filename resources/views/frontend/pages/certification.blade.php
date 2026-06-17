@extends('frontend.layouts.master')

@section("content")
    <!-- Certification Section -->
    <section class="certification-section py-24 lg:py-32 min-h-screen bg-dark-800 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="section-caption">Official Document</span>
                <h1 class="section-title">Certification</h1>
                <p class="section-text">
                    View our official certification document.
                </p>
            </div>

            <!-- PDF Viewer Container -->
            <div class="pdf-viewer-container max-w-6xl mx-auto bg-dark-700 rounded-xl shadow-2xl overflow-hidden border border-dark-600">
                <div class="pdf-toolbar bg-dark-600 px-6 py-4 flex items-center justify-between border-b border-dark-500">
                    <h3 class="text-lg font-semibold text-gray-200">Certificate.pdf</h3>
                    <a href="{{ asset('pdf/certificate.pdf') }}"
                       download="certificate.pdf"
                       class="btn-download flex items-center gap-2 px-4 py-2 bg-accent hover:bg-accent-dark text-white rounded-lg transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download PDF
                    </a>
                </div>

                <!-- PDF Embed -->
                <div class="pdf-embed-wrapper" style="height: 800px;">
                    <iframe
                        src="{{ route('frontend.certification.pdf') }}"
                        type="application/pdf"
                        width="100%"
                        height="100%"
                        class="w-full h-full border-0"
                        title="Certificate PDF"
                    ></iframe>
                </div>

                <!-- Fallback for browsers that don't support embed -->
                <div class="pdf-fallback text-center py-8 px-6 hidden">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold mb-2 text-gray-200">PDF Preview Not Available</h3>
                    <p class="text-gray-400 mb-6">Your browser doesn't support embedded PDFs. Please download the file to view it.</p>
                    <a href="{{ asset('pdf/certificate.pdf') }}"
                       download="certificate.pdf"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-accent hover:bg-accent-dark text-white rounded-lg transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Certificate
                    </a>
                </div>
            </div>

            <!-- Back to Home Button -->
            <div class="text-center mt-12">
                <a href="{{ route('frontend.index') }}" class="inline-flex items-center gap-2 text-accent hover:text-accent-light transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </section>

    <style>
        .pdf-viewer-container {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15, 112, 191, 0.3);
        }

        /* Check if embed loaded, if not show fallback */
        @supports not (display: block) {
            .pdf-fallback {
                display: block !important;
            }
            .pdf-embed-wrapper {
                display: none;
            }
        }
    </style>

    <script>
        // Check if PDF loaded successfully
        document.addEventListener('DOMContentLoaded', function() {
            const iframe = document.querySelector('.pdf-embed-wrapper iframe');
            const fallback = document.querySelector('.pdf-fallback');

            // Listen for iframe load errors
            iframe.addEventListener('error', function() {
                fallback.classList.remove('hidden');
                document.querySelector('.pdf-embed-wrapper').classList.add('hidden');
            });

            // Try to detect if PDF failed to load
            setTimeout(function() {
                try {
                    if (!iframe || iframe.offsetHeight === 0) {
                        fallback.classList.remove('hidden');
                        document.querySelector('.pdf-embed-wrapper').classList.add('hidden');
                    }
                } catch (e) {
                    fallback.classList.remove('hidden');
                    document.querySelector('.pdf-embed-wrapper').classList.add('hidden');
                }
            }, 2000);
        });
    </script>
@endsection
