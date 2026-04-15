<?php
// Start session before any output (including HTML comments)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- MAIN ACTIVE PAGE: ranking.php -->
<!-- Status: ✓ UPDATED TO NEW DESIGN (v2024) -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniPath — Рейтинги Университетов</title>
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

        /* === TOP SECTION === */
        .top-unis {
            background: linear-gradient(135deg, var(--accent-main), var(--accent-light));
            padding: 3rem 2rem;
            border-radius: 12px;
            margin-bottom: 3rem;
        }

        .top-unis-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .top-uni-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            color: white;
            transition: all 0.3s;
        }

        .top-uni-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-4px);
        }

        .top-uni-rank {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
        }

        .top-uni-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .top-uni-flag {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        /* === RANKINGS TABLE === */
        .rankings-container {
            background: var(--bg-secondary);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .rankings-controls {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-tertiary);
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .sort-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sort-control select {
            padding: 0.6rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            cursor: pointer;
        }

        .sort-control select:focus {
            outline: none;
            border-color: var(--accent-main);
        }

        .compare-info {
            margin-left: auto;
            font-size: 0.9rem;
            color: #a0a0a0;
        }

        /* === TABLE === */
        .rankings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .rankings-table thead {
            background: var(--bg-tertiary);
            border-bottom: 2px solid var(--border-color);
        }

        .rankings-table th {
            padding: 1.2rem;
            text-align: left;
            font-weight: 700;
            color: var(--text-primary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .rankings-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s;
        }

        .rankings-table tbody tr:hover {
            background: var(--bg-tertiary);
        }

        .rankings-table td {
            padding: 1.2rem;
            color: var(--text-secondary);
        }

        .rank-number {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--accent-main);
            min-width: 30px;
        }

        .uni-name-cell {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .uni-flag {
            font-size: 1.5rem;
        }

        .compare-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--accent-main);
        }

        .score-bar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .score-fill {
            height: 6px;
            background: linear-gradient(90deg, var(--accent-main), var(--accent-light));
            border-radius: 3px;
            min-width: 100px;
        }

        .score-value {
            min-width: 40px;
            text-align: right;
            font-weight: 600;
            color: var(--accent-main);
        }

        /* === COMPARISON VIEW === */
        .comparison-section {
            background: linear-gradient(135deg, var(--accent-main), var(--accent-light));
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-top: 2rem;
            display: none;
        }

        .comparison-section.show {
            display: block;
        }

        .comparison-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .comparison-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .comparison-card h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .comparison-card .uni-flag {
            font-size: 1.8rem;
        }

        .comparison-metrics {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .metric-row {
            display: flex;
            justify-content: space-between;
            padding: 0.6rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .metric-label {
            opacity: 0.9;
        }

        .metric-value {
            font-weight: 700;
        }

        .btn-reset-compare {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-reset-compare:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .rankings-table {
                font-size: 0.85rem;
            }

            .rankings-table th,
            .rankings-table td {
                padding: 0.8rem;
            }

            .top-unis-grid {
                grid-template-columns: 1fr;
            }

            .comparison-grid {
                grid-template-columns: 1fr;
            }

            .rankings-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .compare-info {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<?php include '_nav.php'; ?>

<!-- === HEADER === -->
<section class="section">
    <div class="container">
        <h1 class="section-title">🏆 Рейтинги Университетов</h1>
        <p class="section-subtitle">Топ университетов мира с фильтрацией и сравнением</p>
    </div>
</section>

<!-- === TOP 5 === -->
<section class="section">
    <div class="container">
        <div class="top-unis">
            <h2 style="color: white; margin-bottom: 1rem;">Top 5 Global Universities 2024</h2>
            <div class="top-unis-grid">
                <div class="top-uni-card">
                    <div class="top-uni-rank">1</div>
                    <div class="top-uni-flag">🇺🇸</div>
                    <div class="top-uni-name">MIT</div>
                    <p style="opacity: 0.9;">USA</p>
                </div>
                <div class="top-uni-card">
                    <div class="top-uni-rank">2</div>
                    <div class="top-uni-flag">🇺🇸</div>
                    <div class="top-uni-name">Stanford</div>
                    <p style="opacity: 0.9;">USA</p>
                </div>
                <div class="top-uni-card">
                    <div class="top-uni-rank">3</div>
                    <div class="top-uni-flag">🇬🇧</div>
                    <div class="top-uni-name">Oxford</div>
                    <p style="opacity: 0.9;">UK</p>
                </div>
                <div class="top-uni-card">
                    <div class="top-uni-rank">4</div>
                    <div class="top-uni-flag">🇬🇧</div>
                    <div class="top-uni-name">Cambridge</div>
                    <p style="opacity: 0.9;">UK</p>
                </div>
                <div class="top-uni-card">
                    <div class="top-uni-rank">5</div>
                    <div class="top-uni-flag">🇨🇭</div>
                    <div class="top-uni-name">ETH Zurich</div>
                    <p style="opacity: 0.9;">Switzerland</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- === RANKINGS TABLE === -->
<section class="section">
    <div class="container">
        <div class="rankings-container">
            <div class="rankings-controls">
                <div class="sort-control">
                    <label for="sortBy">Sort by:</label>
                    <select id="sortBy" onchange="resortTable()">
                        <option value="rank">Global Rank</option>
                        <option value="country">Country</option>
                        <option value="score">Score</option>
                    </select>
                </div>
                <div class="compare-info">
                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"> Select for Comparison
                </div>
            </div>

            <table class="rankings-table">
                <thead>
                    <tr>
                        <th style="width: 40px;"><input type="checkbox" id="selectAll2" onchange="toggleSelectAll()"></th>
                        <th style="width: 50px;">Rank</th>
                        <th>University</th>
                        <th>Country</th>
                        <th>Score</th>
                        <th>Research</th>
                    </tr>
                </thead>
                <tbody id="rankingsBody">
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- === COMPARISON SECTION === -->
<section class="section">
    <div class="container">
        <div class="comparison-section" id="comparisonSection">
            <div>
                <h2 style="color: white; margin-bottom: 0.5rem;">📊 University Comparison</h2>
                <p style="opacity: 0.95; margin-bottom: 1rem;">Select up to 2 universities to compare</p>
            </div>
            <div class="comparison-grid" id="comparisonGrid">
            </div>
            <button class="btn-reset-compare" onclick="resetComparison()">Clear Comparison</button>
        </div>
    </div>
</section>

<!-- === FOOTER === -->
<footer>
    <div class="container">
        <p>© 2025 UniPath. Помогаем студентам найти идеальный университет. | <a href="#">Контакты</a> | <a href="#">Политика</a></p>
    </div>
</footer>

<script src="_shared.js"></script>
<script>
const universities = [
    { rank: 1, name: "MIT", country: "USA", flag: "🇺🇸", score: 98, research: 99, students: "4500", admit: "3.2%" },
    { rank: 2, name: "Stanford", country: "USA", flag: "🇺🇸", score: 98, research: 98, students: "17000", admit: "3.9%" },
    { rank: 3, name: "Oxford", country: "UK", flag: "🇬🇧", score: 97, research: 95, students: "24000", admit: "5%" },
    { rank: 4, name: "Cambridge", country: "UK", flag: "🇬🇧", score: 97, research: 94, students: "19000", admit: "3.3%" },
    { rank: 5, name: "ETH Zurich", country: "Switzerland", flag: "🇨🇭", score: 96, research: 97, students: "22000", admit: "11%" },
    { rank: 6, name: "Caltech", country: "USA", flag: "🇺🇸", score: 96, research: 99, students: "1250", admit: "2.4%" },
    { rank: 7, name: "Imperial College", country: "UK", flag: "🇬🇧", score: 95, research: 96, students: "18000", admit: "8%" },
    { rank: 8, name: "Harvard", country: "USA", flag: "🇺🇸", score: 95, research: 93, students: "23000", admit: "3%" },
    { rank: 9, name: "UCL", country: "UK", flag: "🇬🇧", score: 94, research: 92, students: "43000", admit: "8%" },
    { rank: 10, name: "Princeton", country: "USA", flag: "🇺🇸", score: 94, research: 95, students: "8500", admit: "3.1%" },
    { rank: 11, name: "EPFL", country: "Switzerland", flag: "🇨🇭", score: 93, research: 96, students: "13500", admit: "15%" },
    { rank: 12, name: "NUS", country: "Singapore", flag: "🇸🇬", score: 93, research: 91, students: "40000", admit: "5%" },
    { rank: 13, name: "University of Tokyo", country: "Japan", flag: "🇯🇵", score: 92, research: 90, students: "28000", admit: "3%" },
    { rank: 14, name: "Peking University", country: "China", flag: "🇨🇳", score: 92, research: 89, students: "45000", admit: "2%" },
    { rank: 15, name: "Tsinghua", country: "China", flag: "🇨🇳", score: 91, research: 88, students: "37000", admit: "2.3%" },
    { rank: 16, name: "University of Toronto", country: "Canada", flag: "🇨🇦", score: 90, research: 87, students: "95000", admit: "7%" },
    { rank: 17, name: "University of Melbourne", country: "Australia", flag: "🇦🇺", score: 90, research: 86, students: "48000", admit: "25%" },
    { rank: 18, name: "National University of Singapore", country: "Singapore", flag: "🇸🇬", score: 89, research: 85, students: "38000", admit: "5%" },
    { rank: 19, name: "Delft University of Technology", country: "Netherlands", flag: "🇳🇱", score: 88, research: 84, students: "28000", admit: "9%" },
    { rank: 20, name: "KAIST", country: "South Korea", flag: "🇰🇷", score: 88, research: 86, students: "11000", admit: "9%" }
];

const body = document.getElementById('rankingsBody');
const comparisonSection = document.getElementById('comparisonSection');
const comparisonGrid = document.getElementById('comparisonGrid');
let sortMethod = 'rank';
let selectedUnis = [];

function renderRankings(data) {
    body.innerHTML = '';
    data.forEach(uni => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="checkbox" class="compare-checkbox" value="${uni.name}" onchange="handleCompareSelection(this)"></td>
            <td class="rank-number">#${uni.rank}</td>
            <td class="uni-name-cell">
                <span class="uni-flag">${uni.flag}</span>
                <span>${uni.name}</span>
            </td>
            <td>${uni.country}</td>
            <td>
                <div class="score-bar">
                    <div class="score-fill" style="width: ${uni.score}px;"></div>
                    <span class="score-value">${uni.score}</span>
                </div>
            </td>
            <td>${uni.research}/100</td>
        `;
        body.appendChild(row);
    });
}

function resortTable() {
    sortMethod = document.getElementById('sortBy').value;
    let sorted = [...universities];

    if (sortMethod === 'rank') {
        sorted.sort((a, b) => a.rank - b.rank);
    } else if (sortMethod === 'country') {
        sorted.sort((a, b) => a.country.localeCompare(b.country));
    } else if (sortMethod === 'score') {
        sorted.sort((a, b) => b.score - a.score);
    }

    renderRankings(sorted);
}

function toggleSelectAll() {
    const checkboxes = document.querySelectorAll('.compare-checkbox');
    const isChecked = document.getElementById('selectAll').checked;
    checkboxes.forEach(cb => cb.checked = isChecked);
    updateComparison();
}

function handleCompareSelection(checkbox) {
    if (document.querySelectorAll('.compare-checkbox:checked').length > 2) {
        checkbox.checked = false;
        toast.warning('You can compare maximum 2 universities');
        return;
    }
    updateComparison();
}

function updateComparison() {
    selectedUnis = Array.from(document.querySelectorAll('.compare-checkbox:checked')).map(cb => {
        return universities.find(uni => uni.name === cb.value);
    });

    if (selectedUnis.length > 0) {
        comparisonSection.classList.add('show');
        renderComparison();
    } else {
        comparisonSection.classList.remove('show');
    }
}

function renderComparison() {
    comparisonGrid.innerHTML = '';
    selectedUnis.forEach(uni => {
        const card = document.createElement('div');
        card.className = 'comparison-card';
        card.innerHTML = `
            <h3>
                <span class="uni-flag">${uni.flag}</span>
                ${uni.name}
            </h3>
            <div class="comparison-metrics">
                <div class="metric-row">
                    <span class="metric-label">Global Rank:</span>
                    <span class="metric-value">#${uni.rank}</span>
                </div>
                <div class="metric-row">
                    <span class="metric-label">Country:</span>
                    <span class="metric-value">${uni.country}</span>
                </div>
                <div class="metric-row">
                    <span class="metric-label">Score:</span>
                    <span class="metric-value">${uni.score}/100</span>
                </div>
                <div class="metric-row">
                    <span class="metric-label">Research:</span>
                    <span class="metric-value">${uni.research}/100</span>
                </div>
                <div class="metric-row">
                    <span class="metric-label">Students:</span>
                    <span class="metric-value">${uni.students}</span>
                </div>
                <div class="metric-row">
                    <span class="metric-label">Admission:</span>
                    <span class="metric-value">${uni.admit}</span>
                </div>
            </div>
        `;
        comparisonGrid.appendChild(card);
    });
}

function resetComparison() {
    document.querySelectorAll('.compare-checkbox').forEach(cb => cb.checked = false);
    selectedUnis = [];
    comparisonSection.classList.remove('show');
}

// Initialize
renderRankings(universities);
</script>

</body>
</html>
