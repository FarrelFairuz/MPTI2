{{--
|--------------------------------------------------------------------------
| Section: Kost Putri
| File: resources/views/sections/kost.blade.php
|--------------------------------------------------------------------------
--}}

<section id="kost" class="scroll-reveal" style="background:var(--section-bg)">
  <div class="container">
    <div class="kost-grid">
      <div>
        <div class="section-label">Hunian Premium</div>
        <h2 class="section-title">Kost Putri Lorok Pakjo</h2>
        <div class="kost-rating">
          <div class="kost-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
          <div class="kost-rating-text">4.2 · 15 Ulasan</div>
        </div>
        <p style="color:var(--muted);font-size:.9rem;line-height:1.7;margin-bottom:1.5rem">Hunian nyaman dan aman untuk perempuan di lokasi strategis Palembang. Dekat dengan kampus dan pusat kota.</p>
        <div class="price-tag">
          <span class="price-from">Mulai dari</span>
          <span class="price-amount">Rp 10.000.000</span>
          <span class="price-from">/ Tahun</span>
        </div>
        <div class="price-note">Booking sekarang, tersedia terbatas!</div>
        <div class="facilities-grid">
          <div class="facility-item"><span style="width:24px;display:flex;justify-content:center"><i data-lucide="wifi"></i></span> WiFi Kecepatan Tinggi</div>
          <div class="facility-item"><span style="width:24px;display:flex;justify-content:center"><i data-lucide="shield-check"></i></span> Keamanan 24 Jam &amp; CCTV</div>
          <div class="facility-item"><span style="width:24px;display:flex;justify-content:center"><i data-lucide="car"></i></span> Parkir Luas</div>
          <div class="facility-item"><span style="width:24px;display:flex;justify-content:center"><i data-lucide="bath"></i></span> Kamar Mandi Dalam</div>
          <div class="facility-item"><span style="width:24px;display:flex;justify-content:center"><i data-lucide="sparkles"></i></span> Kebersihan Terjaga</div>
          <div class="facility-item"><span style="width:24px;display:flex;justify-content:center"><i data-lucide="map-pin"></i></span> Lokasi Strategis</div>
        </div>
        <div class="advantages-section scroll-reveal">
          <div class="section-label">KEUNGGULAN KAMI</div>
          <h3 class="section-title-sm">Mengapa Pilih Gurau Kost?</h3>
          <div class="advantages-grid">
            <div class="advantage-card">
              <div class="advantage-icon"><i data-lucide="shield-check"></i></div>
              <h4>Terjamin Aman</h4>
              <p>Keamanan 24 jam dengan CCTV dan petugas jaga</p>
            </div>
            <div class="advantage-card">
              <div class="advantage-icon"><i data-lucide="map-pin"></i></div>
              <h4>Lokasi Strategis</h4>
              <p>Dekat kampus dan pusat kota Palembang</p>
            </div>
            <div class="advantage-card">
              <div class="advantage-icon"><i data-lucide="star"></i></div>
              <h4>Rating Terbaik</h4>
              <p>4.2 bintang dari 15 ulasan Google nyata</p>
            </div>
          </div>
        </div>
        <div class="gold-divider"></div>
        <div style="margin-top:1.5rem">
          <div class="avail-label-row"><span>Cek Ketersediaan Kamar</span><span class="avail-status-badge default" id="availStatusBadge">● Pilih Bulan</span></div>
          <div class="avail-checker">
            <select class="avail-input" id="availMonth">
              <option value="">Pilih bulan masuk...</option>
              @foreach(array_keys($dataKamar) as $bulan)
                <option value="{{ $bulan }}">{{ $bulan }}</option>
              @endforeach
            </select>
            <button class="avail-btn" onclick="cekKetersediaan()">Cek</button>
          </div>
          <div class="avail-result" id="availResult"></div>
        </div>
        <a href="https://wa.me/6289622022001?text=Halo%2C%20saya%20ingin%20info%20kost%20putri" target="_blank" class="wa-btn" style="margin-top:1rem">
          💬 Tanya via WhatsApp
        </a>
      </div>
      <div class="kost-gallery-grid" data-lightbox-group="kost">
        <button type="button" class="gallery-thumb" data-lightbox-index="0" aria-label="Buka foto 1">
          <img src="/images/1.jpeg" alt=" Koridor Kost">
          <span class="gallery-overlay"><i data-lucide="zoom-in"></i></span>
        </button>
        <button type="button" class="gallery-thumb" data-lightbox-index="1" aria-label="Buka foto 2">
          <img src="/images/2.jpeg" alt=" Depan Kamar Kost">
          <span class="gallery-overlay"><i data-lucide="zoom-in"></i></span>
        </button>
        <button type="button" class="gallery-thumb" data-lightbox-index="2" aria-label="Buka foto 3">
          <img src="/images/3.jpeg" alt=" Dalam Kamar Kost">
          <span class="gallery-overlay"><i data-lucide="zoom-in"></i></span>
        </button>
        <button type="button" class="gallery-thumb" data-lightbox-index="3" aria-label="Buka foto 4">
          <img src="/images/4.jpeg" alt=" Parkir Mobil">
          <span class="gallery-overlay"><i data-lucide="zoom-in"></i></span>
        </button>
        <button type="button" class="gallery-thumb" data-lightbox-index="4" aria-label="Buka foto 5">
          <img src="/images/5.jpeg" alt="Parkir Motor">
          <span class="gallery-overlay"><i data-lucide="zoom-in"></i></span>
        </button>
        <button type="button" class="gallery-thumb" data-lightbox-index="5" aria-label="Buka foto 6">
          <img src="/images/6.jpeg" alt=" Gazebo Kost">
          <span class="gallery-overlay"><i data-lucide="zoom-in"></i></span>
        </button>
      </div>
    </div>
  </div>
</section>