<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniPath — Complete Your Profile</title>
    <link rel="stylesheet" href="_shared.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .profile-container {
            width: 100%;
            max-width: 600px;
            background: var(--bg-secondary);
            padding: 3rem 2rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .profile-container h2 {
            font-size: 1.8rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .profile-container p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border-color);
            z-index: 0;
        }

        .step-item {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-tertiary);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: 700;
            border: 2px solid var(--border-color);
        }

        .step-number.active {
            background: var(--accent-main);
            color: white;
            border-color: var(--accent-main);
        }

        .step-number.completed {
            background: #51cf66;
            color: white;
            border-color: #51cf66;
        }

        .step-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
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

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-tertiary);
            color: var(--text-primary);
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-main);
            box-shadow: 0 0 0 3px rgba(91, 77, 255, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
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

        .form-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-nav {
            flex: 1;
            padding: 0.9rem;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .btn-prev {
            background: transparent;
            color: var(--accent-main);
            border: 1px solid var(--accent-main);
        }

        .btn-prev:hover {
            background: rgba(91, 77, 255, 0.1);
        }

        .btn-next {
            background: var(--accent-main);
            color: var(--bg-primary);
        }

        .btn-next:hover:not(:disabled) {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(91, 77, 255, 0.4);
        }

        .btn-next:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .file-upload {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload:hover {
            border-color: var(--accent-main);
            background: rgba(91, 77, 255, 0.05);
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload.uploaded {
            background: rgba(81, 207, 102, 0.1);
            border-color: #51cf66;
        }

        @media (max-width: 480px) {
            .profile-container {
                padding: 2rem 1.5rem;
            }

            .profile-container h2 {
                font-size: 1.5rem;
            }

            .progress-steps {
                margin-bottom: 2rem;
            }

            .step-label {
                display: none;
            }

            .form-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Complete Your Profile</h2>
    <p>Help us learn more about you to give better university recommendations</p>

    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="step-item">
            <div class="step-number active" id="step1">1</div>
            <div class="step-label">Personal</div>
        </div>
        <div class="step-item">
            <div class="step-number" id="step2">2</div>
            <div class="step-label">Academic</div>
        </div>
        <div class="step-item">
            <div class="step-number" id="step3">3</div>
            <div class="step-label">Documents</div>
        </div>
    </div>

    <!-- Form Container -->
    <form id="profileForm" onsubmit="handleSubmit(event)">
        
        <!-- Step 1: Personal Information -->
        <div class="form-section active" id="section1">
            <h3 style="margin-bottom: 1.5rem; color: #e0e0e0;">Personal Information</h3>
            
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="John Doe" required>
                <div class="error-text" id="nameError"></div>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
                <div class="error-text" id="dobError"></div>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" placeholder="Kazakhstan" required>
                <div class="error-text" id="countryError"></div>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+7 (XXX) XXX-XX-XX" required>
                <div class="error-text" id="phoneError"></div>
            </div>
        </div>

        <!-- Step 2: Academic Information -->
        <div class="form-section" id="section2">
            <h3 style="margin-bottom: 1.5rem; color: #e0e0e0;">Academic Background</h3>
            
            <div class="form-group">
                <label for="englishTest">English Test Score</label>
                <select id="englishTest" name="englishTest" required>
                    <option value="">Select test</option>
                    <option value="IELTS">IELTS</option>
                    <option value="TOEFL">TOEFL</option>
                    <option value="Duolingo">Duolingo English Test</option>
                </select>
                <div class="error-text" id="testError"></div>
            </div>

            <div class="form-group">
                <label for="testScore">Test Score</label>
                <input type="number" id="testScore" name="testScore" placeholder="7.5" step="0.1" required>
                <div class="error-text" id="scoreError"></div>
            </div>

            <div class="form-group">
                <label for="gpa">GPA / Average Grade</label>
                <input type="number" id="gpa" name="gpa" placeholder="3.85" step="0.01" min="0" max="4" required>
                <div class="error-text" id="gpaError"></div>
            </div>

            <div class="form-group">
                <label for="interests">Academic Interests (Comma-separated)</label>
                <input type="text" id="interests" name="interests" placeholder="Computer Science, AI, Data Science" required>
                <div class="error-text" id="interestsError"></div>
            </div>
        </div>

        <!-- Step 3: Documents -->
        <div class="form-section" id="section3">
            <h3 style="margin-bottom: 1.5rem; color: #e0e0e0;">Upload Documents</h3>
            
            <div class="form-group">
                <label>Resume / CV</label>
                <div class="file-upload" onclick="document.getElementById('resume').click()">
                    <p style="color: #a0a0a0; margin: 0; cursor: pointer;">
                        📄 Click to upload or drag and drop<br>
                        <small>PDF, DOC (Max 5MB)</small>
                    </p>
                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" onchange="handleFileUpload(this)">
                </div>
                <div class="error-text" id="resumeError"></div>
            </div>

            <div class="form-group">
                <label>Test Score Certificate (Optional)</label>
                <div class="file-upload" onclick="document.getElementById('testCert').click()">
                    <p style="color: #a0a0a0; margin: 0; cursor: pointer;">
                        📋 Click to upload or drag and drop<br>
                        <small>PDF, JPG, PNG (Max 5MB)</small>
                    </p>
                    <input type="file" id="testCert" name="testCert" accept=".pdf,.jpg,.jpeg,.png" onchange="handleFileUpload(this)">
                </div>
                <div class="error-text" id="certError"></div>
            </div>

            <div class="form-group">
                <label for="essay">Write a short introduction (Why do you want to study abroad?)</label>
                <textarea id="essay" name="essay" placeholder="Share your goals and dreams..." required></textarea>
                <div class="error-text" id="essayError"></div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="form-buttons">
            <button type="button" class="btn-nav btn-prev" id="prevBtn" onclick="changeSection(-1)" style="display: none;">← Previous</button>
            <button type="button" class="btn-nav btn-next" id="nextBtn" onclick="changeSection(1)">Next →</button>
        </div>
    </form>
</div>

<script src="_shared.js"></script>
<script>
let currentSection = 1;
const totalSections = 3;

function showSection(sectionNum) {
    document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
    document.getElementById('section' + sectionNum).classList.add('active');

    // Update progress steps
    for (let i = 1; i <= totalSections; i++) {
        const step = document.getElementById('step' + i);
        if (i < sectionNum) {
            step.classList.replace('active', 'completed');
        } else if (i === sectionNum) {
            step.classList.add('active');
        } else {
            step.classList.remove('active', 'completed');
        }
    }

    // Update buttons
    document.getElementById('prevBtn').style.display = sectionNum > 1 ? 'block' : 'none';
    document.getElementById('nextBtn').textContent = sectionNum === totalSections ? 'Complete Profile' : 'Next →';

    window.scrollTo(0, 0);
}

function changeSection(direction) {
    const nextSection = currentSection + direction;
    
    if (nextSection > totalSections) {
        submitProfile();
        return;
    }
    
    if (nextSection >= 1 && nextSection <= totalSections) {
        if (validateSection(currentSection)) {
            currentSection = nextSection;
            showSection(currentSection);
        }
    }
}

function validateSection(sectionNum) {
    const errors = [];

    if (sectionNum === 1) {
        const fullName = document.getElementById('fullName').value.trim();
        const dob = document.getElementById('dob').value;
        const country = document.getElementById('country').value.trim();
        const phone = document.getElementById('phone').value.trim();

        if (fullName.length < 2) errors.push({ id: 'nameError', msg: 'Name must be at least 2 characters' });
        if (!dob) errors.push({ id: 'dobError', msg: 'Please select date of birth' });
        if (!country) errors.push({ id: 'countryError', msg: 'Please enter your country' });
        if (!FormValidator.phone(phone)) errors.push({ id: 'phoneError', msg: 'Invalid phone number' });
    }

    if (sectionNum === 2) {
        const test = document.getElementById('englishTest').value;
        const score = document.getElementById('testScore').value;
        const gpa = document.getElementById('gpa').value;
        const interests = document.getElementById('interests').value.trim();

        if (!test) errors.push({ id: 'testError', msg: 'Please select an English test' });
        if (!score || score < 0) errors.push({ id: 'scoreError', msg: 'Please enter a valid score' });
        if (!gpa || gpa < 0 || gpa > 4) errors.push({ id: 'gpaError', msg: 'GPA must be between 0 and 4' });
        if (!interests) errors.push({ id: 'interestsError', msg: 'Please enter your academic interests' });
    }

    if (sectionNum === 3) {
        const resume = document.getElementById('resume').files.length;
        const essay = document.getElementById('essay').value.trim();

        if (!resume) errors.push({ id: 'resumeError', msg: 'Please upload your resume' });
        if (essay.length < 50) errors.push({ id: 'essayError', msg: 'Essay must be at least 50 characters' });
    }

    if (errors.length > 0) {
        errors.forEach(err => {
            const el = document.getElementById(err.id);
            if (el) {
                el.textContent = err.msg;
                el.classList.add('show');
            }
        });
        toast.warning('Please fix the errors above');
        return false;
    }

    // Clear errors
    document.querySelectorAll('.error-text').forEach(el => el.classList.remove('show'));
    return true;
}

function handleFileUpload(input) {
    const file = input.files[0];
    if (file && file.size <= 5 * 1024 * 1024) {
        input.parentElement.classList.add('uploaded');
    } else {
        toast.error('File must be less than 5MB');
        input.value = '';
    }
}

function handleSubmit(event) {
    event.preventDefault();
}

function submitProfile() {
    if (!validateSection(3)) return;

    const formData = {
        fullName: document.getElementById('fullName').value,
        dob: document.getElementById('dob').value,
        country: document.getElementById('country').value,
        phone: document.getElementById('phone').value,
        englishTest: document.getElementById('englishTest').value,
        testScore: document.getElementById('testScore').value,
        gpa: document.getElementById('gpa').value,
        interests: document.getElementById('interests').value,
        essay: document.getElementById('essay').value,
        resumeFiles: document.getElementById('resume').files.length > 0
    };

    setButtonLoading(document.getElementById('nextBtn'), true);

    // Simulate submission (replace with actual API call)
    setTimeout(() => {
        toast.success('Profile completed! Redirecting to dashboard...');
        setTimeout(() => {
            window.location.href = 'mainpage.php';
        }, 1500);
    }, 1500);
}

// Initialize
showSection(1);
</script>

</body>
</html>
