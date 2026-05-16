{{--
|--------------------------------------------------------------------------
| Section: Kontak, Lokasi & Footer
| File: resources/views/sections/kontak.blade.php
|--------------------------------------------------------------------------
--}}

<section id="contact" style="background:var(--dark)">
  <div class="container">
    <div class="section-header-row">
      <div>
        <div class="section-label">Lokasi &amp; Kontak</div>
        <h2 class="section-title">Temukan Kami</h2>
        <p class="section-desc">Kunjungi lokasi sewa tenda atau kost putri kami langsung di Palembang.</p>
      </div>
    </div>
    <div class="contact-info-row">
      <div class="contact-card">
        <div class="contact-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        </div>
        <div>
          <h4>Telepon / WhatsApp</h4>
          <p>0896-2202-2001</p>
          <a href="https://wa.me/6289622022001" target="_blank" class="wa-btn" style="margin-top:.5rem; display:inline-flex; align-items:center; gap:6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FFFFFF" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg> Chat WhatsApp
          </a>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div>
          <h4>Jam Operasional</h4>
          <p>Buka setiap hari mulai pukul 08.00 WIB</p>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <div>
          <h4>Area Layanan</h4>
          <p>Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang, Sumatera Selatan</p>
        </div>
      </div>
    </div>
    <div class="dual-map-wrap">
      <div class="map-box">
        <div class="map-box-header">
          <div class="map-box-title">
            <div class="map-box-icon map-icon-tenda">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h2v-4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v4h2a2 2 0 0 0 2-2v-8"/><path d="M2 7h20v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2z"/></svg>
            </div>
            <div>
              <div class="map-box-name">Gurau Tenda — Sewa Tenda</div>
              <div class="map-box-sub">Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang</div>
            </div>
          </div>
          <a href="https://maps.app.goo.gl/Ko4X6srwiuR6TQNE6" target="_blank" class="map-open-link">Buka Maps →</a>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.425699112809!2d104.7288354757262!3d-2.979270639821773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b75119b5b25d3%3A0xdb963a90fb31ae43!2sGURAU%20TENDA!5e0!3m2!1sen!2sid!4v1776979411076!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="map-box">
        <div class="map-box-header">
          <div class="map-box-title">
            <div class="map-box-icon map-icon-kost">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
              <div class="map-box-name">Gurau Kost — Kost Putri</div>
              <div class="map-box-sub">Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang</div>
            </div>
          </div>
          <a href="https://maps.app.goo.gl/byiciiCJfVzj4N5c6" target="_blank" class="map-open-link">Buka Maps →</a>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3984.4278268214002!2d104.729364!3d-2.9786827!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b756f11dbd353%3A0x3b60968a9fa2aed7!2sGurau%20kost!5e0!3m2!1sen!2sid!4v1776979480171!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<footer>
  <p>&copy; {{ date('Y') }} <span>Gurau Tenda</span> Palembang &middot; All Rights Reserved &middot;</p>
</footer>

{{-- Tombol WhatsApp mengambang --}}
<a href="https://wa.me/6289622022001" target="_blank" class="wa-float" title="Chat WhatsApp" style="display:flex;align-items:center;justify-content:center;">
  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#FFFFFF" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>
</a>