<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Рейтинг университетов — UniPath</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
      background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 50%, #16213e 100%);
      color: #e0e0e0;
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* HEADER */
    header {
      background: rgba(15, 15, 30, 0.7);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(91, 77, 255, 0.1);
      padding: 1.2rem 2rem;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav {
      max-width: 1400px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
    }

    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: #fff;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    nav {
      display: flex;
      gap: 2rem;
      flex: 1;
    }

    nav a {
      color: #a0a0b0;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
    }

    nav a:hover {
      color: #5B4DFF;
    }

    nav a.active::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, #5B4DFF, #7c3aed);
    }

    /* HERO SECTION */
    .hero {
      max-width: 1400px;
      margin: 4rem auto 0;
      padding: 6rem 2rem;
      text-align: center;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 1rem;
      background: linear-gradient(135deg, #fff 0%, #5B4DFF 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      letter-spacing: -1px;
    }

    .hero p {
      font-size: 1.3rem;
      color: #a0a0b0;
      margin-bottom: 2.5rem;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .hero-btn {
      display: inline-block;
      padding: 1rem 2.5rem;
      background: linear-gradient(135deg, #5B4DFF 0%, #7c3aed 100%);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(91, 77, 255, 0.3);
    }

    .hero-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 40px rgba(91, 77, 255, 0.4);
    }

    /* FILTERS SECTION */
    .filters-section {
      max-width: 1400px;
      margin: 3rem auto;
      padding: 0 2rem;
    }

    .filters-box {
      background: rgba(26, 26, 46, 0.6);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(91, 77, 255, 0.15);
      border-radius: 16px;
      padding: 2rem;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      align-items: end;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .filter-group label {
      font-size: 0.85rem;
      font-weight: 600;
      color: #b0b0c0;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    input, select {
      padding: 0.85rem 1rem;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(91, 77, 255, 0.2);
      border-radius: 10px;
      color: #fff;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }

    input::placeholder, select {
      color: #7a7a8a;
    }

    input:focus, select:focus {
      outline: none;
      background: rgba(91, 77, 255, 0.05);
      border-color: #5B4DFF;
      box-shadow: 0 0 0 3px rgba(91, 77, 255, 0.1);
    }

    .filter-buttons {
      display: flex;
      gap: 1rem;
      grid-column: 1 / -1;
      justify-content: center;
    }

    .filter-btn {
      padding: 0.85rem 1.5rem;
      background: linear-gradient(135deg, #5B4DFF 0%, #7c3aed 100%);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(91, 77, 255, 0.3);
    }

    .filter-btn.secondary {
      background: rgba(91, 77, 255, 0.1);
      border: 1px solid rgba(91, 77, 255, 0.3);
      color: #5B4DFF;
    }

    /* MAIN CONTENT */
    .container {
      max-width: 1400px;
      margin: 4rem auto;
      padding: 0 2rem;
    }

    /* TOP 3 */
    .top-three {
      margin-bottom: 4rem;
    }

    .top-three-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 2rem;
      color: #fff;
    }

    .top-three-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      margin-bottom: 3rem;
    }

    .top-card {
      position: relative;
      overflow: hidden;
      border-radius: 16px;
      transition: all 0.4s ease;
    }

    .top-card.rank-1 {
      grid-column: 1 / -1;
      max-width: 100%;
    }

    .top-card.rank-1 .top-card-bg {
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
      height: 300px;
    }

    .top-card.rank-2 .top-card-bg {
      background: linear-gradient(135deg, #C0C0C0 0%, #A0A0A0 100%);
      height: 240px;
    }

    .top-card.rank-3 .top-card-bg {
      background: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
      height: 240px;
    }

    .top-card-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(15, 15, 30, 0.5);
      backdrop-filter: blur(5px);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 2rem;
    }

    .top-card-bg {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 0;
    }

    .top-card {
      position: relative;
    }

    .top-card-overlay {
      position: relative;
      z-index: 1;
    }

    .top-card-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 1rem;
    }

    .top-card-rank {
      font-size: 3rem;
      font-weight: 800;
      color: rgba(255, 255, 255, 0.2);
      line-height: 1;
    }

    .top-card-match {
      background: rgba(255, 255, 255, 0.2);
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      color: #fff;
    }

    .top-card-content {
      margin-bottom: 1rem;
    }

    .top-card-name {
      font-size: 1.8rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 0.5rem;
    }

    .top-card-info {
      display: flex;
      gap: 1.5rem;
      font-size: 0.9rem;
      color: rgba(255, 255, 255, 0.8);
    }

    .top-card-cta {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 8px;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.85rem;
      transition: all 0.3s ease;
    }

    .top-card-cta:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateX(3px);
    }

    /* RANKING GRID */
    .ranking-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 2rem;
      color: #fff;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 1.8rem;
    }

    .card {
      background: rgba(26, 26, 46, 0.4);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(91, 77, 255, 0.15);
      border-radius: 14px;
      padding: 1.5rem;
      transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(91, 77, 255, 0.1), transparent);
      transition: left 0.6s ease;
    }

    .card:hover::before {
      left: 100%;
    }

    .card:hover {
      transform: translateY(-8px);
      border-color: rgba(91, 77, 255, 0.4);
      background: rgba(26, 26, 46, 0.6);
      box-shadow: 0 20px 40px rgba(91, 77, 255, 0.2);
    }

    .card-rank {
      display: inline-block;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #5B4DFF;
      margin-bottom: 0.5rem;
    }

    .card h3 {
      font-size: 1.3rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 1rem;
      line-height: 1.3;
    }

    .card-meta {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.2rem;
      font-size: 0.85rem;
      color: #a0a0b0;
    }

    .card-meta-item {
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .badge {
      display: inline-block;
      padding: 0.4rem 0.8rem;
      border-radius: 8px;
      background: rgba(91, 77, 255, 0.15);
      color: #5B4DFF;
      font-size: 0.8rem;
      font-weight: 600;
      margin-right: 0.5rem;
      margin-bottom: 0.5rem;
    }

    .match-score {
      display: inline-block;
      padding: 0.4rem 1rem;
      border-radius: 8px;
      background: linear-gradient(135deg, rgba(91, 77, 255, 0.2) 0%, rgba(124, 58, 237, 0.2) 100%);
      color: #5B4DFF;
      font-size: 0.85rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .status {
      margin-top: 1rem;
      padding: 0.75rem;
      border-radius: 8px;
      text-align: center;
      font-size: 0.9rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .status.match {
      background: rgba(16, 185, 129, 0.15);
      color: #10b981;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status.no-match {
      background: rgba(239, 68, 68, 0.15);
      color: #ef4444;
      border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* CTA SECTION */
    .cta-section {
      max-width: 1400px;
      margin: 6rem auto 4rem;
      padding: 0 2rem;
      background: linear-gradient(135deg, rgba(91, 77, 255, 0.1) 0%, rgba(124, 58, 237, 0.05) 100%);
      border: 1px solid rgba(91, 77, 255, 0.2);
      border-radius: 20px;
      padding: 4rem 2rem;
      text-align: center;
    }

    .cta-section h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 1rem;
    }

    .cta-section p {
      font-size: 1.1rem;
      color: #a0a0b0;
      margin-bottom: 2rem;
    }

    .cta-btn {
      display: inline-block;
      padding: 1rem 3rem;
      background: linear-gradient(135deg, #5B4DFF 0%, #7c3aed 100%);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(91, 77, 255, 0.3);
    }

    .cta-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 40px rgba(91, 77, 255, 0.4);
    }

    /* FOOTER */
    footer {
      margin-top: 6rem;
      background: rgba(15, 15, 30, 0.7);
      border-top: 1px solid rgba(91, 77, 255, 0.1);
      padding: 2rem;
      text-align: center;
      color: #7a7a8a;
      font-size: 0.9rem;
    }

    /* ANIMATIONS */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      animation: fadeInUp 0.6s ease backwards;
    }

    .top-card {
      animation: fadeInUp 0.7s ease backwards;
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
      .nav {
        gap: 1.5rem;
      }

      .hero {
        padding: 4rem 1.5rem;
        margin: 3rem auto 0;
      }

      .hero h1 {
        font-size: 2.8rem;
      }
    }

    @media (max-width: 768px) {
      header {
        padding: 1rem;
      }

      .nav {
        gap: 1rem;
      }

      .logo {
        font-size: 1.2rem;
      }

      .hero {
        padding: 3rem 1rem;
        margin: 2rem auto 0;
      }

      .hero h1 {
        font-size: 2.2rem;
      }

      .hero p {
        font-size: 1rem;
      }

      .grid {
        grid-template-columns: 1fr;
      }

      .top-three-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }

      .top-card.rank-1 {
        grid-column: 1;
      }

      nav {
        display: none;
      }

      .filters-box {
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 1.5rem;
      }

      .filter-buttons {
        flex-direction: column;
        grid-column: 1;
      }

      .filter-btn {
        width: 100%;
      }

      .filter-group label {
        font-size: 0.8rem;
      }

      input, select {
        padding: 0.7rem 0.8rem;
        font-size: 0.9rem;
      }
    }

    @media (max-width: 600px) {
      header {
        padding: 0.8rem;
      }

      .nav {
        gap: 0.8rem;
      }

      .logo {
        font-size: 1rem;
      }

      .hero {
        padding: 2.5rem 0.75rem;
      }

      .hero h1 {
        font-size: 1.6rem;
      }

      .hero p {
        font-size: 0.95rem;
      }

      .hero-btn {
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
      }

      .filters-box {
        padding: 1.2rem;
        gap: 0.8rem;
      }

      input, select {
        padding: 0.6rem 0.7rem;
        font-size: 0.85rem;
      }

      .filter-btn {
        padding: 0.7rem 1.2rem;
        font-size: 0.85rem;
      }

      .top-three-title {
        font-size: 1.2rem;
      }
    }

    @media (max-width: 480px) {
      .hero {
        padding: 2rem 0.5rem;
      }

      .hero h1 {
        font-size: 1.4rem;
      }

      .filters-box {
        padding: 1rem;
      }
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header>
    <div class="nav">
      <a href="mainpage.php" class="logo">🎓 UniPath</a>
      <nav>
        <a href="mainpage.php">Главная</a>
        <a href="ranking.php" class="active">Рейтинг</a>
        <a href="alumni.html">Кейсы</a>
        <a href="guides.html">Гайды</a>
        <a href="scholarships.php">Стипендии</a>
      </nav>
    </div>
  </header>

  <!-- HERO SECTION -->
  <section class="hero">
    <h1>Рейтинг университетов мира</h1>
    <p>Лучшие университеты, отсортированные по твоим шансам поступления. Найди свой идеальный вуз за 2 минуты.</p>
    <button class="hero-btn" onclick="document.querySelector('.filters-box').scrollIntoView({behavior: 'smooth'})">
      Начать подбор →
    </button>
  </section>

  <!-- FILTERS SECTION -->
  <section class="filters-section">
    <div class="filters-box">
      <div class="filter-group">
        <label>Твой IELTS</label>
        <input type="number" id="ielts" placeholder="5.5 - 9.0" min="0" max="9" step="0.5">
      </div>

      <div class="filter-group">
        <label>Страна</label>
        <select id="country">
          <option value="">Все страны</option>
          <option value="USA">США</option>
          <option value="UK">Великобритания</option>
          <option value="Germany">Германия</option>
          <option value="Canada">Канада</option>
          <option value="Australia">Австралия</option>
          <option value="Singapore">Сингапур</option>
          <option value="Switzerland">Швейцария</option>
          <option value="Korea">Южная Корея</option>
          <option value="Japan">Япония</option>
          <option value="Hong Kong">Гонконг</option>
          <option value="Netherlands">Нидерланды</option>
          <option value="Belgium">Бельгия</option>
          <option value="Italy">Италия</option>
          <option value="Sweden">Швеция</option>
          <option value="France">Франция</option>
        </select>
      </div>

      <div class="filter-group">
        <label>Бюджет</label>
        <select id="budget">
          <option value="">Любой</option>
          <option value="low">Низкий (&lt; $15k/год)</option>
          <option value="medium">Средний ($15k-$35k)</option>
          <option value="high">Высокий (&gt; $35k)</option>
        </select>
      </div>

      <div class="filter-buttons">
        <button class="filter-btn" onclick="filterUniversities()">Поиск</button>
        <button class="filter-btn secondary" onclick="resetFilters()">Сбросить</button>
      </div>
    </div>
  </section>

  <!-- MAIN CONTAINER -->
  <div class="container">
    <!-- TOP 3 SECTION -->
    <div class="top-three">
      <h2 class="top-three-title">Топ 3 университета</h2>
      <div class="top-three-grid" id="topThreeGrid"></div>
    </div>

    <!-- REST OF RANKING -->
    <h2 class="ranking-title">Все университеты</h2>
    <div class="grid" id="grid"></div>
  </div>

  <!-- CTA SECTION -->
  <section class="cta-section">
    <h2>Не знаешь, куда поступать?</h2>
    <p>Пройди тест и получи персональный план поступления с тьютором</p>
    <button class="cta-btn">Получить персональный план →</button>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>&copy; 2026 UniPath. Путь к лучшему образованию. | <a href="#">Политика конфиденциальности</a></p>
  </footer>

  <script>
    const universities = [
      { rank: 1, name: "MIT", country: "USA", ielts: 7.5, cost: 80000, matchScore: 92 },
      { rank: 2, name: "Stanford", country: "USA", ielts: 7.0, cost: 85000, matchScore: 88 },
      { rank: 3, name: "Harvard", country: "USA", ielts: 7.5, cost: 75000, matchScore: 91 },
      { rank: 4, name: "Caltech", country: "USA", ielts: 7.0, cost: 70000, matchScore: 85 },
      { rank: 5, name: "Oxford", country: "UK", ielts: 7.5, cost: 45000, matchScore: 87 },
      { rank: 6, name: "Cambridge", country: "UK", ielts: 7.5, cost: 48000, matchScore: 89 },
      { rank: 7, name: "Imperial College", country: "UK", ielts: 7.0, cost: 42000, matchScore: 84 },
      { rank: 8, name: "UCL", country: "UK", ielts: 7.0, cost: 40000, matchScore: 82 },
      { rank: 9, name: "ETH Zurich", country: "Switzerland", ielts: 7.0, cost: 30000, matchScore: 86 },
      { rank: 10, name: "EPFL", country: "Switzerland", ielts: 7.0, cost: 28000, matchScore: 83 },
      { rank: 11, name: "TUM", country: "Germany", ielts: 6.5, cost: 12000, matchScore: 78 },
      { rank: 12, name: "LMU Munich", country: "Germany", ielts: 6.5, cost: 10000, matchScore: 76 },
      { rank: 13, name: "RWTH Aachen", country: "Germany", ielts: 6.5, cost: 11000, matchScore: 77 },
      { rank: 14, name: "Univ Toronto", country: "Canada", ielts: 6.5, cost: 35000, matchScore: 79 },
      { rank: 15, name: "UBC", country: "Canada", ielts: 6.5, cost: 32000, matchScore: 81 },
      { rank: 16, name: "McGill", country: "Canada", ielts: 6.5, cost: 30000, matchScore: 80 },
      { rank: 17, name: "NUS", country: "Singapore", ielts: 6.5, cost: 25000, matchScore: 75 },
      { rank: 18, name: "NTU", country: "Singapore", ielts: 6.0, cost: 22000, matchScore: 73 },
      { rank: 19, name: "KAIST", country: "Korea", ielts: 6.5, cost: 18000, matchScore: 74 },
      { rank: 20, name: "Seoul National", country: "Korea", ielts: 6.0, cost: 15000, matchScore: 71 },
      { rank: 21, name: "Tokyo Univ", country: "Japan", ielts: 6.5, cost: 20000, matchScore: 72 },
      { rank: 22, name: "HKU", country: "Hong Kong", ielts: 6.5, cost: 28000, matchScore: 77 },
      { rank: 23, name: "HKUST", country: "Hong Kong", ielts: 6.0, cost: 26000, matchScore: 75 },
      { rank: 24, name: "Melbourne Univ", country: "Australia", ielts: 6.5, cost: 38000, matchScore: 80 },
      { rank: 25, name: "Sydney Univ", country: "Australia", ielts: 6.5, cost: 36000, matchScore: 79 },
      { rank: 26, name: "UNSW", country: "Australia", ielts: 6.5, cost: 37000, matchScore: 78 },
      { rank: 27, name: "Delft University", country: "Netherlands", ielts: 6.5, cost: 16000, matchScore: 76 },
      { rank: 28, name: "Amsterdam Univ", country: "Netherlands", ielts: 6.5, cost: 14000, matchScore: 74 },
      { rank: 29, name: "KU Leuven", country: "Belgium", ielts: 6.5, cost: 13000, matchScore: 73 },
      { rank: 30, name: "Politecnico Milano", country: "Italy", ielts: 6.0, cost: 9000, matchScore: 68 },
      { rank: 31, name: "KTH", country: "Sweden", ielts: 6.5, cost: 12000, matchScore: 72 },
      { rank: 32, name: "Sorbonne", country: "France", ielts: 6.5, cost: 8000, matchScore: 69 },
      { rank: 33, name: "Ecole Polytechnique", country: "France", ielts: 6.5, cost: 10000, matchScore: 70 },
      { rank: 34, name: "University Chicago", country: "USA", ielts: 7.0, cost: 82000, matchScore: 87 },
      { rank: 35, name: "Columbia", country: "USA", ielts: 7.5, cost: 78000, matchScore: 90 },
      { rank: 36, name: "Cornell", country: "USA", ielts: 7.5, cost: 76000, matchScore: 88 },
      { rank: 37, name: "Yale", country: "USA", ielts: 7.0, cost: 79000, matchScore: 89 },
      { rank: 38, name: "Edinburgh", country: "UK", ielts: 6.5, cost: 44000, matchScore: 81 },
      { rank: 39, name: "Manchester", country: "UK", ielts: 6.5, cost: 38000, matchScore: 77 },
      { rank: 40, name: "Warwick", country: "UK", ielts: 6.5, cost: 42000, matchScore: 79 }
    ];

    function getBudgetLabel(cost) {
      if (cost < 15000) return "low";
      if (cost < 35000) return "medium";
      return "high";
    }

    function renderTopThree() {
      const topThreeGrid = document.getElementById('topThreeGrid');
      const topThree = universities.slice(0, 3);

      topThreeGrid.innerHTML = topThree.map((u, index) => {
        const rankClass = `rank-${index + 1}`;
        return `
          <div class="top-card ${rankClass}">
            <div class="top-card-bg"></div>
            <div class="top-card-overlay">
              <div class="top-card-header">
                <div class="top-card-rank">#${u.rank}</div>
                <div class="top-card-match">${u.matchScore}% совпадение</div>
              </div>
              <div class="top-card-content">
                <div class="top-card-name">${u.name}</div>
                <div class="top-card-info">
                  <div>🌍 ${u.country}</div>
                  <div>📝 IELTS ${u.ielts}+</div>
                  <div>💰 $${(u.cost / 1000).toFixed(0)}k/год</div>
                </div>
              </div>
              <a href="#" class="top-card-cta">Узнать больше →</a>
            </div>
          </div>
        `;
      }).join('');
    }

    function renderUniversities(data, userIelts = null) {
      const grid = document.getElementById('grid');

      grid.innerHTML = data.map(u => {
        let statusHtml = '';
        if (userIelts !== null && !isNaN(userIelts)) {
          const matches = userIelts >= u.ielts;
          statusHtml = `
            <div class="status ${matches ? 'match' : 'no-match'}">
              ${matches ? '✅ Ты проходишь' : `❌ Нужен IELTS ${u.ielts}`}
            </div>
          `;
        }

        return `
          <div class="card" style="animation-delay: ${data.indexOf(u) * 50}ms">
            <span class="card-rank">#${u.rank}</span>
            <h3>${u.name}</h3>
            <div class="card-meta">
              <div class="card-meta-item">🌍 ${u.country}</div>
              <div class="card-meta-item">📊 ${u.matchScore}% совпадение</div>
            </div>
            <div>
              <span class="badge">IELTS ${u.ielts}+</span>
              <span class="match-score">$${(u.cost / 1000).toFixed(0)}k/год</span>
            </div>
            ${statusHtml}
          </div>
        `;
      }).join('');
    }

    function filterUniversities() {
      const ielts = parseFloat(document.getElementById('ielts').value) || null;
      const country = document.getElementById('country').value;
      const budget = document.getElementById('budget').value;

      let filtered = universities.filter(u => {
        const countryMatch = !country || u.country === country;
        const budgetMatch = !budget || getBudgetLabel(u.cost) === budget;
        return countryMatch && budgetMatch;
      });

      filtered.sort((a, b) => {
        if (ielts !== null && !isNaN(ielts)) {
          const aMatches = ielts >= a.ielts;
          const bMatches = ielts >= b.ielts;
          if (aMatches !== bMatches) return aMatches ? -1 : 1;
        }
        return a.rank - b.rank;
      });

      renderUniversities(filtered, ielts);
    }

    function resetFilters() {
      document.getElementById('ielts').value = '';
      document.getElementById('country').value = '';
      document.getElementById('budget').value = '';
      renderUniversities(universities.slice(3));
    }

    // Initial render
    renderTopThree();
    renderUniversities(universities.slice(3));
  </script>

</body>

</html>