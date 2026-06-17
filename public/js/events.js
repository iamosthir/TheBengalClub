/* =====================================================
   EVENTS.JS - Events Section Functionality
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initEventCards();
    initEventCountdown();
});

/* =====================================================
   Event Cards Hover Effects
   ===================================================== */
function initEventCards() {
    const eventCards = document.querySelectorAll('.event-card');

    if (!eventCards.length) return;

    eventCards.forEach(card => {
        // 3D tilt effect on hover
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });
}

/* =====================================================
   Event Countdown Timer (Optional)
   ===================================================== */
function initEventCountdown() {
    const countdownElements = document.querySelectorAll('[data-countdown]');

    if (!countdownElements.length) return;

    countdownElements.forEach(element => {
        const targetDate = new Date(element.dataset.countdown).getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                element.innerHTML = 'Event Started!';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            element.innerHTML = `
                <span class="countdown-item">${days}<small>Days</small></span>
                <span class="countdown-item">${hours}<small>Hours</small></span>
                <span class="countdown-item">${minutes}<small>Mins</small></span>
                <span class="countdown-item">${seconds}<small>Secs</small></span>
            `;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
}

/* =====================================================
   Event Filter (Optional - for future use)
   ===================================================== */
function initEventFilter() {
    const filterBtns = document.querySelectorAll('.event-filter-btn');
    const eventCards = document.querySelectorAll('.event-card');

    if (!filterBtns.length || !eventCards.length) return;

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;

            eventCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.5s ease forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

/* =====================================================
   Load More Events (Optional - for future use)
   ===================================================== */
function initLoadMoreEvents() {
    const loadMoreBtn = document.querySelector('.load-more-events');
    const eventsContainer = document.querySelector('.events-grid');

    if (!loadMoreBtn || !eventsContainer) return;

    loadMoreBtn.addEventListener('click', async () => {
        loadMoreBtn.classList.add('loading');
        loadMoreBtn.textContent = 'Loading...';

        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000));

        // Here you would typically fetch more events from an API
        // For demo, we'll just show a message
        console.log('Load more events functionality would be implemented here');

        loadMoreBtn.classList.remove('loading');
        loadMoreBtn.textContent = 'View All Events';
    });
}
