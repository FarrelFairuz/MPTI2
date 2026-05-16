{{--
|--------------------------------------------------------------------------
| Section: Navbar & Modal Admin
| File: resources/views/sections/navbar.blade.php
|--------------------------------------------------------------------------
--}}

{{-- ════════════ NAVBAR ════════════ --}}
<nav id="navbar">
  <a href="#home" class="logo">GURAU<span> TENDA & KOST</span></a>
  <ul class="nav-links" id="navLinks">
    <li><a href="#services">Sewa Tenda</a></li>
    <li><a href="#kost">Kost Putri</a></li>
    <li><a href="#reviews">Testimoni</a></li>
    <li><a href="#contact" class="nav-cta">Hubungi Kami</a></li>
  </ul>
  <div style="display:flex;align-items:center;gap:.5rem">
    <button class="btn-admin" id="btnAdminLogin" onclick="bukaLogin()" title="Admin Login">ADMIN</button>
    <button class="btn-admin btn-admin-logout" id="btnAdminLogout" onclick="togglePanel()" style="display:none" title="Buka Panel"><span class="admin-indicator"></span> Panel</button>
    <button class="hamburger" id="hamburger" onclick="toggleMenu()" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

{{-- ════════════ MODAL LOGIN ADMIN ════════════ --}}
<div class="modal-overlay" id="loginModal" onclick="tutupLoginBg(event)">
  <div class="modal-box">
    <button class="modal-close" onclick="tutupLogin()">✕</button>
    <div class="modal-logo">GURAU</div>
    <div class="modal-title">ADMIN LOGIN</div>
    <div class="modal-sub">Masuk untuk mengelola status ketersediaan kost dan history pemesanan tenda.</div>
    <div class="modal-field">
      <label class="modal-label" for="loginUser">Username</label>
      <input class="modal-input" type="text" id="loginUser" placeholder="Masukkan username" autocomplete="off">
    </div>
    <div class="modal-field">
      <label class="modal-label" for="loginPass">Password</label>
      <input class="modal-input" type="password" id="loginPass" placeholder="Masukkan password" onkeydown="if(event.key==='Enter')prosesLogin()">
    </div>
    <div class="modal-error" id="loginError">Username atau Password Salah!</div>
    <button class="modal-btn" onclick="prosesLogin()">LOGIN</button>
  </div>
</div>

{{-- ════════════ PANEL ADMIN ════════════ --}}
<div class="admin-panel" id="adminPanel">
  <div class="admin-panel-header">
    <div class="admin-panel-title">⚙️ Admin Panel</div>
    <button class="admin-panel-close" onclick="togglePanel()">✕</button>
  </div>
  <div class="admin-panel-body">
    <div style="display:flex;gap:.5rem;margin-bottom:1rem">
      <button onclick="gantiTabAdmin('kamar',this)" id="tabKamar"
        style="flex:1;padding:6px;border-radius:6px;border:1px solid rgba(201,168,76,0.3);background:var(--gold);color:var(--dark);font-size:.75rem;cursor:pointer;font-family:'DM Sans',sans-serif;font-weight:500">
        🏠 Status Kamar
      </button>
      <button onclick="gantiTabAdmin('history',this)" id="tabHistory"
        style="flex:1;padding:6px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:transparent;color:var(--muted);font-size:.75rem;cursor:pointer;font-family:'DM Sans',sans-serif">
        📋 History Pesan
      </button>
    </div>
    <div id="panelKamar">
      <div class="admin-section-label">Ketersediaan Per Bulan</div>
      <div id="adminRoomList"></div>
      <button class="admin-save-btn" onclick="simpanDataAdmin()">💾 Simpan Perubahan</button>
      <div class="admin-saved-msg" id="savedMsg">✓ Perubahan berhasil disimpan!</div>
    </div>
    <div id="panelHistory" style="display:none">
      <div class="admin-section-label">History Pemesanan Masuk</div>
      <div id="historyPemesananList">
        <div style="text-align:center;color:var(--muted);padding:1rem;font-size:.85rem">Klik tab untuk memuat data...</div>
      </div>
    </div>
    <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06);text-align:right">
      <button onclick="adminLogout()" style="background:transparent;border:none;color:rgba(255,59,48,0.7);font-size:.8rem;cursor:pointer;font-family:'DM Sans',sans-serif;padding:4px 8px;border-radius:4px;transition:.2s" onmouseover="this.style.color='#ff6b6b'" onmouseout="this.style.color='rgba(255,59,48,0.7)'">Logout Admin →</button>
    </div>
  </div>
</div>