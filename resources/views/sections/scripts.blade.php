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
         var swatches = '';
         if (selectedOpt && selectedOpt.colors) {
            selectedOpt.colors.forEach(function(c) {
               swatches += '<span style="display:inline-block;width:12px;height:12px;border-radius:50%;background-color:'+c+';margin-right:4px;border:1px solid rgba(255,255,255,0.2);"></span>';
            });
         }
         var label = selectedOpt ? selectedOpt.label : '';
         var html = '<div id="customTentColorBtn" style="width:100%;background:var(--dark2);border:1px solid rgba(255,255,255,0.1);color:var(--white);padding:10px 14px;border-radius:6px;font-size:.9rem;display:flex;align-items:center;justify-content:space-between;min-height:42px;">';
         html += '<div style="display:flex;align-items:center;">' + swatches + '<span style="margin-left:4px;">' + label + '</span></div>';
         html += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>';
         html += '</div>';
         
         html += '<div id="customTentColorList" style="display:none;position:absolute;top:100%;left:0;right:0;background:var(--dark3);border:1px solid rgba(255,255,255,0.1);border-radius:6px;margin-top:4px;z-index:50;max-height:200px;overflow-y:auto;box-shadow:0 10px 25px rgba(0,0,0,0.5);">';
         opsi.forEach(function(opt, idx) {
            var optSwatches = '';
            if (opt.colors) {
               opt.colors.forEach(function(c) {
                  optSwatches += '<span style="display:inline-block;width:12px;height:12px;border-radius:50%;background-color:'+c+';margin-right:4px;border:1px solid rgba(255,255,255,0.2);"></span>';
               });
            }
            html += '<div class="custom-tent-option" data-idx="'+idx+'" style="padding:10px 14px;display:flex;align-items:center;font-size:.9rem;transition:.2s;background:'+(idx===selectedIndex?'rgba(201,168,76,0.1)':'transparent')+';">' + optSwatches + '<span style="margin-left:4px;">' + opt.label + '</span></div>';
         });
         html += '</div>';
         
         customWarna.innerHTML = html;
         
         document.getElementById('customTentColorBtn').onclick = function(e) {
            e.stopPropagation();
            var list = document.getElementById('customTentColorList');
            list.style.display = list.style.display === 'none' ? 'block' : 'none';
         };
         
         var items = customWarna.querySelectorAll('.custom-tent-option');
         items.forEach(function(item) {
            item.onclick = function(e) {
               e.stopPropagation();
               var idx = parseInt(this.getAttribute('data-idx'));
               elWarna.selectedIndex = idx;
               renderCustomUI(idx);
               document.getElementById('customTentColorList').style.display = 'none';
               hitungHarga();
            };
            item.onmouseover = function() { this.style.background = 'rgba(255,255,255,0.05)'; };
            item.onmouseout = function() { 
                var idx = parseInt(this.getAttribute('data-idx'));
                this.style.background = (idx === elWarna.selectedIndex ? 'rgba(201,168,76,0.1)' : 'transparent'); 
            };
         });
      }
      
      renderCustomUI(0);
      elWarna.selectedIndex = 0;
    }
  }

  document.addEventListener('click', function(e) {
      var customWarna = document.getElementById('customTentColor');
      if (customWarna && !customWarna.contains(e.target)) {
          var list = document.getElementById('customTentColorList');
          if (list) list.style.display = 'none';
      }
  });

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

    var baris = '';
    baris += '<div class="breakdown-item"><span class="item-label">' + labelTenda[jenis] + ' × ' + unit + ' unit</span><span class="item-val">' + formatRp(totalTenda) + '</span></div>';
    baris += '<div class="breakdown-item"><span class="item-label">Ukuran: ' + labelUkuran[ukuran] + '</span><span class="item-val" style="color:var(--muted);font-size:.8rem">Informasi Ukuran</span></div>';
    if (warnaPerTenda[jenis] && warnaPerTenda[jenis].length > 0) {
      baris += '<div class="breakdown-item"><span class="item-label">Warna: ' + namaWarna + '</span><span class="item-val" style="color:var(--muted);font-size:.8rem">Informasi Warna</span></div>';
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
    baris += '<div class="breakdown-item total"><span class="item-label">Total Estimasi</span><span class="item-val">' + formatRp(total) + '</span></div>';
    
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
      window.open('https://wa.me/6282279996174?text=' + encodeURIComponent(pesan), '_blank');
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
        if (data.tersedia) {
          elHasil.className   = 'avail-result avail-yes';
          elHasil.textContent = '✓ Tersedia! ' + data.jumlahKamar + ' kamar kosong untuk ' + data.bulan + '.';
        } else {
          elHasil.className   = 'avail-result avail-no';
          elHasil.textContent = '✗ Penuh untuk ' + data.bulan + '. Hubungi kami untuk daftar tunggu.';
        }
      });
  }

  var dataRating = {
    tenda: { nilai:4.8, total:5,  bar:{ 5:80, 4:20, 3:0, 2:0, 1:0 } },
    kost:  { nilai:4.2, total:17, bar:{ 5:Math.round(12/17*100), 4:Math.round(1/17*100), 3:Math.round(1/17*100), 2:Math.round(1/17*100), 1:Math.round(2/17*100) } }
  };

  function filterUlasan(kategori, tombol) {
    document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
    tombol.classList.add('active');
    document.querySelectorAll('.review-card').forEach(function(c) {
      c.style.display = (c.dataset.cat === kategori) ? 'block' : 'none';
    });
    animasiRating(kategori);
  }

  function animasiRating(kategori) {
    var data    = dataRating[kategori];
    var elAngka = document.getElementById('ratingAngka');
    if (!elAngka) return;
    
    var start   = 0, target = data.nilai;
    var timer   = setInterval(function() {
      start += target / 30;
      if (start >= target) { start = target; clearInterval(timer); }
      elAngka.textContent = start.toFixed(1);
    }, 600 / 30);
    var bintang = Math.round(data.nilai);
    document.getElementById('ratingBintang').textContent = '★'.repeat(bintang) + '☆'.repeat(5 - bintang);
    document.getElementById('ratingCount').textContent   = data.total + ' ulasan Google';
    [5,4,3,2,1].forEach(function(b) {
      var elBar = document.getElementById('bar'+b), elPct = document.getElementById('pct'+b);
      if(!elBar || !elPct) return;
      var tPct  = data.bar[b] || 0;
      elBar.style.transition = 'none'; elBar.style.width = '0%'; elPct.textContent = '0%';
      setTimeout(function() { elBar.style.transition='width 0.8s ease'; elBar.style.width=tPct+'%'; elPct.textContent=tPct+'%'; }, 150);
    });
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
        sudahLogin = true; tutupLogin();
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
    .finally(function() {
      sudahLogin = false;
      document.getElementById('btnAdminLogin').style.display  = 'flex';
      document.getElementById('btnAdminLogout').style.display = 'none';
      document.getElementById('adminPanel').classList.remove('show');
    });
  }

  function togglePanel() {
    if (!sudahLogin) return;
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
    .then(function(res) { return res.json(); })
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

<style>
.history-item{padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,0.04)}
.history-item:last-child{border-bottom:none}
.history-tanggal{font-size:.72rem;color:var(--muted);margin-bottom:.35rem}
.history-detail{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.35rem}
.history-detail span{font-size:.75rem;background:rgba(255,255,255,0.05);padding:2px 8px;border-radius:4px;color:var(--white)}
.history-harga{font-size:.85rem;color:var(--gold);font-weight:500}
</style>
@endpush