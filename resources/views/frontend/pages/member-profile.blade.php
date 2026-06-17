<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00d4ff',
                        primaryLight: '#33ddff',
                        cyan: '#00d4ff',
                        dark: '#000000',
                        darker: '#000000'
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'fade-in-down': 'fadeInDown 0.6s ease-out forwards',
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)',
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)',
                            },
                        },
                        fadeInDown: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(-20px)',
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)',
                            },
                        },
                        pulseGlow: {
                            '0%, 100%': {
                                boxShadow: '0 0 15px rgba(0, 212, 255, 0.3), 0 0 30px rgba(0, 212, 255, 0.15)',
                            },
                            '50%': {
                                boxShadow: '0 0 25px rgba(0, 212, 255, 0.5), 0 0 50px rgba(0, 212, 255, 0.25)',
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)',
                            },
                            '50%': {
                                transform: 'translateY(-10px)',
                            },
                        },
                    },
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 212, 255, 0.05);
        }
        ::-webkit-scrollbar-thumb {
            background: #00d4ff;
            border-radius: 4px;
        }

        /* Mesh gradient background */
        .mesh-gradient {
            background:
                radial-gradient(at 0% 0%, rgba(0, 212, 255, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(0, 212, 255, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 212, 255, 0.06) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(0, 212, 255, 0.04) 0px, transparent 50%);
            background-size: 100% 100%;
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 4px solid rgba(0, 212, 255, 0.2);
            border-top-left-radius: 50px;
            border-top-right-radius: 50px;
        }

        .glass-card {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 212, 255, 0.15);
        }

        /* Info item gradient sweep animation */
        .info-item {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .info-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(0, 212, 255, 0.15) 25%,
                rgba(0, 212, 255, 0.25) 50%,
                rgba(0, 212, 255, 0.15) 75%,
                transparent 100%);
            z-index: -1;
            transition: left 0.6s ease-in-out;
        }

        .info-item:hover::before {
            left: 100%;
        }

        .info-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                transparent,
                rgba(0, 212, 255, 0.15),
                transparent);
            background-size: 200% 100%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .info-item:hover::after {
            opacity: 1;
            animation: gradientSweep 1.5s ease-in-out infinite;
        }

        @keyframes gradientSweep {
            0% {
                background-position: -100% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        /* Neon glow hover effect */
        .neon-hover {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .neon-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 212, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .neon-hover:hover::before {
            left: 100%;
        }

        .neon-hover:hover {
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3), 0 0 30px rgba(0, 212, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Profile image glow */
        .profile-glow {
            box-shadow: 0 0 25px rgba(0, 212, 255, 0.4), 0 0 50px rgba(0, 212, 255, 0.2);
            animation: pulseGlow 3s ease-in-out infinite;
        }

        /* Button gradient */
        .btn-gradient {
            background: linear-gradient(135deg, #00a8cc 0%, #00d4ff 50%, #00a8cc 100%);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Social icon hover */
        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 0 25px rgba(0, 212, 255, 0.4);
        }

        /* Staggered animation delays */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }

        /* QR Code frame */
        .qr-frame {
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.1), rgba(0, 212, 255, 0.05));
            border: 2px solid rgba(0, 212, 255, 0.4);
        }

        /* Floating bar */
        .floating-bar {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid rgba(0, 212, 255, 0.3);
        }

        /* Mobile container on desktop */
        @media (min-width: 768px) {
            .mobile-container {
                max-width: 400px;
                height: 850px;
                border-radius: 40px;
                border: 8px solid #1a1a1a;
                box-shadow: 0 25px 80px rgba(0, 0, 0, 0.8), 0 0 60px rgba(0, 212, 255, 0.3);
                overflow: hidden;
            }
        }

        @media (max-width: 767px) {
            .mobile-container {
                height: 100vh;
                border-radius: 0;
                border: none;
                box-shadow: none;
                overflow: hidden;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 mesh-gradient bg-black">

    <!-- Mobile Container -->
    <div class="mobile-container w-full h-[850px] relative bg-black md:h-[850px]">

        <!-- Sticky Header -->
        <header class="sticky top-0 z-50 glass animate-fade-in-down">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Company Logo -->
                <div class="flex items-center gap-2">
                    @if($settings->logo)
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'Company Logo' }}" class="h-11 w-auto">
                    @else
                        <span class="text-primary font-bold text-lg">{{ $settings->site_name ?? 'BengalClub' }}</span>
                    @endif
                </div>

            </div>
        </header>

        <!-- Main Content -->
        <main class="overflow-y-auto h-[calc(850px-140px)] pb-24 scroll-smooth md:h-[calc(850px-140px)]">

            <!-- Profile Section -->
            <section class="flex flex-col items-center pt-8 pb-6 animate-fade-in-up">
                <!-- Profile Image -->
                <div class="relative mb-6">
                    <div class="w-32 h-32 rounded-full profile-glow p-1">
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-cyan-500 to-cyan-700 flex items-center justify-center overflow-hidden">
                            @if($user->profile->photo)
                                <img src="{{ asset('storage/' . $user->profile->photo) }}"
                                     alt="{{ $user->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-5xl text-white"></i>
                            @endif
                        </div>
                    </div>
                    <!-- Status Indicator -->
                    <div class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
                </div>

                <!-- Name & Title -->
                <h1 class="text-cyan text-2xl font-bold mb-1">{{ $user->name }}</h1>
                <p class="text-gray-300 text-sm font-medium mb-6">{{ $user->profile->profession_organization ?? 'Member' }}</p>

            </section>


            <!-- Personal Details -->
            <section class="px-6 py-4 animate-fade-in-up delay-200">
                <div class="glass-card rounded-2xl p-5">
                    <h2 class="text-cyan font-semibold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-user text-cyan"></i>
                        Personal Details
                    </h2>
                    <div class="space-y-3">
                        <div class="info-item block glass rounded-xl p-4 border border-cyan/20 hover:border-cyan/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan/20 hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-cyan/10 flex items-center justify-center">
                                    <i class="fas fa-id-badge text-cyan"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Member ID</p>
                                    <p class="text-gray-100 text-sm font-medium">{{ $user->profile->manual_member_id ?: '2025' . str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </div>
                        <a href="mailto:{{ $user->email }}" class="info-item block glass rounded-xl p-4 border border-cyan/20 hover:border-cyan/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan/20 hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-cyan/10 flex items-center justify-center">
                                    <i class="fas fa-envelope text-cyan"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Email</p>
                                    <p class="text-gray-100 text-sm font-medium">{{ $user->email }}</p>
                                </div>
                                <i class="fas fa-chevron-right text-cyan/50 ml-auto text-sm"></i>
                            </div>
                        </a>
                        <a href="tel:{{ $user->profile->mobile }}" class="info-item block glass rounded-xl p-4 border border-cyan/20 hover:border-cyan/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan/20 hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-cyan/10 flex items-center justify-center">
                                    <i class="fas fa-phone-alt text-cyan"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Phone</p>
                                    <p class="text-gray-100 text-sm font-medium">{{ $user->profile->mobile }}</p>
                                </div>
                                <i class="fas fa-chevron-right text-cyan/50 ml-auto text-sm"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Company Information -->
            <section class="px-6 py-6 animate-fade-in-up delay-100">
                <div class="glass-card rounded-2xl p-5">
                    <h2 class="text-cyan font-semibold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-building text-cyan"></i>
                        {{ $settings->site_name ?? 'Company' }}
                    </h2>
                    @if($settings->site_tagline)
                        <p class="text-gray-300 text-sm leading-relaxed mb-6">
                            {{ $settings->site_tagline }}
                        </p>
                    @endif
                    @if($settings->address)
                        <p class="text-gray-100 text-sm font-bold mb-1">Address</p>
                        <p class="text-gray-300 text-sm leading-relaxed mb-4">
                            {{ $settings->address }}
                            @if($settings->city || $settings->zip_code || $settings->country)
                                <br>
                                @if($settings->city){{ $settings->city }}@endif
                                @if($settings->zip_code), {{ $settings->zip_code }}@endif
                                @if($settings->country), {{ $settings->country }}@endif
                            @endif
                        </p>
                    @endif

                    <!-- Map -->
                    <a href="https://www.google.com/maps?q=23.770316260050162,90.40503061224256" target="_blank" class="block rounded-xl overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7302!2d90.40503061224256!3d23.770316260050162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ2JzEzLjEiTiA5MMKwMjQnMTguMSJF!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd"
                            width="100%"
                            height="200"
                            style="border:0; pointer-events: none;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </a>
                </div>
            </section>

            <!-- Social Media Icons -->
            @php
                $profile = $user->profile;
            @endphp
            @if($profile?->facebook_url || $profile?->twitter_url || $profile?->instagram_url || $profile?->linkedin_url || $profile?->youtube_url)
                <section class="px-6 py-4 animate-fade-in-up delay-300">
                    <h2 class="text-cyan font-semibold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-share-alt text-cyan"></i>
                        Connect
                    </h2>
                    <div class="grid grid-cols-4 gap-4">
                        @if($profile?->linkedin_url)
                            <a href="{{ $profile->linkedin_url }}" target="_blank" class="social-icon glass-card rounded-xl p-4 flex items-center justify-center text-cyan hover:text-white">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                        @endif
                        @if($profile?->facebook_url)
                            <a href="{{ $profile->facebook_url }}" target="_blank" class="social-icon glass-card rounded-xl p-4 flex items-center justify-center text-cyan hover:text-white">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                        @endif
                        @if($profile?->instagram_url)
                            <a href="{{ $profile->instagram_url }}" target="_blank" class="social-icon glass-card rounded-xl p-4 flex items-center justify-center text-cyan hover:text-white">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        @endif
                        @if($profile?->youtube_url)
                            <a href="{{ $profile->youtube_url }}" target="_blank" class="social-icon glass-card rounded-xl p-4 flex items-center justify-center text-cyan hover:text-white">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        @endif
                        @if($profile?->twitter_url)
                            <a href="{{ $profile->twitter_url }}" target="_blank" class="social-icon glass-card rounded-xl p-4 flex items-center justify-center text-cyan hover:text-white">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        @endif
                    </div>
                </section>
            @endif

            <!-- QR Code Section -->
            <section class="px-6 py-6 pb-8 animate-fade-in-up delay-400">
                <div class="flex flex-col items-center">
                    <div class="qr-frame rounded-2xl p-6 animate-float bg-white">
                        <img src="{{ route('member.qr-code', $user->id) }}"
                             alt="QR Code"
                             class="w-36 h-36 rounded-lg">
                    </div>
                    <p class="text-gray-400 text-sm mt-4">Scan to save contact</p>
                </div>
            </section>

        </main>

        <!-- Floating Action Bar -->
        <footer class="fixed bottom-0 left-0 right-0 floating-bar px-6 py-4 animate-fade-in-up delay-500 md:absolute">
            <div class="flex gap-4 max-w-[400px] mx-auto">
                <a href="{{ route('member.vcard', $user->id) }}" class="neon-hover flex-1 btn-gradient text-white py-3 rounded-xl font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    Save Contact
                </a>
                <a href="tel:{{ $user->profile->mobile }}" class="neon-hover flex-1 btn-gradient text-white py-3 rounded-xl font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-phone"></i>
                    Call
                </a>
            </div>
        </footer>

    </div>

</body>
</html>
