/* =====================================================
   CONTACT.JS - Contact Form Functionality
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initContactForm();
    initFormAnimations();
});

/* =====================================================
   Contact Form Handling
   ===================================================== */
function initContactForm() {
    const form = document.querySelector('#contact-form');

    if (!form) return;

    const inputs = form.querySelectorAll('input, select, textarea');
    const submitBtn = form.querySelector('.submit-btn');

    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Validate form
        if (!validateForm(form)) {
            return;
        }

        // Get form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        // Show loading state
        submitBtn.disabled = true;
        const originalContent = submitBtn.innerHTML;
        submitBtn.innerHTML = `
            <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Sending...</span>
        `;

        // Simulate API call (replace with actual API call)
        try {
            await simulateContactSubmission(data);

            // Success
            showNotification('Message sent successfully! We\'ll get back to you soon.', 'success');
            form.reset();

            // Reset all floating labels
            inputs.forEach(input => {
                input.parentElement.classList.remove('has-value');
            });

        } catch (error) {
            showNotification('Something went wrong. Please try again.', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        }
    });

    // Input validation on blur
    inputs.forEach(input => {
        input.addEventListener('blur', () => {
            validateInput(input);
        });

        input.addEventListener('input', () => {
            // Remove error state on input
            input.parentElement.classList.remove('error');
        });
    });
}

/* =====================================================
   Form Validation
   ===================================================== */
function validateForm(form) {
    const inputs = form.querySelectorAll('[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!validateInput(input)) {
            isValid = false;
        }
    });

    return isValid;
}

function validateInput(input) {
    const value = input.value.trim();
    const type = input.type;
    const parent = input.parentElement;

    // Remove existing error
    parent.classList.remove('error');
    const existingError = parent.querySelector('.error-message');
    if (existingError) existingError.remove();

    // Check if required and empty
    if (input.hasAttribute('required') && !value) {
        showInputError(parent, 'This field is required');
        return false;
    }

    // Email validation
    if (type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            showInputError(parent, 'Please enter a valid email address');
            return false;
        }
    }

    // Phone validation (optional)
    if (type === 'tel' && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
        if (!phoneRegex.test(value)) {
            showInputError(parent, 'Please enter a valid phone number');
            return false;
        }
    }

    return true;
}

function showInputError(parent, message) {
    parent.classList.add('error');

    const errorEl = document.createElement('span');
    errorEl.className = 'error-message';
    errorEl.style.cssText = `
        display: block;
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        animation: fadeInUp 0.3s ease;
    `;
    errorEl.textContent = message;

    parent.appendChild(errorEl);
}

/* =====================================================
   Form Animations
   ===================================================== */
function initFormAnimations() {
    const formGroups = document.querySelectorAll('.contact-form .form-group');

    formGroups.forEach(group => {
        const input = group.querySelector('input, select, textarea');
        if (!input) return;

        // Check if input has value on load
        if (input.value) {
            group.classList.add('has-value');
        }

        // Add floating label effect
        input.addEventListener('focus', () => {
            group.classList.add('focused');
        });

        input.addEventListener('blur', () => {
            group.classList.remove('focused');
            if (input.value) {
                group.classList.add('has-value');
            } else {
                group.classList.remove('has-value');
            }
        });
    });
}

/* =====================================================
   Notification System
   ===================================================== */
function showNotification(message, type = 'info') {
    // Remove existing notification
    const existing = document.querySelector('.notification');
    if (existing) existing.remove();

    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 500;
        z-index: 9999;
        animation: slideInRight 0.5s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        max-width: 400px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        ${type === 'success'
            ? 'background: linear-gradient(135deg, #10b981, #059669); color: white;'
            : type === 'error'
            ? 'background: linear-gradient(135deg, #ef4444, #dc2626); color: white;'
            : 'background: linear-gradient(135deg, #0f70bf, #0a5a9c); color: white;'
        }
    `;

    // Icon
    const icon = type === 'success'
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
        : type === 'error'
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>'
        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';

    notification.innerHTML = `${icon}<span>${message}</span>`;

    document.body.appendChild(notification);

    // Remove after delay
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.5s ease forwards';
        setTimeout(() => notification.remove(), 500);
    }, 5000);
}

/* =====================================================
   Simulate Contact Form Submission
   ===================================================== */
function simulateContactSubmission(data) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log('Form submitted:', data);
            // Simulate 95% success rate
            if (Math.random() > 0.05) {
                resolve({ success: true });
            } else {
                reject(new Error('Submission failed'));
            }
        }, 2000);
    });
}

// Add animations to CSS
const contactStyles = document.createElement('style');
contactStyles.textContent = `
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100px);
        }
    }

    .form-group.error input,
    .form-group.error select,
    .form-group.error textarea {
        border-color: #ef4444 !important;
        animation: shake 0.5s ease;
    }

    .form-group.focused input,
    .form-group.focused select,
    .form-group.focused textarea {
        border-color: #0f70bf !important;
        box-shadow: 0 0 20px rgba(15, 112, 191, 0.15);
    }
`;
document.head.appendChild(contactStyles);
