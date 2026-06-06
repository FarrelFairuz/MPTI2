{{--
|--------------------------------------------------------------------------
| Section: Navbar & Modal Admin
| File: resources/views/sections/navbar.blade.php
|--------------------------------------------------------------------------
--}}

{{-- ════════════ NAVBAR ════════════ --}}
<nav id="navbar">
  <a href="{{ route('beranda') }}" class="logo">GURAU<span> TENDA & KOST</span></a>
  <ul class="nav-links" id="navLinks">
    <li><a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
    <li>
      <a href="{{ route('sewa-tenda') }}" class="{{ request()->routeIs('sewa-tenda') ? 'active' : '' }}">Sewa Tenda</a>
      <div class="nav-dropdown">
        <div class="nav-dropdown-title"><i data-lucide="tent" style="display:inline-block; vertical-align:-4px; margin-right:4px;"></i> Sewa Tenda</div>
        <div class="nav-dropdown-desc">Solusi perlengkapan acara dengan berbagai pilihan tenda VIP, roder, plafon, hingga kursi dan meja.</div>
      </div>
    </li>
    <li>
      <a href="{{ route('kost-putri') }}" class="{{ request()->routeIs('kost-putri') ? 'active' : '' }}">Kost Putri</a>
      <div class="nav-dropdown">
        <div class="nav-dropdown-title"><i data-lucide="home" style="display:inline-block; vertical-align:-4px; margin-right:4px;"></i> Kost Putri</div>
        <div class="nav-dropdown-desc">Hunian kost putri premium dengan fasilitas lengkap, aman, dan nyaman di pusat kota.</div>
      </div>
    </li>
    <li><a href="{{ route('testimoni') }}" class="{{ request()->routeIs('testimoni') ? 'active' : '' }}">Testimoni</a></li>
    <li><a href="{{ route('beranda') }}#contact" class="nav-cta">Hubungi Kami</a></li>
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
    <div class="admin-panel-title" style="display:flex; align-items:center; gap:6px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
      Admin Panel
    </div>
    <button class="admin-panel-close" onclick="togglePanel()">✕</button>
  </div>
  <div class="admin-panel-body">
    <div style="display:flex;gap:.5rem;margin-bottom:1rem">
      <button onclick="gantiTabAdmin('kamar',this)" id="tabKamar"
        style="flex:1;padding:6px;border-radius:6px;border:1px solid rgba(201,168,76,0.3);background:var(--gold);color:#FFFFFF;font-size:.75rem;cursor:pointer;font-family:'DM Sans',sans-serif;font-weight:500;display:flex;align-items:center;justify-content:center;gap:6px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Status Kamar
      </button>
      <button onclick="gantiTabAdmin('history',this)" id="tabHistory"
        style="flex:1;padding:6px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:transparent;color:var(--muted);font-size:.75rem;cursor:pointer;font-family:'DM Sans',sans-serif;display:flex;align-items:center;justify-content:center;gap:6px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M12 11h4"/><path d="M12 16h4"/><path d="M8 11h.01"/><path d="M8 16h.01"/></svg>
        History Pesan
      </button>
    </div>
    <div id="panelKamar">
      <div class="admin-section-label">Ketersediaan Per Bulan</div>
      <div id="adminRoomList"></div>
      <button class="admin-save-btn" onclick="simpanDataAdmin()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:6px;">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
          <polyline points="17 21 17 13 7 13 7 21"/>
          <polyline points="7 3 7 8 15 8"/>
        </svg>
        Simpan Perubahan
      </button>
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