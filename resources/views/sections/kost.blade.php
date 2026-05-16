{{--
|--------------------------------------------------------------------------
| Section: Kost Putri
| File: resources/views/sections/kost.blade.php
|--------------------------------------------------------------------------
--}}

<section id="kost" style="background:var(--dark)">
  <div class="container">
    <div class="kost-grid">
      <div>
        <div class="section-label">Hunian Premium</div>
        <h2 class="section-title">Kost Putri Lorok Pakjo</h2>
        <p style="color:var(--muted);font-size:.9rem;line-height:1.7;margin-bottom:1.5rem">Hunian nyaman dan aman untuk perempuan di lokasi strategis Palembang. Dekat dengan kampus dan pusat kota.</p>
        <div class="price-tag">
          <span class="price-from">Mulai dari</span>
          <span class="price-amount">Rp 10.000.000</span>
          <span class="price-from">/ Tahun</span>
        </div>
        <div class="facilities-grid">
          <div class="facility-item"><span style="width:24px;text-align:center">📶</span> WiFi Kecepatan Tinggi</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🔒</span> Keamanan 24 Jam &amp; CCTV</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🚗</span> Parkir Luas</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🚿</span> Kamar Mandi Dalam</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🧹</span> Kebersihan Terjaga</div>
          <div class="facility-item"><span style="width:24px;text-align:center">📍</span> Lokasi Strategis</div>
        </div>
        <div style="margin-top:1.5rem">
          <div style="font-size:.8rem;color:var(--muted);margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.5px">Cek Ketersediaan Kamar</div>
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
      <div class="kost-gallery-grid">
        <div style="grid-row:span 2;border-radius:8px 4px 4px 8px;overflow:hidden">
          <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=600&q=80" alt="Kamar Kost Utama">
        </div>
        <div style="overflow:hidden;border-radius:4px">
          <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=400&q=80" alt="Ruang Kost">
        </div>
        <div style="overflow:hidden;border-radius:4px 8px 8px 4px">
          <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=400&q=80" alt="Fasilitas Kost">
        </div>
      </div>
    </div>
  </div>
</section>