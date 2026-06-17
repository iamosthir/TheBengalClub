/* =====================================================
   HEADER.JS - Header & Navigation Functionality
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initMobileMenu();
    initHeaderSearch();
    initActiveNavLink();
});

/* =====================================================
   Header Scroll Effect
   ===================================================== */
function initHeader() {
    const header = document.querySelector('#header');
    if (!header) return;

    let lastScrollY = window.scrollY;
    let ticking = false;

    function updateHeader() {
        const scrollY = window.scrollY;

        // Add/remove scrolled class
        if (scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Hide/show header on scroll (optional - currently disabled)
        // if (scrollY > lastScrollY && scrollY > 100) {
        //     header.style.transform = 'translateY(-100%)';
        // } else {
        //     header.style.transform = 'translateY(0)';
        // }

        lastScrollY = scrollY;
        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    });

    // Initial check
    updateHeader();
}

/* =====================================================
   Mobile Drawer Toggle
   ===================================================== */
function initMobileMenu() {
    const menuBtn  = document.querySelector('#mobile-menu-btn');
    const drawer   = document.querySelector('#mobile-drawer');
    const backdrop = document.querySelector('#drawer-backdrop');
    const closeBtn = document.querySelector('#drawer-close-btn');

    if (!menuBtn || !drawer || !backdrop) return;

    function openDrawer() {
        drawer.classList.add('open');
        backdrop.classList.add('visible');
        menuBtn.classList.add('active');
        drawer.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        drawer.classList.remove('open');
        backdrop.classList.remove('visible');
        menuBtn.classList.remove('active');
        drawer.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    menuBtn.addEventListener('click', () => {
        drawer.classList.contains('open') ? closeDrawer() : openDrawer();
    });

    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    backdrop.addEventListener('click', closeDrawer);

    drawer.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeDrawer);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && drawer.classList.contains('open')) closeDrawer();
    });
}

/* =====================================================
   Header Search Toggle
   ===================================================== */
function initHeaderSearch() {
    const openBtn      = document.getElementById('search-open-btn');
    const closeBtn     = document.getElementById('search-close-btn');
    const desktopBar   = document.getElementById('header-search-bar');
    const mobileBar    = document.getElementById('mobile-search-bar');
    const desktopInput = document.getElementById('header-search-input');
    const mobileInput  = document.getElementById('mobile-search-input');
    const header       = document.getElementById('header');
    // The CTA buttons div inside #nav-cta (first div child on desktop)
    const ctaDiv       = document.querySelector('#nav-cta > div');

    if (!openBtn) return;

    const isDesktop = () => window.innerWidth >= 1024;

    function openSearch() {
        if (isDesktop()) {
            header.classList.add('search-open');
            desktopBar && desktopBar.classList.add('visible');
            if (ctaDiv) { ctaDiv.style.opacity = '0'; ctaDiv.style.visibility = 'hidden'; ctaDiv.style.pointerEvents = 'none'; }
            setTimeout(() => desktopInput && desktopInput.focus(), 50);
        } else {
            mobileBar && mobileBar.classList.add('visible');
            setTimeout(() => mobileInput && mobileInput.focus(), 50);
        }
        openBtn.setAttribute('aria-expanded', 'true');
    }

    function closeSearch() {
        header.classList.remove('search-open');
        desktopBar && desktopBar.classList.remove('visible');
        mobileBar  && mobileBar.classList.remove('visible');
        if (ctaDiv) { ctaDiv.style.opacity = ''; ctaDiv.style.visibility = ''; ctaDiv.style.pointerEvents = ''; }
        if (desktopInput) desktopInput.value = '';
        if (mobileInput)  mobileInput.value  = '';
        openBtn.setAttribute('aria-expanded', 'false');
    }

    openBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = desktopBar?.classList.contains('visible') || mobileBar?.classList.contains('visible');
        isOpen ? closeSearch() : openSearch();
    });

    if (closeBtn) closeBtn.addEventListener('click', closeSearch);

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSearch();
    });

    // Close on click outside
    document.addEventListener('click', (e) => {
        const bar = isDesktop() ? desktopBar : mobileBar;
        if (bar && !bar.contains(e.target) && !openBtn.contains(e.target)) {
            closeSearch();
        }
    });

    // Re-evaluate desktop vs mobile on resize.
    // Only react to WIDTH changes (orientation / breakpoint switch) — opening the
    // mobile keyboard fires a resize with a height-only change, which must NOT
    // close the search bar.
    let lastWidth = window.innerWidth;
    window.addEventListener('resize', () => {
        if (window.innerWidth !== lastWidth) {
            lastWidth = window.innerWidth;
            closeSearch();
        }
    });
}

/* =====================================================
   Active Navigation Link Highlighting
   ===================================================== */
function initActiveNavLink() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

    if (!sections.length || !navLinks.length) return;

    function updateActiveLink() {
        const scrollY = window.scrollY;
        const headerHeight = document.querySelector('#header').offsetHeight;

        sections.forEach(section => {
            const sectionTop = section.offsetTop - headerHeight - 100;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }

    // Throttled scroll handler
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                updateActiveLink();
                ticking = false;
            });
            ticking = true;
        }
    });

    // Initial check
    updateActiveLink();
}
