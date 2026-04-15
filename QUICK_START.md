# UniPath Redesign - Quick Start Guide

## 📝 What Was Changed

Complete redesign of all 9 pages with new shared architecture:

### Before (Original Issues):
- ❌ Mixed light/dark theme - inconsistent colors
- ❌ Different navigation on each page - not reusable
- ❌ Uses `alert()` for user feedback - jarring UX
- ❌ No password strength indicator
- ❌ No country flags in scholarships/rankings
- ❌ Guides as huge list - difficult to read
- ❌ No comparison feature in rankings
- ❌ Authentication bug ($succes typo), no proper error handling
- ❌ No responsive hamburger menu

### After (Redesigned):
- ✅ Unified dark theme (#0f0f1a, #1a1a2e, #5B4DFF)
- ✅ Shared `_nav.php` included on all pages
- ✅ Toast notifications instead of alert()
- ✅ Password strength indicator (5 levels with color bands)
- ✅ Country flags with emoji (🇺🇸, 🇬🇧, 🇪🇺, etc.)
- ✅ Accordion guides - compact, searchable
- ✅ Compare up to 2 universities side-by-side
- ✅ Fixed authentication with password_hash(), prepared statements, proper errors
- ✅ Fully responsive mobile hamburger menu

---

## ⚡ 5-Minute Setup

### Step 1: Copy Shared Files (No Configuration Needed)
```bash
# These are NEW files - just place them in root folder
_nav.php
_shared.css
_shared.js
```

✅ **No replacements.** These files are NEW additions.

### Step 2: Back Up Original Files
```bash
# Create backup folder
mkdir backup

# Copy all original files to backup
cp *.php backup/
cp *.html backup/
cp *.HTML backup/
```

### Step 3: Replace Pages With New Versions
```bash
# Rename the _new suffixed files to original names
mv mainpage_new.php mainpage.php
mv signin_new.html signin.html
mv registerpage_new.php registerpage.php
mv scholarships_new.php scholarships.php
mv guides_new.html guides.html
mv alumni_new.HTML alumni.HTML
mv ranking_new.php ranking.php
mv authentication_new.php authentication.php
mv uppload_new.php uppload.php
```

### Step 4: Test in Browser
```
URL: http://localhost/infor/mainpage.php
```

Should see:
- ✅ Dark background (#0f0f1a)
- ✅ Purple accent buttons (#5B4DFF)
- ✅ Responsive navigation menu
- ✅ "Back to top" button when scrolling
- ✅ Toast notifications (hover a button)

---

## 🗄️ Database Setup (Optional - For Authentication)

### If using user registration/login:

**Step 1: Run SQL Commands**
```sql
CREATE DATABASE IF NOT EXISTS unipath_db;
USE unipath_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Or import the provided file:
```bash
mysql -u root < database_init.sql
```

**Step 2: Update Credentials in authentication.php**
```php
// Line 12-15 in authentication_new.php
$host = 'localhost';
$db = 'unipath_db';
$user = 'root';      // Your MySQL username
$pass = '';          // Your MySQL password
```

**Step 3: Test Authentication**
- Go to: http://localhost/infor/registerpage.php
- Fill form and submit
- Should see toast success message
- Then Sign in with same email/password
- Should redirect to mainpage and show logged-in state

---

## 📂 File Structure After Setup

```
htdocs/infor/
├── mainpage.php                 ← Updated (was mainpage_new.php)
├── signin.html                  ← Updated (was signin_new.html)
├── registerpage.php             ← Updated (was registerpage_new.php)
├── scholarships.php             ← Updated (was scholarships_new.php)
├── guides.html                  ← Updated (was guides_new.html)
├── alumni.HTML                  ← Updated (was alumni_new.HTML)
├── ranking.php                  ← Updated (was ranking_new.php)
├── authentication.php           ← Updated (was authentication_new.php)
├── uppload.php                  ← Updated (was uppload_new.php)
├── logout.php                   ← Unchanged (already exists)
├── connection.php               ← Unchanged (or use connection_new.php)
│
├── _nav.php                     ← NEW (shared component)
├── _shared.css                  ← NEW (shared styles)
├── _shared.js                   ← NEW (shared scripts)
│
├── REDESIGN_GUIDE.md            ← Documentation
├── NAVIGATION_MAP.md            ← Navigation structure
├── CHANGES_SUMMARY.md           ← Detailed changes per page
├── database_init.sql            ← DB schema
├── connection_new.php           ← Updated DB connection config
│
└── Dockerfile                   ← Unchanged
```

---

## 🧪 Testing Checklist

### 1. Visual/Design (All Pages)
- [ ] Dark theme applied (#0f0f1a background)
- [ ] Accent color is purple (#5B4DFF) on buttons
- [ ] All text is readable (white/light gray on dark)
- [ ] Cards have hover effect (slightly raised with shadow)
- [ ] Font is clean (Inter from Google Fonts)

### 2. Navigation (All Pages)
- [ ] Header visible at top with logo
- [ ] 5 nav links: Главная, Рейтинги, Стипендии, Обучение, Alumni
- [ ] Home page shows "Sign In" and "Sign Up" buttons
- [ ] Current page link is underlined/highlighted
- [ ] Mobile: At 768px, links hide, hamburger appears ☰

### 3. Responsiveness (All Pages)
- [ ] Desktop (1024px+): 3+ column grid
- [ ] Tablet (768px): 2 column grid
- [ ] Mobile (480px): 1 column (full width)
- [ ] Text is readable at all sizes
- [ ] No horizontal scroll on any size

### 4. Animations
- [ ] Cards rise up slightly on hover (translateY -4px)
- [ ] Buttons have smooth color transition on hover
- [ ] Hamburger animates to X when menu opens
- [ ] Toast notifications slide in smoothly

### 5. Forms (Sign In, Register, Upload)
- [ ] Input fields have focus state (glow effect, border color change)
- [ ] Error messages appear inline below fields
- [ ] Success toast appears on submit
- [ ] Form disables submit button during processing (loading spinner)

### 6. Features by Page

**mainpage.php**
- [ ] Fullscreen hero section with gradient
- [ ] 50 universities grid with search
- [ ] IELTS score filter works
- [ ] Status shows "✓ Проходите" or "✗ Нужен IELTS X"

**signin.html**
- [ ] Email validation (must be valid format)
- [ ] Password field (minimum 6 characters)
- [ ] "Forgot password?" link present
- [ ] Loading spinner on submit
- [ ] Error message for wrong credentials

**registerpage.php**
- [ ] Password strength meter grows as you type
- [ ] Strength bar changes color: Red → Yellow → Green → Blue → Purple
- [ ] Strength label updates: Very Weak → Weak → Fair → Good → Strong → Very Strong
- [ ] Password match indicator shows when passwords match
- [ ] Confirmation validates before submit

**scholarships.php**
- [ ] 32 scholarships display
- [ ] Country flag emoji next to country name (🇺🇸, 🇬🇧, etc.)
- [ ] Filter by country works
- [ ] Filter by amount ($5k+, $15k+, etc.) works
- [ ] EU filter shows Erasmus+ scholarships
- [ ] Copy button copies scholarship name
- [ ] Save button shows toast "Scholarship saved"

**guides.html**
- [ ] 10 guides in accordion format (collapsed by default)
- [ ] Click to expand guide
- [ ] Only 1 guide expanded at a time
- [ ] Reading time shows (e.g., "8 min read")
- [ ] Category tabs filter guides
- [ ] Search filter by guide title
- [ ] Pro tips highlighted in colored box

**alumni.HTML**
- [ ] 10 alumni profiles display
- [ ] Avatar emoji unique to each person
- [ ] Region filter buttons (USA, UK, EU, Asia, Canada)
- [ ] Search by university name, alumni name, role
- [ ] Achievement badges show (Google, Dean's List, etc.)
- [ ] Quote appears at bottom of card

**ranking.php**
- [ ] Top 5 universities in showcase
- [ ] Full table of 20 universities
- [ ] Country flag next to each university
- [ ] Sort dropdown changes ranking (by rank, country, score)
- [ ] Checkboxes enable for comparison
- [ ] Max 2 universities can be selected
- [ ] Comparison section shows side-by-side view
- [ ] Reset button clears selection

### 7. Authentication Flow (If Database Configured)
- [ ] Register → Create new user → Redirect to Sign In
- [ ] Sign In → See new user → Redirect to Main Page
- [ ] Nav shows "👤 user@email.com" after login
- [ ] Click profile icon → Dropdown with Logout
- [ ] Logout → Destroy session → Redirect to Main Page

---

## 🐛 Troubleshooting

**Q: Pages look weird/colors are wrong**
- A: Make sure _shared.css is in the same folder as .php files and linked correctly
  ```html
  <link rel="stylesheet" href="_shared.css">
  ```

**Q: Navigation menu is all messed up**
- A: Check that all pages include _nav.php:
  ```php
  <?php include '_nav.php'; ?>
  ```

**Q: Toast notifications (success messages) don't show**
- A: Make sure _shared.js is linked before closing </body>:
  ```html
  <script src="_shared.js"></script>
  ```

**Q: Password strength indicator not working**
- A: Make sure you're on registerpage.php (not signin.html). Check browser console (F12) for JS errors.

**Q: Country flags showing as ❓ or wrong emoji**
- A: Browser might not support emoji. Update to latest Chrome/Firefox. Fallback is 🌍 (globe icon).

**Q: Database connection fails**
- A: Check authentication.php has correct credentials:
     - $host = 'localhost' (or your MySQL server)
     - $db = 'unipath_db' (database name - create if doesn't exist)
     - $user = 'root' (your MySQL username)
     - $pass = '' (your MySQL password)

**Q: Hamburger menu doesn't work on mobile**
- A: Check browser mobile view is 768px or smaller (Ctrl+Shift+M in Chrome)

---

## 🎨 Customization Options

### Change Primary Color
Edit `_shared.css` line 2-4:
```css
:root {
    --accent-main: #5B4DFF;    /* Change to any hex color */
    --accent-light: #7C66FF;   /* Lighter version for hover */
}
```

### Change Font
Edit line 1 of `_shared.css`:
```css
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

body {
    font-family: 'Roboto', sans-serif;  /* Change 'Inter' to 'Roboto' */
}
```

### Add New Navigation Link
Edit `_nav.php` around line 50:
```html
<a href="newpage.php" class="nav-link">New Link</a>
```

### Change Toast Position
Edit `_shared.css` around line 400:
```css
.toast-container {
    top: 20px;      /* Move down from top */
    right: 20px;    /* Or change to left: 20px */
}
```

---

## 📞 Support Resources

1. **REDESIGN_GUIDE.md** - Complete feature documentation
2. **NAVIGATION_MAP.md** - Navigation structure and links
3. **CHANGES_SUMMARY.md** - What changed on each page
4. **Code Comments** - Every .php/.html/.css/.js file has comments explaining key sections

---

## ✅ Verification Checklist

After setup, verify these work:
- [ ] All pages load without 404 errors
- [ ] Navigation menu appears at top
- [ ] Dark theme is consistent across pages
- [ ] Responsive menu works on mobile
- [ ] At least one grid page shows data properly
- [ ] Toast notification appears (test any button with onclick)
- [ ] "Back to top" button appears when scrolling

**If all green ✅, you're ready to go!**

---

*Last Updated: 2025*
*UniPath Redesign v1.0*
