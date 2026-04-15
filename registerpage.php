<?php 
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniPath — Register</title>
    <link rel="stylesheet" href="_shared.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            background: var(--bg-secondary);
            padding: 3rem 2rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .register-container h2 {
            font-size: 1.8rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .register-container p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-group input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-tertiary);
            color: var(--text-primary);
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent-main);
            box-shadow: 0 0 0 3px rgba(91, 77, 255, 0.1);
            background: var(--bg-secondary);
        }

        .form-group input.error {
            border-color: #ff6b6b;
        }

        .error-text {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-top: 0.4rem;
            display: none;
        }

        .error-text.show {
            display: block;
        }

        .success-text {
            color: #51cf66;
            font-size: 0.85rem;
            margin-top: 0.4rem;
            display: none;
        }

        .success-text.show {
            display: block;
        }

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 0.8rem;
        }

        .strength-bar {
            height: 4px;
            background: var(--bg-tertiary);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-fill.weak {
            width: 25%;
            background: #ff6b6b;
        }

        .strength-fill.fair {
            width: 50%;
            background: #ffd93d;
        }

        .strength-fill.good {
            width: 75%;
            background: #51cf66;
        }

        .strength-fill.strong {
            width: 100%;
            background: #4d96ff;
        }

        .strength-fill.very-strong {
            width: 100%;
            background: #7C66FF;
        }

        .strength-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Password Match Indicator */
        .password-match-indicator {
            display: none;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.8rem;
            padding: 0.6rem;
            background: rgba(91, 77, 255, 0.1);
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .password-match-indicator.show {
            display: flex;
        }

        .match-icon {
            font-size: 1rem;
        }

        .match-icon.success {
            color: #51cf66;
        }

        .match-icon.error {
            color: #ff6b6b;
        }

        .submit-btn {
            width: 100%;
            padding: 0.9rem;
            border: none;
            border-radius: 8px;
            background: var(--accent-main);
            color: var(--bg-primary);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 2rem;
            position: relative;
        }

        .submit-btn:hover:not(:disabled) {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(91, 77, 255, 0.4);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .submit-btn .spinner {
            display: none;
            width: 16px;
            height: 16px;
            margin: 0 auto;
            border-width: 2px;
        }

        .submit-btn.loading {
            color: transparent;
        }

        .submit-btn.loading .spinner {
            display: inline-block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .form-footer a {
            color: var(--accent-main);
            font-weight: 600;
        }

        .form-footer a:hover {
            color: var(--accent-light);
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 2rem 1.5rem;
            }

            .register-container h2 {
                font-size: 1.5rem;
            }

            .form-group input {
                padding: 0.75rem;
            }

            .submit-btn {
                padding: 0.8rem;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Create Account</h2>
    <p>Join UniPath and find your perfect university</p>

    <form id="registerForm">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input id="name" name="name" type="text" placeholder="John Doe" required>
            <div class="error-text" id="nameError"></div>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" name="email" type="email" placeholder="john@example.com" required>
            <div class="error-text" id="emailError"></div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="••••••••" required>
            <div class="error-text" id="passwordError"></div>
            
            <div class="password-strength">
                <div class="strength-bar">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
                <div class="strength-text" id="strengthText">Enter a password</div>
            </div>
        </div>

        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input id="confirmPassword" name="confirmPassword" type="password" placeholder="••••••••" required>
            <div class="error-text" id="confirmError"></div>
            
            <div class="password-match-indicator" id="matchIndicator">
                <span class="match-icon" id="matchIcon">✓</span>
                <span id="matchText">Passwords match</span>
            </div>
        </div>

        <button class="submit-btn" type="submit" id="submitBtn">
            Create Account
            <span class="spinner"></span>
        </button>
    </form>

    <div class="form-footer">
        <p>Already have an account? <a href="signin.html">Sign In</a></p>
    </div>
</div>

<script src="_shared.js"></script>
<script>
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const strengthFill = document.getElementById('strengthFill');
const strengthText = document.getElementById('strengthText');
const matchIndicator = document.getElementById('matchIndicator');
const matchIcon = document.getElementById('matchIcon');
const matchText = document.getElementById('matchText');

// Password strength checker
passwordInput.addEventListener('input', function() {
    const password = this.value;
    const strength = FormValidator.passwordStrength(password);
    const label = getPasswordStrengthLabel(strength);

    // Update strength bar
    strengthFill.className = 'strength-fill';
    if (strength === 0) strengthFill.classList.remove('weak', 'fair', 'good', 'strong', 'very-strong');
    else if (strength === 1) strengthFill.classList.add('weak');
    else if (strength === 2) strengthFill.classList.add('fair');
    else if (strength === 3) strengthFill.classList.add('good');
    else if (strength === 4) strengthFill.classList.add('strong');
    else if (strength === 5) strengthFill.classList.add('very-strong');

    strengthText.textContent = label.text;
    strengthText.style.color = label.color;

    // Check password match
    checkPasswordMatch();
});

// Password match checker
function checkPasswordMatch() {
    if (confirmPasswordInput.value === '') return;

    const password = passwordInput.value;
    const confirm = confirmPasswordInput.value;
    const matches = password === confirm && password !== '';

    if (matches) {
        matchIndicator.classList.add('show');
        matchIcon.classList.remove('error');
        matchIcon.classList.add('success');
        matchIcon.textContent = '✓';
        matchText.textContent = 'Passwords match';
        clearFieldError(confirmPasswordInput);
    } else if (confirm !== '') {
        matchIndicator.classList.add('show');
        matchIcon.classList.remove('success');
        matchIcon.classList.add('error');
        matchIcon.textContent = '✕';
        matchText.textContent = 'Passwords do not match';
    }
}

confirmPasswordInput.addEventListener('input', checkPasswordMatch);

// Form submission
document.getElementById('registerForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();
    const button = document.getElementById('submitBtn');

    // Clear all errors
    ['name', 'email', 'password', 'confirm'].forEach(field => {
        const error = document.getElementById(field + 'Error');
        if (error) error.classList.remove('show');
    });

    let hasError = false;

    // Validate name
    if (name.length < 2) {
        showFieldError(document.getElementById('name'), 'Name must be at least 2 characters');
        hasError = true;
    }

    // Validate email
    if (!FormValidator.email(email)) {
        showFieldError(document.getElementById('email'), 'Please enter a valid email');
        hasError = true;
    }

    // Validate password
    const strength = FormValidator.passwordStrength(password);
    if (strength < 2) {
        showFieldError(document.getElementById('password'), 'Password is too weak. Use uppercase, numbers, and symbols.');
        hasError = true;
    }

    // Validate password match
    if (password !== confirmPassword) {
        showFieldError(document.getElementById('confirmPassword'), 'Passwords do not match');
        hasError = true;
    }

    if (hasError) {
        toast.warning('Please fix the errors above');
        return;
    }

    // Set loading state
    setButtonLoading(button, true);

    try {
        const response = await fetch('authentication.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'register',
                name: name,
                email: email,
                password: password
            })
        });

        const data = await response.json();

        if (data.success) {
            toast.success('Account created successfully! Redirecting to sign in...');
            setTimeout(() => {
                window.location.href = 'signin.html';
            }, 1500);
        } else {
            toast.error(data.message || 'Registration failed. Please try again.');
            setButtonLoading(button, false);
        }
    } catch (error) {
        toast.error('Network error. Please try again.');
        setButtonLoading(button, false);
    }
});
</script>

</body>
</html>
