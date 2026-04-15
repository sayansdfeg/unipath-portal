# UniPath Navigation Map

## Main Navigation Structure

All pages use `<?php include '_nav.php'; ?>` which provides:

```
┌─────────────────────────────────────────────────────────────┐
│ UniPath (Logo) │ Главная │ Рейтинги │ Стипендии │ Обучение │
│                │ Rankings│ Scholarships│ Guides  │  Alumni  │
│                └─ Sign In / Sign Up (or User Menu)         │
└─────────────────────────────────────────────────────────────┘
```

## Navigation Links

| Nav Item | File | Route | Visible |
|---|---|---|---|
| Главная (Home) | mainpage.php | / | Always |
| Рейтинги (Rankings) | ranking.php | /ranking.php | Always |
| Стипендии (Scholarships) | scholarships.php | /scholarships.php | Always |
| Обучение (Guides) | guides.html | /guides.html | Always |
| Alumni | alumni.HTML | /alumni.HTML | Always |
| Sign In | signin.html | /signin.html | Not logged in |
| Sign Up | registerpage.php | /registerpage.php | Not logged in |
| Profile | uppload.php | /uppload.php | Logged in |
| Logout | logout.php | /logout.php | Logged in |

## Active Link Detection

The navigation automatically highlights the current page:
- `mainpage.php` → "Главная" link has `.active` class
- `ranking.php` → "Рейтинги" link has `.active` class
- `scholarships.php` → "Стипендии" link has `.active` class
- `guides.html` → "Обучение" link has `.active` class
- `alumni.HTML` → "Alumni" link has `.active` class

Implementation in `_nav.php`:
```php
<?php
$current_page = basename($_SERVER['PHP_SELF']);
$active_class = ($current_page === 'mainpage.php') ? 'active' : '';
?>
<a href="mainpage.php" class="nav-link <?php echo $active_class; ?>">Главная</a>
```

## Mobile Menu

On screens smaller than 768px:
- Navigation links hide in mobile menu
- Hamburger icon (3 horizontal lines) appears
- Click hamburger to toggle `.nav-menu.active` state
- Hamburger icon animates to X when menu open

## Authenticated User Display

When user is logged in (`$_SESSION['user_email']` is set):
- Shows: "👤 [User Email]" with dropdown menu
- Dropdown has options: Profile, Logout
- Profile link goes to `uppload.php`
- Logout link goes to `logout.php` (destroys session)

When user is not logged in:
- Shows two buttons: "Sign In" and "Sign Up"
- Sign In → `signin.html`
- Sign Up → `registerpage.php`

## Navigation CSS Classes

**Active State:**
```css
.nav-link.active {
    color: var(--accent-main);    /* #5B4DFF */
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--accent-main);  /* Underline */
    border-radius: 2px;
}
```

**Mobile Menu:**
```css
.nav-menu {
    display: none;                          /* Hidden on desktop */
}

@media (max-width: 768px) {
    .nav-menu.active {
        display: flex;                      /* Shows on mobile when active */
        flex-direction: column;
        gap: 1rem;
    }
}
```

**Hamburger Icon:**
```css
.hamburger {
    display: none;                          /* Hidden on desktop */
    width: 28px;
    height: 20px;
    cursor: pointer;
}

@media (max-width: 768px) {
    .hamburger {
        display: flex;                      /* Shows on mobile */
        flex-direction: column;
        justify-content: space-between;
    }
    
    .hamburger.active line:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }
    
    .hamburger.active line:nth-child(2) {
        opacity: 0;
    }
    
    .hamburger.active line:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }
}
```

## JavaScript Navigation Handling

In `_nav.php`:
```javascript
// Toggle mobile menu
hamburger.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    hamburger.classList.toggle('active');
});

// Close menu when link clicked
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        hamburger.classList.remove('active');
    });
});

// Highlight active page
window.addEventListener('load', () => {
    const current = basename(window.location.pathname);
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === current) {
            link.classList.add('active');
        }
    });
});
```

## Multi-Level Navigation (Future Enhancement)

If you need dropdown menus:
```html
<li class="nav-item dropdown">
    <a href="#" class="nav-link">Меню</a>
    <ul class="dropdown-menu">
        <li><a href="subpage.php">Подпункт 1</a></li>
        <li><a href="subpage2.php">Подпункт 2</a></li>
    </ul>
</li>
```

Required CSS:
```css
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: var(--bg-secondary);
    border-radius: 8px;
    min-width: 200px;
}

.nav-item:hover .dropdown-menu {
    display: flex;
    flex-direction: column;
}
```

## Breadcrumb Navigation (Optional - Not Implemented)

For nested pages, you could add breadcrumbs:
```
Home > Universities > Stanford University > Application Center
```

Add in `_nav.php` after main nav:
```php
<?php
// Parse current breadcrumb
$breadcrumbs = [
    'mainpage.php' => 'Home',
    'ranking.php' => 'Universities',
    'scholarships.php' => 'Scholarships',
];
?>
<div class="breadcrumbs">
    <a href="mainpage.php">Home</a>
    <?php if (isset($breadcrumbs[$current_page])): ?>
        / <span><?php echo $breadcrumbs[$current_page]; ?></span>
    <?php endif; ?>
</div>
```

## Customizing Navigation Items

To add a new link, edit `_nav.php`:

1. Find the `<ul class="nav-menu">` section
2. Add new `<li>`:
```html
<li class="nav-item">
    <a href="newpage.php" class="nav-link">New Page</a>
</li>
```

3. If page has no database queries, add to hardcoded list
4. Test active link highlighting works

## Testing Navigation

**Desktop:**
- [ ] All 5 links visible
- [ ] Current page link highlighted (underline + color)
- [ ] Hover shows smooth transition
- [ ] Links navigate to correct pages

**Mobile (< 768px):**
- [ ] Hamburger icon visible
- [ ] Click hamburger opens menu
- [ ] Menu overlays page
- [ ] All links clickable
- [ ] Clicking link closes menu
- [ ] Hamburger icon animates to X and back

**Authenticated User:**
- [ ] Log in with test account
- [ ] Navigation shows "👤 email@example.com"
- [ ] Profile icon has dropdown
- [ ] Logout button present
- [ ] Click logout → redirect to mainpage, session destroyed

---

See `_nav.php` for full implementation details.
