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
    *{margin:0;padding:0;box-sizing:border-box;transition:background .3s ease,color .3s ease,border-color .3s ease,fill .3s ease,stroke .3s ease}
    :root{
      --gold:#C9A84C;--gold-light:#F0D080;
      --bg:#0F0F0F;--nav-bg:rgba(15,15,15,0.95);--hero-bg:linear-gradient(135deg,#0F0F0F 0%,#1a1208 100%);
      --section-bg:#0F0F0F;--card-bg:#1A1A1A;--bg-soft:#242424;--input-bg:#1A1A1A;--input-border:rgba(255,255,255,0.1);
      --text:#FAFAF8;--muted:#999;--card-border:rgba(255,255,255,0.06);--footer-bg:#1A1A1A;--dropdown-bg:#1A1A1A;
      --white:#FAFAF8;--dark:#0F0F0F;--dark2:#1A1A1A;--dark3:#242424;--accent:#E8D5A3;
    }
    .light-mode{
      --bg:#F5F0E8;--nav-bg:#F5F0E8;--hero-bg:#F5F0E8;
      --section-bg:#F5F0E8;--card-bg:#EDE8DE;--bg-soft:#F5F0E8;--input-bg:#EDE8DE;--input-border:rgba(212,207,196,0.8);
      --text:#1a1612;--muted:#5e5350;--card-border:#D4CFC4;--footer-bg:#F5F0E8;--dropdown-bg:#F5F0E8;
      --white:#1a1612;--dark:#1a1612;--dark2:#EDE8DE;--dark3:#F5F0E8;--accent:#E8D5A3;
    }
    .light-mode section{background:#F5F0E8 !important;}
    .light-mode .service-card::before{color:rgba(201,168,76,0.12);}
    .light-mode .hero-watermark{color:rgba(201,168,76,0.12);}
    .light-mode .review-time{color:rgba(26,26,26,0.3);}
    .light-mode .btn-admin{border-color:rgba(26,26,26,0.15);color:rgba(26,26,26,0.85);}
    html{scroll-behavior:smooth}
    body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);overflow-x:hidden;transition:background .3s ease,color .3s ease}

    /* ── NAV ── */
    nav{position:sticky;top:0;z-index:100;background:var(--nav-bg);backdrop-filter:blur(12px);border-bottom:1px solid rgba(201,168,76,0.25);padding:0 2rem;display:flex;align-items:center;justify-content:space-between;height:64px;transition:all .3s}
    .logo{font-family:'Playfair Display',serif;font-size:1.4rem;letter-spacing:2px;color:var(--gold);text-decoration:none}
    .logo span{color:var(--text)}
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
    .nav-dropdown{position:absolute;top:100%;left:50%;transform:translateX(-50%) translateY(15px);background:var(--dropdown-bg);border:1px solid rgba(201,168,76,0.2);border-radius:8px;padding:1rem;width:240px;opacity:0;visibility:hidden;transition:all .3s ease;z-index:101;box-shadow:0 10px 25px rgba(0,0,0,0.5);pointer-events:none;text-align:center}
    .hamburger svg{width:22px;height:22px;stroke:var(--text)}
    @keyframes slideDown{from{opacity:0;transform:translateY(-16px)}to{opacity:1;transform:translateY(0)}}
    .nav-links li:hover .nav-dropdown{opacity:1;visibility:visible;transform:translateX(-50%) translateY(0)}
    .nav-dropdown-title{color:var(--gold);font-size:.9rem;margin-bottom:.3rem;font-weight:500;font-family:'Playfair Display',serif;letter-spacing:1px;text-transform:none}
    .nav-dropdown-desc{color:var(--muted);font-size:.75rem;line-height:1.5;text-transform:none;letter-spacing:0}
    .hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:4px;background:none;border:none}
    .hamburger span{width:22px;height:2px;background:var(--text);transition:.3s;display:block}

    /* ── HERO ── */
    .hero{min-height:720px;display:grid;grid-template-columns:1.1fr .9fr;position:relative;overflow:hidden;background:linear-gradient(135deg,#0f0f0f 0%,#141212 100%);background-image:radial-gradient(circle at top left, rgba(201,168,76,0.12), transparent 18%),radial-gradient(circle at bottom right, rgba(201,168,76,0.08), transparent 20%),linear-gradient(135deg,#0f0f0f 0%,#141212 100%);background-size:cover}
    .hero-pattern{position:absolute;inset:0;background-image:radial-gradient(rgba(201,168,76,0.15) 1px,transparent 1px);background-size:24px 24px;opacity:0.5;pointer-events:none}
    .hero-watermark{position:absolute;right:-5rem;top:50%;transform:translateY(-50%) rotate(90deg);font-family:'Playfair Display',serif;font-size:10rem;color:var(--gold);opacity:0.06;font-weight:900;white-space:nowrap;pointer-events:none;letter-spacing:10px}
    .hero-decor-line{position:absolute;height:1px;background:var(--gold);opacity:0.25;pointer-events:none}
    .line-1{top:15%;right:0;width:40%}
    .line-2{bottom:25%;right:8%;width:20%}
    .hero-left{display:flex;flex-direction:column;justify-content:center;padding:5rem 3rem;position:relative;z-index:2;max-width:700px}
    .hero-sub-wrap{display:flex;align-items:flex-start;gap:1rem;position:relative;margin-bottom:2rem;flex-wrap:wrap}
    .hero-desc-deco{color:var(--gold);flex-shrink:0;display:flex;align-items:center;justify-content:center}
    .hero-desc-deco svg{display:block;width:28px;height:28px;}
    .hero-right{display:grid;gap:1.25rem;align-self:center;position:relative;z-index:2;padding:5rem 0}
    .hero-photo-grid{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:repeat(2,minmax(180px,1fr));gap:1rem;position:relative}
    .hero-photo-card{border-radius:24px;background-size:cover;background-position:center;border:1px solid rgba(201,168,76,0.25);box-shadow:0 20px 40px rgba(0,0,0,0.35);min-height:220px;cursor:pointer;position:relative;overflow:hidden;transition:transform .3s ease;border:none;padding:0;display:flex;align-items:center;justify-content:center}
    .hero-photo-card:hover{transform:translateY(-2px)}
    .hero-photo-card::before{content:'';position:absolute;inset:0;background:rgba(0,0,0,0);transition:background .3s ease;z-index:1}
    .hero-photo-card:hover::before{background:rgba(0,0,0,0.4)}
    .hero-photo-overlay{position:relative;display:flex;align-items:center;justify-content:center;z-index:2}
    .hero-photo-overlay i{width:40px;height:40px;color:#fff;opacity:0;transition:opacity .3s ease}
    .hero-photo-card:hover .hero-photo-overlay i{opacity:1}
    .hero-photo-large{grid-row:1 / span 2;min-height:480px}
    .hero-photo-small{min-height:220px}
    .hero-expertise-card{background:rgba(15,15,15,0.95);border:1px solid rgba(201,168,76,0.35);border-radius:24px;padding:2rem;color:var(--white);box-shadow:0 25px 60px rgba(0,0,0,0.35)}
    .hero-expertise-label{font-size:.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:.75rem;font-weight:600}
    .hero-expertise-copy{font-size:.95rem;line-height:1.6;color:var(--white);margin-bottom:1.5rem}
    .expertise-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
    .expertise-item{display:flex;align-items:center;gap:.85rem;color:var(--white);font-size:.95rem;line-height:1.4}
    .expertise-icon{width:36px;height:36px;border-radius:14px;background:rgba(201,168,76,0.15);display:flex;align-items:center;justify-content:center;color:var(--gold)}
    .expertise-icon i{width:20px;height:20px;display:flex;align-items:center;justify-content:center}
    .hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(201,168,76,0.1);border:1px solid rgba(201,168,76,0.3);color:var(--gold);font-size:.8rem;padding:8px 16px;border-radius:24px;margin-bottom:1.5rem;letter-spacing:1px}
    .star-pulse{display:inline-block;animation:pulseStar 2s infinite}
    @keyframes pulseStar{0%,100%{opacity:1;transform:scale(1)}50%{opacity:0.4;transform:scale(1.3)}}
    h1{font-family:'Playfair Display',serif;font-size:3.2rem;line-height:1.2;margin-bottom:1.2rem;color:var(--text)}
    h1 em{color:var(--gold);font-style:normal}
    .hero-sub{color:var(--muted);font-size:1.05rem;line-height:1.7;margin-bottom:2.5rem;max-width:550px}
    .hero-btns{display:flex;gap:12px;flex-wrap:wrap}
    .btn-gold{background:var(--gold);color:var(--dark);padding:12px 28px;border-radius:4px;text-decoration:none;font-weight:500;font-size:.9rem;transition:all .2s;border:none;cursor:pointer;display:inline-block}
    .btn-gold:hover{background:var(--gold-light);transform:translateY(-1px)}
    .stats-row{display:flex;align-items:center;gap:1.5rem;margin-top:2.5rem;flex-wrap:wrap}
    .stat-item{display:flex;flex-direction:column;align-items:center;background:rgba(26,26,26,0.7);border:1px solid rgba(201,168,76,0.25);border-radius:10px;padding:1.25rem 2rem;min-width:140px;backdrop-filter:blur(5px)}
    .light-mode .stat-item{background:rgba(26,26,26,0.92);border-color:rgba(201,168,76,0.25)}
    .stat-divider{width:1px;height:50px;background:rgba(201,168,76,0.3)}
    .stat-num{font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--gold);font-weight:700}
    .light-mode .stat-label{color:#FFFFFF}
    .stat-label{font-size:.75rem;color:var(--muted);letter-spacing:.5px;margin-top:4px;text-transform:uppercase}
    .hero-bottom-divider{height:1px;background:linear-gradient(to right,transparent,var(--gold),transparent);width:100%;opacity:0.35}

    /* ── SHARED ── */
    section{padding:5rem 2rem}
    .container{max-width:1100px;margin:0 auto}
    .section-label{font-size:.75rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:.75rem}
    h2.section-title{font-family:'Playfair Display',serif;font-size:2.2rem;color:var(--text);margin-bottom:1rem}
    .section-desc{color:var(--muted);max-width:520px;line-height:1.7}
    .section-header-row{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:3rem;flex-wrap:wrap;gap:1rem}

    /* ── SERVICES ── */
    .services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5px;background:rgba(255,255,255,0.06)}
    .service-card{background:var(--card-bg);padding:2.5rem 2rem;position:relative;overflow:hidden;transition:background .3s}
    .service-card::before{content:attr(data-num);position:absolute;top:1.5rem;right:1.5rem;font-family:'Playfair Display',serif;font-size:4rem;color:rgba(201,168,76,0.06);font-weight:900;line-height:1}
    .service-card{background:var(--card-bg);padding:2.5rem 2rem;position:relative;overflow:hidden;transition:background .3s,transform .3s,box-shadow .3s}
    .service-card:hover{background:rgba(201,168,76,0.08);transform:translateY(-8px);box-shadow:0 24px 40px rgba(201,168,76,0.12)}
    .service-card::before{content:attr(data-num);position:absolute;top:1.5rem;right:1.5rem;font-family:'Playfair Display',serif;font-size:4rem;color:rgba(201,168,76,0.06);font-weight:900;line-height:1}
    .service-badge{display:inline-flex;align-items:center;gap:.4rem;background:rgba(201,168,76,0.14);color:var(--gold);font-size:.75rem;font-weight:600;padding:.45rem .75rem;border-radius:999px;margin-bottom:1rem}
    .service-meta{font-size:.9rem;color:var(--muted);margin:1.25rem 0 1rem;line-height:1.6}
    .service-cta{display:inline-flex;align-items:center;gap:.5rem;padding:.8rem 1.1rem;border-radius:999px;border:1px solid rgba(201,168,76,0.35);color:var(--gold);text-decoration:none;font-weight:600;transition:background .2s,transform .2s,box-shadow .2s}
    .service-cta:hover{background:rgba(201,168,76,0.12);transform:translateY(-2px);box-shadow:0 10px 22px rgba(201,168,76,0.12)}
    .service-icon{width:44px;height:44px;background:rgba(201,168,76,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem;font-size:1.2rem}
    .service-card h3{font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--text);margin-bottom:.75rem}
    .service-card p{color:var(--muted);font-size:.875rem;line-height:1.7}
    .service-tag{display:inline-block;margin-top:1rem;font-size:.75rem;color:var(--gold);letter-spacing:1px}

    .scroll-reveal{opacity:0;transform:translateY(30px);will-change:opacity,transform;transition:opacity .6s ease-out,transform .6s ease-out}
    .scroll-reveal[data-reveal-direction="down"]{transform:translateY(30px)}
    .scroll-reveal[data-reveal-direction="up"]{transform:translateY(-30px)}
    .scroll-reveal.reveal-visible{opacity:1;transform:translateY(0)}

    .stats-section{background:rgba(201,168,76,0.04);border:1px solid rgba(201,168,76,0.14);border-radius:24px;padding:3rem 2rem;margin:3rem 0}
    .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem}
    .stats-section .stat-item{background:var(--card-bg);border-color:rgba(201,168,76,0.16);padding:1.5rem;min-height:140px;backdrop-filter:blur(6px)}
    .stats-section .stat-num{font-size:2rem}

    .faq-section{margin-top:3rem}
    .faq-title{font-family:'Playfair Display',serif;font-size:1.4rem;color:var(--text);margin:1rem 0 1.5rem}
    .faq-list{display:grid;gap:1rem}
    .faq-item{background:var(--card-bg);border:1px solid rgba(255,255,255,0.08);border-radius:16px;overflow:hidden;transition:border .2s,box-shadow .2s}
    .faq-item.open{border-color:rgba(201,168,76,0.3);box-shadow:0 18px 30px rgba(201,168,76,0.1)}
    .faq-question{width:100%;display:flex;justify-content:space-between;align-items:center;padding:1.25rem 1.25rem;font-size:1rem;color:var(--text);background:none;border:none;cursor:pointer;text-align:left;font-weight:600}
    .faq-question:hover{color:var(--gold)}
    .faq-toggle-icon{display:inline-flex;align-items:center;justify-content:center;width:1.9rem;height:1.9rem;border-radius:999px;background:rgba(255,255,255,0.08);transition:transform .3s}
    .faq-item.open .faq-toggle-icon{transform:rotate(180deg)}
    .faq-answer{padding:0 1.25rem 1.25rem;font-size:.95rem;color:var(--muted);line-height:1.75;max-height:0;overflow:hidden;opacity:0;transition:max-height .28s ease, opacity .22s ease}
    .faq-item.open .faq-answer{opacity:1}

    /* ── CALCULATOR ── */
    .calculator-section{background:var(--card-bg)}
    .calc-grid{display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start}
    .calc-form{background:var(--card-bg);border:1px solid var(--card-border);border-radius:12px;padding:2rem}
    .form-row{margin-bottom:1.25rem}
    .form-label{display:block;font-size:.8rem;letter-spacing:.5px;color:var(--muted);margin-bottom:.5rem;text-transform:uppercase}
    .form-select,.form-input{width:100%;background:var(--input-bg);border:1px solid var(--input-border);color:var(--text);padding:10px 14px;border-radius:6px;font-size:.9rem;font-family:'DM Sans',sans-serif;outline:none;transition:border .2s;-webkit-appearance:none;appearance:none}
    .form-select:focus,.form-input:focus{border-color:var(--gold)}
    .qty-row{display:flex;align-items:center;gap:12px}
    .qty-btn{width:34px;height:34px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:var(--text);border-radius:6px;font-size:1.1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:.2s}
    .qty-btn:hover{background:rgba(201,168,76,0.2);border-color:var(--gold);color:var(--gold)}
    .qty-display{font-family:'Playfair Display',serif;font-size:1.4rem;color:var(--text);min-width:2rem;text-align:center}
    .calc-result{background:var(--card-bg);border:1px solid rgba(201,168,76,0.2);border-radius:12px;padding:2rem}
    .result-label{font-size:.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:.5rem}
    .result-price{font-family:'Playfair Display',serif;font-size:2.5rem;color:var(--text);margin-bottom:.25rem}
    .result-note{font-size:.8rem;color:var(--muted);line-height:1.6;margin-bottom:1.5rem}
    .price-breakdown{border-top:1px solid var(--card-border);padding-top:1rem;margin-top:1rem}
    .breakdown-item{display:flex;justify-content:space-between;font-size:.85rem;margin-bottom:.5rem}
    .breakdown-item .item-label{color:var(--muted)}
    .breakdown-item .item-val{color:var(--text)}
    .breakdown-item.total{margin-top:.5rem;padding-top:.5rem;border-top:1px solid rgba(255,255,255,0.06)}
    .breakdown-item.total .item-label,.breakdown-item.total .item-val{color:var(--gold);font-weight:500}

    /* ── KOST ── */
    .kost-grid{display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center}
    .kost-gallery-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px}
    .kost-gallery-grid .gallery-thumb{position:relative;display:block;cursor:pointer;overflow:hidden;border-radius:12px;aspect-ratio:4/3;transition:transform .24s ease}
    .kost-gallery-grid .gallery-thumb img{display:block;width:100%;height:100%;object-fit:cover}
    .kost-gallery-grid .gallery-thumb:hover{transform:translateY(-4px)}
    .gallery-overlay{position:absolute;inset:0;background:rgba(0,0,0,0.24);opacity:0;display:flex;align-items:center;justify-content:center;transition:opacity .18s ease}
    .gallery-overlay i{width:32px;height:32px;color:#fff;stroke-width:1.8}
    .gallery-thumb:hover .gallery-overlay{opacity:1}

    @media (max-width: 768px) {
      .kost-gallery-grid{grid-template-columns:repeat(2,1fr);gap:8px}
      .kost-gallery-grid .gallery-thumb{aspect-ratio:4/3;height:150px}
      .kost-gallery-grid .gallery-thumb img{height:100%;width:100%;object-fit:cover}
    }
    .lightbox-overlay{position:fixed;top:0;left:0;width:100vw;height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem;background:rgba(0,0,0,0.95);opacity:0;pointer-events:none;transition:opacity .3s ease;z-index:9999}
    .lightbox-overlay.open{opacity:1;pointer-events:auto}
    .lightbox-inner{position:relative;width:min(90vw,1080px);max-width:90vw;max-height:90vh;display:flex;align-items:center;justify-content:center;overflow:hidden}
    .lightbox-content{position:relative;width:100%;display:flex;align-items:center;justify-content:center}
    .lightbox-content img{max-width:100%;max-height:90vh;object-fit:contain;width:auto;height:auto;border-radius:16px;box-shadow:0 28px 70px rgba(0,0,0,0.5)}
    .lightbox-caption{margin-top:.85rem;font-size:.95rem;color:rgba(255,255,255,0.82);text-align:center}
    .lightbox-close,.lightbox-nav{position:fixed;width:42px;height:42px;border-radius:50%;border:none;background:rgba(0,0,0,0.45);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,transform .2s;z-index:10001}
    .lightbox-close:hover,.lightbox-nav:hover{background:rgba(255,255,255,0.12);transform:scale(1.03)}
    .lightbox-close{top:16px;right:16px}
    .lightbox-nav{top:50%;transform:translateY(-50%)}
    .lightbox-prev{left:16px}
    .lightbox-next{right:16px}
    .price-tag{position:relative;display:inline-flex;align-items:baseline;gap:.5rem;background:rgba(201,168,76,0.08);border:1px solid rgba(201,168,76,0.2);padding:.75rem 1.25rem;border-radius:8px;margin-bottom:1.5rem}
    .price-badge{position:absolute;top:-10px;right:-10px;background:var(--gold);color:#fff;font-size:11px;font-weight:700;padding:5px 10px;border-radius:999px;letter-spacing:.5px;box-shadow:0 0 0 0 rgba(201,168,76,0.3);animation:pulseBadge 2.2s ease-in-out infinite}
    .price-note{font-size:12px;color:var(--gold);font-style:italic;margin-top:-.8rem;margin-bottom:1.25rem}
    .price-from{font-size:.8rem;color:var(--muted)}
    .price-amount{font-family:'Playfair Display',serif;font-size:1.5rem;color:var(--gold)}
    .kost-rating{display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;font-size:.95rem;color:var(--muted)}
    .kost-stars{display:flex;gap:4px;color:var(--gold);font-size:16px;line-height:1}
    .kost-rating-text{font-size:.9rem;color:var(--muted)}
    .gold-divider{height:1px;background:rgba(201,168,76,0.3);margin:1.5rem 0;border-radius:1px}
    .avail-label-row{display:flex;align-items:center;gap:.75rem;font-size:.8rem;color:var(--muted);margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.5px}
    .avail-status-badge{padding:.35rem .75rem;border-radius:999px;font-size:.75rem;font-weight:600;display:inline-flex;align-items:center;gap:.35rem;background:rgba(255,255,255,0.08);color:var(--text);border:1px solid rgba(255,255,255,0.08)}
    .avail-status-badge.available{background:rgba(52,199,89,0.12);border-color:rgba(52,199,89,0.25);color:#34C759;animation:none}
    .avail-status-badge.full{background:rgba(255,59,48,0.12);border-color:rgba(255,59,48,0.25);color:#FF3B30;animation:none}
    .avail-status-badge.default{background:#C9A84C;border-color:rgba(201,168,76,0.4);color:#1F1F1F;animation:pulseBadge 2s ease-in-out infinite}
    .avail-checker{display:flex;gap:.5rem;margin:1rem 0}
    .advantages-section{margin-top:1.5rem}
    .section-title-sm{font-family:'Playfair Display',serif;font-size:1.35rem;color:var(--text);margin:.75rem 0 1rem}
    .advantages-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem}
    .advantage-card{background:var(--card-bg);border:1px solid rgba(201,168,76,0.15);border-radius:16px;padding:1.25rem;transition:transform .3s ease,box-shadow .3s ease,border-color .3s ease;opacity:0;transform:translateY(20px)}
    .advantage-card.visible{opacity:1;transform:translateY(0)}
    .advantage-card:hover{border-color:rgba(201,168,76,0.45);box-shadow:0 18px 40px rgba(201,168,76,0.16);}
    .advantage-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:rgba(201,168,76,0.1);color:var(--gold);margin-bottom:1rem}
    .advantage-card h4{font-size:1rem;color:var(--text);margin-bottom:.45rem}
    .advantage-card p{font-size:.9rem;color:var(--muted);line-height:1.6}
    .facility-item{display:flex;align-items:center;gap:.75rem;padding:.75rem 1rem;background:var(--card-bg);border:1px solid var(--card-border);border-radius:8px;font-size:.875rem;color:var(--muted);transition:all .3s ease;opacity:0;transform:translateY(20px)}
    .facility-item.visible{opacity:1;transform:translateY(0)}
    .facility-item:hover{border-color:var(--gold);box-shadow:0 0 12px rgba(201,168,76,0.3);color:var(--text);background:rgba(201,168,76,0.08)}
    .facility-item:hover i{color:var(--gold)}
    @keyframes pulseBadge{0%,100%{box-shadow:0 0 0 0 rgba(201,168,76,0.35)}50%{box-shadow:0 0 0 8px rgba(201,168,76,0.18)}}
    .avail-input{flex:1;background:var(--input-bg);border:1px solid var(--input-border);color:var(--text);padding:10px 14px;border-radius:6px;font-size:.875rem;font-family:'DM Sans',sans-serif;-webkit-appearance:none;appearance:none;outline:none}
    .avail-btn{background:var(--gold);color:var(--dark);padding:10px 20px;border-radius:6px;border:none;cursor:pointer;font-weight:500;font-size:.875rem;white-space:nowrap}
    .avail-result{font-size:.85rem;padding:8px 12px;border-radius:6px;display:none}
    .avail-yes{background:rgba(52,199,89,0.1);border:1px solid rgba(52,199,89,0.3);color:#34C759}
    .avail-no{background:rgba(255,59,48,0.1);border:1px solid rgba(255,59,48,0.3);color:#FF3B30}

    /* ── REVIEWS ── */
    .reviews-section{background:var(--card-bg)}
    .review-tabs{display:flex;gap:.5rem}
    .tab-btn{padding:6px 16px;border-radius:20px;border:1px solid rgba(255,255,255,0.1);background:transparent;color:var(--muted);font-size:.8rem;cursor:pointer;transition:.2s;font-family:'DM Sans',sans-serif;letter-spacing:.5px}
    .tab-btn.active{background:var(--gold);border-color:var(--gold);color:var(--dark);font-weight:500}
    .reviews-carousel{position:relative;overflow:hidden;margin-top:1.5rem}
    .carousel-header{display:flex;justify-content:flex-end;margin-bottom:1rem}
    .carousel-nav{display:flex;gap:.5rem}
    .carousel-arrow{width:38px;height:38px;border:1px solid rgba(255,255,255,0.1);border-radius:50%;background:var(--card-bg);color:var(--text);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:.2s}
    .carousel-arrow:hover{border-color:var(--gold);background:rgba(201,168,76,0.08)}
    .carousel-arrow i{width:18px;height:18px;display:flex;align-items:center;justify-content:center}
    .reviews-scroll{overflow-x:auto;overflow-y:hidden;scroll-behavior:smooth;-ms-overflow-style:none;scrollbar-width:none;touch-action:pan-y;-webkit-overflow-scrolling:touch}
    .reviews-scroll::-webkit-scrollbar{display:none}
    .reviews-track{display:flex;gap:1.5rem;align-items:stretch}
    .carousel-dots{display:flex;justify-content:center;gap:.45rem;margin-top:1rem}
    .carousel-dot{width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.18);border:none;cursor:pointer;transition:.2s}
    .carousel-dot.active{background:var(--gold);transform:scale(1.2)}
    .review-card{background:var(--card-bg);border:1px solid var(--card-border);border-radius:18px;padding:1.5rem;transition:transform .3s ease,box-shadow .3s ease,border-color .3s ease;min-width:300px;flex:0 0 300px;position:relative;overflow:hidden}
    .review-card:hover{transform:translateY(-6px);border-color:rgba(201,168,76,0.2);box-shadow:0 8px 24px rgba(201,168,76,0.2)}
    .review-card::before{content:'“';position:absolute;top:18px;left:18px;font-size:4rem;color:#C9A84C;opacity:.2;pointer-events:none}
    .review-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem;position:relative;z-index:1}
    .reviewer-info{display:flex;align-items:center;gap:.75rem}
    .avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#C9A84C,#8B6914);display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:.9rem;flex-shrink:0;box-shadow:0 8px 20px rgba(0,0,0,0.08)}
    .reviewer-name{font-weight:600;font-size:.94rem;color:var(--text)}
    .reviewer-role{font-size:.8rem;color:var(--muted);margin-top:2px;display:flex;align-items:center;gap:.4rem}
    .review-verified{display:inline-flex;align-items:center;justify-content:center;width:16px;height:16px;color:#C9A84C}
    .review-verified i{width:14px;height:14px;display:block}
    .review-badge{font-size:.7rem;padding:4px 11px;border-radius:999px;letter-spacing:.4px;white-space:nowrap;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.08)}
    .badge-tenda{background:rgba(201,168,76,0.12);color:var(--gold);border-color:rgba(201,168,76,0.2)}
    .badge-kost{background:rgba(52,199,89,0.12);color:#34C759;border-color:rgba(52,199,89,0.2)}
    .stars-row{color:var(--gold);font-size:.82rem;margin-bottom:.75rem;letter-spacing:1px}
    .review-text{font-size:.9rem;color:var(--muted);line-height:1.75;position:relative;z-index:1}
    .review-time{font-size:.75rem;color:rgba(255,255,255,0.3);margin-top:.9rem;position:relative;z-index:1}
    .light-mode .review-time{color:rgba(26,26,26,0.3)}
    .light-mode .hero{background:#F5F0E8}
    .light-mode .hero h1{color:#1a1612}
    .light-mode .hero-expertise-card{background:#EDE8DE;border-color:rgba(212,207,196,0.8);color:#1a1612;box-shadow:0 20px 40px rgba(0,0,0,0.08)}
    .light-mode .hero-expertise-copy,.light-mode .expertise-item{color:#1a1612}
    .light-mode .hero-expertise-card .expertise-icon{background:rgba(201,168,76,0.15)}
    .light-mode .theme-toggle svg{stroke:#C9A84C}
    .theme-toggle svg{width:18px;height:18px;stroke:#C9A84C}
    .hero-expertise-card{background:rgba(15,15,15,0.95);border:1px solid rgba(201,168,76,0.35);border-radius:24px;padding:1.25rem;color:var(--white);box-shadow:0 25px 60px rgba(0,0,0,0.35)}
    .expertise-item{display:flex;align-items:center;gap:.65rem;color:var(--white);font-size:.9rem;line-height:1.4}
    .expertise-icon{width:30px;height:30px;border-radius:12px;background:rgba(201,168,76,0.15);display:flex;align-items:center;justify-content:center;color:var(--gold)}
    .expertise-icon i{width:18px;height:18px;display:flex;align-items:center;justify-content:center}
    .rating-summary{display:flex;align-items:center;gap:1.5rem;padding:1.5rem;background:var(--card-bg);border-radius:12px;margin-bottom:2rem}
    .rating-stars{font-size:1rem;color:var(--gold);margin:.25rem 0}
    .rating-count{font-size:.8rem;color:var(--muted)}
    .stats-row{display:flex;align-items:center;gap:1.5rem;margin-top:2.5rem;flex-wrap:wrap}
    .stat-item{display:flex;flex-direction:column;align-items:center;background:rgba(26,26,26,0.7);border:1px solid rgba(201,168,76,0.25);border-radius:10px;padding:1.25rem 2rem;min-width:140px;backdrop-filter:blur(5px);transition:all .3s ease}
    .stat-divider{width:1px;height:50px;background:rgba(201,168,76,0.3)}
    .rating-bars{flex:1}
    .rating-bar-row{display:flex;align-items:center;gap:.75rem;margin-bottom:.4rem}
    .bar-label{font-size:.75rem;color:var(--muted);width:20px;text-align:right}
    .bar-track{flex:1;height:4px;background:rgba(255,255,255,0.08);border-radius:2px}
    .bar-fill{height:100%;background:var(--gold);border-radius:2px}
    .bar-pct{font-size:.75rem;color:var(--muted);width:30px}

    /* ── CONTACT ── */
    .contact-info-row{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2.5rem}
    .contact-card{background:var(--card-bg);border:1px solid var(--card-border);border-radius:12px;padding:1.25rem 1.5rem;display:flex;gap:1rem;align-items:flex-start;transition:.2s}
    .contact-card:hover{border-color:rgba(201,168,76,0.2)}
    .contact-icon{width:40px;height:40px;background:rgba(201,168,76,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
    .contact-card h4{font-size:.8rem;letter-spacing:.5px;color:var(--muted);text-transform:uppercase;margin-bottom:.25rem}
    .contact-card p{font-size:.9rem;color:var(--text);line-height:1.5}
    /* ── DUAL MAP ── */
    .dual-map-wrap{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
    .map-box{background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;overflow:hidden}
    .map-box-header{padding:.9rem 1.25rem;border-bottom:1px solid var(--card-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem}
    .map-box-title{display:flex;align-items:center;gap:.6rem}
    .map-box-icon{width:30px;height:30px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.85rem;flex-shrink:0}
    .map-icon-tenda{background:rgba(201,168,76,0.12)}
    .map-icon-kost{background:rgba(52,199,89,0.12)}
    .map-box-name{font-size:.875rem;font-weight:500;color:var(--text)}
    .map-box-sub{font-size:.72rem;color:var(--muted);margin-top:1px}
    .map-open-link{font-size:.75rem;color:var(--gold);text-decoration:none;letter-spacing:.5px;white-space:nowrap;padding:4px 10px;border:1px solid rgba(201,168,76,0.25);border-radius:4px;transition:.2s}
    .map-open-link:hover{background:rgba(201,168,76,0.08);border-color:var(--gold)}
    .map-frame{border:none;width:100%;height:260px;display:block}

    /* ── BUTTONS ── */
    .wa-btn{display:inline-flex;align-items:center;gap:.5rem;background:#25D366;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;font-size:.875rem;font-weight:500;margin-top:.5rem;transition:.2s}
    .wa-btn:hover{background:#22be5c}
    .wa-btn-full{width:100%;justify-content:center;margin-top:1rem}
    
    /* ── COLOR SWATCH GRID ── */
    #colorSwatchGrid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;animation:swatchFadeIn .2s ease-out}
    @keyframes swatchFadeIn{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
    .color-swatch-item{padding:12px;border-radius:8px;background:transparent;border:2px solid rgba(201,168,76,0.2);transition:all .2s ease;cursor:pointer}
    .color-swatch-item:hover{border-color:rgba(201,168,76,0.35);background:rgba(201,168,76,0.03)}
    .color-swatch-item[data-idx][style*="border-color: var(--gold)"]{box-shadow:0 0 8px rgba(201,168,76,0.4)}
    .color-swatch-item[style*="background: rgba(201,168,76, 0.1)"]{box-shadow:0 0 12px rgba(201,168,76,0.5)}
    .color-dot{display:inline-block;width:32px;height:32px;border-radius:8px;border:2px solid transparent;transition:box-shadow .2s ease}
    
    .map-link{font-size:.8rem;color:var(--gold);text-decoration:none;display:inline-block;margin-top:.5rem}
    .map-link:hover{text-decoration:underline}

    /* ── WA FLOAT ── */
    .wa-float{position:fixed;bottom:24px;right:24px;width:52px;height:52px;background:#25D366;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.4rem;text-decoration:none;z-index:999;box-shadow:0 4px 20px rgba(37,211,102,0.3);transition:.3s;animation:pulse 2s infinite}
    @keyframes pulse{0%,100%{box-shadow:0 4px 20px rgba(37,211,102,0.3)}50%{box-shadow:0 4px 30px rgba(37,211,102,0.5)}}
    .wa-float:hover{transform:scale(1.1)}

    /* ── FOOTER ── */
    footer{background:var(--footer-bg);border-top:1px solid var(--card-border);padding:2rem;text-align:center;font-size:.8rem;color:var(--muted)}
    footer span{color:var(--gold)}

    /* ── ADMIN BUTTON ── */
    .btn-admin{background:transparent;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.35);font-size:.75rem;padding:5px 12px;border-radius:4px;cursor:pointer;font-family:'DM Sans',sans-serif;letter-spacing:.5px;transition:.2s;display:flex;align-items:center;gap:5px;margin-left:.5rem}
    .btn-admin:hover{border-color:rgba(201,168,76,0.4);color:var(--gold)}
    #btnAdminLogin{border-color:var(--gold);color:var(--gold);background:transparent}
    #btnAdminLogin:hover{background:rgba(201,168,76,0.08);color:var(--gold)}
    .light-mode .btn-admin{border-color:rgba(26,26,26,0.15);color:rgba(26,26,26,0.85)}
    .theme-toggle{padding:6px 10px;width:auto;min-width:42px;justify-content:center}
    .btn-admin:hover{border-color:rgba(201,168,76,0.4);color:var(--gold)}
    .btn-admin-logout{background:rgba(255,59,48,0.1);border-color:rgba(255,59,48,0.3);color:#ff6b6b}
    .btn-admin-logout:hover{background:rgba(255,59,48,0.2);border-color:#ff6b6b;color:#ff6b6b}
    .admin-indicator{width:6px;height:6px;border-radius:50%;background:#34C759;display:inline-block}

    /* ── MODAL OVERLAY ── */
    .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.75);backdrop-filter:blur(6px);z-index:1000;display:none;align-items:center;justify-content:center}
    .modal-overlay.show{display:flex}
    .modal-box{background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:2.5rem;width:100%;max-width:380px;margin:1rem;position:relative}
    .modal-close{position:absolute;top:1rem;right:1rem;background:transparent;border:none;color:var(--muted);font-size:1.2rem;cursor:pointer;width:28px;height:28px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:.2s}
    .modal-close:hover{background:rgba(255,255,255,0.08);color:var(--text)}
    .modal-logo{font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--gold);margin-bottom:.25rem;letter-spacing:1px}
    .modal-title{font-size:1.3rem;font-weight:500;color:var(--text);margin-bottom:.25rem}
    .modal-sub{font-size:.8rem;color:var(--muted);margin-bottom:1.75rem}
    .modal-field{margin-bottom:1rem}
    .modal-label{display:block;font-size:.75rem;color:var(--muted);margin-bottom:.4rem;text-transform:uppercase;letter-spacing:.5px}
    .modal-input{width:100%;background:var(--input-bg);border:1px solid var(--input-border);color:var(--text);padding:11px 14px;border-radius:8px;font-size:.9rem;font-family:'DM Sans',sans-serif;outline:none;transition:.2s}
    .modal-input:focus{border-color:var(--gold)}
    .modal-error{font-size:.8rem;color:#ff6b6b;margin-bottom:.75rem;display:none;padding:8px 12px;background:rgba(255,59,48,0.1);border-radius:6px;border:1px solid rgba(255,59,48,0.2)}
    .modal-btn{width:100%;background:var(--gold);color:var(--dark);padding:12px;border-radius:8px;border:none;cursor:pointer;font-size:.9rem;font-weight:500;font-family:'DM Sans',sans-serif;transition:.2s;margin-top:.5rem}
    .modal-btn:hover{background:var(--gold-light)}

    /* ── ADMIN PANEL ── */
    .admin-panel{position:fixed;top:80px;right:1.5rem;width:340px;background:var(--card-bg);border:1px solid rgba(201,168,76,0.25);border-radius:16px;z-index:500;display:none;box-shadow:0 20px 60px rgba(0,0,0,0.5);overflow:hidden}
    .admin-panel.show{display:block}
    .admin-panel-header{background:rgba(201,168,76,0.08);padding:1rem 1.25rem;border-bottom:1px solid rgba(201,168,76,0.15);display:flex;align-items:center;justify-content:space-between}
    .admin-panel-title{font-size:.85rem;font-weight:500;color:var(--gold);letter-spacing:.5px;display:flex;align-items:center;gap:.5rem}
    .admin-panel-close{background:transparent;border:none;color:var(--muted);font-size:1rem;cursor:pointer;width:26px;height:26px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:.2s}
    .admin-panel-close:hover{background:rgba(255,255,255,0.08);color:var(--text)}
    .admin-panel-body{padding:1.25rem;max-height:70vh;overflow-y:auto}
    .admin-section-label{font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem}
    .admin-section-label::after{content:'';flex:1;height:1px;background:rgba(255,255,255,0.06)}
    .admin-room-row{display:flex;align-items:center;justify-content:space-between;padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,0.04)}
    .admin-room-row:last-child{border-bottom:none}
    .admin-month-name{font-size:.85rem;color:var(--text);min-width:110px}
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
    .admin-qty-btn{width:22px;height:22px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:var(--text);border-radius:4px;font-size:.85rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:.2s;line-height:1}
    .admin-qty-btn:hover{background:rgba(201,168,76,0.2);border-color:var(--gold);color:var(--gold)}
    .admin-qty-num{font-size:.85rem;color:var(--text);min-width:18px;text-align:center}
    .admin-save-btn{width:100%;background:var(--gold);color:var(--dark);padding:10px;border-radius:8px;border:none;cursor:pointer;font-size:.85rem;font-weight:500;font-family:'DM Sans',sans-serif;transition:.2s;margin-top:1rem}
    .admin-save-btn:hover{background:var(--gold-light)}
    .admin-saved-msg{font-size:.8rem;color:#34C759;text-align:center;margin-top:.75rem;display:none}
    .status-dot{width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:.25rem}
    .dot-avail{background:#34C759}
    .dot-full{background:#ff6b6b}

    /* ── INCLUDED BOX ── */
    .included-box{background:var(--bg-soft);border:1px solid var(--card-border);border-radius:12px;padding:1.25rem;margin-top:1rem}
    .included-grid{display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.75rem}
    .included-item{font-size:.8rem;color:var(--text)}

    /* ── LUCIDE ICONS ── */
    .lucide{width:20px;height:20px;stroke:#C9A84C;stroke-width:2;}

    /* ── RESPONSIVE ── */
    @media(max-width:900px){
      .hero{grid-template-columns:1fr;min-height:auto}
      .hero-left{padding:3rem 1.5rem}
      h1{font-size:1.9rem}
      .hero-left::after{display:none}
      .hero-photo-grid{grid-template-columns:1fr}
      .hero-photo-large{grid-row:auto;min-height:320px}
      .hero-photo-small{min-height:180px}
      .hero-expertise-card{padding:1.75rem}
      .hero-btns{margin-bottom:1rem}
      .hero-sub-wrap{flex-direction:column;align-items:flex-start}
      .hero-sub{max-width:none}
      .hero-desc-deco{margin-top:0.3rem}
      .hero-card{min-height:140px;padding:1.5rem}
      .hero-card h2{font-size:1rem}
      .services-grid{grid-template-columns:1fr}
      .stats-grid{grid-template-columns:1fr}
      .calc-grid,.kost-grid{grid-template-columns:1fr}
      .dual-map-wrap{grid-template-columns:1fr}
      .contact-info-row{grid-template-columns:1fr}
      .reviews-scroll{overflow-x:auto}
      .kost-gallery-grid{grid-template-columns:1fr;grid-template-rows:auto;gap:1rem}
      .advantages-grid{grid-template-columns:1fr}
      .lightbox-inner{width:100%}
      .lightbox-prev{left:8px}
      .lightbox-next{right:8px}
      .lightbox-close{top:8px;right:8px}
      section{padding:3rem 1.5rem}
      nav{padding:0 1.5rem}
      .nav-links{display:none;position:absolute;top:64px;left:0;right:0;background:var(--nav-bg);flex-direction:column;padding:1.5rem;gap:1rem;border-bottom:1px solid rgba(255,255,255,0.06);overflow-y:auto;max-height:calc(100vh - 64px);animation:slideDown .25s ease forwards}
      .nav-links.open{display:flex}
      .hamburger{display:flex}
      .rating-summary{flex-direction:column;gap:1rem}
      .rating-summary>div:first-child{border-right:none;padding-right:0;border-bottom:1px solid rgba(255,255,255,0.08);padding-bottom:1rem}
      .section-header-row{flex-direction:column;align-items:flex-start}
    }
    @media(max-width:768px){
      .hero-left{padding:2rem 1rem}
      h1{font-size:1.75rem}
      .hero-sub{font-size:.98rem}
      .hero-right{padding:2rem 0}
      .hero-expertise-card{padding:1.25rem}
      .expertise-grid{gap:.75rem}
      .stats-row{flex-wrap:nowrap;overflow-x:auto;padding-bottom:1rem;scrollbar-width:none;-ms-overflow-style:none}
      .stats-row::-webkit-scrollbar{display:none}
      .stat-item{min-width:200px}
      .stat-divider{display:none}
      .facilities-grid{grid-template-columns:1fr}
      .kost-gallery-grid{grid-template-columns:1fr;grid-template-rows:auto;gap:1rem}
      .kost-gallery-grid > div{border-radius:8px;overflow:hidden}
      .services-grid{grid-template-columns:1fr}
      .stats-grid{grid-template-columns:1fr}
      .calc-grid{grid-template-columns:1fr}
      .included-grid{grid-template-columns:1fr}
      .contact-info-row{grid-template-columns:1fr}
      .rating-summary{flex-direction:column;gap:1rem}
      .rating-summary>div:first-child{width:100%;border-right:none;padding-right:0;border-bottom:1px solid rgba(255,255,255,0.08);padding-bottom:1rem}
      .rating-bars{padding-left:0}
      .reviews-scroll{padding-bottom:1rem}
      .reviews-track{gap:1rem}
      .review-card{min-width:calc(100vw - 2rem);flex:0 0 calc(100vw - 2rem)}
      .carousel-arrow{width:34px;height:34px}
      .carousel-dot{width:7px;height:7px}
      .nav-links{top:64px;padding:1rem;gap:.75rem;}
      .nav-links a{font-size:.95rem}
      .nav-links .nav-cta{width:100%;text-align:center}
      .btn-gold,.avail-btn,.wa-btn,.modal-btn,.admin-save-btn{width:100%;display:flex;justify-content:center}
      .admin-panel{width:100vw;left:0;right:0;top:64px;border-radius:0;max-width:none;margin:0}
      .admin-panel-header{padding:.85rem 1rem}
      .admin-panel-body{padding:1rem;max-height:75vh}
      .admin-panel-title{font-size:.9rem;gap:.4rem}
      .admin-panel-body button,.admin-panel-body .admin-qty-btn{font-size:.8rem}
      .modal-box{max-width:100%;margin:.5rem}
      section{padding:2rem 1rem}
    }
  </style>
</head>
<body>

{{-- ════════════════════════════════════════════════════════════════ --}}
{{-- KONTEN HALAMAN — diisi oleh view yang meng-extend layout ini    --}}
{{-- ════════════════════════════════════════════════════════════════ --}}
@yield('konten')

<div id="lightboxOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.95); z-index:99999; align-items:center; justify-content:center;">
  <img id="lightboxImg" style="max-width:85vw; max-height:85vh; object-fit:contain; border-radius:8px;">
  <button id="lightboxClose" style="position:fixed; top:20px; right:20px; width:42px; height:42px; border:none; border-radius:50%; background:rgba(0,0,0,0.45); color:#fff; font-size:1.5rem; cursor:pointer;">×</button>
  <button id="lightboxPrev" style="position:fixed; left:16px; top:50%; transform:translateY(-50%); width:42px; height:42px; border:none; border-radius:50%; background:rgba(0,0,0,0.45); color:#fff; font-size:1.5rem; cursor:pointer;">‹</button>
  <button id="lightboxNext" style="position:fixed; right:16px; top:50%; transform:translateY(-50%); width:42px; height:42px; border:none; border-radius:50%; background:rgba(0,0,0,0.45); color:#fff; font-size:1.5rem; cursor:pointer;">›</button>

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