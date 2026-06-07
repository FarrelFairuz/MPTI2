{{--
|--------------------------------------------------------------------------
| Section: Hero
| File: resources/views/sections/hero.blade.php
|--------------------------------------------------------------------------
--}}

<header id="home" class="hero">
  {{-- Background Pattern --}}
  <div class="hero-pattern"></div>
  
  {{-- Decorative Elements --}}
  <div class="hero-decor-line line-1"></div>
  <div class="hero-decor-line line-2"></div>
  
  <div class="hero-left">
    <div class="hero-badge"><span class="star-pulse">★</span> 4.8 Rating Google · Est. 2004</div>
    <h1>Solusi <em>Tenda</em> &amp; <em>Kost Putri</em> Premium di <em>Palembang</em></h1>
    <div class="hero-sub-wrap">
      <p class="hero-sub">Kepercayaan masyarakat Palembang. Dari pernikahan hingga corporate event — semua kami tangani secara profesional.</p>
    </div>
    <div class="hero-btns">
      <a href="#contact" class="btn-gold">Hubungi Kami</a>
    </div>
    <div class="stats-row">
      <div class="stat-item"><span class="stat-num" id="c1">4.8★</span><span class="stat-label">Rating Tenda</span></div>
      <div class="stat-divider"></div>
      <div class="stat-item"><span class="stat-num" id="c2">4.2★</span><span class="stat-label">Rating Kost</span></div>
      <div class="stat-divider"></div>
      <div class="stat-item"><span class="stat-num" id="c3">20+</span><span class="stat-label">Tahun Berdiri</span></div>
    </div>
  </div>

  <div class="hero-right">
    <div class="hero-photo-grid" data-lightbox-group="hero">
      <button type="button" class="hero-photo-card hero-photo-large" data-lightbox-index="0" aria-label="Contoh tenda" style="background-image:url('/images/Tenda_potrait.jpeg');"><span class="hero-photo-overlay"><i data-lucide="zoom-in"></i></span></button>
      <button type="button" class="hero-photo-card hero-photo-small" data-lightbox-index="1" aria-label="Gedung Kost" style="background-image:url('/images/Kost.jpeg');"><span class="hero-photo-overlay"><i data-lucide="zoom-in"></i></span></button>
      <button type="button" class="hero-photo-card hero-photo-small" data-lightbox-index="2" aria-label="Detail tenda" style="background-image:url('/images/Tenda_Sentris1.jpeg');"><span class="hero-photo-overlay"><i data-lucide="zoom-in"></i></span></button>
    </div>
    <div class="hero-expertise-card">
      <div class="hero-expertise-header">
        <div class="hero-expertise-label">Keahlian Kami</div>
        <div class="hero-expertise-copy">Pengalaman layanan tenda &amp; kost dalam satu tim.</div>
      </div>
      <div class="expertise-grid">
        <div class="expertise-item"><span class="expertise-icon"><i data-lucide="tent"></i></span><span>Tenda</span></div>
        <div class="expertise-item"><span class="expertise-icon"><i data-lucide="home"></i></span><span>Kost Putri</span></div>
        <div class="expertise-item"><span class="expertise-icon"><i data-lucide="key"></i></span><span>Keamanan</span></div>
        <div class="expertise-item"><span class="expertise-icon"><i data-lucide="globe"></i></span><span>Informasi</span></div>
      </div>
    </div>
  </div>
</header>
<div class="hero-bottom-divider"></div>
