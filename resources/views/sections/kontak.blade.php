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
        <div class="contact-icon">📞</div>
        <div>
          <h4>Telepon / WhatsApp</h4>
          <p>0896-2202-2001</p>
          <a href="https://wa.me/6289622022001" target="_blank" class="wa-btn" style="margin-top:.5rem">💬 Chat WhatsApp</a>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-icon">🕐</div>
        <div>
          <h4>Jam Operasional</h4>
          <p>Buka setiap hari mulai pukul 08.00 WIB</p>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-icon">📍</div>
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
            <div class="map-box-icon map-icon-tenda">🏕️</div>
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
            <div class="map-box-icon map-icon-kost">🏠</div>
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
<a href="https://wa.me/6289622022001" target="_blank" class="wa-float" title="Chat WhatsApp">💬</a>