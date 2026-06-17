/* =====================================================
   NEWSLETTER.JS - Newsletter Subscription Functionality
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initNewsletterForm();
});

/* =====================================================
   Newsletter Form Handling
   ===================================================== */
function initNewsletterForm() {
    const form = document.querySelector('#newsletter-form');

    if (!form) return;

    const input = form.querySelector('.newsletter-input');
    const submitBtn = form.querySelector('.newsletter-btn');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = input.value.trim();

        // Validate email
        if (!validateEmail(email)) {
            showFormMessage(form, 'Please enter a valid email address', 'error');
            shakeElement(input);
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        const originalContent = submitBtn.innerHTML;
        submitBtn.innerHTML = `
            <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Subscribing...</span>
        `;

        // Simulate API call (replace with actual API call)
        try {
            await simulateNewsletterSubscription(email);

            // Success state
            form.classList.add('success');
            showFormMessage(form, 'Thank you for subscribing! Check your email for confirmation.', 'success');
            input.value = '';

            // Reset success state after delay
            setTimeout(() => {
                form.classList.remove('success');
            }, 5000);

        } catch (error) {
            // Error state
            showFormMessage(form, 'Something went wrong. Please try again.', 'error');
        } finally {
            // Reset button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        }
    });

    // Input focus effects
    input.addEventListener('focus', () => {
        form.querySelector('.form-group').classList.add('focused');
    });

    input.addEventListener('blur', () => {
        form.querySelector('.form-group').classList.remove('focused');
    });
}

/* =====================================================
   Helper Functions
   ===================================================== */

// Email validation
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Show form message
function showFormMessage(form, message, type) {
    // Remove existing message
    const existingMessage = form.querySelector('.form-message');
    if (existingMessage) {
        existingMessage.remove();
    }

    // Create message element
    const messageEl = document.createElement('div');
    messageEl.className = `form-message ${type}`;
    messageEl.style.cssText = `
        margin-top: 1rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        text-align: center;
        animation: fadeInUp 0.3s ease;
        ${type === 'success'
            ? 'background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);'
            : 'background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);'
        }
    `;
    messageEl.textContent = message;

    form.appendChild(messageEl);

    // Remove message after delay
    setTimeout(() => {
        messageEl.style.animation = 'fadeOut 0.3s ease forwards';
        setTimeout(() => messageEl.remove(), 300);
    }, 5000);
}

// Shake animation for invalid input
function shakeElement(element) {
    element.style.animation = 'shake 0.5s ease';
    setTimeout(() => {
        element.style.animation = '';
    }, 500);
}

// Simulate newsletter subscription
function simulateNewsletterSubscription(email) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            // Simulate 90% success rate
            if (Math.random() > 0.1) {
                resolve({ success: true, email });
            } else {
                reject(new Error('Subscription failed'));
            }
        }, 1500);
    });
}

// Add shake animation to CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }

    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-10px); }
    }

    @keyframes animate-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .animate-spin {
        animation: animate-spin 1s linear infinite;
    }
`;
document.head.appendChild(style);
