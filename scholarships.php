<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniPath — Стипендии</title>
    <link rel="stylesheet" href="_shared.css">
    <style>
        .section {
            padding: 4rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #a0a0a0;
            text-align: center;
            margin-bottom: 3rem;
        }

        /* === FILTERS === */
        .filters-section {
            background: var(--bg-secondary);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 3rem;
            border: 1px solid var(--border-color);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        .filter-group input,
        .filter-group select {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-tertiary);
            color: var(--text-primary);
            font-size: 1rem;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--accent-main);
            box-shadow: 0 0 0 3px rgba(91, 77, 255, 0.1);
        }

        .filter-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
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
            background: var(--accent-main);
            color: var(--bg-primary);
        }

        .btn-filter-primary:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
        }

        .btn-filter-secondary {
            background: transparent;
            color: var(--accent-main);
            border: 1px solid var(--accent-main);
        }

        .btn-filter-secondary:hover {
            background: rgba(91, 77, 255, 0.1);
        }

        /* === GRID === */
        .scholarships-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        /* === CARD === */
        .scholarship-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .scholarship-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent-main);
            box-shadow: 0 10px 30px rgba(91, 77, 255, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--accent-main), var(--accent-light));
            color: white;
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .country-flag {
            font-size: 1.5rem;
        }

        .card-subtitle {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .card-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .info-row:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            color: #a0a0a0;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .info-value {
            color: var(--text-primary);
            font-weight: 600;
        }

        .description {
            color: #a0a0a0;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 1rem 0;
            flex-grow: 1;
        }

        .card-footer {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-card {
            flex: 1;
            padding: 0.65rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: transparent;
            color: var(--accent-main);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-card:hover {
            background: rgba(91, 77, 255, 0.1);
            border-color: var(--accent-main);
        }

        .badge-success {
            display: inline-block;
            background: rgba(81, 207, 102, 0.15);
            color: #51cf66;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
            border: 1px solid rgba(81, 207, 102, 0.3);
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            color: #a0a0a0;
            font-size: 1.1rem;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .filters-grid {
                grid-template-columns: 1fr;
            }

            .scholarships-grid {
                grid-template-columns: 1fr;
            }

            .card-footer {
                flex-direction: column;
            }

            .btn-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<?php include '_nav.php'; ?>

<!-- === HEADER === -->
<section class="section">
    <div class="container">
        <h1 class="section-title">Стипендии и Гранты</h1>
        <p class="section-subtitle">Найди финансовую поддержку для учебы в лучших университетах мира</p>
    </div>
</section>

<!-- === FILTERS === -->
<section class="section">
    <div class="container">
        <div class="filters-section">
            <div class="filters-grid">
                <div class="filter-group">
                    <label for="countryFilter">📍 Страна</label>
                    <select id="countryFilter">
                        <option value="">All Countries</option>
                        <option value="USA">USA</option>
                        <option value="UK">United Kingdom</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="Germany">Germany</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Singapore">Singapore</option>
                        <option value="China">China</option>
                        <option value="Japan">Japan</option>
                        <option value="EU">Erasmus+ (EU)</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="amountFilter">💰 Минимум стипендии</label>
                    <select id="amountFilter">
                        <option value="">All Amounts</option>
                        <option value="5000">$5,000+</option>
                        <option value="15000">$15,000+</option>
                        <option value="25000">$25,000+</option>
                        <option value="50000">Full Tuition</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="searchScholarship">🔍 Поиск</label>
                    <input type="text" id="searchScholarship" placeholder="Название стипендии...">
                </div>
            </div>

            <div class="filter-buttons">
                <button class="btn-filter btn-filter-primary" onclick="filterScholarships()">Найти</button>
                <button class="btn-filter btn-filter-secondary" onclick="resetScholarshipFilter()">Сбросить</button>
            </div>
        </div>
    </div>
</section>

<!-- === SCHOLARSHIPS GRID === -->
<section class="section">
    <div class="container">
        <div class="scholarships-grid" id="scholarshipGrid"></div>
    </div>
</section>

<!-- === FOOTER === -->
<footer>
    <div class="container">
        <p>© 2025 UniPath. Помогаем студентам найти идеальный университет и финансирование.  |  <a href="#">Контакты</a>  |  <a href="#">Политика</a></p>
    </div>
</footer>

<script src="_shared.js"></script>
<script>
const scholarships = [
    { name: "MIT Presidential Fellowship", country: "USA", amount: "$60,000", coverage: "Full Tuition + Stipend", deadline: "2025-01-15", desc: "For exceptional students pursuing graduate studies in engineering and science." },
    { name: "Stanford Reliance Scholarship", country: "USA", amount: "$50,000", coverage: "Full Tuition", deadline: "2025-02-01", desc: "Merit-based award for outstanding international students." },
    { name: "Harvard Crimson Scholarship", country: "USA", amount: "$45,000", coverage: "Tuition + Housing", deadline: "2025-01-01", desc: "For students from underrepresented backgrounds." },
    { name: "Caltech Global Fellowship", country: "USA", amount: "$55,000", coverage: "Full Tuition + Stipend", deadline: "2025-03-15", desc: "For exceptional graduate and undergraduate students." },
    { name: "Princeton Graduate Fellowship", country: "USA", amount: "$52,000", coverage: "Full Tuition + Stipend", deadline: "2025-02-01", desc: "Supports graduate studies in all disciplines." },

    { name: "Oxford Magdalen Scholarship", country: "UK", amount: "£40,000", coverage: "Full Tuition", deadline: "2025-01-20", desc: "For postgraduate students from Commonwealth countries." },
    { name: "Cambridge Gates Fellowship", country: "UK", amount: "£35,000", coverage: "Full Tuition + Living", deadline: "2025-01-15", desc: "For exceptional Master's students." },
    { name: "Imperial Rector's Scholarships", country: "UK", amount: "£30,000", coverage: "Tuition + Housing", deadline: "2025-02-15", desc: "Merit and need-based scholarships." },
    { name: "UCL Quad Scholarship", country: "UK", amount: "£28,000", coverage: "Full Tuition", deadline: "2025-03-01", desc: "For exceptional postgraduate students." },
    { name: "Edinburgh Global Scholarship", country: "UK", amount: "£25,000", coverage: "Tuition Reduction", deadline: "2025-02-20", desc: "For international students throughout the university." },

    { name: "University of Toronto Fellowship", country: "Canada", amount: "CAD 45,000", coverage: "Full Tuition + Stipend", deadline: "2025-01-31", desc: "For graduate students in all programs." },
    { name: "UBC Gubernatorial Scholarship", country: "Canada", amount: "CAD 40,000", coverage: "Full Tuition", deadline: "2025-02-28", desc: "For outstanding international undergraduate students." },
    { name: "McGill Major Scholarship", country: "Canada", amount: "CAD 35,000", coverage: "Tuition + Housing", deadline: "2025-03-15", desc: "Merit-based award for exceptional students." },

    { name: "TUM Excellence Fellowship", country: "Germany", amount: "€25,000", coverage: "Full Tuition + Living", deadline: "2025-01-10", desc: "For exceptional graduate students." },
    { name: "LMU Munich Scholarship", country: "Germany", amount: "€20,000", coverage: "Tuition Coverage", deadline: "2025-02-01", desc: "For Master's students in all departments." },
    { name: "RWTH Aachen Elite Scholarship", country: "Germany", amount: "€18,000", coverage: "Full Tuition", deadline: "2025-01-20", desc: "For engineering and technology programs." },

    { name: "ETH Zurich Excellence Scholarship", country: "Switzerland", amount: "CHF 35,000", coverage: "Full Tuition + Stipend", deadline: "2025-01-15", desc: "Competitive award for exceptional global talent." },
    { name: "EPFL Fellowship", country: "Switzerland", amount: "CHF 30,000", coverage: "Full Tuition + Living", deadline: "2025-02-01", desc: "For Master's and doctoral students." },

    { name: "Delft Fellowship Programme", country: "Netherlands", amount: "€20,000", coverage: "Tuition + Housing", deadline: "2025-02-15", desc: "For high-achieving international students." },
    { name: "University of Amsterdam Fellowship", country: "Netherlands", amount: "€18,000", coverage: "Full Tuition", deadline: "2025-03-01", desc: "Merit and need-based awards." },

    { name: "NUS Research Scholarship", country: "Singapore", amount: "SGD 60,000", coverage: "Full + Stipend", deadline: "2025-01-10", desc: "For graduate research students." },
    { name: "NTU Scholarship", country: "Singapore", amount: "SGD 55,000", coverage: "Full Tuition", deadline: "2025-02-01", desc: "For exceptional undergraduate and graduate students." },

    { name: "Tsinghua Scholarship", country: "China", amount: "¥200,000", coverage: "Full Tuition + Living", deadline: "2025-01-20", desc: "For international Master's and PhD students." },
    { name: "Peking University Award", country: "China", amount: "¥180,000", coverage: "Full Tuition + Stipend", deadline: "2025-02-10", desc: "Competitive award for exceptional students." },

    { name: "KAIST Scholarship", country: "South Korea", amount: "₩35,000,000", coverage: "Full Tuition + Living", deadline: "2025-01-15", desc: "For selective graduate programs." },
    { name: "Seoul National University Fellowship", country: "South Korea", amount: "₩30,000,000", coverage: "Full Tuition", deadline: "2025-02-20", desc: "Merit-based scholarship for graduate students." },

    { name: "University of Melbourne Scholarship", country: "Australia", amount: "AUD 50,000", coverage: "Full Tuition", deadline: "2025-01-31", desc: "For postgraduate students." },
    { name: "UNSW Scholarship", country: "Australia", amount: "AUD 45,000", coverage: "Tuition + Living", deadline: "2025-02-28", desc: "For exceptional research and academic students." },

    { name: "Erasmus+ Master's Scholarship", country: "EU", amount: "€25,000", coverage: "Full Tuition + Living", deadline: "Rolling", desc: "For Master's programs across European universities." },
    { name: "Erasmus Mundus Joint Degree", country: "EU", amount: "€30,000", coverage: "Full Tuition + Allowance", deadline: "Rolling", desc: "Integrated Master's across multiple EU countries." }
];

const grid = document.getElementById('scholarshipGrid');

function renderScholarships(data) {
    grid.innerHTML = '';

    if (data.length === 0) {
        grid.innerHTML = '<div class="no-results">No scholarships found matching your criteria. Try adjusting your filters.</div>';
        return;
    }

    data.forEach(scholarship => {
        const card = document.createElement('div');
        card.className = 'scholarship-card';

        const flagEmoji = getCountryFlag(scholarship.country.split(' ')[0]);

        card.innerHTML = `
            <div class="card-header">
                <div class="card-title">
                    <span class="country-flag">${flagEmoji}</span>
                    ${scholarship.name}
                </div>
                <div class="card-subtitle">${scholarship.country}</div>
            </div>
            <div class="card-body">
                <div class="badge-success">${scholarship.coverage}</div>
                <div class="info-row">
                    <span class="info-label">💰 Amount</span>
                    <span class="info-value">${scholarship.amount}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">📅 Deadline</span>
                    <span class="info-value">${scholarship.deadline}</span>
                </div>
                <p class="description">${scholarship.desc}</p>
                <div class="card-footer">
                    <button class="btn-card" onclick="copyToClipboard('${scholarship.name}')">📋 Copy</button>
                    <button class="btn-card" onclick="toast.success('Scholarship saved to your profile!')">💾 Save</button>
                </div>
            </div>
        `;

        grid.appendChild(card);
    });
}

function filterScholarships() {
    const countryFilter = document.getElementById('countryFilter').value;
    const amountFilter = document.getElementById('amountFilter').value;
    const searchTerm = document.getElementById('searchScholarship').value.toLowerCase();

    const filtered = scholarships.filter(s => {
        const matchCountry = !countryFilter || s.country === countryFilter || (countryFilter === 'EU' && s.country === 'EU');
        const matchAmount = !amountFilter || (parseInt(s.amount) >= parseInt(amountFilter) || s.amount.includes('Full'));
        const matchSearch = !searchTerm || s.name.toLowerCase().includes(searchTerm);

        return matchCountry && matchAmount && matchSearch;
    });

    renderScholarships(filtered);
}

function resetScholarshipFilter() {
    document.getElementById('countryFilter').value = '';
    document.getElementById('amountFilter').value = '';
    document.getElementById('searchScholarship').value = '';
    renderScholarships(scholarships);
}

// Initialize
renderScholarships(scholarships);

// Enter key support
document.getElementById('searchScholarship').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') filterScholarships();
});
</script>

</body>
</html>
