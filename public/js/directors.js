/* =====================================================
   DIRECTORS.JS - Board of Directors Marquee Slider
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initDirectorsMarquee();
});

/* =====================================================
   Directors Marquee Slider
   ===================================================== */
function initDirectorsMarquee() {
    const marquee = document.querySelector('.directors-marquee');
    const track = document.querySelector('.marquee-track');

    if (!marquee || !track) return;

    // Clone the track content for seamless looping
    // This is already done in HTML, but we can do it dynamically too
    // cloneMarqueeContent();

    // Pause on hover
    track.addEventListener('mouseenter', () => {
        track.style.animationPlayState = 'paused';
    });

    track.addEventListener('mouseleave', () => {
        track.style.animationPlayState = 'running';
    });

    // Adjust animation speed based on screen width
    function adjustMarqueeSpeed() {
        const screenWidth = window.innerWidth;
        let duration = 40; // Default duration in seconds

        if (screenWidth < 768) {
            duration = 25;
        } else if (screenWidth < 1024) {
            duration = 30;
        }

        track.style.animationDuration = `${duration}s`;
    }

    // Initial adjustment
    adjustMarqueeSpeed();

    // Adjust on resize (debounced)
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(adjustMarqueeSpeed, 200);
    });
}

/* =====================================================
   Clone Marquee Content (if needed dynamically)
   ===================================================== */
function cloneMarqueeContent() {
    const track = document.querySelector('.marquee-track');
    if (!track) return;

    const cards = track.querySelectorAll('.director-card');
    if (cards.length === 0) return;

    // Clone all cards and append to track
    cards.forEach(card => {
        const clone = card.cloneNode(true);
        track.appendChild(clone);
    });
}

/* =====================================================
   Alternative: Manual Scroll Animation (for more control)
   ===================================================== */
function initManualMarquee() {
    const marquee = document.querySelector('.directors-marquee');
    const track = document.querySelector('.marquee-track');

    if (!marquee || !track) return;

    let scrollAmount = 0;
    const scrollSpeed = 1; // pixels per frame
    let isPaused = false;
    let animationId;

    // Calculate track width
    const cardWidth = 280; // card width + gap
    const cards = track.querySelectorAll('.director-card');
    const originalCards = cards.length / 2; // Since we have duplicates
    const resetPoint = originalCards * (cardWidth + 32); // 32px gap

    function scrollMarquee() {
        if (!isPaused) {
            scrollAmount += scrollSpeed;

            // Reset position for seamless loop
            if (scrollAmount >= resetPoint) {
                scrollAmount = 0;
            }

            track.style.transform = `translateX(-${scrollAmount}px)`;
        }

        animationId = requestAnimationFrame(scrollMarquee);
    }

    // Start animation
    scrollMarquee();

    // Pause on hover
    marquee.addEventListener('mouseenter', () => {
        isPaused = true;
    });

    marquee.addEventListener('mouseleave', () => {
        isPaused = false;
    });

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
        cancelAnimationFrame(animationId);
    });
}
