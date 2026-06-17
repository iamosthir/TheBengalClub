/* =====================================================
   BANNER.JS - Hero Slider Functionality
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initBannerSlider();
});

/* =====================================================
   Banner Slider
   ===================================================== */
function initBannerSlider() {
    const slider = document.querySelector('.banner-slider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.banner-slide');
    const dots = document.querySelectorAll('.banner-dot');
    const prevBtn = document.querySelector('.banner-prev');
    const nextBtn = document.querySelector('.banner-next');

    if (!slides.length) return;

    let currentSlide = 0;
    let slideInterval;
    let isTransitioning = false;
    const autoPlayDelay = 6000; // 6 seconds

    // Initialize slider
    function init() {
        showSlide(currentSlide);
        startAutoPlay();
        addEventListeners();
    }

    // Show specific slide
    function showSlide(index) {
        if (isTransitioning) return;
        isTransitioning = true;

        // Handle index bounds
        if (index >= slides.length) index = 0;
        if (index < 0) index = slides.length - 1;

        // Remove active class from all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });

        // Activate current slide and dot
        slides[index].classList.add('active');
        if (dots[index]) {
            dots[index].classList.add('active');
        }

        currentSlide = index;

        // Reset transition lock after animation
        setTimeout(() => {
            isTransitioning = false;
        }, 1000);
    }

    // Next slide
    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    // Previous slide
    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    // Go to specific slide
    function goToSlide(index) {
        showSlide(index);
        resetAutoPlay();
    }

    // Auto play
    function startAutoPlay() {
        slideInterval = setInterval(nextSlide, autoPlayDelay);
    }

    // Stop auto play
    function stopAutoPlay() {
        clearInterval(slideInterval);
    }

    // Reset auto play
    function resetAutoPlay() {
        stopAutoPlay();
        startAutoPlay();
    }

    // Add event listeners
    function addEventListeners() {
        // Navigation buttons
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoPlay();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoPlay();
            });
        }

        // Dots navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
            });
        });

        // Pause on hover
        slider.addEventListener('mouseenter', stopAutoPlay);
        slider.addEventListener('mouseleave', startAutoPlay);

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            // Only respond when banner is in viewport
            const banner = document.querySelector('.banner-section');
            if (!banner) return;

            const rect = banner.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;

            if (isVisible) {
                if (e.key === 'ArrowRight') {
                    nextSlide();
                    resetAutoPlay();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                    resetAutoPlay();
                }
            }
        });

        // Touch/Swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        slider.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        slider.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swiped left - next slide
                    nextSlide();
                } else {
                    // Swiped right - previous slide
                    prevSlide();
                }
                resetAutoPlay();
            }
        }
    }

    // Initialize
    init();
}

/* =====================================================
   Parallax Effect for Banner (Optional)
   ===================================================== */
function initBannerParallax() {
    const bannerBg = document.querySelectorAll('.slide-bg');

    if (!bannerBg.length) return;

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        bannerBg.forEach(bg => {
            bg.style.transform = `scale(1.1) translateY(${scrollY * 0.3}px)`;
        });
    });
}
