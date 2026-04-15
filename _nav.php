<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_email']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : '';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header id="header">
    <div class="nav-container">
        <a href="mainpage.php" class="logo">
            <span style="color: #5B4DFF;">◆</span> UniPath
        </a>
        
        <nav class="nav-menu">
            <ul>
                <li><a href="mainpage.php" class="nav-link <?php echo ($current_page === 'mainpage.php' || $current_page === 'index.php') ? 'active' : ''; ?>">Главная</a></li>
                <li><a href="ranking.php" class="nav-link <?php echo $current_page === 'ranking.php' ? 'active' : ''; ?>">Рейтинги</a></li>
                <li><a href="scholarships.php" class="nav-link <?php echo $current_page === 'scholarships.php' ? 'active' : ''; ?>">Стипендии</a></li>
                <li><a href="guides.html" class="nav-link <?php echo $current_page === 'guides.html' ? 'active' : ''; ?>">Гайды</a></li>
                <li><a href="alumni.html" class="nav-link <?php echo $current_page === 'alumni.html' ? 'active' : ''; ?>">Выпускники</a></li>
                <li><a href="chat.html" class="nav-link <?php echo $current_page === 'chat.html' ? 'active' : ''; ?>">🤖 AI помощник</a></li>
            </ul>
        </nav>

        <div class="nav-auth">
            <?php if ($is_logged_in): ?>
                <span class="user-welcome">👋 <?php echo htmlspecialchars($user_name); ?></span>
                <a href="logout.php" class="nav-btn logout-btn">Выход</a>
            <?php else: ?>
                <a href="signin.html" class="nav-btn signin-btn">Вход</a>
                <a href="registerpage.php" class="nav-btn signup-btn">Регистрация</a>
            <?php endif; ?>
        </div>

        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<style>
/* Header & Navigation */
header {
    background-color: #0f0f1a;
    backdrop-filter: blur(10px);
    position: sticky;
    top: 0;
    z-index: 1000;
    border-bottom: 1px solid rgba(91, 77, 255, 0.1);
    padding: 1rem 0;
}

.nav-container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
    gap: 2rem;
}

.logo {
    color: #fff;
    font-size: 1.5rem;
    font-weight: 900;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    letter-spacing: -1px;
    white-space: nowrap;
    transition: color 0.3s;
}

.logo:hover {
    color: #5B4DFF;
}

.nav-menu {
    flex: 1;
}

.nav-menu ul {
    list-style: none;
    display: flex;
    gap: 2.5rem;
    margin: 0;
    padding: 0;
}

.nav-link {
    color: #e0e0e0;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: color 0.3s;
    position: relative;
}

.nav-link:hover {
    color: #5B4DFF;
}

.nav-link.active {
    color: #5B4DFF;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 0;
    right: 0;
    height: 2px;
    background: #5B4DFF;
}

.nav-auth {
    display: flex;
    align-items: center;
    gap: 1rem;
    white-space: nowrap;
}

.user-welcome {
    color: #e0e0e0;
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    background: rgba(91, 77, 255, 0.1);
    border-radius: 20px;
}

.nav-btn {
    text-decoration: none;
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
    display: inline-block;
}

.signin-btn {
    color: #5B4DFF;
    border: 1px solid #5B4DFF;
    background: transparent;
}

.signin-btn:hover {
    background: rgba(91, 77, 255, 0.1);
}

.signup-btn {
    background: #5B4DFF;
    color: #0f0f1a;
}

.signup-btn:hover {
    background: #7C66FF;
    box-shadow: 0 4px 15px rgba(91, 77, 255, 0.4);
}

.logout-btn {
    background: #5B4DFF;
    color: #0f0f1a;
}

.logout-btn:hover {
    background: #7C66FF;
}

.mobile-menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #e0e0e0;
    flex-direction: column;
    gap: 5px;
    padding: 0;
}

.mobile-menu-toggle span {
    width: 25px;
    height: 3px;
    background-color: #e0e0e0;
    border-radius: 2px;
    transition: all 0.3s;
}

.mobile-menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg) translate(8px, 8px);
}

.mobile-menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg) translate(8px, -8px);
}

/* Mobile Menu */
@media (max-width: 768px) {
    .nav-container {
        padding: 0 1rem;
        gap: 1rem;
    }

    .logo {
        font-size: 1.2rem;
    }

    .nav-menu {
        position: absolute;
        top: 60px;
        left: 0;
        right: 0;
        background: #1a1a2e;
        border-bottom: 1px solid rgba(91, 77, 255, 0.1);
        display: none;
        flex-direction: column;
        padding: 1rem 0;
    }

    .nav-menu.active {
        display: flex;
    }

    .nav-menu ul {
        flex-direction: column;
        gap: 0;
        padding: 0 2rem;
    }

    .nav-menu li {
        padding: 1rem 0;
        border-bottom: 1px solid rgba(91, 77, 255, 0.05);
    }

    .nav-auth {
        display: none;
    }

    .nav-auth.mobile-visible {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #1a1a2e;
        display: flex;
        flex-direction: column;
        padding: 1rem 2rem;
        gap: 0.5rem;
        border-bottom: 1px solid rgba(91, 77, 255, 0.1);
        z-index: 999;
    }

    .nav-auth.mobile-visible .nav-btn {
        width: 100%;
        text-align: center;
    }

    .mobile-menu-toggle {
        display: flex;
    }
}

@media (max-width: 480px) {
    .nav-container {
        padding: 0 1rem;
    }

    .logo {
        font-size: 1.1rem;
    }

    .nav-menu {
        top: 55px;
    }

    .nav-menu ul {
        padding: 0 1rem;
    }

    .nav-menu li {
        padding: 0.8rem 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const navMenu = document.querySelector('.nav-menu');
    const navAuth = document.querySelector('.nav-auth');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
            navAuth.classList.toggle('mobile-visible');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                mobileMenuToggle.classList.remove('active');
                navMenu.classList.remove('active');
                navAuth.classList.remove('mobile-visible');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.nav-container')) {
                mobileMenuToggle.classList.remove('active');
                navMenu.classList.remove('active');
                navAuth.classList.remove('mobile-visible');
            }
        });
    }
});
</script>
