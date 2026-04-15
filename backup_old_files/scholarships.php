<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UniPath Scholarships</title>

<style>
* {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif;}
body {background:#121212;color:#e0e0e0;}

/* NAV */
header {background:#1e1e1e;padding:1rem 2rem;}
.nav {display:flex;justify-content:space-between;align-items:center;}
.logo {color:#fff;font-size:1.5rem;font-weight:bold;}
nav a {color:#ccc;margin-left:20px;text-decoration:none;}
nav a:hover {color:#bb86fc;}

/* TITLE */
.title {text-align:center;margin:2rem 0;}

/* FILTER */
.filters {
display:flex;
justify-content:center;
gap:1rem;
flex-wrap:wrap;
margin-bottom:2rem;
}

input, select, button {
padding:10px;
border-radius:8px;
border:none;
background:#2c2c2c;
color:#fff;
}

button {
background:#bb86fc;
color:#121212;
cursor:pointer;
}
button:hover {background:#9e67e3;}

/* GRID */
.container {max-width:1200px;margin:auto;padding:1rem;}
.grid {
display:grid;
grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
gap:1.5rem;
}

/* CARD */
.card {
background:#1e1e1e;
padding:1.5rem;
border-radius:12px;
transition:0.3s;
}
.card:hover {transform:translateY(-5px);}

.badge {
display:inline-block;
padding:5px 10px;
border-radius:20px;
background:#bb86fc;
color:#121212;
margin-top:10px;
font-size:0.8rem;
}

.status {
margin-top:10px;
padding:8px;
border-radius:6px;
text-align:center;
font-size:0.9rem;
}

.ok {background:#1b5e20;}
.no {background:#7f1d1d;}

.desc {
font-size:0.9rem;
color:#bbb;
margin-top:8px;
}
</style>
</head>

<body>

<header>
<div class="nav">
<div class="logo">🎓 UniPath</div>
<nav>   
<a href="mainpage.php" class="active">Главная</a>
<a href="ranking.php">Рейтинг Вузов</a>
<a href="alumni.html">Кейсы поступивших</a>
<a href="guides.html">Гайды и Эссе</a>
<a href="scholarships.php">Стипендии</a>
<a href="#">О нас / Помощь</a>

</nav>
</div>
</header>

<div class="title">
<h1>💰 Стипендии по всему миру</h1>
</div>

<div class="filters">
<select id="country">
<option value="">Все страны</option>
<option>USA</option>
<option>UK</option>
<option>Germany</option>
<option>Canada</option>
<option>Asia</option>
</select>

<select id="level">
<option value="">Любой уровень</option>
<option>Bachelor</option>
<option>Master</option>
</select>

<input type="number" id="ielts" placeholder="IELTS 0-9" min="0" max="9" step="0.5">

<button onclick="filter()">Найти</button>
<button onclick="resetFilters()">Сбросить</button>
</div>

<div class="container">
<div class="grid" id="grid"></div>
</div>

<script>

const scholarships = [
{name:"Fulbright",country:"USA",level:"Master",ielts:7.0,desc:"Полное покрытие обучения + проживание"},
{name:"Chevening",country:"UK",level:"Master",ielts:6.5,desc:"Полный грант от правительства UK"},
{name:"DAAD",country:"Germany",level:"Master",ielts:6.5,desc:"Стипендия для обучения в Германии"},
{name:"Erasmus+",country:"EU",level:"Master",ielts:6.0,desc:"Программа обмена по Европе"},
{name:"MEXT",country:"Japan",level:"Bachelor",ielts:6.5,desc:"Японская гос. стипендия"},
{name:"GKS",country:"Korea",level:"Bachelor",ielts:6.0,desc:"Полный грант в Корее"},
{name:"CSC",country:"China",level:"Bachelor",ielts:6.0,desc:"Китайская гос. программа"},
{name:"Turkiye Burslari",country:"Turkey",level:"Bachelor",ielts:5.5,desc:"Турецкие гранты"},
{name:"Vanier Scholarship",country:"Canada",level:"Master",ielts:7.0,desc:"Топ стипендия Канады"},
{name:"Australia Awards",country:"Australia",level:"Master",ielts:6.5,desc:"Полное финансирование"},

{name:"Oxford Scholarship",country:"UK",level:"Bachelor",ielts:7.5,desc:"Финансирование Oxford"},
{name:"Cambridge Trust",country:"UK",level:"Bachelor",ielts:7.5,desc:"Гранты Cambridge"},
{name:"MIT Scholarship",country:"USA",level:"Bachelor",ielts:7.5,desc:"Need-based грант"},
{name:"Stanford Aid",country:"USA",level:"Bachelor",ielts:7.0,desc:"Полное покрытие"},
{name:"Harvard Aid",country:"USA",level:"Bachelor",ielts:7.5,desc:"100% need-based"},

{name:"ETH Excellence",country:"Switzerland",level:"Master",ielts:7.0,desc:"Топ грант ETH"},
{name:"EPFL Scholarship",country:"Switzerland",level:"Master",ielts:7.0,desc:"Поддержка студентов"},
{name:"TU Delft Grant",country:"Netherlands",level:"Master",ielts:6.5,desc:"Грант Нидерланды"},
{name:"KU Leuven Grant",country:"Belgium",level:"Master",ielts:6.5,desc:"Доступный грант"},

{name:"NUS Scholarship",country:"Asia",level:"Bachelor",ielts:6.5,desc:"Сингапур грант"},
{name:"NTU Grant",country:"Asia",level:"Bachelor",ielts:6.0,desc:"Полное покрытие"},
{name:"KAIST Scholarship",country:"Asia",level:"Bachelor",ielts:6.5,desc:"Полный грант"},
{name:"HKU Scholarship",country:"Asia",level:"Bachelor",ielts:6.5,desc:"Гонконг грант"},
{name:"Tokyo MEXT",country:"Asia",level:"Bachelor",ielts:6.5,desc:"Япония грант"},

{name:"UBC Scholarship",country:"Canada",level:"Bachelor",ielts:6.5,desc:"Canada funding"},
{name:"Toronto Grant",country:"Canada",level:"Bachelor",ielts:6.5,desc:"Top Canada"},
{name:"Melbourne Grant",country:"Australia",level:"Bachelor",ielts:6.5,desc:"Australia funding"},
{name:"Sydney Grant",country:"Australia",level:"Bachelor",ielts:6.5,desc:"Australia"},
{name:"UNSW Grant",country:"Australia",level:"Bachelor",ielts:6.5,desc:"Australia"}
];

const grid = document.getElementById("grid");

function render(data, userScore=null){
    grid.innerHTML="";

    data.forEach(s=>{
        let status="";

        if(userScore){
            if(userScore >= s.ielts){
                status=`<div class="status ok">✅ Подходишь</div>`;
            } else {
                status=`<div class="status no">❌ Нужно ${s.ielts}</div>`;
            }
        }

        grid.innerHTML += `
        <div class="card">
            <h3>${s.name}</h3>
            <p>${s.country} • ${s.level}</p>
            <div class="badge">IELTS ${s.ielts}+</div>
            <div class="desc">${s.desc}</div>
            ${status}
        </div>`;
    });
}

function filter(){
    let country = document.getElementById("country").value;
    let level = document.getElementById("level").value;
    let ielts = parseFloat(document.getElementById("ielts").value);

    if(!isNaN(ielts)){
        if(ielts < 0) ielts = 0;
        if(ielts > 9) ielts = 9;
    }

    let filtered = scholarships.filter(s=>{
        return (
            (country === "" || s.country === country) &&
            (level === "" || s.level === level)
        );
    });

    render(filtered, ielts);
}

function resetFilters(){
    document.getElementById("country").value="";
    document.getElementById("level").value="";
    document.getElementById("ielts").value="";
    render(scholarships);
}

render(scholarships);

</script>

</body>
</html>
