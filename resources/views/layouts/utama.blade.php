<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  {{-- ─── Meta SEO ─────────────────────────────────────────────────── --}}
  <title>Gurau Tenda | Sewa Tenda & Kost Premium Palembang</title>
  <meta name="description" content="Sewa Tenda Palembang & Kost Lorok Pakjo berkualitas. Hubungi Gurau Tenda untuk solusi event dan hunian nyaman.">

  {{-- ─── CSRF Token: wajib ada untuk request POST via JavaScript ───── --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- ─── Google Fonts ───────────────────────────────────────────────── --}}
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    :root{
      --gold:#C9A84C;--gold-light:#F0D080;--dark:#0F0F0F;--dark2:#1A1A1A;
      --dark3:#242424;--white:#FAFAF8;--muted:#999;--accent:#E8D5A3;
    }
    html{scroll-behavior:smooth}
    body{font-family:'DM Sans',sans-serif;background:var(--dark);color:var(--white);overflow-x:hidden}

    /* ── NAV ── */
    nav{position:sticky;top:0;z-index:100;background:rgba(15,15,15,0.95);backdrop-filter:blur(12px);border-bottom:1px solid rgba(201,168,76,0.15);padding:0 2rem;display:flex;align-items:center;justify-content:space-between;height:64px;transition:all .3s}
    .logo{font-family:'Playfair Display',serif;font-size:1.4rem;letter-spacing:2px;color:var(--gold);text-decoration:none}
    .logo span{color:var(--white)}
    .nav-links{display:flex;gap:2rem;list-style:none;align-items:center}
    .nav-links li{position:relative;display:flex;align-items:center;height:100%;padding:10px 0}
    .nav-links a{color:var(--muted);font-size:.85rem;text-decoration:none;letter-spacing:1px;text-transform:uppercase;transition:all .3s ease;position:relative}
    .nav-links a:not(.nav-cta):hover{color:var(--gold);text-shadow:0 0 8px rgba(201,168,76,0.6)}
    .nav-links a:not(.nav-cta)::after{content:'';position:absolute;bottom:-4px;left:50%;width:0;height:2px;background:var(--gold);transition:all .3s ease;transform:translateX(-50%)}
    .nav-links a:not(.nav-cta):hover::after{width:100%}
    .nav-links a.active{color:var(--gold)}
    .nav-links a.active::before{content:'';position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);width:4px;height:4px;border-radius:50%;background:var(--gold)}
    .nav-cta{background:var(--gold)!important;color:var(--dark)!important;padding:8px 20px!important;border-radius:4px;font-weight:500!important;transition:all .3s ease}
    .nav-cta:hover{box-shadow:0 0 12px rgba(201,168,76,0.4);transform:translateY(-1px)}
    .nav-dropdown{position:absolute;top:100%;left:50%;transform:translateX(-50%) translateY(15px);background:var(--dark2);border:1px solid rgba(201,168,76,0.2);border-radius:8px;padding:1rem;width:240px;opacity:0;visibility:hidden;transition:all .3s ease;z-index:101;box-shadow:0 10px 25px rgba(0,0,0,0.5);pointer-events:none;text-align:center}
    .nav-links li:hover .nav-dropdown{opacity:1;visibility:visible;transform:translateX(-50%) translateY(0)}
    .nav-dropdown-title{color:var(--gold);font-size:.9rem;margin-bottom:.3rem;font-weight:500;font-family:'Playfair Display',serif;letter-spacing:1px;text-transform:none}
    .nav-dropdown-desc{color:var(--muted);font-size:.75rem;line-height:1.5;text-transform:none;letter-spacing:0}
    .hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:4px;background:none;border:none}
    .hamburger span{width:22px;height:2px;background:var(--white);transition:.3s;display:block}

    /* ── HERO ── */
    .hero{min-height:600px;display:grid;grid-template-columns:1fr;position:relative;overflow:hidden;background:linear-gradient(135deg,#0F0F0F 0%,#1a1208 100%)}
    .hero-pattern{position:absolute;inset:0;background-image:radial-gradient(rgba(201,168,76,0.15) 1px,transparent 1px);background-size:24px 24px;opacity:0.5;pointer-events:none}
    .hero-watermark{position:absolute;right:-5rem;top:50%;transform:translateY(-50%) rotate(90deg);font-family:'Playfair Display',serif;font-size:10rem;color:var(--gold);opacity:0.06;font-weight:900;white-space:nowrap;pointer-events:none;letter-spacing:10px}
    .hero-decor-line{position:absolute;height:1px;background:var(--gold);opacity:0.25;pointer-events:none}
    .line-1{top:15%;right:0;width:40%}
    .line-2{bottom:25%;right:8%;width:20%}
    .hero-left{display:flex;flex-direction:column;justify-content:center;padding:5rem 3rem;position:relative;z-index:2;max-width:800px}
    .hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(201,168,76,0.1);border:1px solid rgba(201,168,76,0.3);color:var(--gold);font-size:.8rem;padding:8px 16px;border-radius:24px;margin-bottom:1.5rem;letter-spacing:1px}
    .star-pulse{display:inline-block;animation:pulseStar 2s infinite}
    @keyframes pulseStar{0%,100%{opacity:1;transform:scale(1)}50%{opacity:0.4;transform:scale(1.3)}}
    h1{font-family:'Playfair Display',serif;font-size:3.2rem;line-height:1.2;margin-bottom:1.2rem;color:var(--white)}
    h1 em{color:var(--gold);font-style:normal}
    .hero-sub{color:var(--muted);font-size:1.05rem;line-height:1.7;margin-bottom:2.5rem;max-width:550px}
    .hero-btns{display:flex;gap:12px;flex-wrap:wrap}
    .btn-gold{background:var(--gold);color:var(--dark);padding:12px 28px;border-radius:4px;text-decoration:none;font-weight:500;font-size:.9rem;transition:all .2s;border:none;cursor:pointer;display:inline-block}
    .btn-gold:hover{background:var(--gold-light);transform:translateY(-1px)}
    .stats-row{display:flex;align-items:center;gap:1.5rem;margin-top:2.5rem;flex-wrap:wrap}
    .stat-item{display:flex;flex-direction:column;align-items:center;background:rgba(26,26,26,0.7);border:1px solid rgba(201,168,76,0.25);border-radius:10px;padding:1.25rem 2rem;min-width:140px;backdrop-filter:blur(5px)}
    .stat-divider{width:1px;height:50px;background:rgba(201,168,76,0.3)}
    .stat-num{font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--gold);font-weight:700}
    .stat-label{font-size:.75rem;color:var(--muted);letter-spacing:.5px;margin-top:4px;text-transform:uppercase}
    .hero-bottom-divider{height:1px;background:linear-gradient(to right,transparent,var(--gold),transparent);width:100%;opacity:0.35}

    /* ── SHARED ── */
    section{padding:5rem 2rem}
    .container{max-width:1100px;margin:0 auto}
    .section-label{font-size:.75rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:.75rem}
    h2.section-title{font-family:'Playfair Display',serif;font-size:2.2rem;color:var(--white);margin-bottom:1rem}
    .section-desc{color:var(--muted);max-width:520px;line-height:1.7}
    .section-header-row{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:3rem;flex-wrap:wrap;gap:1rem}

    /* ── SERVICES ── */
    .services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5px;background:rgba(255,255,255,0.06)}
    .service-card{background:var(--dark2);padding:2.5rem 2rem;position:relative;overflow:hidden;transition:background .3s}
    .service-card::before{content:attr(data-num);position:absolute;top:1.5rem;right:1.5rem;font-family:'Playfair Display',serif;font-size:4rem;color:rgba(201,168,76,0.06);font-weight:900;line-height:1}
    .service-card:hover{background:rgba(201,168,76,0.04)}
    .service-icon{width:44px;height:44px;background:rgba(201,168,76,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem;font-size:1.2rem}
    .service-card h3{font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--white);margin-bottom:.75rem}
    .service-card p{color:var(--muted);font-size:.875rem;line-height:1.7}
    .service-tag{display:inline-block;margin-top:1rem;font-size:.75rem;color:var(--gold);letter-spacing:1px}

    /* ── CALCULATOR ── */
    .calculator-section{background:var(--dark2)}
    .calc-grid{display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start}
    .calc-form{background:var(--dark3);border:1px solid rgba(255,255,255,0.06);border-radius:12px;padding:2rem}
    .form-row{margin-bottom:1.25rem}
    .form-label{display:block;font-size:.8rem;letter-spacing:.5px;color:var(--muted);margin-bottom:.5rem;text-transform:uppercase}
    .form-select,.form-input{width:100%;background:var(--dark2);border:1px solid rgba(255,255,255,0.1);color:var(--white);padding:10px 14px;border-radius:6px;font-size:.9rem;font-family:'DM Sans',sans-serif;outline:none;transition:border .2s;-webkit-appearance:none;appearance:none}
    .form-select:focus,.form-input:focus{border-color:var(--gold)}
    .qty-row{display:flex;align-items:center;gap:12px}
    .qty-btn{width:34px;height:34px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:var(--white);border-radius:6px;font-size:1.1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:.2s}
    .qty-btn:hover{background:rgba(201,168,76,0.2);border-color:var(--gold);color:var(--gold)}
    .qty-display{font-family:'Playfair Display',serif;font-size:1.4rem;color:var(--white);min-width:2rem;text-align:center}
    .calc-result{background:var(--dark3);border:1px solid rgba(201,168,76,0.2);border-radius:12px;padding:2rem}
    .result-label{font-size:.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:.5rem}
    .result-price{font-family:'Playfair Display',serif;font-size:2.5rem;color:var(--white);margin-bottom:.25rem}
    .result-note{font-size:.8rem;color:var(--muted);line-height:1.6;margin-bottom:1.5rem}
    .price-breakdown{border-top:1px solid rgba(255,255,255,0.06);padding-top:1rem;margin-top:1rem}
    .breakdown-item{display:flex;justify-content:space-between;font-size:.85rem;margin-bottom:.5rem}
    .breakdown-item .item-label{color:var(--muted)}
    .breakdown-item .item-val{color:var(--white)}
    .breakdown-item.total{margin-top:.5rem;padding-top:.5rem;border-top:1px solid rgba(255,255,255,0.06)}
    .breakdown-item.total .item-label,.breakdown-item.total .item-val{color:var(--gold);font-weight:500}

    /* ── KOST ── */
    .kost-grid{display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center}
    .kost-gallery-grid{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:180px 180px;gap:4px}
    .kost-gallery-grid img{width:100%;height:100%;object-fit:cover;transition:.3s}
    .kost-gallery-grid img:hover{opacity:.8}
    .facilities-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin:1.5rem 0}
    .facility-item{display:flex;align-items:center;gap:.75rem;padding:.75rem 1rem;background:var(--dark2);border-radius:8px;font-size:.875rem;color:var(--muted)}
    .price-tag{display:inline-flex;align-items:baseline;gap:.5rem;background:rgba(201,168,76,0.08);border:1px solid rgba(201,168,76,0.2);padding:.75rem 1.25rem;border-radius:8px;margin-bottom:1.5rem}
    .price-from{font-size:.8rem;color:var(--muted)}
    .price-amount{font-family:'Playfair Display',serif;font-size:1.5rem;color:var(--gold)}
    .avail-checker{display:flex;gap:.5rem;margin:1rem 0}
    .avail-input{flex:1;background:var(--dark2);border:1px solid rgba(255,255,255,0.1);color:var(--white);padding:10px 14px;border-radius:6px;font-size:.875rem;font-family:'DM Sans',sans-serif;-webkit-appearance:none;appearance:none;outline:none}
    .avail-btn{background:var(--gold);color:var(--dark);padding:10px 20px;border-radius:6px;border:none;cursor:pointer;font-weight:500;font-size:.875rem;white-space:nowrap}
    .avail-result{font-size:.85rem;padding:8px 12px;border-radius:6px;display:none}
    .avail-yes{background:rgba(52,199,89,0.1);border:1px solid rgba(52,199,89,0.3);color:#34C759}
    .avail-no{background:rgba(255,59,48,0.1);border:1px solid rgba(255,59,48,0.3);color:#FF3B30}

    /* ── REVIEWS ── */
    .reviews-section{background:var(--dark2)}
    .review-tabs{display:flex;gap:.5rem}
    .tab-btn{padding:6px 16px;border-radius:20px;border:1px solid rgba(255,255,255,0.1);background:transparent;color:var(--muted);font-size:.8rem;cursor:pointer;transition:.2s;font-family:'DM Sans',sans-serif;letter-spacing:.5px}
    .tab-btn.active{background:var(--gold);border-color:var(--gold);color:var(--dark);font-weight:500}
    .reviews-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem}
    .review-card{background:var(--dark3);border:1px solid rgba(255,255,255,0.06);border-radius:12px;padding:1.5rem;transition:.2s}
    .review-card:hover{border-color:rgba(201,168,76,0.2)}
    .review-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem}
    .reviewer-info{display:flex;align-items:center;gap:.75rem}
    .avatar{width:40px;height:40px;border-radius:50%;background:rgba(201,168,76,0.15);display:flex;align-items:center;justify-content:center;font-weight:500;color:var(--gold);font-size:.875rem;flex-shrink:0}
    .reviewer-name{font-weight:500;font-size:.9rem;color:var(--white)}
    .reviewer-role{font-size:.8rem;color:var(--muted);margin-top:1px}
    .review-badge{font-size:.7rem;padding:3px 10px;border-radius:10px;letter-spacing:.5px;white-space:nowrap}
    .badge-tenda{background:rgba(201,168,76,0.1);color:var(--gold)}
    .badge-kost{background:rgba(52,199,89,0.1);color:#34C759}
    .stars-row{color:var(--gold);font-size:.8rem;margin-bottom:.75rem;letter-spacing:1px}
    .review-text{font-size:.875rem;color:var(--muted);line-height:1.7}
    .review-time{font-size:.75rem;color:rgba(255,255,255,0.25);margin-top:.75rem}
    .rating-summary{display:flex;align-items:center;gap:1.5rem;padding:1.5rem;background:var(--dark3);border-radius:12px;margin-bottom:2rem}
    .rating-big{font-family:'Playfair Display',serif;font-size:3.5rem;color:var(--gold);font-weight:700;line-height:1}
    .rating-stars{font-size:1rem;color:var(--gold);margin:.25rem 0}
    .rating-count{font-size:.8rem;color:var(--muted)}
    .rating-bars{flex:1}
    .rating-bar-row{display:flex;align-items:center;gap:.75rem;margin-bottom:.4rem}
    .bar-label{font-size:.75rem;color:var(--muted);width:20px;text-align:right}
    .bar-track{flex:1;height:4px;background:rgba(255,255,255,0.08);border-radius:2px}
    .bar-fill{height:100%;background:var(--gold);border-radius:2px}
    .bar-pct{font-size:.75rem;color:var(--muted);width:30px}

    /* ── CONTACT ── */
    .contact-info-row{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2.5rem}
    .contact-card{background:var(--dark2);border:1px solid rgba(255,255,255,0.06);border-radius:12px;padding:1.25rem 1.5rem;display:flex;gap:1rem;align-items:flex-start;transition:.2s}
    .contact-card:hover{border-color:rgba(201,168,76,0.2)}
    .contact-icon{width:40px;height:40px;background:rgba(201,168,76,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
    .contact-card h4{font-size:.8rem;letter-spacing:.5px;color:var(--muted);text-transform:uppercase;margin-bottom:.25rem}
    .contact-card p{font-size:.9rem;color:var(--white);line-height:1.5}
    /* ── DUAL MAP ── */
    .dual-map-wrap{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
    .map-box{background:var(--dark2);border:1px solid rgba(255,255,255,0.06);border-radius:16px;overflow:hidden}
    .map-box-header{padding:.9rem 1.25rem;border-bottom:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem}
    .map-box-title{display:flex;align-items:center;gap:.6rem}
    .map-box-icon{width:30px;height:30px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.85rem;flex-shrink:0}
    .map-icon-tenda{background:rgba(201,168,76,0.12)}
    .map-icon-kost{background:rgba(52,199,89,0.12)}
    .map-box-name{font-size:.875rem;font-weight:500;color:var(--white)}
    .map-box-sub{font-size:.72rem;color:var(--muted);margin-top:1px}
    .map-open-link{font-size:.75rem;color:var(--gold);text-decoration:none;letter-spacing:.5px;white-space:nowrap;padding:4px 10px;border:1px solid rgba(201,168,76,0.25);border-radius:4px;transition:.2s}
    .map-open-link:hover{background:rgba(201,168,76,0.08);border-color:var(--gold)}
    .map-frame{border:none;width:100%;height:260px;display:block}

    /* ── BUTTONS ── */
    .wa-btn{display:inline-flex;align-items:center;gap:.5rem;background:#25D366;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;font-size:.875rem;font-weight:500;margin-top:.5rem;transition:.2s}
    .wa-btn:hover{background:#22be5c}
    .wa-btn-full{width:100%;justify-content:center;margin-top:1rem}
    .map-link{font-size:.8rem;color:var(--gold);text-decoration:none;display:inline-block;margin-top:.5rem}
    .map-link:hover{text-decoration:underline}

    /* ── WA FLOAT ── */
    .wa-float{position:fixed;bottom:24px;right:24px;width:52px;height:52px;background:#25D366;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.4rem;text-decoration:none;z-index:999;box-shadow:0 4px 20px rgba(37,211,102,0.3);transition:.3s;animation:pulse 2s infinite}
    @keyframes pulse{0%,100%{box-shadow:0 4px 20px rgba(37,211,102,0.3)}50%{box-shadow:0 4px 30px rgba(37,211,102,0.5)}}
    .wa-float:hover{transform:scale(1.1)}

    /* ── FOOTER ── */
    footer{background:var(--dark2);border-top:1px solid rgba(255,255,255,0.06);padding:2rem;text-align:center;font-size:.8rem;color:rgba(255,255,255,0.3)}
    footer span{color:var(--gold)}

    /* ── ADMIN BUTTON ── */
    .btn-admin{background:transparent;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.35);font-size:.75rem;padding:5px 12px;border-radius:4px;cursor:pointer;font-family:'DM Sans',sans-serif;letter-spacing:.5px;transition:.2s;display:flex;align-items:center;gap:5px;margin-left:.5rem}
    .btn-admin:hover{border-color:rgba(201,168,76,0.4);color:var(--gold)}
    .btn-admin-logout{background:rgba(255,59,48,0.1);border-color:rgba(255,59,48,0.3);color:#ff6b6b}
    .btn-admin-logout:hover{background:rgba(255,59,48,0.2);border-color:#ff6b6b;color:#ff6b6b}
    .admin-indicator{width:6px;height:6px;border-radius:50%;background:#34C759;display:inline-block}

    /* ── MODAL OVERLAY ── */
    .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.75);backdrop-filter:blur(6px);z-index:1000;display:none;align-items:center;justify-content:center}
    .modal-overlay.show{display:flex}
    .modal-box{background:var(--dark2);border:1px solid rgba(201,168,76,0.2);border-radius:16px;padding:2.5rem;width:100%;max-width:380px;margin:1rem;position:relative}
    .modal-close{position:absolute;top:1rem;right:1rem;background:transparent;border:none;color:var(--muted);font-size:1.2rem;cursor:pointer;width:28px;height:28px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:.2s}
    .modal-close:hover{background:rgba(255,255,255,0.08);color:var(--white)}
    .modal-logo{font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--gold);margin-bottom:.25rem;letter-spacing:1px}
    .modal-title{font-size:1.3rem;font-weight:500;color:var(--white);margin-bottom:.25rem}
    .modal-sub{font-size:.8rem;color:var(--muted);margin-bottom:1.75rem}
    .modal-field{margin-bottom:1rem}
    .modal-label{display:block;font-size:.75rem;color:var(--muted);margin-bottom:.4rem;text-transform:uppercase;letter-spacing:.5px}
    .modal-input{width:100%;background:var(--dark3);border:1px solid rgba(255,255,255,0.1);color:var(--white);padding:11px 14px;border-radius:8px;font-size:.9rem;font-family:'DM Sans',sans-serif;outline:none;transition:.2s}
    .modal-input:focus{border-color:var(--gold)}
    .modal-error{font-size:.8rem;color:#ff6b6b;margin-bottom:.75rem;display:none;padding:8px 12px;background:rgba(255,59,48,0.1);border-radius:6px;border:1px solid rgba(255,59,48,0.2)}
    .modal-btn{width:100%;background:var(--gold);color:var(--dark);padding:12px;border-radius:8px;border:none;cursor:pointer;font-size:.9rem;font-weight:500;font-family:'DM Sans',sans-serif;transition:.2s;margin-top:.5rem}
    .modal-btn:hover{background:var(--gold-light)}

    /* ── ADMIN PANEL ── */
    .admin-panel{position:fixed;top:80px;right:1.5rem;width:340px;background:var(--dark2);border:1px solid rgba(201,168,76,0.25);border-radius:16px;z-index:500;display:none;box-shadow:0 20px 60px rgba(0,0,0,0.5);overflow:hidden}
    .admin-panel.show{display:block}
    .admin-panel-header{background:rgba(201,168,76,0.08);padding:1rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.15);display:flex;align-items:center;justify-content:space-between}
    .admin-panel-title{font-size:.85rem;font-weight:500;color:var(--gold);letter-spacing:.5px;display:flex;align-items:center;gap:.5rem}
    .admin-panel-close{background:transparent;border:none;color:var(--muted);font-size:1rem;cursor:pointer;width:26px;height:26px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:.2s}
    .admin-panel-close:hover{background:rgba(255,255,255,0.08);color:var(--white)}
    .admin-panel-body{padding:1.25rem;max-height:70vh;overflow-y:auto}
    .admin-section-label{font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem}
    .admin-section-label::after{content:'';flex:1;height:1px;background:rgba(255,255,255,0.06)}
    .admin-room-row{display:flex;align-items:center;justify-content:space-between;padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,0.04)}
    .admin-room-row:last-child{border-bottom:none}
    .admin-month-name{font-size:.85rem;color:var(--white);min-width:110px}
    .admin-controls{display:flex;align-items:center;gap:.5rem}
    .toggle-wrap{display:flex;align-items:center;gap:.4rem}
    .toggle-label{font-size:.75rem;color:var(--muted)}
    .toggle{position:relative;width:36px;height:20px;cursor:pointer}
    .toggle input{opacity:0;width:0;height:0;position:absolute}
    .toggle-slider{position:absolute;inset:0;background:rgba(255,255,255,0.1);border-radius:10px;transition:.2s}
    .toggle-slider::before{content:'';position:absolute;width:14px;height:14px;left:3px;top:3px;background:var(--muted);border-radius:50%;transition:.2s}
    .toggle input:checked + .toggle-slider{background:rgba(52,199,89,0.3)}
    .toggle input:checked + .toggle-slider::before{transform:translateX(16px);background:#34C759}
    .admin-qty{display:flex;align-items:center;gap:.35rem}
    .admin-qty-btn{width:22px;height:22px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:var(--white);border-radius:4px;font-size:.85rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:.2s;line-height:1}
    .admin-qty-btn:hover{background:rgba(201,168,76,0.2);border-color:var(--gold);color:var(--gold)}
    .admin-qty-num{font-size:.85rem;color:var(--white);min-width:18px;text-align:center}
    .admin-save-btn{width:100%;background:var(--gold);color:var(--dark);padding:10px;border-radius:8px;border:none;cursor:pointer;font-size:.85rem;font-weight:500;font-family:'DM Sans',sans-serif;transition:.2s;margin-top:1rem}
    .admin-save-btn:hover{background:var(--gold-light)}
    .admin-saved-msg{font-size:.8rem;color:#34C759;text-align:center;margin-top:.75rem;display:none}
    .status-dot{width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:.25rem}
    .dot-avail{background:#34C759}
    .dot-full{background:#ff6b6b}

    /* ── INCLUDED BOX ── */
    .included-box{background:var(--dark3);border:1px solid rgba(255,255,255,0.06);border-radius:12px;padding:1.25rem;margin-top:1rem}
    .included-grid{display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.75rem}
    .included-item{font-size:.8rem;color:var(--white)}

    /* ── LUCIDE ICONS ── */
    .lucide{width:20px;height:20px;stroke:#C9A84C;stroke-width:2;}

    /* ── RESPONSIVE ── */
    @media(max-width:900px){
      .hero{grid-template-columns:1fr;min-height:auto}
      .hero-left{padding:3rem 1.5rem}
      h1{font-size:1.9rem}
      .hero-left::after{display:none}
      .hero-right{display:grid;grid-template-columns:1fr 1fr}
      .hero-card{min-height:140px;padding:1.5rem}
      .hero-card h2{font-size:1rem}
      .services-grid{grid-template-columns:1fr}
      .calc-grid,.kost-grid{grid-template-columns:1fr}
      .dual-map-wrap{grid-template-columns:1fr}
      .contact-info-row{grid-template-columns:1fr}
      .reviews-grid{grid-template-columns:1fr}
      .kost-gallery-grid{grid-template-rows:140px 140px}
      section{padding:3rem 1.5rem}
      nav{padding:0 1.5rem}
      .nav-links{display:none;position:absolute;top:64px;left:0;right:0;background:var(--dark2);flex-direction:column;padding:1.5rem;gap:1rem;border-bottom:1px solid rgba(255,255,255,0.06)}
      .nav-links.open{display:flex}
      .hamburger{display:flex}
      .rating-summary{flex-direction:column;gap:1rem}
      .rating-summary>div:first-child{border-right:none;padding-right:0;border-bottom:1px solid rgba(255,255,255,0.08);padding-bottom:1rem}
      .section-header-row{flex-direction:column;align-items:flex-start}
    }
  </style>
</head>
<body>

{{-- ════════════════════════════════════════════════════════════════ --}}
{{-- KONTEN HALAMAN — diisi oleh view yang meng-extend layout ini    --}}
{{-- ════════════════════════════════════════════════════════════════ --}}
@yield('konten')

{{-- ════════════════════════════════════════════════════════════════ --}}
{{-- JAVASCRIPT — diisi oleh view child jika perlu tambahan script   --}}
{{-- ════════════════════════════════════════════════════════════════ --}}
@stack('scripts')

{{-- ─── Lucide Icons ─────────────────────────────────────────────── --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
</body>
</html>