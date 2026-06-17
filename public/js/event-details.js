// Event Details - Slideshow functionality
let currentSlideIndex = 0;
let slideInterval;

// Initialize slideshow on page load
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');

    if (slides.length > 1) {
        // Start auto-play
        startSlideshow();

        // Pause on hover
        const slideshowContainer = document.querySelector('.slideshow-container');
        if (slideshowContainer) {
            slideshowContainer.addEventListener('mouseenter', stopSlideshow);
            slideshowContainer.addEventListener('mouseleave', startSlideshow);
        }
    }
});

// Change slide
function changeSlide(direction) {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');

    if (slides.length === 0) return;

    // Remove active class from current slide
    slides[currentSlideIndex].classList.remove('active');
    if (indicators[currentSlideIndex]) {
        indicators[currentSlideIndex].classList.remove('active');
    }

    // Calculate new index
    currentSlideIndex += direction;

    // Wrap around
    if (currentSlideIndex >= slides.length) {
        currentSlideIndex = 0;
    } else if (currentSlideIndex < 0) {
        currentSlideIndex = slides.length - 1;
    }

    // Add active class to new slide
    slides[currentSlideIndex].classList.add('active');
    if (indicators[currentSlideIndex]) {
        indicators[currentSlideIndex].classList.add('active');
    }

    // Restart auto-play timer
    stopSlideshow();
    startSlideshow();
}

// Go to specific slide
function goToSlide(index) {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');

    if (slides.length === 0 || index === currentSlideIndex) return;

    // Remove active class from current slide
    slides[currentSlideIndex].classList.remove('active');
    if (indicators[currentSlideIndex]) {
        indicators[currentSlideIndex].classList.remove('active');
    }

    // Set new index
    currentSlideIndex = index;

    // Add active class to new slide
    slides[currentSlideIndex].classList.add('active');
    if (indicators[currentSlideIndex]) {
        indicators[currentSlideIndex].classList.add('active');
    }

    // Restart auto-play timer
    stopSlideshow();
    startSlideshow();
}

// Start slideshow auto-play
function startSlideshow() {
    const slides = document.querySelectorAll('.slide');
    if (slides.length > 1) {
        slideInterval = setInterval(() => {
            changeSlide(1);
        }, 5000); // Change slide every 5 seconds
    }
}

// Stop slideshow auto-play
function stopSlideshow() {
    if (slideInterval) {
        clearInterval(slideInterval);
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const slides = document.querySelectorAll('.slide');
    if (slides.length > 1) {
        if (e.key === 'ArrowLeft') {
            changeSlide(-1);
        } else if (e.key === 'ArrowRight') {
            changeSlide(1);
        }
    }
});

// Touch/Swipe support for mobile
let touchStartX = 0;
let touchEndX = 0;

document.addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
}, false);

document.addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
}, false);

function handleSwipe() {
    const slides = document.querySelectorAll('.slide');
    if (slides.length > 1) {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swiped left - next slide
                changeSlide(1);
            } else {
                // Swiped right - previous slide
                changeSlide(-1);
            }
        }
    }
}

// Smooth scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for animation
document.querySelectorAll('.event-description-card, .info-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.8s ease-out';
    observer.observe(el);
});
