/* ========================================
   UNIPATH SHARED JAVASCRIPT UTILITIES
   ======================================== */

// Initialize toast notifications system
class ToastNotification {
    constructor() {
        this.container = this.getOrCreateContainer();
    }

    getOrCreateContainer() {
        let container = document.querySelector('.toast-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'toast-container';
            document.body.appendChild(container);
        }
        return container;
    }

    show(message, type = 'info', duration = 4000) {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.textContent = message;

        this.container.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('remove');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }

    success(message, duration = 4000) {
        this.show(message, 'success', duration);
    }

    error(message, duration = 5000) {
        this.show(message, 'error', duration);
    }

    warning(message, duration = 4000) {
        this.show(message, 'warning', duration);
    }

    info(message, duration = 4000) {
        this.show(message, 'info', duration);
    }
}

// Global toast instance
const toast = new ToastNotification();

// Back to top button functionality
function initBackToTop() {
    let backToTopBtn = document.getElementById('backToTop');
    
    if (!backToTopBtn) {
        backToTopBtn = document.createElement('button');
        backToTopBtn.id = 'backToTop';
        backToTopBtn.innerHTML = '↑';
        backToTopBtn.setAttribute('aria-label', 'Back to top');
        document.body.appendChild(backToTopBtn);
    }

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Form validation utilities
const FormValidator = {
    email(value) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(value);
    },

    password(value) {
        return value.length >= 6;
    },

    passwordStrength(value) {
        let strength = 0;
        if (value.length >= 8) strength++;
        if (/[A-Z]/.test(value)) strength++;
        if (/[a-z]/.test(value)) strength++;
        if (/[0-9]/.test(value)) strength++;
        if (/[!@#$%^&*]/.test(value)) strength++;
        return strength;
    },

    phone(value) {
        const regex = /^[\d\s\-\+\(\)]+$/;
        return regex.test(value) && value.replace(/\D/g, '').length >= 10;
    },

    url(value) {
        try {
            new URL(value);
            return true;
        } catch {
            return false;
        }
    }
};

// Get password strength label
function getPasswordStrengthLabel(strength) {
    const labels = {
        0: { text: 'Very Weak', color: '#ff6b6b' },
        1: { text: 'Weak', color: '#ff922b' },
        2: { text: 'Fair', color: '#ffd93d' },
        3: { text: 'Good', color: '#51cf66' },
        4: { text: 'Strong', color: '#4d96ff' },
        5: { text: 'Very Strong', color: '#7C66FF' }
    };
    return labels[strength] || labels[0];
}

// Utility: Check if all required fields are filled
function validateFormFields(form, requiredFields = []) {
    const fields = requiredFields.length > 0 
        ? requiredFields.map(name => form.querySelector(`[name="${name}"]`))
        : Array.from(form.querySelectorAll('input[required], textarea[required], select[required]'));

    return fields.every(field => field && field.value.trim() !== '');
}

// Utility: Show inline error message
function showFieldError(inputElement, message) {
    const errorElement = inputElement.parentElement.querySelector('.error-text');
    
    if (errorElement) {
        errorElement.textContent = message;
    } else {
        const error = document.createElement('div');
        error.className = 'error-text';
        error.textContent = message;
        inputElement.parentElement.appendChild(error);
    }

    inputElement.classList.add('error');
}

// Utility: Clear error message
function clearFieldError(inputElement) {
    const errorElement = inputElement.parentElement.querySelector('.error-text');
    if (errorElement) {
        errorElement.textContent = '';
    }
    inputElement.classList.remove('error');
}

// Utility: Create and show loading spinner on button
function setButtonLoading(button, isLoading = true) {
    if (isLoading) {
        button.disabled = true;
        button.dataset.originalText = button.textContent;
        button.innerHTML = '<span class="spinner spinner-sm" style="margin: 0 auto;"></span>';
    } else {
        button.disabled = false;
        button.textContent = button.dataset.originalText || 'Submit';
    }
}

// Utility: Copy text to clipboard
function copyToClipboard(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text)
            .then(() => toast.success('Copied to clipboard!'))
            .catch(() => {
                // Fallback for older browsers
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                toast.success('Copied to clipboard!');
            });
    } else {
        // Fallback
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        toast.success('Copied to clipboard!');
    }
}

// Utility: Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// Utility: Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initBackToTop();
});

// Flag emoji by country code
const countryFlags = {
    'KZ': '🇰🇿', 'RU': '🇷🇺', 'US': '🇺🇸', 'GB': '🇬🇧', 'DE': '🇩🇪',
    'FR': '🇫🇷', 'IT': '🇮🇹', 'ES': '🇪🇸', 'NL': '🇳🇱', 'BE': '🇧🇪',
    'SE': '🇸🇪', 'NO': '🇳🇴', 'CH': '🇨🇭', 'AT': '🇦🇹', 'PL': '🇵🇱',
    'CZ': '🇨🇿', 'HU': '🇭🇺', 'RO': '🇷🇴', 'GR': '🇬🇷', 'PT': '🇵🇹',
    'IE': '🇮🇪', 'DK': '🇩🇰', 'FI': '🇫🇮', 'TR': '🇹🇷', 'UA': '🇺🇦',
    'JP': '🇯🇵', 'CN': '🇨🇳', 'IN': '🇮🇳', 'AU': '🇦🇺', 'CA': '🇨🇦',
    'KR': '🇰🇷', 'MX': '🇲🇽', 'BR': '🇧🇷', 'ZA': '🇿🇦', 'SG': '🇸🇬',
    'MY': '🇲🇾', 'TH': '🇹🇭', 'VN': '🇻🇳', 'PH': '🇵🇭', 'ID': '🇮🇩',
    'NZ': '🇳🇿', 'EU': '🇪🇺'
};

// Get flag by country code
function getCountryFlag(countryCode) {
    return countryFlags[countryCode.toUpperCase()] || '🌍';
}
