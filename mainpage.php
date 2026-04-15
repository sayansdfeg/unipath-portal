<?php
// Start session before any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniPath — Найди свой университет за 5 минут</title>
    <link rel="stylesheet" href="_shared.css">
    <style>
        /* === HERO SECTION === */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f0f1a 0%, #16213e 50%, #1a1a2e 100%);
            position: relative;
            overflow: hidden;
            padding: 2rem;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(91, 77, 255, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: floating 6s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(91, 77, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -50px;
            left: -100px;
            animation: floating 8s ease-in-out infinite reverse;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .hero-content {
            max-width: 900px;
            text-align: center;
            position: relative;
            z-index: 2;
            margin-top: 60px;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #5B4DFF 0%, #7C66FF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.25rem;
            color: #a0a0a0;
            margin-bottom: 3rem;
            line-height: 1.7;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-cta {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .btn-hero {
            padding: 1.2rem 3rem;
            font-size: 1rem;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-hero-primary {
            background: #5B4DFF;
            color: #0f0f1a;
            box-shadow: 0 10px 30px rgba(91, 77, 255, 0.4);
        }

        .btn-hero-primary:hover {
            background: #7C66FF;
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(91, 77, 255, 0.5);
        }

        .btn-hero-secondary {
            background: transparent;
            color: #5B4DFF;
            border: 2px solid #5B4DFF;
        }

        .btn-hero-secondary:hover {
            background: rgba(91, 77, 255, 0.1);
            transform: translateY(-4px);
        }

        .hero-visual {
            font-size: 6rem;
            opacity: 0.8;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* === SECTION STYLES === */
        .section {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-align: center;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #a0a0a0;
            text-align: center;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .how-it-works {
            background: var(--bg-primary);
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
        }

        .step {
            text-align: center;
        }

        .step-number {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #5B4DFF, #7C66FF);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 900;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 30px rgba(91, 77, 255, 0.3);
        }

        .step h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .step p {
            color: #a0a0a0;
            line-height: 1.6;
        }

        .benefits {
            background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 100%);
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .benefit-card {
            padding: 2rem;
            background: var(--bg-secondary);
            border: 1px solid rgba(91, 77, 255, 0.1);
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            transform: translateY(-4px);
            border-color: #5B4DFF;
            box-shadow: 0 10px 30px rgba(91, 77, 255, 0.2);
        }

        .benefit-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .benefit-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.8rem;
        }

        .benefit-card p {
            color: #a0a0a0;
            font-size: 0.95rem;
        }

        /* === RESULTS SECTION === */
        .results-section {
            background: var(--bg-primary);
        }

        .result-showcase {
            max-width: 600px;
            margin: 0 auto;
        }

        .result-card {
            background: var(--bg-secondary);
            border: 1px solid rgba(91, 77, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .result-card:hover {
            transform: translateY(-4px);
            border-color: #5B4DFF;
            box-shadow: 0 15px 40px rgba(91, 77, 255, 0.3);
        }

        .result-header {
            background: linear-gradient(135deg, #5B4DFF, #7C66FF);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .result-header h4 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .result-body {
            padding: 2rem;
        }

        .result-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(91, 77, 255, 0.1);
        }

        .result-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .result-label {
            color: #a0a0a0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .result-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #5B4DFF;
        }

        .match-probability {
            text-align: center;
            padding: 1.5rem;
            background: rgba(91, 77, 255, 0.1);
            border-radius: 12px;
            margin-top: 1.5rem;
        }

        .match-probability p {
            color: #a0a0a0;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .match-percentage {
            font-size: 2.5rem;
            font-weight: 900;
            color: #5B4DFF;
        }

        /* === SOCIAL PROOF === */
        .social-proof {
            background: linear-gradient(135deg, #0f0f1a 0%, #16213e 100%);
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
        }

        .stat-box {
            padding: 2rem;
            background: var(--bg-secondary);
            border: 1px solid rgba(91, 77, 255, 0.1);
            border-radius: 12px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            color: #5B4DFF;
            margin-bottom: 0.5rem;
        }

        .stat-text {
            color: #a0a0a0;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* === SEARCH SECTION === */
        .search-section {
            background: var(--bg-secondary);
            padding: 3rem 2rem;
            border-radius: 12px;
            border: 1px solid rgba(91, 77, 255, 0.1);
        }

        .search-section h3 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2.5rem;
        }

        .filter-section {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-weight: 600;
            color: #e0e0e0;
            font-size: 0.9rem;
        }

        .filter-group input {
            padding: 0.75rem 1rem;
            border: 1px solid rgba(91, 77, 255, 0.2);
            border-radius: 8px;
            background: var(--bg-tertiary);
            color: #e0e0e0;
            font-size: 1rem;
        }

        .filter-group input:focus {
            outline: none;
            border-color: #5B4DFF;
            box-shadow: 0 0 0 3px rgba(91, 77, 255, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            align-self: flex-end;
        }

        .btn-filter {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-filter-primary {
            background: #5B4DFF;
            color: #0f0f1a;
        }

        .btn-filter-primary:hover {
            background: #7C66FF;
            transform: translateY(-2px);
        }

        .btn-filter-secondary {
            background: transparent;
            color: #5B4DFF;
            border: 1px solid #5B4DFF;
        }

        .btn-filter-secondary:hover {
            background: rgba(91, 77, 255, 0.1);
        }

        /* === UNIVERSITIES SECTION === */
        .universities-section {
            padding: 2rem 0;
        }

        .results-info {
            margin-bottom: 2rem;
            font-weight: 700;
            color: #e0e0e0;
            font-size: 1rem;
        }

        .universities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .uni-card {
            background: var(--bg-secondary);
            border: 1px solid rgba(91, 77, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .uni-card:hover {
            transform: translateY(-4px);
            border-color: #5B4DFF;
            box-shadow: 0 10px 30px rgba(91, 77, 255, 0.2);
        }

        .uni-header {
            background: linear-gradient(135deg, #5B4DFF, #7C66FF);
            color: white;
            padding: 1.5rem;
        }

        .uni-header h3 {
            margin: 0 0 0.5rem 0;
            font-size: 1.1rem;
            line-height: 1.3;
        }

        .uni-header span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .uni-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .badges {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .badge {
            background: rgba(91, 77, 255, 0.15);
            color: #5B4DFF;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid rgba(91, 77, 255, 0.3);
        }

        .uni-desc {
            font-size: 0.95rem;
            line-height: 1.5;
            color: #a0a0a0;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .status-message {
            margin-top: auto;
            font-weight: 600;
            padding: 0.8rem;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
        }

        .status-eligible {
            background: rgba(81, 207, 102, 0.15);
            color: #51cf66;
            border: 1px solid rgba(81, 207, 102, 0.3);
        }

        .status-ineligible {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            font-size: 1.2rem;
            color: #a0a0a0;
        }

        /* === FINAL CTA === */
        .final-cta {
            background: linear-gradient(135deg, #5B4DFF 0%, #7C66FF 100%);
            color: white;
            padding: 5rem 2rem;
            text-align: center;
        }

        .final-cta h2 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .final-cta p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .final-cta .btn-primary {
            background: #0f0f1a;
            color: #5B4DFF;
            padding: 1.2rem 3rem;
            font-size: 1.05rem;
        }

        .final-cta .btn-primary:hover {
            background: #1a1a2e;
            color: #7C66FF;
        }

        /* === FOOTER === */
        footer {
            background: #0f0f1a;
            color: #a0a0a0;
            padding: 3rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(91, 77, 255, 0.1);
        }

        footer a {
            color: #5B4DFF;
        }

        footer a:hover {
            color: #7C66FF;
        }

        /* === RESPONSIVE === */
        @media (max-width: 1024px) {
            .hero {
                min-height: 80vh;
                padding: 1.5rem;
            }

            .hero h1 {
                font-size: 3.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .section {
                padding: 3.5rem 0;
            }
        }

        @media (max-width: 768px) {
            .hero {
                min-height: 70vh;
                padding: 1rem;
            }

            .hero-content {
                margin-top: 40px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-cta {
                flex-direction: column;
            }

            .btn-hero {
                width: 100%;
            }

            .filter-section {
                flex-direction: column;
            }

            .filter-group {
                min-width: 100%;
            }

            .btn-group {
                width: 100%;
                align-self: auto;
                flex-direction: column;
            }

            .btn-filter {
                width: 100%;
            }

            .universities-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .final-cta {
                padding: 3rem 1rem;
            }

            .final-cta h2 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                min-height: 60vh;
                padding: 0.75rem;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p {
                font-size: 0.9rem;
            }

            .hero-visual {
                font-size: 4rem;
            }

            .button-hero {
                padding: 0.9rem 1.5rem;
                font-size: 0.9rem;
            }

            .search-section {
                padding: 1.5rem;
            }

            .filter-group input {
                padding: 0.65rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .section-subtitle {
                font-size: 0.95rem;
            }
        }
    </style>
</head>

<body>

<?php include '_nav.php'; ?>

<!-- === HERO SECTION === -->
<section class="hero">
    <div class="hero-content">
        <h1>Найди свой идеальный университет за 5 минут</h1>
        <p>UniPath анализирует твои результаты и рекомендует лучшие вузы мира с точностью 94%. Никакой лишней информации — только те, куда ты реально поступишь.</p>
        
        <div class="hero-cta">
            <button class="btn-hero btn-hero-primary" onclick="document.querySelector('.search-section').scrollIntoView({ behavior: 'smooth' })">
                🚀 Начать подбор
            </button>
            <button class="btn-hero btn-hero-secondary" onclick="document.getElementById('how-it-works').scrollIntoView({ behavior: 'smooth' })">
                Узнать как это работает →
            </button>
        </div>

        <div class="hero-visual">🎯</div>
    </div>
</section>

<!-- === КАК ЭТО РАБОТАЕТ === -->
<section class="section how-it-works" id="how-it-works">
    <div class="container">
        <h2 class="section-title">Как это работает</h2>
        <p class="section-subtitle">От твоих данных к лучшим рекомендациям за считанные секунды</p>
        
        <div class="steps-grid">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Введи свои баллы</h3>
                <p>Скажи нам твой IELTS, GPA и другие показатели — это займёт пару минут</p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>Искусственный интеллект анализирует</h3>
                <p>Наша AI изучает требования 500+ университетов и твой профиль</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Получи рекомендации</h3>
                <p>Видишь лучшие совпадения с вероятностью поступления и полезными ссылками</p>
            </div>
            <div class="step">
                <div class="step-number">4</div>
                <h3>Выбери и действуй</h3>
                <p>Выбери понравившиеся вузы и начни готовиться к поступлению</p>
            </div>
        </div>
    </div>
</section>

<!-- === ПРЕИМУЩЕСТВА === -->
<section class="section benefits">
    <div class="container">
        <h2 class="section-title">Почему выбирают UniPath</h2>
        <p class="section-subtitle">Результаты, на которые можно положиться</p>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">⚡</div>
                <h3>Невероятно быстро</h3>
                <p>Анализ за 5 секунд вместо часов поиска в интернете</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🎯</div>
                <h3>Точные рекомендации</h3>
                <p>Алгоритм учитывает все детали, чтобы ты видел реальные шансы</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">💯</div>
                <h3>Честная оценка</h3>
                <p>Мы говорим правду: какие вузы реально достижимы для тебя</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🌍</div>
                <h3>Весь мир в одном месте</h3>
                <p>500+ лучших университетов из США, UK, Европы, Азии и Австралии</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🚀</div>
                <h3>Данные сегодняшних требований</h3>
                <p>Информация обновляется каждый месяц — всегда актуально</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🔒</div>
                <h3>Безопасность данных</h3>
                <p>Твоя информация защищена и никогда не продаётся</p>
            </div>
        </div>
    </div>
</section>

<!-- === ПРИМЕР РЕЗУЛЬТАТА === -->
<section class="section results-section">
    <div class="container">
        <h2 class="section-title">Вот как выглядит результат</h2>
        <p class="section-subtitle">Полная информация о каждом рекомендованном университете</p>
        
        <div class="result-showcase">
            <div class="result-card">
                <div class="result-header">
                    <h4>🎓 MIT</h4>
                    <p>Massachusetts Institute of Technology</p>
                </div>
                <div class="result-body">
                    <div class="result-row">
                        <span class="result-label">📍 Страна</span>
                        <span class="result-value">США</span>
                    </div>
                    <div class="result-row">
                        <span class="result-label">💰 Стоимость</span>
                        <span class="result-value">$57,000/год</span>
                    </div>
                    <div class="result-row">
                        <span class="result-label">📊 Мин. IELTS</span>
                        <span class="result-value">7.5+</span>
                    </div>
                    <div class="result-row">
                        <span class="result-label">🔬 Специализация</span>
                        <span class="result-value">Инженерия, AI</span>
                    </div>
                    
                    <div class="match-probability">
                        <p>Твой шанс поступления</p>
                        <div class="match-percentage">87%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- === СОЦИАЛЬНОЕ ДОКАЗАТЕЛЬСТВО === -->
<section class="section social-proof">
    <div class="container">
        <h2 class="section-title">Уже помогли студентам по всему миру</h2>
        <p class="section-subtitle">Реальные числа - реальные результаты</p>
        
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-number">2,500+</div>
                <div class="stat-text">Студентов подобрали вузы</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">94%</div>
                <div class="stat-text">Точность рекомендаций</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">500+</div>
                <div class="stat-text">Лучших университетов</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">45</div>
                <div class="stat-text">Стран в базе</div>
            </div>
        </div>
    </div>
</section>

<!-- === ПОИСКОВИК И ФИЛЬТРЫ === -->
<section class="section">
    <div class="container">
        <div class="search-section">
            <h3>Найди свой вуз прямо сейчас</h3>
            
            <div class="filter-section">
                <div class="filter-group">
                    <label for="search-name">🔍 Поиск по названию:</label>
                    <input type="text" id="search-name" placeholder="MIT, Oxford, Sorbonne...">
                </div>
                <div class="filter-group">
                    <label for="ielts-score">📝 Твой IELTS:</label>
                    <input type="number" id="ielts-score" placeholder="7.5" step="0.5" min="0" max="9">
                </div>
                <div class="btn-group">
                    <button class="btn-filter btn-filter-primary" onclick="filterUniversities()">Найти</button>
                    <button class="btn-filter btn-filter-secondary" onclick="resetFilter()">Сбросить</button>
                </div>
            </div>

            <div class="universities-section">
                <div class="results-info" id="results-count">Показано университетов: 50</div>
                <div class="universities-grid" id="uni-grid"></div>
            </div>
        </div>
    </div>
</section>

<!-- === ФИНАЛЬНЫЙ CTA === -->
<section class="final-cta">
    <div class="container">
        <h2>Готов найти свой идеальный вуз?</h2>
        <p>Присоединяйся к тысячам студентов, которые уже выбрали UniPath</p>
        <button class="btn-primary" onclick="document.querySelector('.search-section').scrollIntoView({ behavior: 'smooth' })">
            🚀 Начать подбор сейчас
        </button>
    </div>
</section>

<!-- === FOOTER === -->
<footer>
    <div class="container">
        <p>© 2025 UniPath. Помогаем студентам найти идеальный университет.  |  <a href="#">Контакты</a>  |  <a href="#">Политика</a></p>
    </div>
</footer>

<script src="_shared.js"></script>
<script>
    // БАЗА ДАННЫХ: 50 ЛУЧШИХ УНИВЕРСИТЕТОВ МИРА
    const universities = [
        // США
        { name: "Massachusetts Institute of Technology (MIT)", country: "USA", minIELTS: 7.5, tuition: "$57,000/год", desc: "Святой Грааль для инженеров и программистов. Нужен идеальный SAT (1520+) и мощное портфолио проектов." },
        { name: "Stanford University", country: "USA", minIELTS: 7.0, tuition: "$56,000/год", desc: "Сердце Кремниевой долины. Требуется высочайший GPA и выдающиеся лидерские качества." },
        { name: "Harvard University", country: "USA", minIELTS: 7.5, tuition: "$54,000/год", desc: "Требует исключительных академических результатов. 100% need-blind финансирование." },
        { name: "California Institute of Technology (Caltech)", country: "USA", minIELTS: 7.0, tuition: "$58,000/год", desc: "Экстремальный фокус на точные науки. Требуются результаты международных олимпиад." },
        { name: "Princeton University", country: "USA", minIELTS: 7.5, tuition: "$56,000/год", desc: "Сильнейшая теоретическая база. Одна из лучших программ финансовой помощи." },
        { name: "Carnegie Mellon University", country: "USA", minIELTS: 7.5, tuition: "$58,000/год", desc: "№1 для Computer Science и AI. Жесткий отбор по математике." },
        { name: "University of California, Berkeley", country: "USA", minIELTS: 7.0, tuition: "$44,000/год", desc: "Лидер среди публичных вузов США. Стипендии для иностранцев редки." },
        { name: "Cornell University", country: "USA", minIELTS: 7.5, tuition: "$60,000/год", desc: "Лига Плюща с мощнейшим инженерным факультетом." },
        { name: "Columbia University", country: "USA", minIELTS: 7.5, tuition: "$63,000/год", desc: "В центре Нью-Йорка. Ищет студентов с глобальным мышлением." },
        { name: "University of Pennsylvania", country: "USA", minIELTS: 7.5, tuition: "$60,000/год", desc: "Программы на стыке технологий и бизнеса. Вторая по размеру Лига Плюща." },
        { name: "Yale University", country: "USA", minIELTS: 7.0, tuition: "$59,000/год", desc: "Мощная база, ищет гармонично развитых личностей." },
        { name: "University of Chicago", country: "USA", minIELTS: 7.0, tuition: "$60,000/год", desc: "Фокус на теорию и исследования. Известны сложными эссе." },
        { name: "Johns Hopkins University", country: "USA", minIELTS: 7.0, tuition: "$58,000/год", desc: "Мировой лидер в биомедицине и биоинженерии." },
        { name: "UCLA", country: "USA", minIELTS: 7.0, tuition: "$43,000/год", desc: "Самый популярный университет. Отличные программы по Data Science." },
        { name: "NYU", country: "USA", minIELTS: 7.5, tuition: "$56,000/год", desc: "Глобальный кампус. Сильные программы по прикладной математике." },
        
        // ВЕЛИКОБРИТАНИЯ
        { name: "University of Oxford", country: "UK", minIELTS: 7.5, tuition: "£35,000/год", desc: "Требует профильных вступительных экзаменов. Нужен балл близкий к максимуму." },
        { name: "University of Cambridge", country: "UK", minIELTS: 7.5, tuition: "£36,000/год", desc: "Для CS нужна сдача TMUA и отличное знание математики." },
        { name: "Imperial College London", country: "UK", minIELTS: 7.0, tuition: "£34,000/год", desc: "Главный конкурент MIT в Европе. Требует Online-тестов." },
        { name: "UCL", country: "UK", minIELTS: 7.0, tuition: "£32,000/год", desc: "Огромный выбор программ. Строгие требования к оценкам." },
        { name: "University of Edinburgh", country: "UK", minIELTS: 6.5, tuition: "£30,000/год", desc: "Один из лучших центров по развитию ИИ в Европе." },
        { name: "King's College London", country: "UK", minIELTS: 7.0, tuition: "£28,000/год", desc: "Престижный вуз в центре Лондона. Сильные программы по кибунбезопасности." },
        { name: "University of Manchester", country: "UK", minIELTS: 6.5, tuition: "£26,000/год", desc: "Альма-матер нобелевских лауреатов. Отличный выбор для точных наук." },
        { name: "LSE", country: "UK", minIELTS: 7.0, tuition: "£25,000/год", desc: "Для сочетания Data Science с экономикой или финансами." },
        { name: "University of Warwick", country: "UK", minIELTS: 6.5, tuition: "£24,000/год", desc: "Выдающийся факультет математики. Часто требует STEP." },
        
        // ЕВРОПА
        { name: "ETH Zurich", country: "Switzerland", minIELTS: 7.0, tuition: "$1,600/год", desc: "Университет Эйнштейна. Практически бесплатное образование мирового уровня." },
        { name: "EPFL", country: "Switzerland", minIELTS: 7.0, tuition: "$1,500/год", desc: "Брат ETH во франкоязычной части. Передовые ИТ-лаборатории." },
        { name: "TUM", country: "Germany", minIELTS: 6.5, tuition: "~$200/год", desc: "Лучший тех. вуз Германии. Высший пилотаж в инженерии." },
        { name: "LMU Munich", country: "Germany", minIELTS: 6.5, tuition: "~$200/год", desc: "Сильнейшая фундаментальная наука. Сосед и партнер TUM." },
        { name: "RWTH Aachen", country: "Germany", minIELTS: 6.5, tuition: "~$200/год", desc: "Мекка для инженеров. Связи с немецким автопромом." },
        { name: "Delft University of Technology", country: "Netherlands", minIELTS: 6.5, tuition: "€16,000/год", desc: "Топ-15 инженерных вузов мира. Обучение на английском." },
        { name: "University of Amsterdam", country: "Netherlands", minIELTS: 6.5, tuition: "€12,000/год", desc: "Англоязычные программы по AI и Data Science." },
        { name: "KU Leuven", country: "Belgium", minIELTS: 6.5, tuition: "€4,000/год", desc: "Один из старейших и инновационных вузов Европы." },
        { name: "Politecnico di Milano", country: "Italy", minIELTS: 6.0, tuition: "€3,900/год", desc: "Лидер Италии. Доступны стипендии по доходу." },
        { name: "KTH", country: "Sweden", minIELTS: 6.5, tuition: "€14,000/год", desc: "Родина Spotify. Шикарные условия для стартаперов." },
        { name: "Sorbonne University", country: "France", minIELTS: 6.5, tuition: "€2,770/год", desc: "Исторический вуз с мощной математической школой." },
        { name: "École Polytechnique", country: "France", minIELTS: 6.5, tuition: "€18,000/год", desc: "Гранд-эколь Франции. Программы на английском языке." },

        // АЗИЯ И ОКЕАНИЯ
        { name: "NUS", country: "Singapore", minIELTS: 6.5, tuition: "$15,000/год*", desc: "Топ-10 мира. Tuition Grant от правительства Сингапура." },
        { name: "NTU", country: "Singapore", minIELTS: 6.0, tuition: "$15,000/год*", desc: "Выдающийся кампус. Огромные инвестиции в технологии." },
        { name: "Tsinghua University", country: "China", minIELTS: 6.5, tuition: "$4,500/год", desc: "«Китайский MIT». №1 в Азии по Computer Science." },
        { name: "Peking University", country: "China", minIELTS: 6.5, tuition: "$4,500/год", desc: "Сильнейшая теоретическая школа. Государственные гранты." },
        { name: "KAIST", country: "South Korea", minIELTS: 6.5, tuition: "Бесплатно", desc: "Передовые технологии. Полная стипендия всем иностранцам." },
        { name: "Seoul National University", country: "South Korea", minIELTS: 6.0, tuition: "$5,000/год", desc: "Самый престижный вуз Кореи. Global Korea Scholarship." },
        { name: "University of Tokyo", country: "Japan", minIELTS: 6.5, tuition: "$5,000/год", desc: "Программы PEAK на английском. MEXT стипендия." },
        { name: "University of Hong Kong", country: "Hong Kong", minIELTS: 6.5, tuition: "$22,000/год", desc: "Высочайший рейтинг трудоустройства. Щедрые стипендии." },
        { name: "HKUST", country: "Hong Kong", minIELTS: 6.0, tuition: "$18,000/год", desc: "Технологический гигант Азии. Отличные лаборатории." },
        { name: "University of Melbourne", country: "Australia", minIELTS: 6.5, tuition: "AUD 45,000/год", desc: "№1 в Австралии. Высокие требования к оценкам." },
        { name: "University of Sydney", country: "Australia", minIELTS: 6.5, tuition: "AUD 45,000/год", desc: "Отличные возможности для исследований и стажировок." },
        { name: "UNSW Sydney", country: "Australia", minIELTS: 6.5, tuition: "AUD 44,000/год", desc: "Выпускники имеют высокий стартовый оклад." },

        // КАНАДА
        { name: "University of Toronto", country: "Canada", minIELTS: 6.5, tuition: "CAD 60,000/год", desc: "Родина Deep Learning. Lester B. Pearson стипендия." },
        { name: "UBC", country: "Canada", minIELTS: 6.5, tuition: "CAD 55,000/год", desc: "Ванкувер. Популярен среди программистов. Стипендии." },
        { name: "McGill University", country: "Canada", minIELTS: 6.5, tuition: "CAD 50,000/год", desc: "«Канадский Гарвард». Строгие требования к оценкам." }
    ];

    const grid = document.getElementById('uni-grid');
    const countDisplay = document.getElementById('results-count');

    function renderUniversities(data, userScore = null) {
        grid.innerHTML = '';
        countDisplay.innerText = `Показано университетов: ${data.length}`;

        if (data.length === 0) {
            grid.innerHTML = '<div class="no-results">Университеты по вашему запросу не найдены. Попробуйте изменить параметры фильтра.</div>';
            return;
        }

        data.forEach(uni => {
            const card = document.createElement('div');
            card.className = 'uni-card';

            let statusHtml = '';
            if (userScore !== null && userScore !== '') {
                if (parseFloat(userScore) >= uni.minIELTS) {
                    statusHtml = `<div class="status-message status-eligible">✓ Проходите по IELTS (Мин: ${uni.minIELTS})</div>`;
                } else {
                    statusHtml = `<div class="status-message status-ineligible">✕ Нужен IELTS ${uni.minIELTS} (У вас ${userScore})</div>`;
                }
            }

            card.innerHTML = `
                <div class="uni-header">
                    <h3>${uni.name}</h3>
                    <span>📍 ${uni.country}</span>
                </div>
                <div class="uni-body">
                    <div class="badges">
                        <span class="badge">IELTS от ${uni.minIELTS}</span>
                        <span class="badge">💰 ${uni.tuition}</span>
                    </div>
                    <p class="uni-desc">${uni.desc}</p>
                    ${statusHtml}
                </div>
            `;
            
            grid.appendChild(card);
        });
    }

    function filterUniversities() {
        const nameQuery = document.getElementById('search-name').value.toLowerCase().trim();
        const scoreQuery = document.getElementById('ielts-score').value;

        const filtered = universities.filter(uni => {
            const matchesName = uni.name.toLowerCase().includes(nameQuery) || uni.country.toLowerCase().includes(nameQuery);
            return matchesName;
        });

        if (scoreQuery !== '') {
            filtered.sort((a, b) => {
                const aPass = parseFloat(scoreQuery) >= a.minIELTS ? -1 : 1;
                const bPass = parseFloat(scoreQuery) >= b.minIELTS ? -1 : 1;
                return aPass - bPass;
            });
        }

        renderUniversities(filtered, scoreQuery);
    }

    function resetFilter() {
        document.getElementById('search-name').value = '';
        document.getElementById('ielts-score').value = '';
        renderUniversities(universities);
    }

    // Инициализация
    renderUniversities(universities);

    // Enter key support
    document.getElementById('search-name').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') filterUniversities();
    });
    document.getElementById('ielts-score').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') filterUniversities();
    });
</script>
</body>
</html>
</body>
</html>
