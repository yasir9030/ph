<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RedPulse - Blood Donation Network</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--red:#C8102E;--red-dark:#8B0000;--red-light:#a55360;--cream:#e4cfcf;--white:#FFFFFF;--ink:#331919;--muted:#7A5A5A;--border:#F0D5D5;--success:#1A7A4A;--shadow:0 4px 32px rgba(200,16,46,0.10);--radius:14px}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--ink);min-height:100vh;overflow-x:hidden}
nav{background:var(--white);border-bottom:2px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 5vw;height:68px;position:sticky;top:0;z-index:999;box-shadow:0 2px 18px rgba(200,16,46,0.07)}
.logo{display:flex;align-items:center;gap:10px;cursor:pointer}
.logo-drop{width:36px;height:36px;background:var(--red);border-radius:50% 50% 50% 0;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;box-shadow:0 2px 12px rgba(200,16,46,0.35)}
.logo-drop span{transform:rotate(45deg);font-size:17px;color:white;font-weight:900}
.logo-text{font-family:'Playfair Display',serif;font-size:1.55rem;font-weight:900;color:var(--red)}
.logo-text em{color:var(--ink);font-style:normal}
.nav-links{display:flex;gap:4px;list-style:none}
.nav-links button{background:none;border:none;font-family:'DM Sans',sans-serif;font-size:.92rem;font-weight:500;color:var(--muted);cursor:pointer;padding:8px 18px;border-radius:8px;transition:all .2s}
.nav-links button:hover,.nav-links button.active{background:var(--red);color:white}
.page{display:none;animation:fadeUp .4s ease}
.page.visible{display:block}
@keyframes fadeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}
.hero{background:linear-gradient(135deg,var(--red-dark) 0%,var(--red) 60%,#cc2c46 100%);color:white;padding:80px 5vw 100px;position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;right:-60px;top:-60px;width:500px;height:500px;background:rgba(255,255,255,.04);border-radius:50%}
.hero::after{content:'';position:absolute;right:80px;bottom:-120px;width:320px;height:320px;background:rgba(255,255,255,.03);border-radius:50%}
.hero-inner{max-width:700px;position:relative;z-index:1}
.hero-badge{display:inline-block;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:99px;padding:5px 16px;font-size:.78rem;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:22px}
.hero h1{font-family:'Playfair Display',serif;font-size:clamp(2.4rem,5vw,4rem);font-weight:900;line-height:1.1;margin-bottom:20px}
.hero h1 span{color:rgba(255,220,220,.9)}
.hero p{font-size:1.05rem;line-height:1.7;opacity:.88;max-width:520px;margin-bottom:36px}
.hero-actions{display:flex;gap:14px;flex-wrap:wrap}
.btn{display:inline-flex;align-items:center;gap:8px;padding:13px 28px;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.95rem;font-weight:600;cursor:pointer;border:none;transition:all .22s}
.btn-white{background:white;color:var(--red);box-shadow:0 4px 20px rgba(0,0,0,.12)}
.btn-white:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(0,0,0,.18)}
.btn-outline-white{background:transparent;color:rgb(243, 236, 236);border:2px solid rgba(255,255,255,.6)}
.btn-outline-white:hover{background:rgba(255,255,255,.12)}
.stats-strip{background:var(--white);display:flex;justify-content:space-around;flex-wrap:wrap;padding:28px 5vw;border-bottom:2px solid var(--border);gap:20px}
.stat-item{text-align:center}
.stat-item .num{font-family:'Playfair Display',serif;font-size:2.1rem;font-weight:900;color:var(--red);display:block}
.stat-item .lbl{font-size:.82rem;color:var(--muted);font-weight:500;letter-spacing:.5px}
.section{padding:64px 5vw}
.section-title{font-family:'Playfair Display',serif;font-size:1.9rem;font-weight:900;color:var(--ink);margin-bottom:8px}
.section-sub{color:var(--muted);font-size:.95rem;margin-bottom:40px;max-width:520px}
.cards-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:22px}
.card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--radius);padding:28px 24px;box-shadow:var(--shadow);transition:transform .22s,box-shadow .22s}
.card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(200,16,46,.14)}
.card-icon{font-size:2rem;margin-bottom:14px}
.card h3{font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;margin-bottom:8px}
.card p{font-size:.88rem;color:var(--muted);line-height:1.65}
.blood-grid{display:flex;flex-wrap:wrap;gap:14px;margin-top:36px}
.blood-badge{background:var(--white);border:2px solid var(--red);color:var(--red);border-radius:10px;padding:12px 20px;font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:900;min-width:70px;text-align:center;box-shadow:var(--shadow);transition:all .2s;cursor:default}
.blood-badge:hover{background:var(--red);color:white}
.form-wrap{max-width:640px;margin:0 auto;padding:56px 5vw}
.form-card{background:var(--white);border:1.5px solid var(--border);border-radius:18px;padding:42px 40px;box-shadow:0 8px 48px rgba(200,16,46,.10)}
.form-head{display:flex;align-items:center;gap:14px;margin-bottom:32px;padding-bottom:22px;border-bottom:2px solid var(--border)}
.form-head-icon{width:48px;height:48px;background:linear-gradient(135deg,var(--red),var(--red-light));border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;box-shadow:0 4px 14px rgba(200,16,46,.3)}
.form-head h2{font-family:'Playfair Display',serif;font-size:1.55rem;font-weight:900;color:var(--ink)}
.form-head p{font-size:.82rem;color:var(--muted)}
.form-group{margin-bottom:20px}
.form-group label{display:block;font-size:.83rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px}
.form-group input,.form-group select{width:100%;padding:12px 16px;border:1.5px solid var(--border);border-radius:9px;font-family:'DM Sans',sans-serif;font-size:.95rem;color:var(--ink);background:var(--cream);transition:border-color .2s,box-shadow .2s;appearance:none}
.form-group input:focus,.form-group select:focus{outline:none;border-color:var(--red);box-shadow:0 0 0 3px rgba(200,16,46,.10);background:white}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.btn-red{background:linear-gradient(135deg,var(--red-dark),var(--red));color:white;width:100%;padding:14px;border-radius:10px;font-size:1rem;font-weight:700;border:none;cursor:pointer;margin-top:8px;box-shadow:0 4px 22px rgba(200,16,46,.35);transition:all .22s;font-family:'DM Sans',sans-serif}
.btn-red:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(200,16,46,.45)}
.toast{position:fixed;bottom:32px;left:50%;transform:translateX(-50%) translateY(20px);background:var(--success);color:white;padding:13px 28px;border-radius:10px;font-weight:600;font-size:.93rem;opacity:0;transition:all .35s;z-index:9999;pointer-events:none;box-shadow:0 6px 28px rgba(0,0,0,.2)}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.panel-wrap{padding:48px 5vw}
.panel-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:18px;margin-bottom:32px}
.panel-header h2{font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:900}
.search-bar{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
.search-bar select,.search-bar input{padding:10px 16px;border:1.5px solid var(--border);border-radius:9px;font-family:'DM Sans',sans-serif;font-size:.9rem;color:var(--ink);background:var(--white);min-width:140px;appearance:none}
.search-bar select:focus,.search-bar input:focus{outline:none;border-color:var(--red)}
.btn-sm{padding:10px 20px;border-radius:9px;font-family:'DM Sans',sans-serif;font-size:.88rem;font-weight:600;cursor:pointer;border:none;background:var(--red);color:white;transition:all .2s}
.btn-sm:hover{background:var(--red-dark)}
.btn-sm.ghost{background:var(--white);border:1.5px solid var(--border);color:var(--ink)}
.btn-sm.ghost:hover{border-color:var(--red);color:var(--red)}
.table-wrap{overflow-x:auto;border-radius:var(--radius);border:1.5px solid var(--border);box-shadow:var(--shadow)}
table{width:100%;border-collapse:collapse;background:var(--white);min-width:660px}
thead{background:linear-gradient(135deg,var(--red-dark),var(--red));color:white}
thead th{padding:14px 18px;text-align:left;font-size:.80rem;font-weight:600;text-transform:uppercase;letter-spacing:.8px;white-space:nowrap}
tbody tr{border-bottom:1px solid var(--border);transition:background .15s}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:var(--cream)}
tbody td{padding:14px 18px;font-size:.90rem;color:var(--ink);vertical-align:middle}
.blood-tag{display:inline-block;background:var(--red);color:white;border-radius:6px;padding:3px 10px;font-size:.82rem;font-weight:700}
.empty-state{text-align:center;padding:64px 20px;color:var(--muted)}
.empty-state .empty-icon{font-size:3.5rem;margin-bottom:16px;display:block}
.del-btn{background:none;border:1.5px solid #F0D5D5;color:var(--red);border-radius:7px;padding:5px 12px;font-size:.82rem;cursor:pointer;font-family:'DM Sans',sans-serif;font-weight:600;transition:all .18s}
.del-btn:hover{background:var(--red);color:white;border-color:var(--red)}
.lock-screen{max-width:400px;margin:80px auto;padding:0 20px}
.lock-card{background:var(--white);border:1.5px solid var(--border);border-radius:18px;padding:42px 36px;text-align:center;box-shadow:var(--shadow)}
.lock-icon{font-size:3rem;margin-bottom:16px}
.lock-card h2{font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;margin-bottom:6px}
.lock-card p{color:var(--muted);font-size:.88rem;margin-bottom:28px}
.lock-card input{width:100%;padding:13px 16px;border:1.5px solid var(--border);border-radius:9px;font-family:'DM Sans',sans-serif;font-size:.95rem;margin-bottom:14px;color:var(--ink);background:var(--cream);text-align:center;letter-spacing:4px;font-weight:700}
.lock-card input:focus{outline:none;border-color:var(--red)}
.lock-hint{font-size:.78rem;color:var(--muted);margin-top:12px}
.count-badge{background:var(--red);color:white;border-radius:99px;padding:2px 10px;font-size:.78rem;font-weight:700;margin-left:6px}
@media(max-width:600px){.form-card{padding:28px 20px}.form-row{grid-template-columns:1fr}.panel-header{flex-direction:column;align-items:flex-start}.nav-links button{padding:8px 10px;font-size:.82rem}}
</style>
</head>
<body>

<nav>
  <div class="logo" onclick="showPage('home')">
    <div class="logo-drop"><span>&#9829;</span></div>
    <span class="logo-text">Red<em>Pulse</em></span>
  </div>
  <ul class="nav-links">
    <li><button id="nav-home" onclick="showPage('home')" class="active">&#127968; Home</button></li>
    <li><button id="nav-donate" onclick="showPage('donate')">&#129656; Donate</button></li>
    <li><button id="nav-donors" onclick="showPage('donors')">&#128101; Donors</button></li>
    <li><button id="nav-admin" onclick="showPage('admin')">&#128274; Admin</button></li>
  </ul>
</nav>

<div class="toast" id="toast"></div>

<!-- HOME -->
<div class="page visible" id="page-home">
  <div class="hero">
    <div class="hero-inner">
      <span class="hero-badge">&#9829; Save Lives Today</span>
      <h1>Give Blood.<br><span>Give Life.</span></h1>
      <p>RedPulse connects blood donors with those in urgent need across Bangladesh. Every drop matters — register as a donor or find a donor near you right now.</p>
      <div class="hero-actions">
        <button class="btn btn-white" onclick="showPage('donate')">&#129656; Become a Donor</button>
        <button class="btn btn-outline-white" onclick="showPage('donors')">&#128269; Find a Donor</button>
      </div>
    </div>
  </div>
  <div class="stats-strip">
    <div class="stat-item"><span class="num" id="stat-total">0</span><span class="lbl">Registered Donors</span></div>
    <div class="stat-item"><span class="num">8</span><span class="lbl">Blood Groups</span></div>
    <div class="stat-item"><span class="num">64</span><span class="lbl">Districts Covered</span></div>
    <div class="stat-item"><span class="num">24/7</span><span class="lbl">Available Support</span></div>
  </div>
  <div class="section">
    <p class="section-title">Why Donate Blood?</p>
    <p class="section-sub">One donation can save up to 3 lives. It is safe, simple, and takes under an hour.</p>
    <div class="cards-grid">
      <div class="card"><div class="card-icon">&#127973;</div><h3>Emergency Support</h3><p>Accident victims, surgery patients, and cancer patients constantly need fresh blood supply to survive.</p></div>
      <div class="card"><div class="card-icon">&#128170;</div><h3>Safe and Healthy</h3><p>Donating blood is completely safe. Your body replenishes blood cells within 24-48 hours of donation.</p></div>
      <div class="card"><div class="card-icon">&#129309;</div><h3>Community Bond</h3><p>RedPulse builds a trusted network of verified donors across all 64 zilas of Bangladesh.</p></div>
      <div class="card"><div class="card-icon">&#9889;</div><h3>Instant Match</h3><p>Search by blood group and district to find the nearest available donor in seconds.</p></div>
    </div>
  </div>
  <div class="section" style="background:var(--white);border-top:2px solid var(--border);border-bottom:2px solid var(--border);">
    <p class="section-title">All Blood Types Welcome</p>
    <p class="section-sub">Every blood type is needed. Hover to highlight your group.</p>
    <div class="blood-grid">
      <div class="blood-badge">A+</div><div class="blood-badge">A-</div>
      <div class="blood-badge">B+</div><div class="blood-badge">B-</div>
      <div class="blood-badge">AB+</div><div class="blood-badge">AB-</div>
      <div class="blood-badge">O+</div><div class="blood-badge">O-</div>
    </div>
  </div>
  <div class="section" style="text-align:center;">
    <p class="section-title">Ready to Be a Hero?</p>
    <p class="section-sub" style="margin:0 auto 28px;">Register as a donor today — it takes less than 2 minutes.</p>
    <button class="btn-red" style="width:auto;display:inline-flex;padding:14px 36px;" onclick="showPage('donate')">&#129656; Register as Donor Now</button>
  </div>
</div>

<!-- DONATE FORM -->
<div class="page" id="page-donate">
  <div class="form-wrap">
    <div class="form-card">
      <div class="form-head">
        <div class="form-head-icon">&#129656;</div>
        <div><h2>Donor Registration</h2><p>Fill in your details to join the RedPulse network</p></div>
      </div>
      <div class="form-group">
        <label>Full Name *</label>
        <input type="text" id="f-name" placeholder="e.g. Md. Rahim Uddin" />
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Blood Group *</label>
          <select id="f-blood">
            <option value="">-- Select --</option>
            <option>A+</option><option>A-</option><option>B+</option><option>B-</option>
            <option>AB+</option><option>AB-</option><option>O+</option><option>O-</option>
          </select>
        </div>
        <div class="form-group">
          <label>Phone Number *</label>
          <input type="tel" id="f-phone" placeholder="01XXXXXXXXX" maxlength="11" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Available Days *</label>
          <select id="f-days">
            <option value="">-- Select --</option>
            <option>Everyday</option><option>Weekdays (Sat-Thu)</option>
            <option>Weekends Only</option><option>Flexible / On Call</option><option>Once a Month</option>
          </select>
        </div>
        <div class="form-group">
          <label>Zilla (District) *</label>
          <select id="f-zilla">
            <option value="">-- Select --</option>
            <option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Sylhet</option>
            <option>Khulna</option><option>Barisal</option><option>Rangpur</option><option>Mymensingh</option>
            <option>Cumilla</option><option>Narayanganj</option><option>Pabna</option><option>Bogura</option>
            <option>Jessore</option><option>Noakhali</option><option>Gazipur</option><option>Tangail</option>
            <option>Brahmanbaria</option><option>Dinajpur</option><option>Cox's Bazar</option><option>Faridpur</option>
            <option>Narsingdi</option><option>Kishoreganj</option><option>Manikganj</option><option>Munshiganj</option>
            <option>Shariatpur</option><option>Madaripur</option><option>Gopalganj</option><option>Jashore</option>
            <option>Meherpur</option><option>Chuadanga</option><option>Kushtia</option><option>Magura</option>
            <option>Narail</option><option>Satkhira</option><option>Bagerhat</option><option>Pirojpur</option>
            <option>Jhalokathi</option><option>Patuakhali</option><option>Bhola</option><option>Barguna</option>
            <option>Feni</option><option>Lakshmipur</option><option>Chandpur</option><option>Khagrachhari</option>
            <option>Rangamati</option><option>Bandarban</option><option>Moulvibazar</option><option>Habiganj</option>
            <option>Sunamganj</option><option>Netrokona</option><option>Jamalpur</option><option>Sherpur</option>
            <option>Gaibandha</option><option>Kurigram</option><option>Lalmonirhat</option><option>Nilphamari</option>
            <option>Panchagarh</option><option>Thakurgaon</option><option>Joypurhat</option><option>Naogaon</option>
            <option>Chapai Nawabganj</option><option>Natore</option><option>Sirajganj</option>
          </select>
        </div>
      </div>
      <button class="btn-red" onclick="submitDonor()">&#129656; Register as Donor</button>
    </div>
  </div>
</div>

<!-- DONORS LIST -->
<div class="page" id="page-donors">
  <div class="panel-wrap">
    <div class="panel-header">
      <div>
        <h2>&#129656; Donor Directory <span class="count-badge" id="donor-count">0</span></h2>
        <p style="color:var(--muted);font-size:.88rem;margin-top:4px;">Search by blood group or district to find a donor near you</p>
      </div>
      <div class="search-bar">
        <select id="filter-blood" onchange="renderDonors()">
          <option value="">All Blood Groups</option>
          <option>A+</option><option>A-</option><option>B+</option><option>B-</option>
          <option>AB+</option><option>AB-</option><option>O+</option><option>O-</option>
        </select>
        <input type="text" id="filter-zilla" placeholder="Filter by Zilla..." oninput="renderDonors()" />
       
<button class="btn-sm ghost" onclick="clearFilters()">Clear</button>
</script>
      </div>
    </div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>#</th><th>Name</th><th>Blood Group</th><th>Phone</th><th>Available Days</th><th>Zilla</th></tr></thead>
        <tbody id="donors-tbody"></tbody>
      </table>
    </div>
    <div class="empty-state" id="donors-empty" style="display:none;">
      <span class="empty-icon">&#128269;</span>
      <p>No donors found. Try a different filter or <a href="#" onclick="showPage('donate')" style="color:var(--red)">register yourself</a>!</p>
    </div>
  </div>
</div>

<!-- ADMIN -->
<div class="page" id="page-admin">
  <div id="admin-lock">
    <div class="lock-screen">
      <div class="lock-card">
        <div class="lock-icon">&#128274;</div>
        <h2>Admin Access</h2>
        <p>Enter the admin password to manage all donors</p>
        <input type="password" id="admin-pass" placeholder="Password" onkeydown="if(event.key==='Enter')checkAdmin()" />
        <button class="btn-red" onclick="checkAdmin()">Unlock Panel</button>
        <p class="lock-hint">Default password: <strong>redpulse123</strong></p>
      </div>
    </div>
  </div>
  <div id="admin-panel" style="display:none;">
    <div class="panel-wrap">
      <div class="panel-header">
        <div>
          <h2>Admin Panel <span class="count-badge" id="admin-count">0</span></h2>
          <p style="color:var(--muted);font-size:.88rem;margin-top:4px;">Manage all registered donors</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
          <div class="search-bar">
            <select id="admin-filter-blood" onchange="renderAdminDonors()">
              <option value="">All Blood Groups</option>
              <option>A+</option><option>A-</option><option>B+</option><option>B-</option>
              <option>AB+</option><option>AB-</option><option>O+</option><option>O-</option>
            </select>
            <input type="text" id="admin-filter-zilla" placeholder="Filter by Zilla..." oninput="renderAdminDonors()" />
          </div>
          <button class="btn-sm ghost" onclick="clearAllDonors()" style="border-color:#F0D5D5;color:var(--red);">Clear All</button>
          <button class="btn-sm ghost" onclick="adminLogout()">Logout</button>
        </div>
      </div>
      <div class="cards-grid" id="admin-stats" style="margin-bottom:28px;"></div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>#</th><th>Name</th><th>Blood Group</th><th>Phone</th><th>Available Days</th><th>Zilla</th><th>Registered</th><th>Action</th></tr></thead>
          <tbody id="admin-tbody"></tbody>
        </table>
      </div>
      <div class="empty-state" id="admin-empty" style="display:none;">
        <span class="empty-icon">&#128101;</span>
        <p>No donors registered yet.</p>
      </div>
    </div>
  </div>
</div>

<script>
function getDonors(){return JSON.parse(localStorage.getItem('rp_donors')||'[]')}
function saveDonors(a){localStorage.setItem('rp_donors',JSON.stringify(a))}
function showPage(id){
  document.querySelectorAll('.page').forEach(function(p){p.classList.remove('visible')});
  document.querySelectorAll('.nav-links button').forEach(function(b){b.classList.remove('active')});
  document.getElementById('page-'+id).classList.add('visible');
  document.getElementById('nav-'+id).classList.add('active');
  if(id==='donors')renderDonors();
  if(id==='admin')renderAdminDonors();
  if(id==='home')updateStats();
  window.scrollTo(0,0);
}
function updateStats(){document.getElementById('stat-total').textContent=getDonors().length}
function submitDonor(){
  var name=document.getElementById('f-name').value.trim();
  var blood=document.getElementById('f-blood').value;
  var phone=document.getElementById('f-phone').value.trim();
  var days=document.getElementById('f-days').value;
  var zilla=document.getElementById('f-zilla').value;
  if(!name||!blood||!phone||!days||!zilla){showToast('Please fill in all fields!','#C8102E');return}
  if(!/^01[3-9]\d{8}$/.test(phone)){showToast('Enter a valid BD phone number (01XXXXXXXXX)','#C8102E');return}
  var donors=getDonors();
  donors.unshift({id:Date.now(),name:name,blood:blood,phone:phone,days:days,zilla:zilla,date:new Date().toLocaleDateString('en-GB')});
  saveDonors(donors);
  document.getElementById('f-name').value='';
  document.getElementById('f-phone').value='';
  document.getElementById('f-blood').selectedIndex=0;
  document.getElementById('f-days').selectedIndex=0;
  document.getElementById('f-zilla').selectedIndex=0;
  showToast('Thank you! You are now registered as a donor.');
}
function renderDonors(){
  var bg=document.getElementById('filter-blood').value;
  var bz=document.getElementById('filter-zilla').value.trim().toLowerCase();
  var donors=getDonors();
  if(bg)donors=donors.filter(function(d){return d.blood===bg});
  if(bz)donors=donors.filter(function(d){return d.zilla.toLowerCase().indexOf(bz)>-1});
  document.getElementById('donor-count').textContent=donors.length;
  var tbody=document.getElementById('donors-tbody');
  var empty=document.getElementById('donors-empty');
  if(donors.length===0){tbody.innerHTML='';empty.style.display='block';return}
  empty.style.display='none';
  tbody.innerHTML=donors.map(function(d,i){
    return '<tr><td style="color:var(--muted);font-size:.82rem;">'+(i+1)+'</td><td><strong>'+esc(d.name)+'</strong></td><td><span class="blood-tag">'+esc(d.blood)+'</span></td><td><a href="tel:'+esc(d.phone)+'" style="color:var(--red);text-decoration:none;font-weight:600;">'+esc(d.phone)+'</a></td><td>'+esc(d.days)+'</td><td>'+esc(d.zilla)+'</td></tr>';
  }).join('');
}
function clearFilters(){document.getElementById('filter-blood').selectedIndex=0;document.getElementById('filter-zilla').value='';renderDonors()}
var ADMIN_PASS='redpulse123';
function checkAdmin(){
  if(document.getElementById('admin-pass').value===ADMIN_PASS){
    document.getElementById('admin-lock').style.display='none';
    document.getElementById('admin-panel').style.display='block';
    renderAdminDonors();
  }else{showToast('Wrong password!','#C8102E')}
}
function adminLogout(){
  document.getElementById('admin-lock').style.display='block';
  document.getElementById('admin-panel').style.display='none';
  document.getElementById('admin-pass').value='';
}
function renderAdminDonors(){
  var bg=document.getElementById('admin-filter-blood').value;
  var bz=document.getElementById('admin-filter-zilla').value.trim().toLowerCase();
  var donors=getDonors();
  if(bg)donors=donors.filter(function(d){return d.blood===bg});
  if(bz)donors=donors.filter(function(d){return d.zilla.toLowerCase().indexOf(bz)>-1});
  var all=getDonors();
  document.getElementById('admin-count').textContent=all.length;
  var grouped={};all.forEach(function(d){grouped[d.blood]=(grouped[d.blood]||0)+1});
  var top=Object.entries(grouped).sort(function(a,b){return b[1]-a[1]}).slice(0,1);
  var dists=[];all.forEach(function(d){if(dists.indexOf(d.zilla)<0)dists.push(d.zilla)});
  document.getElementById('admin-stats').innerHTML=[
    {icon:'&#128101;',label:'Total Donors',val:all.length},
    {icon:'&#129656;',label:'Most Common Group',val:top[0]?top[0][0]+' ('+top[0][1]+')':'N/A'},
    {icon:'&#128205;',label:'Districts',val:dists.length},
    {icon:'&#128197;',label:'Latest Entry',val:all[0]?all[0].date:'None'}
  ].map(function(s){
    return '<div class="card" style="padding:20px 22px;"><div class="card-icon" style="font-size:1.6rem;margin-bottom:8px;">'+s.icon+'</div><div style="font-family:Playfair Display,serif;font-size:1.5rem;font-weight:900;color:var(--red);">'+s.val+'</div><div style="font-size:.82rem;color:var(--muted);font-weight:500;margin-top:2px;">'+s.label+'</div></div>';
  }).join('');
  var tbody=document.getElementById('admin-tbody');
  var empty=document.getElementById('admin-empty');
  if(donors.length===0){tbody.innerHTML='';empty.style.display='block';return}
  empty.style.display='none';
  tbody.innerHTML=donors.map(function(d,i){
    return '<tr><td style="color:var(--muted);font-size:.82rem;">'+(i+1)+'</td><td><strong>'+esc(d.name)+'</strong></td><td><span class="blood-tag">'+esc(d.blood)+'</span></td><td>'+esc(d.phone)+'</td><td>'+esc(d.days)+'</td><td>'+esc(d.zilla)+'</td><td style="color:var(--muted);font-size:.82rem;">'+(d.date||'-')+'</td><td><button class="del-btn" onclick="deleteDonor('+d.id+')">Delete</button></td></tr>';
  }).join('');
}
function deleteDonor(id){
  if(!confirm('Remove this donor?'))return;
  saveDonors(getDonors().filter(function(d){return d.id!==id}));
  renderAdminDonors();
  showToast('Donor removed.');
}
function clearAllDonors(){
  if(!confirm('Delete ALL donors? This cannot be undone.'))return;
  saveDonors([]);renderAdminDonors();showToast('All donors cleared.','#C8102E');
}
function showToast(msg,bg){
  bg=bg||'#1A7A4A';
  var t=document.getElementById('toast');
  t.textContent=msg;t.style.background=bg;t.classList.add('show');
  setTimeout(function(){t.classList.remove('show')},3000);
}
function esc(s){return String(s).replace(/[&<>"']/g,function(c){return{'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]})}
updateStats();
</script>
</body>
</html>