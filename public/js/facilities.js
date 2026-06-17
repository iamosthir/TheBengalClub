/* =====================================================
   FACILITIES.JS - Facilities Section Interactivity
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initFacilityCards();
    initFacilityHoverEffects();
});

/* =====================================================
   Facility Cards Initialization
   ===================================================== */
function initFacilityCards() {
    const cards = document.querySelectorAll('.facility-card');

    cards.forEach((card, index) => {
        // Add entrance animation delay
        card.style.setProperty('--delay', `${index * 0.1}s`);

        // Add click handler
        card.addEventListener('click', () => {
            handleFacilityCardClick(card);
        });
    });
}

/* =====================================================
   Facility Card Click Handler
   ===================================================== */
function handleFacilityCardClick(card) {
    const title = card.querySelector('.facility-title').textContent;
    const description = card.querySelector('.facility-description').textContent;

    // Add ripple effect
    createRippleEffect(card, event);

    // Optional: Show more info modal or navigate
    console.log(`Clicked on facility: ${title}`);

    // You can implement a modal or detail page here
    // For now, we'll just add a subtle feedback
    card.style.transform = 'translateY(-10px) scale(0.98)';
    setTimeout(() => {
        card.style.transform = '';
    }, 200);
}

/* =====================================================
   Ripple Effect
   ===================================================== */
function createRippleEffect(element, e) {
    const ripple = document.createElement('div');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;

    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        border-radius: 50%;
        background: rgba(15, 112, 191, 0.3);
        top: ${y}px;
        left: ${x}px;
        transform: scale(0);
        pointer-events: none;
        animation: ripple 0.6s ease-out;
    `;

    const container = element.querySelector('.facility-image');
    if (container) {
        container.style.position = 'relative';
        container.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    }
}

/* =====================================================
   Hover Effects
   ===================================================== */
function initFacilityHoverEffects() {
    const cards = document.querySelectorAll('.facility-card');

    cards.forEach(card => {
        const image = card.querySelector('.facility-image');

        if (!image) return;

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;

            image.style.transform = `
                perspective(1000px)
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
                scale(1.1)
            `;
        });

        card.addEventListener('mouseleave', () => {
            image.style.transform = '';
        });
    });
}

/* =====================================================
   Facility Badge Animation
   ===================================================== */
const facilityBadges = document.querySelectorAll('.facility-badge');

facilityBadges.forEach(badge => {
    badge.addEventListener('mouseenter', () => {
        badge.style.animation = 'pulse 0.5s ease';
    });

    badge.addEventListener('animationend', () => {
        badge.style.animation = '';
    });
});

// Add ripple animation to styles
const facilitiesStyles = document.createElement('style');
facilitiesStyles.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .facility-card {
        position: relative;
    }

    .facility-image {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(facilitiesStyles);
