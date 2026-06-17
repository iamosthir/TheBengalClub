/* =====================================================
   MEMBERSHIP APPLICATION - JavaScript
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initFlatpickr();
    initTermsModal();
    initPhotoUpload();
    initNidPhotoUpload();
    initPaymentMethod();
    initPaymentProofUpload();
    initStepNavigation();
    initFormSubmission();
});

/* =====================================================
   Flatpickr Date Picker Initialization
   ===================================================== */
function initFlatpickr() {
    const dobField = document.getElementById('date_of_birth');

    if (dobField && typeof flatpickr !== 'undefined') {
        flatpickr(dobField, {
            dateFormat: "Y-m-d",
            maxDate: "today",
            altInput: true,
            altFormat: "F j, Y",
            theme: "dark",
            disableMobile: false,
            locale: {
                firstDayOfWeek: 1
            }
        });
    }
}

/* =====================================================
   Two-Step Form Navigation
   ===================================================== */
function initStepNavigation() {
    const nextBtn  = document.getElementById('next-btn');
    const backBtn  = document.getElementById('back-btn');
    const resetBtn = document.getElementById('reset-btn');
    const step1    = document.getElementById('step-1');
    const step2    = document.getElementById('step-2');

    if (!nextBtn || !backBtn || !step1 || !step2) return;

    nextBtn.addEventListener('click', () => {
        if (!validateStep1()) return;
        goToStep(2);
    });

    backBtn.addEventListener('click', () => {
        goToStep(1);
    });

    // Reset button clears everything and returns to step 1
    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            clearErrors();
            // Let the native reset fire first, then snap back to step 1
            setTimeout(() => goToStep(1), 50);
        });
    }
}

function goToStep(step) {
    const step1     = document.getElementById('step-1');
    const step2     = document.getElementById('step-2');
    const dot1      = document.getElementById('step-dot-1');
    const dot2      = document.getElementById('step-dot-2');
    const label1    = document.getElementById('step-label-1');
    const label2    = document.getElementById('step-label-2');
    const connector = document.getElementById('step-connector');

    if (step === 2) {
        step1.classList.add('hidden');
        step2.classList.remove('hidden');

        // Update indicator — step 1 done, step 2 active
        dot1.classList.remove('bg-accent', 'text-white');
        dot1.classList.add('bg-green-500', 'text-white');
        dot1.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>`;

        dot2.classList.remove('bg-dark-800', 'border-accent/30', 'text-gray-400');
        dot2.classList.add('bg-accent', 'text-white', 'border-accent');
        dot2.textContent = '2';

        label1.classList.remove('text-white');
        label1.classList.add('text-green-400');
        label2.classList.remove('text-gray-400');
        label2.classList.add('text-white');

        connector.classList.remove('bg-accent/30');
        connector.classList.add('bg-green-500/60');
    } else {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');

        // Restore indicator to step 1 active
        dot1.classList.remove('bg-green-500');
        dot1.classList.add('bg-accent', 'text-white');
        dot1.textContent = '1';

        dot2.classList.remove('bg-accent', 'text-white', 'border-accent');
        dot2.classList.add('bg-dark-800', 'border-accent/30', 'text-gray-400');
        dot2.textContent = '2';

        label1.classList.remove('text-green-400');
        label1.classList.add('text-white');
        label2.classList.remove('text-white');
        label2.classList.add('text-gray-400');

        connector.classList.remove('bg-green-500/60');
        connector.classList.add('bg-accent/30');
    }

    // Scroll to top of form
    const formWrapper = document.getElementById('membership-application');
    if (formWrapper) {
        formWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

/* =====================================================
   Step 1 Validation
   ===================================================== */
function validateStep1() {
    clearErrors();
    let valid = true;

    const required = [
        { id: 'name',                    label: 'Full name' },
        { id: 'date_of_birth',           label: 'Date of birth' },
        { id: 'nid_passport',            label: 'NID / Passport number' },
        { id: 'profession_organization', label: 'Profession / Organization' },
        { id: 'mobile',                  label: 'Mobile number' },
        { id: 'email',                   label: 'Email address' },
        { id: 'address',                 label: 'Present address' },
    ];

    required.forEach(({ id, label }) => {
        const input = document.getElementById(id);
        if (!input) return;
        if (!input.value.trim()) {
            setFieldError(input, `${label} is required.`);
            valid = false;
        }
    });

    // Membership category
    const categorySelected = document.querySelector('input[name="membership_category_id"]:checked');
    if (!categorySelected) {
        const errEl = document.getElementById('category-error');
        if (errEl) {
            errEl.textContent = 'Please select a membership category.';
            errEl.classList.remove('hidden');
        }
        valid = false;
    }

    if (!valid) {
        // Scroll to first error
        const firstErr = document.querySelector('#step-1 .error-message:not(.hidden)');
        if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    return valid;
}

function setFieldError(input, message) {
    const formGroup = input.closest('.form-group') || input.parentElement;
    const errorSpan = formGroup.querySelector('.error-message');

    formGroup.classList.add('error');
    if (errorSpan) {
        errorSpan.textContent = message;
        errorSpan.classList.remove('hidden');
    }
    input.style.borderColor = '#ef4444';
}

/* =====================================================
   Terms & Conditions Modal
   ===================================================== */
function initTermsModal() {
    const openModalBtn = document.getElementById('open-tos-modal');

    if (!openModalBtn) return;

    openModalBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showTermsModal();
    });
}

function showTermsModal() {
    const modal = document.createElement('div');
    modal.className = 'tos-modal';
    modal.innerHTML = `
        <div class="tos-modal-backdrop"></div>
        <div class="tos-modal-content">
            <div class="tos-modal-header">
                <h3>Terms & Conditions</h3>
                <button type="button" class="tos-modal-close" aria-label="Close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="tos-modal-body-wrapper" style="position: relative;">
                <div class="tos-modal-body">
                    <h4 style="margin-bottom: 20px;">Membership Terms & Conditions</h4>
                    <ul style="list-style-type: disc; padding-left: 25px; line-height: 1.8;">
                        <li style="margin-bottom: 15px;">Membership is subject to approval by the Executive Committee of The Bengal Club.</li>
                        <li style="margin-bottom: 15px;">Membership fees are non-refundable unless otherwise decided by the Club.</li>
                        <li style="margin-bottom: 15px;">Members must comply with all rules, policies, and codes of conduct of the Club.</li>
                        <li style="margin-bottom: 15px;">Misconduct, non-payment of dues, or reputational harm to the Club may result in suspension or termination.</li>
                        <li style="margin-bottom: 15px;">Membership privileges are non-transferable.</li>
                        <li style="margin-bottom: 15px;">The Club reserves the right to amend its policies, rules, and fee structure at any time.</li>
                        <li style="margin-bottom: 15px;">All disputes shall be governed by the laws of Bangladesh.</li>
                    </ul>
                </div>
                <div class="scroll-indicator">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
            <div class="tos-modal-footer">
                <button type="button" class="btn-reject" id="reject-tos">Reject</button>
                <button type="button" class="btn-accept" id="accept-tos" disabled>Accept</button>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    const backdrop       = modal.querySelector('.tos-modal-backdrop');
    const closeBtn       = modal.querySelector('.tos-modal-close');
    const acceptBtn      = modal.querySelector('#accept-tos');
    const rejectBtn      = modal.querySelector('#reject-tos');
    const scrollIndicator = modal.querySelector('.scroll-indicator');
    const tosCheckbox    = document.getElementById('is_tos_accepted');

    scrollIndicator.style.display = 'none';
    acceptBtn.disabled = false;

    acceptBtn.addEventListener('click', () => { tosCheckbox.checked = true;  closeModal(modal); });
    rejectBtn.addEventListener('click', () => { tosCheckbox.checked = false; closeModal(modal); });
    closeBtn.addEventListener('click',  () => closeModal(modal));
    backdrop.addEventListener('click',  () => closeModal(modal));

    document.addEventListener('keydown', function escHandler(e) {
        if (e.key === 'Escape') { closeModal(modal); document.removeEventListener('keydown', escHandler); }
    });
}

function closeModal(modal) {
    const content = modal.querySelector('.tos-modal-content');
    modal.style.animation = 'modalFadeOut 0.3s ease forwards';
    content.style.animation = 'modalScaleOut 0.3s ease forwards';
    setTimeout(() => modal.remove(), 300);
}

/* =====================================================
   Passport Photo Upload & Preview
   ===================================================== */
function initPhotoUpload() {
    const fileInput  = document.getElementById('photo');
    const placeholder = document.getElementById('photo-placeholder');
    const preview    = document.getElementById('photo-preview');
    const previewImg = document.getElementById('photo-preview-img');
    const removeBtn  = document.getElementById('remove-photo');

    if (!fileInput) return;

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
            showErrorMessage('Please upload a PNG or JPG image file for photo.');
            fileInput.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            showErrorMessage('Photo file size must be less than 2MB.');
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (ev) => {
            previewImg.src = ev.target.result;
            placeholder.style.display = 'none';
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });

    if (removeBtn) {
        removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            fileInput.value = '';
            preview.style.display = 'none';
            placeholder.style.display = 'flex';
            previewImg.src = '';
        });
    }
}

/* =====================================================
   NID / Passport Photo Upload & Preview
   ===================================================== */
function initNidPhotoUpload() {
    const fileInput  = document.getElementById('nid_photo');
    const placeholder = document.getElementById('nid-photo-placeholder');
    const preview    = document.getElementById('nid-photo-preview');
    const previewImg = document.getElementById('nid-photo-preview-img');
    const fileName   = document.getElementById('nid-photo-file-name');
    const removeBtn  = document.getElementById('remove-nid-photo');

    if (!fileInput) return;

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
            showErrorMessage('Please upload a PNG or JPG image file for NID/Passport photo.');
            fileInput.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            showErrorMessage('NID/Passport photo file size must be less than 2MB.');
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (ev) => {
            previewImg.src = ev.target.result;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
            fileName.textContent = file.name;
        };
        reader.readAsDataURL(file);
    });

    if (removeBtn) {
        removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            fileInput.value = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            previewImg.src = '';
            fileName.textContent = '';
        });
    }
}

/* =====================================================
   Payment Method Selection
   ===================================================== */
function initPaymentMethod() {
    const radios     = document.querySelectorAll('input[name="payment_method_id"]');
    const detailsBox = document.getElementById('payment-details-box');

    if (!radios.length || !detailsBox) return;

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (!radio.checked) return;

            const instruction = radio.dataset.instruction || '';
            const wallet      = radio.dataset.wallet || '';
            const qr          = radio.dataset.qr || '';

            document.getElementById('payment-instruction').textContent =
                instruction || 'Follow the payment instructions and provide your transaction ID below.';

            const walletWrap = document.getElementById('payment-wallet-wrap');
            const walletEl   = document.getElementById('payment-wallet');
            const walletDisplayLabel = document.getElementById('wallet-display-label');
            console.log(radio.dataset);

            if (wallet) {
                walletEl.textContent = wallet;
                walletWrap.classList.remove('hidden');
                walletDisplayLabel.textContent = radio.dataset.label + ":" || 'Wallet Number:';
            } else {
                walletWrap.classList.add('hidden');
            }

            const qrWrap = document.getElementById('payment-qr-wrap');
            const qrImg  = document.getElementById('payment-qr-img');
            if (qr) {
                qrImg.src = qr;
                qrWrap.classList.remove('hidden');
            } else {
                qrWrap.classList.add('hidden');
            }

            detailsBox.classList.remove('hidden');
        });
    });
}

/* =====================================================
   Payment Proof Upload & Preview
   ===================================================== */
function initPaymentProofUpload() {
    const fileInput  = document.getElementById('payment_proof');
    const placeholder = document.getElementById('proof-placeholder');
    const preview    = document.getElementById('proof-preview');
    const previewImg = document.getElementById('proof-preview-img');
    const fileName   = document.getElementById('proof-file-name');
    const removeBtn  = document.getElementById('remove-proof');

    if (!fileInput) return;

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
            showErrorMessage('Please upload a PNG or JPG image for the payment proof.');
            fileInput.value = '';
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            showErrorMessage('Payment proof file size must be less than 5MB.');
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (ev) => {
            previewImg.src = ev.target.result;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
            fileName.textContent = file.name;
        };
        reader.readAsDataURL(file);
    });

    if (removeBtn) {
        removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            fileInput.value = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            previewImg.src = '';
            fileName.textContent = '';
        });
    }
}

/* =====================================================
   Form Submission
   ===================================================== */
function initFormSubmission() {
    const form = document.getElementById('membership-application-form');

    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        clearErrors();
        hideMessages();

        const formData   = new FormData(form);
        const submitBtn  = document.getElementById('submit-btn');
        const submitSpan = submitBtn.querySelector('span');
        const originalText = submitSpan.textContent;

        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Submitting...</span>
        `;

        try {
            const response = await fetch(form.action || '/membership/apply', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showSuccessMessage(data.message);

                if (data.application_id) {
                    const appInfo     = document.getElementById('application-info');
                    const appIdDisplay = document.getElementById('application-id-display');
                    const downloadBtn  = document.getElementById('download-pdf-btn');

                    appIdDisplay.textContent = '#' + data.application_id;
                    downloadBtn.href = data.pdf_url;
                    appInfo.classList.remove('hidden');
                }

                // Hide form and step indicator
                form.classList.add('hidden');
                const indicator = document.getElementById('step-indicator');
                if (indicator) indicator.classList.add('hidden');

                const successMsg = document.getElementById('success-message');
                successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });

            } else if (response.status === 422 && data.errors) {
                // If errors belong to step-1 fields, go back to step 1
                const step1Fields = ['name', 'date_of_birth', 'nid_passport', 'profession_organization',
                                     'mobile', 'email', 'address', 'membership_category_id'];
                const hasStep1Error = Object.keys(data.errors).some(f => step1Fields.includes(f));
                if (hasStep1Error) goToStep(1);

                showFieldErrors(data.errors);
                if (data.message) showErrorMessage(data.message);
            } else {
                showErrorMessage(data.message || 'An error occurred. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            showErrorMessage('Failed to submit application. Please check your connection and try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>${originalText}</span>
            `;
        }
    });

    // Clear individual field error on input
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', () => clearFieldError(input));
    });
}

/* =====================================================
   Error Handling
   ===================================================== */
function showFieldErrors(errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            setFieldError(input, messages[0]);
        }
    }
}

function clearFieldError(input) {
    const formGroup = input.closest('.form-group') || input.parentElement;
    const errorSpan = formGroup.querySelector('.error-message');

    formGroup.classList.remove('error');
    if (errorSpan) {
        errorSpan.textContent = '';
        errorSpan.classList.add('hidden');
    }
    input.style.borderColor = '';
}

function clearErrors() {
    document.querySelectorAll('.form-group').forEach(group => {
        group.classList.remove('error');
        const errorSpan = group.querySelector('.error-message');
        if (errorSpan) {
            errorSpan.textContent = '';
            errorSpan.classList.add('hidden');
        }
    });

    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.style.borderColor = '';
    });

    const categoryErr = document.getElementById('category-error');
    if (categoryErr) { categoryErr.textContent = ''; categoryErr.classList.add('hidden'); }

    const paymentErr = document.getElementById('payment-method-error');
    if (paymentErr) { paymentErr.textContent = ''; paymentErr.classList.add('hidden'); }
}

function showSuccessMessage(message) {
    const successDiv  = document.getElementById('success-message');
    const successText = document.getElementById('success-message-text');
    if (successDiv && successText) {
        successText.textContent = message;
        successDiv.classList.remove('hidden');
    }
}

function showErrorMessage(message) {
    const errorDiv  = document.getElementById('error-message');
    const errorText = document.getElementById('error-message-text');
    if (errorDiv && errorText) {
        errorText.textContent = message;
        errorDiv.classList.remove('hidden');
        setTimeout(() => errorDiv.classList.add('hidden'), 8000);
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function hideMessages() {
    const successDiv = document.getElementById('success-message');
    const errorDiv   = document.getElementById('error-message');
    if (successDiv) successDiv.classList.add('hidden');
    if (errorDiv)   errorDiv.classList.add('hidden');
}

// ── Copy wallet number to clipboard ─────────────────────────────────────────
function copyWalletNumber(spanId, btn) {
    const text = document.getElementById(spanId).textContent.trim();
    navigator.clipboard.writeText(text).then(function () {
        const label = btn.querySelector('.copy-label');
        label.textContent = 'Copied!';
        setTimeout(function () { label.textContent = 'Copy'; }, 2000);
    });
}
