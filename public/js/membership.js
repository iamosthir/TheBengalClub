/* =====================================================
   MEMBERSHIP.JS - Membership Form Page Scripts
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    // Form submission handler
    const membershipForm = document.getElementById('membership-form');

    if (membershipForm) {
        membershipForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Get form data
            const formData = new FormData(membershipForm);
            const data = Object.fromEntries(formData);

            // Show success message (you can replace this with actual form submission)
            showSuccessMessage();

            // Reset form
            membershipForm.reset();
        });
    }

    // Success message function
    function showSuccessMessage() {
        const message = document.createElement('div');
        message.className = 'success-message';
        message.innerHTML = `
            <div class="success-content">
                <svg class="success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3>Application Submitted Successfully!</h3>
                <p>Thank you for your interest in joining The Bengal Club. Our team will review your application and contact you within 3-5 business days.</p>
                <button class="btn-primary close-message">Close</button>
            </div>
        `;

        document.body.appendChild(message);

        // Add styles dynamically
        const style = document.createElement('style');
        style.textContent = `
            .success-message {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(10px);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                animation: fadeIn 0.3s ease;
            }

            .success-content {
                background: var(--dark-700);
                border: 1px solid rgba(15, 112, 191, 0.3);
                border-radius: 24px;
                padding: 3rem;
                max-width: 500px;
                text-align: center;
                animation: scaleIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .success-icon {
                width: 80px;
                height: 80px;
                margin: 0 auto 1.5rem;
                color: var(--accent);
            }

            .success-content h3 {
                font-family: 'Playfair Display', serif;
                font-size: 1.75rem;
                color: var(--white);
                margin-bottom: 1rem;
            }

            .success-content p {
                color: var(--gray-400);
                line-height: 1.6;
                margin-bottom: 2rem;
            }

            .close-message {
                width: 100%;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }
        `;
        document.head.appendChild(style);

        // Close button handler
        const closeBtn = message.querySelector('.close-message');
        closeBtn.addEventListener('click', () => {
            message.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => {
                message.remove();
                style.remove();
            }, 300);
        });

        // Add fadeOut animation
        const fadeOutStyle = document.createElement('style');
        fadeOutStyle.textContent = `
            @keyframes fadeOut {
                from {
                    opacity: 1;
                }
                to {
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(fadeOutStyle);
    }

    // Form validation enhancements
    const inputs = membershipForm.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', () => {
            if (input.value.trim() !== '') {
                input.style.borderColor = 'var(--accent)';
            }
        });

        input.addEventListener('focus', () => {
            input.style.borderColor = 'var(--accent)';
        });
    });

    // Mobile number formatting (Bangladesh format)
    const mobileInput = document.getElementById('mobile');
    if (mobileInput) {
        mobileInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('880')) {
                value = value.substring(3);
            }
            if (value.length > 11) {
                value = value.substring(0, 11);
            }
            e.target.value = value ? '+880 ' + value : '';
        });
    }
});
