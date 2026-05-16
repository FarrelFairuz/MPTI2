{{--
|--------------------------------------------------------------------------
| Section: Kalkulator Harga
| File: resources/views/sections/kalkulator.blade.php
|--------------------------------------------------------------------------
--}}

<section id="calculator" class="calculator-section">
  <div class="container">
    <div class="section-header-row">
      <div>
        <div class="section-label">Kalkulator Harga</div>
        <h2 class="section-title">Estimasi Biaya Sewa Tenda</h2>
        <p class="section-desc">Hitung perkiraan biaya event Anda secara instan. Harga final konfirmasi via WhatsApp.</p>
      </div>
    </div>
    <div class="calc-grid">
      <div class="calc-form">

        {{-- 1. Jenis Tenda --}}
        <div class="form-row">
          <label class="form-label" for="tentType">Jenis Tenda</label>
          <select class="form-select" id="tentType" onchange="onTentTypeChange()">
            <option value="biasa">Tenda Biasa — Rp 150.000 / unit</option>
            <option value="semivip">Tenda Semi VIP — Rp 250.000 / unit</option>
            <option value="vip">Tenda VIP — Rp 350.000 / unit</option>
            <option value="balon">Tenda Balon — Rp 850.000 / unit (min. 2 unit)</option>
            <option value="sentris">Tenda Sentris — Rp 600.000 / unit</option>
          </select>
          <div id="balonWarning" style="display:none;font-size:.75rem;color:var(--gold);margin-top:.4rem;padding:6px 10px;background:rgba(201,168,76,0.08);border-radius:6px;border-left:2px solid var(--gold)">
            ⚠ Tenda Balon minimal order 2 unit
          </div>
        </div>

        {{-- 2. Jumlah Unit --}}
        <div class="form-row">
          <label class="form-label">Jumlah Unit Tenda</label>
          <div class="qty-row">
            <button class="qty-btn" onclick="ubahQty('units',-1)">−</button>
            <span class="qty-display" id="unitsDisplay">1</span>
            <button class="qty-btn" onclick="ubahQty('units',1)">+</button>
            <span style="font-size:.85rem;color:var(--muted);margin-left:.25rem">unit</span>
          </div>
        </div>

        {{-- 3. Ukuran Tenda --}}
        <div class="form-row">
          <label class="form-label" for="tentSize">Ukuran Tenda</label>
          <select class="form-select" id="tentSize" onchange="hitungHarga()">
            <option value="kecil">Kecil (3×2 m)</option>
            <option value="sedang">Sedang (4×5 m)</option>
            <option value="besar">Besar (5×5 m)</option>
          </select>
        </div>

        {{-- 4. Warna / Dekor --}}
        <div class="form-row" id="warnaRow">
          <label class="form-label" for="tentColor">Warna / Dekor Tenda</label>
          <select class="form-select" id="tentColor" onchange="hitungHarga()"></select>
        </div>

        {{-- 5. Pilihan Kursi --}}
        <div class="form-row">
          <label class="form-label">Pilihan Kursi</label>
          <select class="form-select" id="chairType" onchange="hitungHarga()">
            <option value="none">Tidak Pakai Kursi</option>
            <option value="biasa">Kursi Biasa — Rp 2.000 / pcs</option>
            <option value="cover">Kursi + Cover — Rp 5.000 / pcs</option>
          </select>
        </div>

        {{-- 6. Jumlah Kursi --}}
        <div class="form-row" id="chairQtyRow" style="display:none">
          <label class="form-label">Jumlah Kursi</label>
          <div class="qty-row">
            <button class="qty-btn" onclick="ubahQty('chairs',-10)">−</button>
            <span class="qty-display" id="chairsDisplay">50</span>
            <button class="qty-btn" onclick="ubahQty('chairs',10)">+</button>
            <span style="font-size:.85rem;color:var(--muted);margin-left:.25rem">pcs</span>
          </div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.4rem">Kelipatan 10 kursi</div>
        </div>

        {{-- 7. Panggung --}}
        <div class="form-row">
          <label class="form-label">Panggung</label>
          <select class="form-select" id="panggungType" onchange="hitungHarga()">
            <option value="none">Tidak Pakai Panggung</option>
            <option value="ada">Panggung 5×5 m — Rp 350.000</option>
          </select>
        </div>

        {{-- 8. Meja --}}
        <div class="form-row">
          <label class="form-label">Pilihan Meja</label>
          <select class="form-select" id="mejaType" onchange="hitungHarga()">
            <option value="none">Tidak Pakai Meja</option>
            <option value="kado">Meja Kado — Rp 100.000 / pcs (include cover)</option>
            <option value="makan">Meja Makan — Rp 150.000 / pcs (include cover)</option>
          </select>
        </div>

        {{-- 9. Jumlah Meja --}}
        <div class="form-row" id="mejaQtyRow" style="display:none">
          <label class="form-label">Jumlah Meja</label>
          <div class="qty-row">
            <button class="qty-btn" onclick="ubahQty('meja',-1)">−</button>
            <span class="qty-display" id="mejaDisplay">1</span>
            <button class="qty-btn" onclick="ubahQty('meja',1)">+</button>
            <span style="font-size:.85rem;color:var(--muted);margin-left:.25rem">pcs</span>
          </div>
        </div>

      </div>

      <div>
        <div class="calc-result">
          <div class="result-label">Estimasi Harga</div>
          <div class="result-price" id="totalPrice">Rp 150.000</div>
          <div class="result-note">* Harga Perkiraan. Konfirmasi &amp; Negosiasi Via WhatsApp Untuk Harga Terbaik.</div>
          <div class="price-breakdown" id="breakdown"></div>
          <button onclick="konfirmasiPesan()" class="wa-btn wa-btn-full" style="border:none;cursor:pointer;">
            💬 Konfirmasi via WhatsApp
          </button>
        </div>
        <div class="included-box">
          <div style="font-size:.8rem;color:var(--muted);text-transform:uppercase;letter-spacing:.5px">Sudah termasuk</div>
          <div class="included-grid">
            <div class="included-item">✓ Pengiriman &amp; Setup</div>
            <div class="included-item">✓ Tim Pemasangan</div>
            <div class="included-item">✓ Bongkar Setelah Acara</div>
            <div class="included-item">✓ Konsultasi Gratis</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>