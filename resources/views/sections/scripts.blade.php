@push('scripts')
<script>
  // ── URL endpoint Laravel ──
  var urlCekKamar        = "{{ route('kamar.cek') }}";
  var urlLoginAdmin      = "{{ route('admin.login') }}";
  var urlSimpanAdmin     = "{{ route('admin.simpanStatus') }}";
  var urlLogoutAdmin     = "{{ route('admin.logout') }}";
  var urlSimpanPemesanan = "{{ route('pemesanan.simpan') }}";
  var urlDaftarPemesanan = "{{ route('admin.pemesanan') }}";
  var csrfToken          = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var dataKamar          = @json($dataKamar);

  function renderThemeIcon(theme) {
    var iconContainer = document.getElementById('themeIcon');
    if (!iconContainer) return;
    iconContainer.innerHTML = theme === 'light'
      ? `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>`
      : `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z"/></svg>`;
  }

  function applyTheme(theme) {
    var selected = theme === 'light' ? 'light' : 'dark';
    document.body.classList.toggle('light-mode', selected === 'light');
    localStorage.setItem('theme', selected);
    renderThemeIcon(selected);
  }

  function toggleTheme() {
    applyTheme(document.body.classList.contains('light-mode') ? 'dark' : 'light');
  }

  function initTheme() {
    var storedTheme = localStorage.getItem('theme');
    applyTheme(storedTheme === 'light' ? 'light' : 'dark');
  }

  // ─────────────────────────────────────────────
  // DATA WARNA PER JENIS TENDA
  // ─────────────────────────────────────────────
  var warnaPerTenda = {
    biasa: [
      { value: 'merah_gold',   label: 'Merah & Gold', colors: ['#DC2626', '#C9A84C'] },
      { value: 'putih_biru',   label: 'Putih & Biru', colors: ['#FFFFFF', '#3B82F6'] },
    ],
    semivip: [
      { value: 'abu_putih',    label: 'Abu & Putih', colors: ['#9CA3AF', '#FFFFFF'] },
      { value: 'lilac_putih',  label: 'Lilac & Putih', colors: ['#C8A2C8', '#FFFFFF'] },
      { value: 'biru_putih',   label: 'Biru & Putih', colors: ['#3B82F6', '#FFFFFF'] },
    ],
    vip: [
      { value: 'moca_putih',    label: 'Moca & Putih', colors: ['#D2B48C', '#FFFFFF'] },
      { value: 'pink_putih',    label: 'Pink & Putih', colors: ['#FFC0CB', '#FFFFFF'] },
      { value: 'biru_putih',    label: 'Biru & Putih', colors: ['#3B82F6', '#FFFFFF'] },
      { value: 'merah_putih',   label: 'Merah & Putih', colors: ['#DC2626', '#FFFFFF'] },
      { value: 'merah_maroon',  label: 'Merah Maroon & Putih', colors: ['#800000', '#FFFFFF'] },
      { value: 'cream_putih',   label: 'Cream & Putih', colors: ['#FFFDD0', '#FFFFFF'] },
      { value: 'abu_putih_vip', label: 'Abu & Putih', colors: ['#9CA3AF', '#FFFFFF'] },
    ],
    balon:   [],
    sentris: [],
  };

  // ─────────────────────────────────────────────
  // HARGA & LABEL
  // ─────────────────────────────────────────────
  var hargaTenda  = { biasa:150000, semivip:250000, vip:350000, balon:850000, sentris:600000 };
  var labelTenda  = { biasa:'Tenda Biasa', semivip:'Tenda Semi VIP', vip:'Tenda VIP', balon:'Tenda Balon', sentris:'Tenda Sentris' };
  var labelUkuran = { kecil:'Kecil (3×2m)', sedang:'Sedang (4×5m)', besar:'Besar (5×5m)' };
  var hargaKursi  = { none:0, biasa:2000, cover:5000 };
  var labelKursi  = { none:'Tidak Pakai Kursi', biasa:'Kursi Biasa', cover:'Kursi + Cover' };
  var hargaMeja   = { none:0, kado:100000, makan:150000 };
  var labelMeja   = { none:'Tidak Pakai Meja', kado:'Meja Kado (include cover)', makan:'Meja Makan (include cover)' };
  var HARGA_PANGGUNG = 350000;

  var unit  = 1;
  var kursi = 50;
  var meja  = 1;

  function formatRp(n) {
    return 'Rp ' + Math.round(n).toLocaleString('id-ID');
  }

  function updateOpsiWarna(jenis) {
    var warnaRow = document.getElementById('warnaRow');
    var elWarna  = document.getElementById('tentColor');
    if (!warnaRow || !elWarna) return;
    
    var opsi = warnaPerTenda[jenis] || [];
    if (opsi.length === 0) {
      warnaRow.style.display = 'none';
      elWarna.innerHTML = '';
      var customWarna = document.getElementById('customTentColor');
      if (customWarna) customWarna.style.display = 'none';
    } else {
      warnaRow.style.display = 'block';
      elWarna.style.display = 'none'; // Sembunyikan select asli
      elWarna.innerHTML = opsi.map(function(w) {
        return '<option value="' + w.value + '">' + w.label + '</option>';
      }).join('');
      
      var customWarna = document.getElementById('customTentColor');
      if (!customWarna) {
        customWarna = document.createElement('div');
        customWarna.id = 'customTentColor';
        customWarna.style.position = 'relative';
        customWarna.style.cursor = 'pointer';
        elWarna.parentNode.insertBefore(customWarna, elWarna.nextSibling);
      }
      customWarna.style.display = 'block';
      
      function renderCustomUI(selectedIndex) {
         var selectedOpt = opsi[selectedIndex];
         var html = '<div id="colorSwatchGrid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;animation:swatchFadeIn .2s ease-out;">';
         
         opsi.forEach(function(opt, idx) {
            var isSelected = idx === selectedIndex;
            var swatchesHtml = '';
            if (opt.colors) {
               opt.colors.forEach(function(c) {
                  swatchesHtml += '<div style="display:inline-block;width:32px;height:32px;border-radius:8px;background-color:'+c+';border:2px solid transparent;margin-right:4px;transition:.2s ease;"></div>';
               });
            }
            html += '<div class="color-swatch-item" data-idx="'+idx+'" style="padding:12px;border-radius:8px;background:'+(isSelected?'rgba(201,168,76,0.1)':'transparent')+';border:2px solid '+(isSelected?'var(--gold)':'rgba(201,168,76,0.2)')+';transition:all .2s ease;cursor:pointer;display:flex;flex-direction:column;align-items:center;">';
            html += '<div style="display:flex;align-items:center;gap:6px;margin-bottom:8px;justify-content:center;">' + swatchesHtml + '</div>';
            html += '<div style="font-size:.85rem;color:var(--text);text-align:center;font-weight:500;line-height:1.4;">' + opt.label + '</div>';
            if (isSelected) {
               html += '<div style="margin-top:6px;font-size:.7rem;color:var(--gold);letter-spacing:.5px;text-transform:uppercase;">✓ Dipilih</div>';
            }
            html += '</div>';
         });
         html += '</div>';
         
         customWarna.innerHTML = html;
         
         // Update hidden input dengan nilai warna yang dipilih
         var selectedColorInput = document.getElementById('selectedColorValue');
         if (selectedColorInput) {
            selectedColorInput.value = opsi[selectedIndex] ? opsi[selectedIndex].value : '';
         }
         
         var items = customWarna.querySelectorAll('.color-swatch-item');
         items.forEach(function(item) {
            item.onclick = function(e) {
               e.stopPropagation();
               var idx = parseInt(this.getAttribute('data-idx'));
               elWarna.selectedIndex = idx;
               renderCustomUI(idx);
               hitungHarga();
            };
            item.onmouseover = function() { 
               var idx = parseInt(this.getAttribute('data-idx'));
               if (idx !== selectedIndex) {
                  this.style.background = 'rgba(201,168,76,0.05)';
                  this.style.borderColor = 'rgba(201,168,76,0.35)';
               }
            };
            item.onmouseout = function() { 
                var idx = parseInt(this.getAttribute('data-idx'));
                this.style.background = (idx === selectedIndex ? 'rgba(201,168,76,0.1)' : 'transparent');
                this.style.borderColor = (idx === selectedIndex ? 'var(--gold)' : 'rgba(201,168,76,0.2)');
            };
         });
      }
      
      renderCustomUI(0);
      elWarna.selectedIndex = 0;
    }
  }

  function onTentTypeChange() {
    var elJenis = document.getElementById('tentType');
    if (!elJenis) return;
    var jenis = elJenis.value;
    var warn  = document.getElementById('balonWarning');
    if (warn) warn.style.display = (jenis === 'balon') ? 'block' : 'none';
    
    if (jenis === 'balon' && unit < 2) {
      unit = 2;
      var ud = document.getElementById('unitsDisplay');
      if (ud) ud.textContent = unit;
    }
    updateOpsiWarna(jenis);
    hitungHarga();
  }

  function hitungHarga() {
    var elJenis = document.getElementById('tentType');
    if (!elJenis) return;
    
    var jenis     = elJenis.value;
    var ukuran    = document.getElementById('tentSize').value;
    var tipeKursi = document.getElementById('chairType').value;
    var tipeMeja  = document.getElementById('mejaType').value;
    var panggung  = document.getElementById('panggungType').value;

    var totalTenda   = (hargaTenda[jenis] || 150000) * unit;
    var totalKursi   = (hargaKursi[tipeKursi] || 0) * kursi;
    var totalMeja    = (hargaMeja[tipeMeja] || 0) * meja;
    var totalPanggung = (panggung === 'ada') ? HARGA_PANGGUNG : 0;

    var cq = document.getElementById('chairQtyRow');
    if (cq) cq.style.display = (tipeKursi !== 'none') ? 'block' : 'none';
    
    var mq = document.getElementById('mejaQtyRow');
    if (mq) mq.style.display  = (tipeMeja !== 'none') ? 'block' : 'none';

    var total = totalTenda + totalKursi + totalMeja + totalPanggung;
    var tp = document.getElementById('totalPrice');
    if (tp) tp.textContent = formatRp(total);

    var elWarna   = document.getElementById('tentColor');
    var namaWarna = (elWarna && elWarna.options.length > 0) ? elWarna.options[elWarna.selectedIndex].text : '-';
    
    // Ambil warna dari opsi yang dipilih untuk preview
    var warnaPreview = '';
    if (warnaPerTenda[jenis] && elWarna && elWarna.selectedIndex >= 0 && warnaPerTenda[jenis][elWarna.selectedIndex]) {
      var selectedColor = warnaPerTenda[jenis][elWarna.selectedIndex];
      if (selectedColor.colors && selectedColor.colors.length > 0) {
        selectedColor.colors.forEach(function(color) {
          warnaPreview += '<span style="display:inline-block;width:10px;height:10px;border-radius:50%;background-color:' + color + ';border:1px solid rgba(255,255,255,0.3);margin-right:4px;"></span>';
        });
      }
    }

    var baris = '';
    baris += '<div class="breakdown-item"><span class="item-label">' + labelTenda[jenis] + ' × ' + unit + ' unit</span><span class="item-val">' + formatRp(totalTenda) + '</span></div>';
    baris += '<div class="breakdown-item"><span class="item-label">Ukuran: ' + labelUkuran[ukuran] + '</span><span class="item-val" style="color:var(--muted);font-size:.8rem">Informasi Ukuran</span></div>';
    if (warnaPerTenda[jenis] && warnaPerTenda[jenis].length > 0) {
      baris += '<div class="breakdown-item"><span class="item-label">Warna: <span style="margin-left:4px;">' + warnaPreview + ' ' + namaWarna + '</span></span><span class="item-val" style="color:var(--muted);font-size:.8rem">Informasi Warna</span></div>';
    }
    if (tipeKursi !== 'none') {
      baris += '<div class="breakdown-item"><span class="item-label">' + labelKursi[tipeKursi] + ' × ' + kursi + ' pcs</span><span class="item-val">' + formatRp(totalKursi) + '</span></div>';
    }
    if (panggung === 'ada') {
      baris += '<div class="breakdown-item"><span class="item-label">Panggung 5×5 m</span><span class="item-val">' + formatRp(totalPanggung) + '</span></div>';
    }
    if (tipeMeja !== 'none') {
      baris += '<div class="breakdown-item"><span class="item-label">' + labelMeja[tipeMeja] + ' × ' + meja + ' pcs</span><span class="item-val">' + formatRp(totalMeja) + '</span></div>';
    }
    baris += '<div style="border-top:1px solid rgba(201,168,76,0.2);margin:1rem 0;"></div>';
    baris += '<div class="breakdown-item total" style="font-size:1.1rem;font-weight:bold;padding-top:.5rem;"><span class="item-label">Total Estimasi</span><span class="item-val">' + formatRp(total) + '</span></div>';
    
    var bd = document.getElementById('breakdown');
    if (bd) bd.innerHTML = baris;
  }

  function ubahQty(tipe, delta) {
    if (tipe === 'units') {
      var minUnit = (document.getElementById('tentType').value === 'balon') ? 2 : 1;
      unit = Math.max(minUnit, Math.min(50, unit + delta));
      var ud = document.getElementById('unitsDisplay');
      if (ud) ud.textContent = unit;
    } else if (tipe === 'chairs') {
      kursi = Math.max(10, Math.min(1000, kursi + delta));
      var cd = document.getElementById('chairsDisplay');
      if (cd) cd.textContent = kursi;
    } else if (tipe === 'meja') {
      meja = Math.max(1, Math.min(100, meja + delta));
      var md = document.getElementById('mejaDisplay');
      if (md) md.textContent = meja;
    }
    hitungHarga();
  }

  function konfirmasiPesan() {
    var elJenis    = document.getElementById('tentType');
    if (!elJenis) return;
    
    var elUkuran   = document.getElementById('tentSize');
    var elWarna    = document.getElementById('tentColor');
    var elKursi    = document.getElementById('chairType');
    var elMeja     = document.getElementById('mejaType');
    var elPanggung = document.getElementById('panggungType');

    var namaJenis     = elJenis.options[elJenis.selectedIndex].text.split('—')[0].trim();
    var namaUkuran    = elUkuran.options[elUkuran.selectedIndex].text;
    var namaWarna     = (elWarna && elWarna.options.length > 0) ? elWarna.options[elWarna.selectedIndex].text : '-';
    var namaKursi     = elKursi.options[elKursi.selectedIndex].text.split('—')[0].trim();
    var namaMeja      = elMeja.options[elMeja.selectedIndex].text.split('—')[0].trim();
    var pakaiPanggung = elPanggung.value === 'ada';
    var jumlahKursiVal = (elKursi.value !== 'none') ? kursi : 0;
    var jumlahMejaVal  = (elMeja.value !== 'none') ? meja : 0;
    var hargaAngka     = parseInt(document.getElementById('totalPrice').textContent.replace(/[^0-9]/g, ''));

    fetch(urlSimpanPemesanan, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
      body: JSON.stringify({
        jenis_tenda:    namaJenis,
        jumlah_unit:    unit,
        ukuran_tenda:   namaUkuran,
        warna_dekor:    namaWarna,
        jenis_kursi:    namaKursi,
        jumlah_kursi:   jumlahKursiVal,
        estimasi_harga: hargaAngka,
        pakai_panggung: pakaiPanggung,
        jenis_meja:     jumlahMejaVal > 0 ? namaMeja : null,
        jumlah_meja:    jumlahMejaVal,
      })
    })
    .finally(function() {
      var namaUkuranBersih = namaUkuran.replace('×', 'x');
      var pesan = 'Halo Gurau Tenda, saya ingin memesan:\n'
        + '- Jenis: ' + namaJenis + '\n'
        + '- Jumlah: ' + unit + ' unit\n'
        + '- Ukuran: ' + namaUkuranBersih + '\n'
        + (namaWarna !== '-' ? '- Warna: ' + namaWarna + '\n' : '')
        + (jumlahKursiVal > 0 ? '- Kursi: ' + namaKursi + ' x ' + jumlahKursiVal + ' pcs\n' : '')
        + (pakaiPanggung ? '- Panggung: 5x5 m\n' : '')
        + (jumlahMejaVal > 0 ? '- Meja: ' + namaMeja + ' x ' + jumlahMejaVal + ' pcs\n' : '')
        + '- Estimasi: ' + document.getElementById('totalPrice').textContent;
      window.open('https://wa.me/6289622022001?text=' + encodeURIComponent(pesan), '_blank');
    });
  }

  function cekKetersediaan() {
    var am = document.getElementById('availMonth');
    if (!am) return;
    
    var bulan   = am.value;
    var elHasil = document.getElementById('availResult');
    if (!bulan) { elHasil.style.display = 'none'; return; }
    fetch(urlCekKamar + '?bulan=' + encodeURIComponent(bulan))
      .then(function(res) { return res.json(); })
      .then(function(data) {
        elHasil.style.display = 'block';
        var badge = document.getElementById('availStatusBadge');
        if (data.tersedia) {
          elHasil.className   = 'avail-result avail-yes';
          elHasil.textContent = '✓ Tersedia! ' + data.jumlahKamar + ' kamar kosong untuk ' + data.bulan + '.';
          if (badge) { badge.className = 'avail-status-badge available'; badge.textContent = '● Tersedia'; }
        } else {
          elHasil.className   = 'avail-result avail-no';
          elHasil.textContent = '✗ Penuh untuk ' + data.bulan + '. Hubungi kami untuk daftar tunggu.';
          if (badge) { badge.className = 'avail-status-badge full'; badge.textContent = '● Penuh'; }
        }
      });
  }

  function initGlobalLightbox() {
    var buttons = Array.from(document.querySelectorAll('button[data-lightbox-index]'));
    var overlay = document.getElementById('lightboxOverlay');
    var imageEl = document.getElementById('lightboxImg');
    var closeBtn = document.getElementById('lightboxClose');
    var prevBtn = document.getElementById('lightboxPrev');
    var nextBtn = document.getElementById('lightboxNext');
    if (!overlay || !imageEl || !closeBtn || !prevBtn || !nextBtn || !buttons.length) return;

    var galleries = new Map();
    buttons.forEach(function(button) {
      var groupEl = button.closest('[data-lightbox-group]');
      var groupKey = groupEl ? groupEl.getAttribute('data-lightbox-group') : 'default';
      if (!galleries.has(groupKey)) galleries.set(groupKey, []);
      galleries.get(groupKey).push(button);
    });

    var currentGallery = null;
    var items = [];
    var currentIndex = 0;
    var touchStartX = null;

    function getButtonItem(button) {
      var img = button.querySelector('img');
      if (img && img.src) {
        return { src: img.src, alt: img.alt || button.getAttribute('aria-label') || '' };
      }
      var bgImg = button.style.backgroundImage;
      var src = '';
      if (bgImg) {
        var match = bgImg.match(/url\(["']?([^"')]+)["']?\)/);
        if (match) src = match[1];
      }
      return { src: src, alt: button.getAttribute('aria-label') || '' };
    }

    function prepareGallery(key) {
      var galleryButtons = galleries.get(key) || [];
      return galleryButtons.map(getButtonItem);
    }

    function updateLightbox(index) {
      if (!items.length) return;
      currentIndex = (index % items.length + items.length) % items.length;
      var item = items[currentIndex];
      imageEl.src = item.src;
      imageEl.alt = item.alt || '';
      overlay.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      overlay.style.display = 'none';
      document.body.style.overflow = '';
    }

    function showPrev() { updateLightbox(currentIndex - 1); }
    function showNext() { updateLightbox(currentIndex + 1); }

    galleries.forEach(function(galleryButtons, key) {
      galleryButtons.forEach(function(button, index) {
        button.addEventListener('click', function() {
          currentGallery = key;
          items = prepareGallery(key);
          updateLightbox(index);
        });
      });
    });

    closeBtn.addEventListener('click', closeLightbox);
    prevBtn.addEventListener('click', showPrev);
    nextBtn.addEventListener('click', showNext);

    overlay.addEventListener('click', function(e) {
      if (e.target === overlay) closeLightbox();
    });

    document.addEventListener('keydown', function(e) {
      if (overlay.style.display !== 'flex') return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft') showPrev();
      if (e.key === 'ArrowRight') showNext();
    });

    overlay.addEventListener('touchstart', function(e) {
      touchStartX = e.changedTouches[0].clientX;
    }, { passive: true });

    overlay.addEventListener('touchend', function(e) {
      if (touchStartX === null) return;
      var deltaX = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(deltaX) > 40) {
        if (deltaX > 0) showPrev(); else showNext();
      }
      touchStartX = null;
    });
  }

  function initFacilityStagger() {
    var grid = document.querySelector('.facilities-grid');
    if (!grid) return;
    var items = Array.from(grid.querySelectorAll('.facility-item'));
    if (!items.length) return;

    var observer = new IntersectionObserver(function(entries, obs) {
      entries.forEach(function(entry) {
        if (!entry.isIntersecting) return;
        items.forEach(function(item, idx) {
          setTimeout(function() { item.classList.add('visible'); }, idx * 100);
        });
        obs.disconnect();
      });
    }, { threshold: 0.15 });

    observer.observe(grid);
  }

  function initAdvantageCards() {
    var cards = Array.from(document.querySelectorAll('.advantage-card'));
    if (!cards.length) return;

    var observer = new IntersectionObserver(function(entries, obs) {
      entries.forEach(function(entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('visible');
        obs.unobserve(entry.target);
      });
    }, { threshold: 0.2 });

    cards.forEach(function(card) { observer.observe(card); });
  }

  function initKostEnhancements() {
    initFacilityStagger();
    initAdvantageCards();
  }

  var dataRating = {
    tenda: { nilai:4.8, total:5,  bar:{ 5:80, 4:20, 3:0, 2:0, 1:0 } },
    kost:  { nilai:4.2, total:17, bar:{ 5:Math.round(12/17*100), 4:Math.round(1/17*100), 3:Math.round(1/17*100), 2:Math.round(1/17*100), 1:Math.round(2/17*100) } }
  };
  var ratingAnimated = false;
  var carouselState = {
    wrapper: null,
    track: null,
    dots: null,
    cards: [],
    activeCount: 0,
    cardWidth: 0,
    setWidth: 0,
    paused: false,
    dragging: false,
    startX: 0,
    startScroll: 0,
    frameId: null,
    resumeTimer: null,
    currentIndex: 0,
    speed: 0.14,
    initialized: false
  };

  function filterUlasan(kategori, tombol) {
    document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
    tombol.classList.add('active');
    document.querySelectorAll('.review-card').forEach(function(c) {
      c.style.display = (c.dataset.cat === kategori) ? 'block' : 'none';
    });
    animasiRating(kategori);
    setupReviewCarousel();
  }

  function animasiRating(kategori) {
    var data    = dataRating[kategori];
    var elAngka = document.getElementById('ratingAngka');
    var elCount = document.getElementById('ratingCount');
    var elStars = document.getElementById('ratingBintang');
    if (!elAngka || !elCount || !elStars) return;

    var target = data.nilai;
    var countTarget = data.total;
    var duration = 1500;
    var startTime = null;

    var bintang = Math.round(data.nilai);
    elStars.textContent = '★'.repeat(bintang) + '☆'.repeat(5 - bintang);

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 2);
      elAngka.textContent = (target * eased).toFixed(1);
      elCount.textContent = Math.floor(countTarget * eased) + ' ulasan Google';
      if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);

    [5,4,3,2,1].forEach(function(b) {
      var elBar = document.getElementById('bar'+b), elPct = document.getElementById('pct'+b);
      if(!elBar || !elPct) return;
      var tPct  = data.bar[b] || 0;
      elBar.style.transition = 'none'; elBar.style.width = '0%'; elPct.textContent = '0%';
      setTimeout(function() {
        elBar.style.transition='width 1s ease-out'; elBar.style.width=tPct+'%'; elPct.textContent=tPct+'%';
      }, 50);
    });
  }

  function buildCarouselDots(count) {
    if (!carouselState.dots) return;
    carouselState.dots.innerHTML = '';
    for (var i = 0; i < count; i++) {
      var dot = document.createElement('button');
      dot.type = 'button';
      dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
      dot.setAttribute('aria-label', 'Slide ' + (i + 1));
      dot.dataset.index = i;
      dot.addEventListener('click', function() {
        scrollToCard(parseInt(this.dataset.index, 10));
      });
      carouselState.dots.appendChild(dot);
    }
  }

  function updateCarouselDots(index) {
    if (!carouselState.dots) return;
    Array.from(carouselState.dots.children).forEach(function(dot, idx) {
      dot.classList.toggle('active', idx === index);
    });
  }

  function scrollToCard(index) {
    var state = carouselState;
    if (!state.wrapper || state.activeCount === 0) return;
    index = (index % state.activeCount + state.activeCount) % state.activeCount;
    state.currentIndex = index;
    state.wrapper.scrollTo({ left: state.cardWidth * index, behavior: 'smooth' });
    updateCarouselDots(index);
    pauseAutoScroll();
    resumeAutoScrollDelayed();
  }

  function scrollReview(direction) {
    var state = carouselState;
    if (!state.wrapper || state.activeCount === 0) return;
    var index = state.currentIndex + direction;
    if (index < 0) index = state.activeCount - 1;
    if (index >= state.activeCount) index = 0;
    scrollToCard(index);
  }

  function setupReviewCarousel() {
    var wrapper = document.getElementById('reviewsScroll');
    var track = document.getElementById('reviewsTrack');
    var dots = document.getElementById('carouselDots');
    if (!wrapper || !track || !dots) return;

    carouselState.wrapper = wrapper;
    carouselState.track = track;
    carouselState.dots = dots;

    track.querySelectorAll('.review-card.clone').forEach(function(clone) { clone.remove(); });
    var originalCards = Array.from(track.querySelectorAll('.review-card')).filter(function(card) {
      return card.dataset.clone !== 'true' && card.style.display !== 'none';
    });

    if (originalCards.length === 0) {
      buildCarouselDots(0);
      return;
    }

    originalCards.forEach(function(card) {
      var clone = card.cloneNode(true);
      clone.dataset.clone = 'true';
      clone.classList.add('clone');
      track.appendChild(clone);
    });
    originalCards.forEach(function(card) {
      var clone = card.cloneNode(true);
      clone.dataset.clone = 'true';
      clone.classList.add('clone');
      track.appendChild(clone);
    });

    carouselState.cards = originalCards;
    carouselState.activeCount = originalCards.length;
    carouselState.currentIndex = 0;
    carouselState.wrapper.scrollLeft = 0;

    var gap = parseFloat(getComputedStyle(track).gap || '0');
    carouselState.cardWidth = originalCards[0].offsetWidth + gap;
    carouselState.setWidth = carouselState.cardWidth * originalCards.length;

    buildCarouselDots(carouselState.activeCount);
    updateCarouselDots(0);

    if (!carouselState.initialized) {
      wrapper.addEventListener('mouseenter', pauseAutoScroll);
      wrapper.addEventListener('mouseleave', resumeAutoScrollDelayed);
      wrapper.addEventListener('pointerdown', onCarouselPointerDown);
      wrapper.addEventListener('pointermove', onCarouselPointerMove);
      wrapper.addEventListener('pointerup', onCarouselPointerUp);
      wrapper.addEventListener('pointercancel', onCarouselPointerUp);
      wrapper.addEventListener('scroll', throttle(updateCarouselIndex, 100));
      carouselState.initialized = true;
    }

    wrapper.style.scrollBehavior = 'smooth';
    resumeAutoScroll();
  }

  function onCarouselPointerDown(e) {
    if (e.pointerType === 'mouse' && e.button !== 0) return;
    carouselState.dragging = true;
    carouselState.startX = e.clientX;
    carouselState.startScroll = carouselState.wrapper.scrollLeft;
    pauseAutoScroll();
    try { carouselState.wrapper.setPointerCapture(e.pointerId); } catch (err) {}
  }

  function onCarouselPointerMove(e) {
    if (!carouselState.dragging) return;
    var delta = e.clientX - carouselState.startX;
    carouselState.wrapper.scrollLeft = carouselState.startScroll - delta;
    updateCarouselIndex();
  }

  function onCarouselPointerUp(e) {
    if (!carouselState.dragging) return;
    carouselState.dragging = false;
    try { carouselState.wrapper.releasePointerCapture(e.pointerId); } catch (err) {}
    resumeAutoScrollDelayed();
  }

  function pauseAutoScroll() {
    carouselState.paused = true;
    if (carouselState.resumeTimer) {
      clearTimeout(carouselState.resumeTimer);
      carouselState.resumeTimer = null;
    }
  }

  function resumeAutoScroll() {
    carouselState.paused = false;
    if (!carouselState.frameId) {
      carouselState.frameId = requestAnimationFrame(autoScrollStep);
    }
  }

  function resumeAutoScrollDelayed() {
    if (carouselState.resumeTimer) {
      clearTimeout(carouselState.resumeTimer);
    }
    carouselState.resumeTimer = setTimeout(function() {
      carouselState.paused = false;
      if (!carouselState.frameId) {
        carouselState.frameId = requestAnimationFrame(autoScrollStep);
      }
    }, 700);
  }

  function autoScrollStep() {
    carouselState.frameId = null;
    if (carouselState.paused || carouselState.dragging || !carouselState.wrapper) return;
    carouselState.wrapper.scrollLeft += carouselState.speed;
    if (carouselState.wrapper.scrollLeft >= carouselState.setWidth * 2) {
      carouselState.wrapper.scrollLeft -= carouselState.setWidth;
    }
    updateCarouselIndex();
    carouselState.frameId = requestAnimationFrame(autoScrollStep);
  }

  function updateCarouselIndex() {
    if (!carouselState.wrapper || !carouselState.cardWidth || carouselState.activeCount === 0) return;
    if (carouselState.wrapper.scrollLeft >= carouselState.setWidth * 2) {
      carouselState.wrapper.scrollLeft -= carouselState.setWidth;
    }
    var index = Math.round(carouselState.wrapper.scrollLeft / carouselState.cardWidth) % carouselState.activeCount;
    if (index < 0) index += carouselState.activeCount;
    if (index !== carouselState.currentIndex) {
      carouselState.currentIndex = index;
      updateCarouselDots(index);
    }
  }

  function initSectionReveal() {
    var revealElements = Array.from(document.querySelectorAll('.scroll-reveal'));
    if (!revealElements.length) return;

    var lastScrollY = window.scrollY;
    var scrollDirection = 'down';
    window.addEventListener('scroll', function() {
      var currentScrollY = window.scrollY;
      if (currentScrollY > lastScrollY) {
        scrollDirection = 'down';
      } else if (currentScrollY < lastScrollY) {
        scrollDirection = 'up';
      }
      lastScrollY = currentScrollY;
    }, { passive: true });

    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.dataset.revealDirection = scrollDirection;
          entry.target.classList.add('reveal-visible');
          if (entry.target.querySelectorAll('.stat-value').length) {
            entry.target.querySelectorAll('.stat-value').forEach(function(counter) {
              delete counter.dataset.animated;
            });
            animateStatCounters(entry.target);
          }
        } else {
          entry.target.classList.remove('reveal-visible');
          entry.target.removeAttribute('data-reveal-direction');
          entry.target.querySelectorAll('.stat-value').forEach(function(counter) {
            delete counter.dataset.animated;
          });
        }
      });
    }, { threshold: 0.1 });

    revealElements.forEach(function(el) { observer.observe(el); });
  }

  function animateStatCounters(root) {
    root.querySelectorAll('.stat-value').forEach(function(counter) {
      if (counter.dataset.animated === 'true') return;
      counter.dataset.animated = 'true';
      var target = parseFloat(counter.dataset.target) || 0;
      var suffix = counter.dataset.suffix || '';
      var duration = 1200;
      var startTime = null;
      var initial = 0;
      function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = Math.min((timestamp - startTime) / duration, 1);
        var value = initial + (target - initial) * progress;
        counter.textContent = (target % 1 === 0 ? Math.floor(value) : value.toFixed(1)) + suffix;
        if (progress < 1) {
          requestAnimationFrame(step);
        }
      }
      requestAnimationFrame(step);
    });
  }

  function initFAQAccordion() {
    var questions = Array.from(document.querySelectorAll('.faq-question'));
    var items = Array.from(document.querySelectorAll('.faq-item'));

    // Initialize: ensure all answers are hidden and attributes reset
    items.forEach(function(it) {
      it.classList.remove('open');
      var ans = it.querySelector('.faq-answer');
      if (ans) {
        ans.style.maxHeight = '0';
        ans.style.opacity = '0';
        ans.style.overflow = 'hidden';
      }
      var btn = it.querySelector('.faq-question');
      if (btn) btn.setAttribute('aria-expanded', 'false');
    });

    questions.forEach(function(button) {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        var item = button.closest('.faq-item');
        if (!item) return;
        var answer = item.querySelector('.faq-answer');
        var isOpen = item.classList.contains('open');

        // Close any other open item
        items.forEach(function(other) {
          if (other !== item) {
            other.classList.remove('open');
            var otherAnswer = other.querySelector('.faq-answer');
            if (otherAnswer) {
              otherAnswer.style.maxHeight = '0';
              otherAnswer.style.opacity = '0';
            }
            var otherButton = other.querySelector('.faq-question');
            if (otherButton) otherButton.setAttribute('aria-expanded', 'false');
          }
        });

        if (!isOpen) {
          // Open this item
          item.classList.add('open');
          button.setAttribute('aria-expanded', 'true');
          if (answer) {
            // set to natural height then fade in
            answer.style.maxHeight = answer.scrollHeight + 'px';
            // small timeout to ensure transition applies
            setTimeout(function() { answer.style.opacity = '1'; }, 20);
          }
        } else {
          // Close this item
          item.classList.remove('open');
          button.setAttribute('aria-expanded', 'false');
          if (answer) {
            answer.style.maxHeight = '0';
            answer.style.opacity = '0';
          }
        }
      });
    });
  }

  function initPageEnhancements() {
    initSectionReveal();
    initFAQAccordion();
    initGlobalLightbox();
    initKostEnhancements();
  }

  function initReviewObserver() {
    var section = document.getElementById('reviews');
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting && !ratingAnimated) {
          ratingAnimated = true;
          var activeTab = document.querySelector('.tab-btn.active');
          var current = activeTab ? activeTab.getAttribute('data-cat') : 'tenda';
          animasiRating(current);
          setupReviewCarousel();
          observer.disconnect();
        }
      });
    }, { threshold: 0.35 });
    observer.observe(section);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
      initReviewObserver();
      initPageEnhancements();
    });
  } else {
    initReviewObserver();
    initPageEnhancements();
  }

  function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('open');
  }
  document.addEventListener('click', function(e) {
    var menu = document.getElementById('navLinks'), btn = document.getElementById('hamburger');
    if (menu && btn && menu.classList.contains('open') && !menu.contains(e.target) && !btn.contains(e.target)) menu.classList.remove('open');
  });

  function animasiCounter(id, target, suffix, durasi) {
    var el = document.getElementById(id);
    if(!el) return;
    var mulai = 0, langkah = target / 60;
    var timer = setInterval(function() {
      mulai += langkah;
      if (mulai >= target) { mulai = target; clearInterval(timer); }
      el.textContent = (target % 1 === 0 ? Math.floor(mulai) : mulai.toFixed(1)) + suffix;
    }, durasi / 60);
  }
  setTimeout(function() {
    animasiCounter('c1', 4.8, '★', 1200);
    animasiCounter('c2', 4.2, '★', 1200);
    animasiCounter('c3', 20, '+', 1000);
  }, 400);

  var sudahLogin = false;

  function bukaLogin() {
    document.getElementById('loginModal').classList.add('show');
    document.getElementById('loginUser').value = '';
    document.getElementById('loginPass').value = '';
    document.getElementById('loginError').style.display = 'none';
    setTimeout(function(){ document.getElementById('loginUser').focus(); }, 100);
  }
  function tutupLogin() { document.getElementById('loginModal').classList.remove('show'); }
  function tutupLoginBg(e) { if (e.target === document.getElementById('loginModal')) tutupLogin(); }

  function prosesLogin() {
    var u = document.getElementById('loginUser').value.trim();
    var p = document.getElementById('loginPass').value;
    fetch(urlLoginAdmin, {
      method: 'POST',
      headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':csrfToken },
      body: JSON.stringify({ username:u, password:p })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data.status === 'berhasil') {
        sudahLogin = true;
        localStorage.setItem('adminLoggedIn', 'true');
        tutupLogin();
        document.getElementById('btnAdminLogin').style.display  = 'none';
        document.getElementById('btnAdminLogout').style.display = 'flex';
        buatPanelAdmin();
        document.getElementById('adminPanel').classList.add('show');
      } else {
        var elErr = document.getElementById('loginError');
        elErr.style.display = 'block';
        document.getElementById('loginPass').value = '';
        setTimeout(function(){ elErr.style.display='none'; }, 3000);
      }
    });
  }

  function adminLogout() {
    fetch(urlLogoutAdmin, { method:'POST', headers:{'X-CSRF-TOKEN':csrfToken} })
    .then(function() {
        sudahLogin = false;
        localStorage.removeItem('adminLoggedIn');
        document.getElementById('btnAdminLogin').style.display  = 'flex';
        document.getElementById('btnAdminLogout').style.display = 'none';
        document.getElementById('adminPanel').classList.remove('show');
    })
    .catch(function(err) { console.error('Logout error:', err); });
  }

  function togglePanel() {
    if (!sudahLogin) {
      bukaLogin();
      return;
    }
    document.getElementById('adminPanel').classList.toggle('show');
  }

  function gantiTabAdmin(tab, tombol) {
    var tKamar = document.getElementById('tabKamar'), tHistory = document.getElementById('tabHistory');
    [tKamar, tHistory].forEach(function(t) { 
      t.style.background='transparent'; 
      t.style.color='var(--muted)'; 
      t.style.borderColor='rgba(255,255,255,0.1)'; 
      t.style.fontWeight='normal'; 
      var svg = t.querySelector('svg');
      if (svg) {
        svg.setAttribute('stroke', '#C9A84C');
        svg.style.stroke = '#C9A84C';
      }
    });
    tombol.style.background='var(--gold)'; 
    tombol.style.color='#FFFFFF'; 
    tombol.style.borderColor='var(--gold)'; 
    tombol.style.fontWeight='500';
    var svgAktif = tombol.querySelector('svg');
    if (svgAktif) {
      svgAktif.setAttribute('stroke', '#FFFFFF');
      svgAktif.style.stroke = '#FFFFFF';
    }
    
    if (tab === 'kamar') {
      document.getElementById('panelKamar').style.display='block';
      document.getElementById('panelHistory').style.display='none';
    } else {
      document.getElementById('panelKamar').style.display='none';
      document.getElementById('panelHistory').style.display='block';
      muatHistoryPemesanan();
    }
  }

  function buatPanelAdmin() {
    var list = document.getElementById('adminRoomList'), html = '';
    Object.keys(dataKamar).forEach(function(bulan) {
      var d = dataKamar[bulan], sid = bulan.replace(/\s/g,'_');
      html += '<div class="admin-room-row">';
      html += '<span class="admin-month-name"><span class="status-dot '+(d.tersedia?'dot-avail':'dot-full')+'" id="dot_'+sid+'"></span>'+bulan+'</span>';
      html += '<div class="admin-controls"><div class="toggle-wrap"><span class="toggle-label">'+(d.tersedia?'Tersedia':'Penuh')+'</span>';
      html += '<label class="toggle"><input type="checkbox" id="tog_'+sid+'" '+(d.tersedia?'checked':'')+' onchange="onToggleKetersediaan(\''+bulan+'\',this)"><span class="toggle-slider"></span></label></div>';
      html += '<div class="admin-qty"><button class="admin-qty-btn" onclick="adminUbahQty(\''+bulan+'\',-1)">−</button><span class="admin-qty-num" id="qty_'+sid+'">'+d.jumlah_kamar+'</span><button class="admin-qty-btn" onclick="adminUbahQty(\''+bulan+'\',1)">+</button></div>';
      html += '</div></div>';
    });
    list.innerHTML = html;
  }

  function onToggleKetersediaan(bulan, el) {
    var sid = bulan.replace(/\s/g,'_');
    dataKamar[bulan].tersedia = el.checked;
    var lbl = el.closest('.toggle-wrap').querySelector('.toggle-label');
    if (lbl) lbl.textContent = el.checked ? 'Tersedia' : 'Penuh';
    var dot = document.getElementById('dot_'+sid);
    if (dot) dot.className = 'status-dot '+(el.checked?'dot-avail':'dot-full');
    if (!el.checked) { dataKamar[bulan].jumlah_kamar=0; var q=document.getElementById('qty_'+sid); if(q)q.textContent='0'; }
  }

  function adminUbahQty(bulan, delta) {
    var sid  = bulan.replace(/\s/g,'_');
    var next = Math.max(0, Math.min(20, (dataKamar[bulan].jumlah_kamar||0) + delta));
    dataKamar[bulan].jumlah_kamar = next;
    var q = document.getElementById('qty_'+sid); if(q) q.textContent = next;
    dataKamar[bulan].tersedia = next > 0;
    var tog = document.getElementById('tog_'+sid);
    if (tog) { tog.checked=next>0; var l=tog.closest('.toggle-wrap').querySelector('.toggle-label'); if(l) l.textContent=next>0?'Tersedia':'Penuh'; }
    var dot = document.getElementById('dot_'+sid);
    if (dot) dot.className = 'status-dot '+(next>0?'dot-avail':'dot-full');
  }

  function simpanDataAdmin() {
    var dataKirim = {};
    Object.keys(dataKamar).forEach(function(b) {
      dataKirim[b] = { avail:dataKamar[b].tersedia, rooms:dataKamar[b].jumlah_kamar };
    });
    fetch(urlSimpanAdmin, {
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
      body:JSON.stringify({ data:dataKirim })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      var msg = document.getElementById('savedMsg');
      msg.textContent=data.pesan||'✓ Berhasil disimpan!'; msg.style.display='block';
      setTimeout(function(){ msg.style.display='none'; }, 2500);
    });
  }

  function muatHistoryPemesanan() {
    var kontainer = document.getElementById('historyPemesananList');
    kontainer.innerHTML = '<div style="text-align:center;color:var(--muted);padding:1rem;font-size:.85rem">Memuat data...</div>';
    fetch(urlDaftarPemesanan, { headers:{'X-CSRF-TOKEN':csrfToken} })
    .then(function(res) {
      if (res.status === 403 || res.status === 401) {
        localStorage.removeItem('adminLoggedIn');
        sudahLogin = false;
        location.reload();
        throw new Error('Unauthorized');
      }
      return res.json();
    })
    .then(function(data) {
      if (!data.data || data.data.length === 0) {
        kontainer.innerHTML = '<div style="text-align:center;color:var(--muted);padding:1rem;font-size:.85rem">Belum ada pemesanan masuk.</div>';
        return;
      }
      var html = '';
      data.data.forEach(function(item) {
        html += '<div class="history-item">';
        html += '<div class="history-tanggal"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>' + item.tanggal_pesan + '</div>';
        html += '<div class="history-detail">';
        html += '<span style="display:inline-flex;align-items:center;gap:4px;"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>' + item.jenis_tenda + ' × ' + item.jumlah_unit + ' unit</span>';
        html += '<span style="display:inline-flex;align-items:center;gap:4px;"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/></svg>' + item.ukuran_tenda + '</span>';
        if (item.warna_dekor && item.warna_dekor !== '-') html += '<span style="display:inline-flex;align-items:center;gap:4px;"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5" fill="#C9A84C"/><circle cx="17.5" cy="10.5" r=".5" fill="#C9A84C"/><circle cx="8.5" cy="7.5" r=".5" fill="#C9A84C"/><circle cx="6.5" cy="12.5" r=".5" fill="#C9A84C"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/></svg>' + item.warna_dekor + '</span>';
        if (item.jumlah_kursi > 0) html += '<span>🪑 ' + item.jenis_kursi + ' × ' + item.jumlah_kursi + '</span>';
        if (item.pakai_panggung) html += '<span>🎪 Panggung 5×5</span>';
        if (item.jumlah_meja > 0) html += '<span>🪞 ' + item.jenis_meja + ' × ' + item.jumlah_meja + '</span>';
        html += '</div><div class="history-harga">' + item.estimasi_harga + '</div></div>';
      });
      kontainer.innerHTML = html;
    })
    .catch(function() {
      kontainer.innerHTML = '<div style="text-align:center;color:#ff6b6b;padding:1rem;font-size:.85rem">Gagal memuat data.</div>';
    });
  }

  // Inisialisasi status admin saat halaman dimuat
  if (localStorage.getItem('adminLoggedIn') === 'true') {
      sudahLogin = true;
      var btnLogin = document.getElementById('btnAdminLogin');
      var btnPanel = document.getElementById('btnAdminLogout');
      if (btnLogin) btnLogin.style.display = 'none';
      if (btnPanel) btnPanel.style.display = 'flex';
      if (document.getElementById('adminPanel')) {
          buatPanelAdmin();
          document.getElementById('adminPanel').classList.add('show');
      }
  }

  initTheme();

  // Inisialisasi aman
  if (document.getElementById('tentType')) {
      updateOpsiWarna('biasa');
      hitungHarga();
  }
  
  if (document.getElementById('ratingAngka')) {
      animasiRating('tenda');
      document.querySelectorAll('.review-card').forEach(function(c) {
        c.style.display = (c.dataset.cat === 'tenda') ? 'block' : 'none';
      });
  }

  </script>
@endpush