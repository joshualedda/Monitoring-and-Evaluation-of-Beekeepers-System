<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>APIACORE — Smart Apiary Management</title>
  <meta name="description" content="Monitor colonies, track honey production, and support local beekeepers with data-driven insights across the Philippines.">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
  <!-- Phosphor Icons -->
  <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css">

<style>
/* ─── Reset & Base ─────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --honey:      #f4b400;
  --honey-dark: #d9a000;
  --honey-light:#fff8e1;
  --green:      #2e7d32;
  --green-light:#e8f5e9;
  --green-mid:  #43a047;
  --dark:       #1a1a2e;
  --dark2:      #16213e;
  --text:       #374151;
  --muted:      #6b7280;
  --border:     #e5e7eb;
  --white:      #ffffff;
  --radius:     14px;
}
html { scroll-behavior: smooth; }
body { font-family: 'Inter', sans-serif; color: var(--text); background: #fff; overflow-x: hidden; }

/* ─── Scrollbar ─────────────────────────────────────────── */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #f1f1f1; }
::-webkit-scrollbar-thumb { background: var(--honey); border-radius: 4px; }

/* ─── Navbar ─────────────────────────────────────────────── */
.apiary-nav {
  position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
  transition: all .35s ease;
  padding: 18px 0;
  background: transparent;
}
.apiary-nav.scrolled {
  background: rgba(255,255,255,.97);
  backdrop-filter: blur(12px);
  box-shadow: 0 2px 24px rgba(0,0,0,.08);
  padding: 10px 0;
}
.apiary-nav .logo-text {
  font-size: 1.5rem; font-weight: 900; letter-spacing: -.03em;
  color: #fff;
  transition: color .3s;
}
.apiary-nav.scrolled .logo-text { color: var(--dark); }
.logo-bee { color: var(--honey); font-size: 1.4rem; }

.nav-link-item {
  color: rgba(255,255,255,.85) !important; font-weight: 500; font-size: .9rem;
  padding: 6px 14px !important; border-radius: 8px;
  transition: all .2s;
}
.apiary-nav.scrolled .nav-link-item { color: var(--text) !important; }
.nav-link-item:hover { color: var(--honey) !important; background: rgba(244,180,0,.1); }

.btn-nav-login {
  font-size: .85rem; font-weight: 600; padding: 7px 18px; border-radius: 20px;
  border: 1.5px solid rgba(255,255,255,.5); color: #fff;
  background: transparent; transition: all .2s; text-decoration: none; display: inline-block;
}
.apiary-nav.scrolled .btn-nav-login { border-color: var(--border); color: var(--text); }
.btn-nav-login:hover { background: rgba(255,255,255,.15); }
.apiary-nav.scrolled .btn-nav-login:hover { background: var(--honey-light); }

.btn-nav-dashboard {
  font-size: .85rem; font-weight: 700; padding: 7px 20px; border-radius: 20px;
  background: var(--honey); color: var(--dark); border: none;
  text-decoration: none; display: inline-block; transition: all .2s;
  box-shadow: 0 4px 14px rgba(244,180,0,.35);
}
.btn-nav-dashboard:hover { background: var(--honey-dark); transform: translateY(-1px); color: var(--dark); }

/* ─── Hero / Carousel ────────────────────────────────────── */
#heroCarousel { height: 100vh; min-height: 600px; }
.hero-slide {
  height: 100vh; min-height: 600px;
  background-size: cover; background-position: center;
  position: relative; display: flex; align-items: center;
}
.hero-slide::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(26,26,46,.72) 0%, rgba(26,26,46,.3) 60%, rgba(0,0,0,.1) 100%);
}
.hero-slide-1 { background-image: url('https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=1920&q=85&fit=crop'); }
.hero-slide-2 { background-image: url('https://images.unsplash.com/photo-1558642891-54be180ea339?w=1920&q=85&fit=crop'); }
.hero-slide-3 { background-image: url('https://images.unsplash.com/photo-1472723740421-34c888f30a3b?w=1920&q=85&fit=crop'); }

.hero-content { position: relative; z-index: 2; }
.hero-label {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(244,180,0,.2); border: 1px solid rgba(244,180,0,.4);
  color: var(--honey); font-size: .78rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .1em;
  padding: 5px 14px; border-radius: 20px; margin-bottom: 20px;
  backdrop-filter: blur(6px);
}
.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2.4rem, 5.5vw, 4.2rem);
  font-weight: 800; line-height: 1.1;
  color: #fff; margin-bottom: 20px;
}
.hero-title .accent { color: var(--honey); }
.hero-subtitle {
  font-size: clamp(.95rem, 1.8vw, 1.15rem); color: rgba(255,255,255,.8);
  max-width: 540px; line-height: 1.7; margin-bottom: 36px;
}
.btn-hero-primary {
  background: var(--honey); color: var(--dark); font-weight: 700; font-size: .95rem;
  padding: 13px 28px; border-radius: 30px; border: none; text-decoration: none;
  display: inline-flex; align-items: center; gap: 8px;
  box-shadow: 0 8px 24px rgba(244,180,0,.4); transition: all .25s;
}
.btn-hero-primary:hover { background: var(--honey-dark); transform: translateY(-2px); color: var(--dark); }
.btn-hero-outline {
  border: 2px solid rgba(255,255,255,.55); color: #fff; font-weight: 600; font-size: .95rem;
  padding: 11px 28px; border-radius: 30px; text-decoration: none;
  display: inline-flex; align-items: center; gap: 8px; transition: all .25s;
  backdrop-filter: blur(6px); background: rgba(255,255,255,.08);
}
.btn-hero-outline:hover { background: rgba(255,255,255,.18); color: #fff; border-color: rgba(255,255,255,.9); }

/* Carousel controls */
.carousel-control-prev, .carousel-control-next {
  width: 52px; height: 52px; background: rgba(255,255,255,.12);
  border-radius: 50%; top: 50%; transform: translateY(-50%);
  position: absolute; border: 1.5px solid rgba(255,255,255,.25);
  backdrop-filter: blur(8px); transition: all .2s;
}
.carousel-control-prev { left: 24px; }
.carousel-control-next { right: 24px; }
.carousel-control-prev:hover, .carousel-control-next:hover { background: rgba(244,180,0,.35); }
.carousel-indicators { bottom: 20px; }
.carousel-indicators [data-bs-target] {
  width: 8px; height: 8px; border-radius: 50%; border: none;
  background: rgba(255,255,255,.4); transition: all .3s;
}
.carousel-indicators .active { background: var(--honey); width: 24px; border-radius: 4px; }

/* ─── Stats strip ────────────────────────────────────────── */
.stats-strip {
  background: var(--dark);
  padding: 28px 0;
}
.stat-item { text-align: center; }
.stat-num { font-size: 2rem; font-weight: 800; color: var(--honey); line-height: 1; }
.stat-lbl { font-size: .78rem; color: rgba(255,255,255,.55); font-weight: 500; margin-top: 4px; text-transform: uppercase; letter-spacing: .06em; }

/* ─── Section commons ────────────────────────────────────── */
.section-label {
  font-size: .72rem; font-weight: 800; letter-spacing: .18em; text-transform: uppercase;
  color: var(--honey); display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px;
}
.section-label::after { content: ''; display: inline-block; width: 32px; height: 2px; background: var(--honey); border-radius: 2px; }
.section-heading { font-family: 'Playfair Display', serif; font-weight: 800; color: var(--dark); line-height: 1.2; }
.section-sub { color: var(--muted); line-height: 1.75; max-width: 560px; margin: 0 auto; }

/* ─── Why APIACORE ───────────────────────────────────────── */
.why-section { background: #f9fafb; padding: 96px 0; }
.feature-card {
  background: #fff; border-radius: var(--radius); padding: 32px 28px;
  border: 1px solid var(--border); transition: all .25s; height: 100%;
  position: relative; overflow: hidden;
}
.feature-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, var(--honey), var(--green-mid));
  transform: scaleX(0); transform-origin: left; transition: transform .3s;
}
.feature-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,.08); border-color: transparent; }
.feature-card:hover::before { transform: scaleX(1); }
.feature-icon {
  width: 56px; height: 56px; border-radius: 14px; display: flex;
  align-items: center; justify-content: center; font-size: 1.6rem;
  margin-bottom: 20px;
}
.feature-card h4 { font-size: 1.05rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; }
.feature-card p { font-size: .88rem; color: var(--muted); line-height: 1.7; margin: 0; }

/* Honeycomb pattern bg */
.honeycomb-bg {
  background-color: #f9fafb;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='56' height='100'%3E%3Cpath d='M28 66L0 50V18L28 2l28 16v32L28 66zm0-6l22-12.7V22.7L28 10 6 22.7v24.6L28 60z' fill='%23f4b400' fill-opacity='0.05'/%3E%3C/svg%3E");
}

/* ─── Products Section ───────────────────────────────────── */
.products-section { padding: 96px 0; background: #fff; }
.product-card {
  background: #fff; border-radius: var(--radius); overflow: hidden;
  border: 1px solid var(--border); transition: all .25s; height: 100%;
}
.product-card:hover { transform: translateY(-6px); box-shadow: 0 24px 48px rgba(0,0,0,.1); border-color: transparent; }
.product-img-wrap { position: relative; overflow: hidden; height: 220px; }
.product-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
.product-card:hover .product-img-wrap img { transform: scale(1.06); }
.product-badge {
  position: absolute; top: 12px; right: 12px;
  font-size: .68rem; font-weight: 700; padding: 4px 10px; border-radius: 20px;
}
.badge-instock  { background: rgba(46,125,50,.12); color: #2e7d32; border: 1px solid rgba(46,125,50,.2); }
.badge-low      { background: rgba(244,180,0,.15);  color: #b08000; border: 1px solid rgba(244,180,0,.3); }
.badge-soldout  { background: rgba(220,53,69,.1);  color: #c62828; border: 1px solid rgba(220,53,69,.2); }
.product-body { padding: 20px; }
.product-name { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
.product-sub  { font-size: .8rem; color: var(--muted); margin-bottom: 14px; }
.btn-product {
  font-size: .8rem; font-weight: 600; padding: 7px 18px; border-radius: 20px;
  border: 1.5px solid var(--honey); color: var(--dark); background: var(--honey-light);
  text-decoration: none; display: inline-block; transition: all .2s;
}
.btn-product:hover { background: var(--honey); color: var(--dark); }

/* ─── CTA Section ────────────────────────────────────────── */
.cta-section {
  background: linear-gradient(135deg, var(--dark) 0%, var(--dark2) 100%);
  padding: 96px 0; position: relative; overflow: hidden;
}
.cta-section::before {
  content: '';
  position: absolute; top: -60px; right: -60px;
  width: 400px; height: 400px;
  background: radial-gradient(circle, rgba(244,180,0,.15) 0%, transparent 70%);
  border-radius: 50%;
}
.cta-section::after {
  content: '';
  position: absolute; bottom: -80px; left: -40px;
  width: 300px; height: 300px;
  background: radial-gradient(circle, rgba(46,125,50,.12) 0%, transparent 70%);
  border-radius: 50%;
}
.cta-section .position-relative { position: relative; z-index: 2; }
.btn-cta {
  font-size: 1rem; font-weight: 700; padding: 14px 36px; border-radius: 30px;
  background: var(--honey); color: var(--dark); border: none;
  text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  box-shadow: 0 10px 30px rgba(244,180,0,.35);
  transition: all .25s;
}
.btn-cta:hover { background: var(--honey-dark); transform: translateY(-2px); color: var(--dark); }

/* ─── Footer ─────────────────────────────────────────────── */
.site-footer {
  background: #0f172a; padding: 60px 0 24px;
}
.footer-logo { font-size: 1.4rem; font-weight: 900; color: #fff; letter-spacing: -.03em; }
.footer-desc { font-size: .88rem; color: rgba(255,255,255,.5); line-height: 1.7; margin-top: 10px; }
.footer-heading { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: rgba(255,255,255,.4); margin-bottom: 14px; }
.footer-link { font-size: .88rem; color: rgba(255,255,255,.6); text-decoration: none; display: block; margin-bottom: 8px; transition: color .2s; }
.footer-link:hover { color: var(--honey); }
.footer-divider { border-color: rgba(255,255,255,.07); margin: 40px 0 20px; }
.footer-copy { font-size: .8rem; color: rgba(255,255,255,.3); }
.footer-social a {
  width: 36px; height: 36px; border-radius: 50%;
  background: rgba(255,255,255,.06); color: rgba(255,255,255,.5);
  display: inline-flex; align-items: center; justify-content: center;
  text-decoration: none; font-size: 1rem; transition: all .2s; margin-left: 8px;
}
.footer-social a:hover { background: var(--honey); color: var(--dark); }

/* ─── Scroll-in Animation ────────────────────────────────── */
.reveal { opacity: 0; transform: translateY(30px); transition: opacity .6s ease, transform .6s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }

/* ─── Mobile Nav Toggler ────────────────────────────────── */
.navbar-toggler { border: 1.5px solid rgba(255,255,255,.4); padding: 5px 10px; }
.navbar-toggler-icon { filter: invert(1); }
.apiary-nav.scrolled .navbar-toggler { border-color: var(--border); }
.apiary-nav.scrolled .navbar-toggler-icon { filter: none; }
</style>
</head>
<body>

<!-- ══════════════════════════════════════
     NAVBAR
══════════════════════════════════════ -->
<nav class="apiary-nav navbar navbar-expand-lg" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url('website/index'); ?>">
      <span class="logo-text">🐝 APIACORE</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/index'); ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/news'); ?>">News</a></li>
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/about'); ?>">About</a></li>
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/contact'); ?>">Contact</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <a href="<?php echo base_url('auth/login'); ?>" class="btn-nav-login">Log In</a>
        <a href="<?php echo base_url('auth/login'); ?>" class="btn-nav-dashboard">
          <i class="ph ph-layout me-1"></i> Dashboard Access
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- ══════════════════════════════════════
     HERO CAROUSEL
══════════════════════════════════════ -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5500">
  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="hero-slide hero-slide-1">
        <div class="hero-content container text-white">
          <div class="hero-label"><span>📊</span> NARTDI - DMMMSU</div>
          <h1 class="hero-title">Monitoring & Evaluation of <br><span class="accent">Beekeepers</span> System.</h1>
          <p class="hero-subtitle">Digitizing the monitoring process and evaluation of beekeepers to empower the Philippine apiculture industry with data-driven insights.</p>
          <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo base_url('website/news'); ?>" class="btn-hero-primary"><i class="ph ph-newspaper"></i> Latest Updates</a>
            <a href="<?php echo base_url('website/about'); ?>" class="btn-hero-outline"><i class="ph ph-info"></i> Our Mission</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="hero-slide hero-slide-2">
        <div class="hero-content container text-white">
          <div class="hero-label"><span>🐝</span> Apiculture Development</div>
          <h1 class="hero-title">Empowering Beekeepers,<br><span class="accent">Strengthening</span> Communities.</h1>
          <p class="hero-subtitle">Our evaluation system ensures that every beekeeper receives the support they need to sustain and grow their operations.</p>
          <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo base_url('website/news'); ?>" class="btn-hero-primary"><i class="ph ph-newspaper"></i> Read News</a>
            <a href="<?php echo base_url('auth/login'); ?>" class="btn-hero-outline"><i class="ph ph-layout"></i> Access Portal</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <div class="hero-slide hero-slide-3">
        <div class="hero-content container text-white">
          <div class="hero-label"><span>📈</span> Data-Driven Growth</div>
          <h1 class="hero-title">Tracking Progress,<br><span class="accent">Evaluating</span> Success.</h1>
          <p class="hero-subtitle">Comprehensive metrics and monitoring for a more efficient and impactful apiculture development program.</p>
          <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo base_url('auth/login'); ?>" class="btn-hero-primary"><i class="ph ph-sign-in"></i> Get Started</a>
            <a href="<?php echo base_url('website/about'); ?>" class="btn-hero-outline"><i class="ph ph-info"></i> Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <i class="ph ph-caret-left text-white" style="font-size:1.3rem;"></i>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <i class="ph ph-caret-right text-white" style="font-size:1.3rem;"></i>
  </button>
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
  </div>
</div>

<!-- ══════════════════════════════════════
     STATS STRIP
══════════════════════════════════════ -->
<section class="stats-strip">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num"><?php echo $total_beekeeper ?? '120+'; ?></div>
          <div class="stat-lbl">Active Beekeepers</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num"><?php echo $total_news ?? '50+'; ?></div>
          <div class="stat-lbl">Latest Updates</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num">NARTDI</div>
          <div class="stat-lbl">Leading Institute</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num">🇵🇭</div>
          <div class="stat-lbl">National Scope</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     WHY APIACORE
══════════════════════════════════════ -->
<section class="why-section honeycomb-bg">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <div class="section-label justify-content-center">Core Objectives</div>
      <h2 class="section-heading fs-1 mb-3">Monitoring & Evaluation</h2>
      <p class="section-sub">Empowering beekeepers through a structured system of assessment, support, and resource management.</p>
    </div>
    <div class="row g-4">
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.05s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#fff8e1;">📑</div>
          <h4>Systematic Monitoring</h4>
          <p>Regular assessments of beekeeper profiles and operational progress to ensure program alignment.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.1s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#e8f5e9;">📊</div>
          <h4>Effective Evaluation</h4>
          <p>Data-driven evaluation of impact and beekeeping success rates across different associations.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.15s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#e8f5e9;">🌱</div>
          <h4>Growth & Sustainability</h4>
          <p>Identifying key needs and providing beekeepers with targeted training and sustainable resources.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.2s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#fff8e1;">💡</div>
          <h4>Resource Optimization</h4>
          <p>Ensuring efficient allocation of apiculture resources through precise beekeeper monitoring data.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     LATEST NEWS SECTION
══════════════════════════════════════ -->
<section class="products-section">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <div class="section-label justify-content-center">Latest News</div>
      <h2 class="section-heading fs-1 mb-3">System Updates & News</h2>
      <p class="section-sub">Stay informed with the latest announcements, training updates, and progress reports from NARTDI.</p>
    </div>
    <div class="row g-4">

      <?php if(!empty($latest_news)): ?>
        <?php foreach($latest_news as $post): ?>
          <div class="col-md-4 reveal">
            <div class="product-card h-100">
              <div class="product-img-wrap" style="height: 200px;">
                <?php if($post['post_image'] && $post['post_image'] != 'noimage.jpg'): ?>
                  <img src="<?php echo base_url('upload/posts/'.$post['post_image']); ?>" alt="<?php echo $post['post_title']; ?>">
                <?php else: ?>
                  <img src="https://images.unsplash.com/photo-1472723740421-34c888f30a3b?w=600&q=80&fit=crop" alt="Placeholder">
                <?php endif; ?>
                <span class="product-badge badge-instock"><?php echo $post['name']; ?></span>
              </div>
              <div class="product-body d-flex flex-column">
                <div class="product-name fs-5"><?php echo $post['post_title']; ?></div>
                <div class="product-sub flex-grow-1">
                  <?php 
                    $text = strip_tags($post['post_text']);
                    echo (strlen($text) > 100) ? substr($text, 0, 100) . '...' : $text; 
                  ?>
                </div>
                <div class="mt-3">
                  <a href="<?php echo base_url('website/view_news/'.$post['post_id']); ?>" class="btn-product">Read More <i class="ph ph-arrow-right ms-1"></i></a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5">
           <i class="ph ph-newspaper-clipping fs-1 text-muted opacity-25"></i>
           <p class="text-muted mt-3">No recent updates available at the moment.</p>
        </div>
      <?php endif; ?>

    </div>
    
    <div class="text-center mt-5 reveal">
      <a href="<?php echo base_url('website/news'); ?>" class="btn btn-outline-primary rounded-pill px-4 py-2">
        View All News <i class="ph ph-arrow-right ms-1"></i>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     CTA SECTION
══════════════════════════════════════ -->
<section class="cta-section">
  <div class="container position-relative text-center">
    <div class="reveal">
      <span style="font-size:3rem;">📊</span>
      <h2 class="section-heading text-white fs-1 mt-3 mb-3">Join the Evaluation System</h2>
      <p class="text-white-50 mb-5 fs-5" style="max-width:500px;margin:0 auto 32px;">
        Registered beekeepers and administrators can access the system to track progress and generate impact reports.
      </p>
      <a href="<?php echo base_url('auth/login'); ?>" class="btn-cta">
        <i class="ph ph-sign-in"></i> Administrator/Staff Login
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     FOOTER
══════════════════════════════════════ -->
<footer class="site-footer">
  <div class="container">
    <div class="row g-5 mb-4">
      <div class="col-lg-4">
        <div class="footer-logo">🐝 APIACORE</div>
        <p class="footer-desc mt-2">
          A smart apiary management platform supporting Philippine beekeepers with real-time monitoring, colony tracking, and data-driven honey production insights.
        </p>
        <div class="footer-social mt-3">
          <a href="#" title="Facebook"><i class="ph ph-facebook-logo"></i></a>
          <a href="#" title="Twitter"><i class="ph ph-twitter-logo"></i></a>
          <a href="#" title="Instagram"><i class="ph ph-instagram-logo"></i></a>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="footer-heading">Quick Links</div>
        <a href="<?php echo base_url('website/index'); ?>" class="footer-link">Home</a>
        <a href="<?php echo base_url('website/news'); ?>" class="footer-link">News & Updates</a>
        <a href="<?php echo base_url('website/about'); ?>" class="footer-link">About NARTDI</a>
        <a href="<?php echo base_url('website/contact'); ?>" class="footer-link">Contact Us</a>
      </div>
      <div class="col-6 col-lg-3">
        <div class="footer-heading">Management</div>
        <a href="<?php echo base_url('auth/login'); ?>" class="footer-link">Dashboard Login</a>
        <a href="<?php echo base_url('beekeeper/'); ?>" class="footer-link">Beekeepers List</a>
        <a href="<?php echo base_url('production/'); ?>" class="footer-link">Production Data</a>
      </div>
      <div class="col-6 col-lg-2">
        <div class="footer-heading">Support</div>
        <a href="<?php echo b<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>APIACORE — Smart Apiary Management</title>
  <meta name="description" content="Monitor colonies, track honey production, and support local beekeepers with data-driven insights across the Philippines.">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
  <!-- Phosphor Icons -->
  <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css">

<style>
/* ─── Reset & Base ─────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --honey:      #f4b400;
  --honey-dark: #d9a000;
  --honey-light:#fff8e1;
  --green:      #2e7d32;
  --green-light:#e8f5e9;
  --green-mid:  #43a047;
  --dark:       #1a1a2e;
  --dark2:      #16213e;
  --text:       #374151;
  --muted:      #6b7280;
  --border:     #e5e7eb;
  --white:      #ffffff;
  --radius:     14px;
}
html { scroll-behavior: smooth; }
body { font-family: 'Inter', sans-serif; color: var(--text); background: #fff; overflow-x: hidden; }

/* ─── Scrollbar ─────────────────────────────────────────── */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #f1f1f1; }
::-webkit-scrollbar-thumb { background: var(--honey); border-radius: 4px; }

/* ─── Navbar ─────────────────────────────────────────────── */
.apiary-nav {
  position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
  transition: all .35s ease;
  padding: 18px 0;
  background: transparent;
}
.apiary-nav.scrolled {
  background: rgba(255,255,255,.97);
  backdrop-filter: blur(12px);
  box-shadow: 0 2px 24px rgba(0,0,0,.08);
  padding: 10px 0;
}
.apiary-nav .logo-text {
  font-size: 1.5rem; font-weight: 900; letter-spacing: -.03em;
  color: #fff;
  transition: color .3s;
}
.apiary-nav.scrolled .logo-text { color: var(--dark); }
.logo-bee { color: var(--honey); font-size: 1.4rem; }

.nav-link-item {
  color: rgba(255,255,255,.85) !important; font-weight: 500; font-size: .9rem;
  padding: 6px 14px !important; border-radius: 8px;
  transition: all .2s;
}
.apiary-nav.scrolled .nav-link-item { color: var(--text) !important; }
.nav-link-item:hover { color: var(--honey) !important; background: rgba(244,180,0,.1); }

.btn-nav-login {
  font-size: .85rem; font-weight: 600; padding: 7px 18px; border-radius: 20px;
  border: 1.5px solid rgba(255,255,255,.5); color: #fff;
  background: transparent; transition: all .2s; text-decoration: none; display: inline-block;
}
.apiary-nav.scrolled .btn-nav-login { border-color: var(--border); color: var(--text); }
.btn-nav-login:hover { background: rgba(255,255,255,.15); }
.apiary-nav.scrolled .btn-nav-login:hover { background: var(--honey-light); }

.btn-nav-dashboard {
  font-size: .85rem; font-weight: 700; padding: 7px 20px; border-radius: 20px;
  background: var(--honey); color: var(--dark); border: none;
  text-decoration: none; display: inline-block; transition: all .2s;
  box-shadow: 0 4px 14px rgba(244,180,0,.35);
}
.btn-nav-dashboard:hover { background: var(--honey-dark); transform: translateY(-1px); color: var(--dark); }

/* ─── Hero / Carousel ────────────────────────────────────── */
#heroCarousel { height: 100vh; min-height: 600px; }
.hero-slide {
  height: 100vh; min-height: 600px;
  background-size: cover; background-position: center;
  position: relative; display: flex; align-items: center;
}
.hero-slide::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(26,26,46,.72) 0%, rgba(26,26,46,.3) 60%, rgba(0,0,0,.1) 100%);
}
.hero-slide-1 { background-image: url('https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=1920&q=85&fit=crop'); }
.hero-slide-2 { background-image: url('https://images.unsplash.com/photo-1558642891-54be180ea339?w=1920&q=85&fit=crop'); }
.hero-slide-3 { background-image: url('https://images.unsplash.com/photo-1472723740421-34c888f30a3b?w=1920&q=85&fit=crop'); }

.hero-content { position: relative; z-index: 2; }
.hero-label {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(244,180,0,.2); border: 1px solid rgba(244,180,0,.4);
  color: var(--honey); font-size: .78rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .1em;
  padding: 5px 14px; border-radius: 20px; margin-bottom: 20px;
  backdrop-filter: blur(6px);
}
.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2.4rem, 5.5vw, 4.2rem);
  font-weight: 800; line-height: 1.1;
  color: #fff; margin-bottom: 20px;
}
.hero-title .accent { color: var(--honey); }
.hero-subtitle {
  font-size: clamp(.95rem, 1.8vw, 1.15rem); color: rgba(255,255,255,.8);
  max-width: 540px; line-height: 1.7; margin-bottom: 36px;
}
.btn-hero-primary {
  background: var(--honey); color: var(--dark); font-weight: 700; font-size: .95rem;
  padding: 13px 28px; border-radius: 30px; border: none; text-decoration: none;
  display: inline-flex; align-items: center; gap: 8px;
  box-shadow: 0 8px 24px rgba(244,180,0,.4); transition: all .25s;
}
.btn-hero-primary:hover { background: var(--honey-dark); transform: translateY(-2px); color: var(--dark); }
.btn-hero-outline {
  border: 2px solid rgba(255,255,255,.55); color: #fff; font-weight: 600; font-size: .95rem;
  padding: 11px 28px; border-radius: 30px; text-decoration: none;
  display: inline-flex; align-items: center; gap: 8px; transition: all .25s;
  backdrop-filter: blur(6px); background: rgba(255,255,255,.08);
}
.btn-hero-outline:hover { background: rgba(255,255,255,.18); color: #fff; border-color: rgba(255,255,255,.9); }

/* Carousel controls */
.carousel-control-prev, .carousel-control-next {
  width: 52px; height: 52px; background: rgba(255,255,255,.12);
  border-radius: 50%; top: 50%; transform: translateY(-50%);
  position: absolute; border: 1.5px solid rgba(255,255,255,.25);
  backdrop-filter: blur(8px); transition: all .2s;
}
.carousel-control-prev { left: 24px; }
.carousel-control-next { right: 24px; }
.carousel-control-prev:hover, .carousel-control-next:hover { background: rgba(244,180,0,.35); }
.carousel-indicators { bottom: 20px; }
.carousel-indicators [data-bs-target] {
  width: 8px; height: 8px; border-radius: 50%; border: none;
  background: rgba(255,255,255,.4); transition: all .3s;
}
.carousel-indicators .active { background: var(--honey); width: 24px; border-radius: 4px; }

/* ─── Stats strip ────────────────────────────────────────── */
.stats-strip {
  background: var(--dark);
  padding: 28px 0;
}
.stat-item { text-align: center; }
.stat-num { font-size: 2rem; font-weight: 800; color: var(--honey); line-height: 1; }
.stat-lbl { font-size: .78rem; color: rgba(255,255,255,.55); font-weight: 500; margin-top: 4px; text-transform: uppercase; letter-spacing: .06em; }

/* ─── Section commons ────────────────────────────────────── */
.section-label {
  font-size: .72rem; font-weight: 800; letter-spacing: .18em; text-transform: uppercase;
  color: var(--honey); display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px;
}
.section-label::after { content: ''; display: inline-block; width: 32px; height: 2px; background: var(--honey); border-radius: 2px; }
.section-heading { font-family: 'Playfair Display', serif; font-weight: 800; color: var(--dark); line-height: 1.2; }
.section-sub { color: var(--muted); line-height: 1.75; max-width: 560px; margin: 0 auto; }

/* ─── Why APIACORE ───────────────────────────────────────── */
.why-section { background: #f9fafb; padding: 96px 0; }
.feature-card {
  background: #fff; border-radius: var(--radius); padding: 32px 28px;
  border: 1px solid var(--border); transition: all .25s; height: 100%;
  position: relative; overflow: hidden;
}
.feature-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, var(--honey), var(--green-mid));
  transform: scaleX(0); transform-origin: left; transition: transform .3s;
}
.feature-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,.08); border-color: transparent; }
.feature-card:hover::before { transform: scaleX(1); }
.feature-icon {
  width: 56px; height: 56px; border-radius: 14px; display: flex;
  align-items: center; justify-content: center; font-size: 1.6rem;
  margin-bottom: 20px;
}
.feature-card h4 { font-size: 1.05rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; }
.feature-card p { font-size: .88rem; color: var(--muted); line-height: 1.7; margin: 0; }

/* Honeycomb pattern bg */
.honeycomb-bg {
  background-color: #f9fafb;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='56' height='100'%3E%3Cpath d='M28 66L0 50V18L28 2l28 16v32L28 66zm0-6l22-12.7V22.7L28 10 6 22.7v24.6L28 60z' fill='%23f4b400' fill-opacity='0.05'/%3E%3C/svg%3E");
}

/* ─── Products Section ───────────────────────────────────── */
.products-section { padding: 96px 0; background: #fff; }
.product-card {
  background: #fff; border-radius: var(--radius); overflow: hidden;
  border: 1px solid var(--border); transition: all .25s; height: 100%;
}
.product-card:hover { transform: translateY(-6px); box-shadow: 0 24px 48px rgba(0,0,0,.1); border-color: transparent; }
.product-img-wrap { position: relative; overflow: hidden; height: 220px; }
.product-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
.product-card:hover .product-img-wrap img { transform: scale(1.06); }
.product-badge {
  position: absolute; top: 12px; right: 12px;
  font-size: .68rem; font-weight: 700; padding: 4px 10px; border-radius: 20px;
}
.badge-instock  { background: rgba(46,125,50,.12); color: #2e7d32; border: 1px solid rgba(46,125,50,.2); }
.badge-low      { background: rgba(244,180,0,.15);  color: #b08000; border: 1px solid rgba(244,180,0,.3); }
.badge-soldout  { background: rgba(220,53,69,.1);  color: #c62828; border: 1px solid rgba(220,53,69,.2); }
.product-body { padding: 20px; }
.product-name { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
.product-sub  { font-size: .8rem; color: var(--muted); margin-bottom: 14px; }
.btn-product {
  font-size: .8rem; font-weight: 600; padding: 7px 18px; border-radius: 20px;
  border: 1.5px solid var(--honey); color: var(--dark); background: var(--honey-light);
  text-decoration: none; display: inline-block; transition: all .2s;
}
.btn-product:hover { background: var(--honey); color: var(--dark); }

/* ─── CTA Section ────────────────────────────────────────── */
.cta-section {
  background: linear-gradient(135deg, var(--dark) 0%, var(--dark2) 100%);
  padding: 96px 0; position: relative; overflow: hidden;
}
.cta-section::before {
  content: '';
  position: absolute; top: -60px; right: -60px;
  width: 400px; height: 400px;
  background: radial-gradient(circle, rgba(244,180,0,.15) 0%, transparent 70%);
  border-radius: 50%;
}
.cta-section::after {
  content: '';
  position: absolute; bottom: -80px; left: -40px;
  width: 300px; height: 300px;
  background: radial-gradient(circle, rgba(46,125,50,.12) 0%, transparent 70%);
  border-radius: 50%;
}
.cta-section .position-relative { position: relative; z-index: 2; }
.btn-cta {
  font-size: 1rem; font-weight: 700; padding: 14px 36px; border-radius: 30px;
  background: var(--honey); color: var(--dark); border: none;
  text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  box-shadow: 0 10px 30px rgba(244,180,0,.35);
  transition: all .25s;
}
.btn-cta:hover { background: var(--honey-dark); transform: translateY(-2px); color: var(--dark); }

/* ─── Footer ─────────────────────────────────────────────── */
.site-footer {
  background: #0f172a; padding: 60px 0 24px;
}
.footer-logo { font-size: 1.4rem; font-weight: 900; color: #fff; letter-spacing: -.03em; }
.footer-desc { font-size: .88rem; color: rgba(255,255,255,.5); line-height: 1.7; margin-top: 10px; }
.footer-heading { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: rgba(255,255,255,.4); margin-bottom: 14px; }
.footer-link { font-size: .88rem; color: rgba(255,255,255,.6); text-decoration: none; display: block; margin-bottom: 8px; transition: color .2s; }
.footer-link:hover { color: var(--honey); }
.footer-divider { border-color: rgba(255,255,255,.07); margin: 40px 0 20px; }
.footer-copy { font-size: .8rem; color: rgba(255,255,255,.3); }
.footer-social a {
  width: 36px; height: 36px; border-radius: 50%;
  background: rgba(255,255,255,.06); color: rgba(255,255,255,.5);
  display: inline-flex; align-items: center; justify-content: center;
  text-decoration: none; font-size: 1rem; transition: all .2s; margin-left: 8px;
}
.footer-social a:hover { background: var(--honey); color: var(--dark); }

/* ─── Scroll-in Animation ────────────────────────────────── */
.reveal { opacity: 0; transform: translateY(30px); transition: opacity .6s ease, transform .6s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }

/* ─── Mobile Nav Toggler ────────────────────────────────── */
.navbar-toggler { border: 1.5px solid rgba(255,255,255,.4); padding: 5px 10px; }
.navbar-toggler-icon { filter: invert(1); }
.apiary-nav.scrolled .navbar-toggler { border-color: var(--border); }
.apiary-nav.scrolled .navbar-toggler-icon { filter: none; }
</style>
</head>
<body>

<!-- ══════════════════════════════════════
     NAVBAR
══════════════════════════════════════ -->
<nav class="apiary-nav navbar navbar-expand-lg" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url('website/index'); ?>">
      <span class="logo-text">🐝 APIACORE</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/index'); ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/news'); ?>">News</a></li>
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/about'); ?>">About</a></li>
        <li class="nav-item"><a class="nav-link nav-link-item" href="<?php echo base_url('website/contact'); ?>">Contact</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <a href="<?php echo base_url('auth/login'); ?>" class="btn-nav-login">Log In</a>
        <a href="<?php echo base_url('auth/login'); ?>" class="btn-nav-dashboard">
          <i class="ph ph-layout me-1"></i> Dashboard Access
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- ══════════════════════════════════════
     HERO CAROUSEL
══════════════════════════════════════ -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5500">
  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="hero-slide hero-slide-1">
        <div class="hero-content container text-white">
          <div class="hero-label"><span>📊</span> NARTDI - DMMMSU</div>
          <h1 class="hero-title">Monitoring & Evaluation of <br><span class="accent">Beekeepers</span> System.</h1>
          <p class="hero-subtitle">Digitizing the monitoring process and evaluation of beekeepers to empower the Philippine apiculture industry with data-driven insights.</p>
          <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo base_url('website/news'); ?>" class="btn-hero-primary"><i class="ph ph-newspaper"></i> Latest Updates</a>
            <a href="<?php echo base_url('website/about'); ?>" class="btn-hero-outline"><i class="ph ph-info"></i> Our Mission</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="hero-slide hero-slide-2">
        <div class="hero-content container text-white">
          <div class="hero-label"><span>🐝</span> Apiculture Development</div>
          <h1 class="hero-title">Empowering Beekeepers,<br><span class="accent">Strengthening</span> Communities.</h1>
          <p class="hero-subtitle">Our evaluation system ensures that every beekeeper receives the support they need to sustain and grow their operations.</p>
          <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo base_url('website/news'); ?>" class="btn-hero-primary"><i class="ph ph-newspaper"></i> Read News</a>
            <a href="<?php echo base_url('auth/login'); ?>" class="btn-hero-outline"><i class="ph ph-layout"></i> Access Portal</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <div class="hero-slide hero-slide-3">
        <div class="hero-content container text-white">
          <div class="hero-label"><span>📈</span> Data-Driven Growth</div>
          <h1 class="hero-title">Tracking Progress,<br><span class="accent">Evaluating</span> Success.</h1>
          <p class="hero-subtitle">Comprehensive metrics and monitoring for a more efficient and impactful apiculture development program.</p>
          <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo base_url('auth/login'); ?>" class="btn-hero-primary"><i class="ph ph-sign-in"></i> Get Started</a>
            <a href="<?php echo base_url('website/about'); ?>" class="btn-hero-outline"><i class="ph ph-info"></i> Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <i class="ph ph-caret-left text-white" style="font-size:1.3rem;"></i>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <i class="ph ph-caret-right text-white" style="font-size:1.3rem;"></i>
  </button>
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
  </div>
</div>

<!-- ══════════════════════════════════════
     STATS STRIP
══════════════════════════════════════ -->
<section class="stats-strip">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num"><?php echo $total_beekeeper ?? '120+'; ?></div>
          <div class="stat-lbl">Active Beekeepers</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num"><?php echo $total_news ?? '50+'; ?></div>
          <div class="stat-lbl">Latest Updates</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num">NARTDI</div>
          <div class="stat-lbl">Leading Institute</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-num">🇵🇭</div>
          <div class="stat-lbl">National Scope</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     WHY APIACORE
══════════════════════════════════════ -->
<section class="why-section honeycomb-bg">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <div class="section-label justify-content-center">Core Objectives</div>
      <h2 class="section-heading fs-1 mb-3">Monitoring & Evaluation</h2>
      <p class="section-sub">Empowering beekeepers through a structured system of assessment, support, and resource management.</p>
    </div>
    <div class="row g-4">
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.05s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#fff8e1;">📑</div>
          <h4>Systematic Monitoring</h4>
          <p>Regular assessments of beekeeper profiles and operational progress to ensure program alignment.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.1s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#e8f5e9;">📊</div>
          <h4>Effective Evaluation</h4>
          <p>Data-driven evaluation of impact and beekeeping success rates across different associations.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.15s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#e8f5e9;">🌱</div>
          <h4>Growth & Sustainability</h4>
          <p>Identifying key needs and providing beekeepers with targeted training and sustainable resources.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 reveal" style="transition-delay:.2s">
        <div class="feature-card">
          <div class="feature-icon" style="background:#fff8e1;">💡</div>
          <h4>Resource Optimization</h4>
          <p>Ensuring efficient allocation of apiculture resources through precise beekeeper monitoring data.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     LATEST NEWS SECTION
══════════════════════════════════════ -->
<section class="products-section">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <div class="section-label justify-content-center">Latest News</div>
      <h2 class="section-heading fs-1 mb-3">System Updates & News</h2>
      <p class="section-sub">Stay informed with the latest announcements, training updates, and progress reports from NARTDI.</p>
    </div>
    <div class="row g-4">

      <?php if(!empty($latest_news)): ?>
        <?php foreach($latest_news as $post): ?>
          <div class="col-md-4 reveal">
            <div class="product-card h-100">
              <div class="product-img-wrap" style="height: 200px;">
                <?php if($post['post_image'] && $post['post_image'] != 'noimage.jpg'): ?>
                  <img src="<?php echo base_url('upload/posts/'.$post['post_image']); ?>" alt="<?php echo $post['post_title']; ?>">
                <?php else: ?>
                  <img src="https://images.unsplash.com/photo-1472723740421-34c888f30a3b?w=600&q=80&fit=crop" alt="Placeholder">
                <?php endif; ?>
                <span class="product-badge badge-instock"><?php echo $post['name']; ?></span>
              </div>
              <div class="product-body d-flex flex-column">
                <div class="product-name fs-5"><?php echo $post['post_title']; ?></div>
                <div class="product-sub flex-grow-1">
                  <?php 
                    $text = strip_tags($post['post_text']);
                    echo (strlen($text) > 100) ? substr($text, 0, 100) . '...' : $text; 
                  ?>
                </div>
                <div class="mt-3">
                  <a href="<?php echo base_url('website/view_news/'.$post['post_id']); ?>" class="btn-product">Read More <i class="ph ph-arrow-right ms-1"></i></a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5">
           <i class="ph ph-newspaper-clipping fs-1 text-muted opacity-25"></i>
           <p class="text-muted mt-3">No recent updates available at the moment.</p>
        </div>
      <?php endif; ?>

    </div>
    
    <div class="text-center mt-5 reveal">
      <a href="<?php echo base_url('website/news'); ?>" class="btn btn-outline-primary rounded-pill px-4 py-2">
        View All News <i class="ph ph-arrow-right ms-1"></i>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     CTA SECTION
══════════════════════════════════════ -->
<section class="cta-section">
  <div class="container position-relative text-center">
    <div class="reveal">
      <span style="font-size:3rem;">📊</span>
      <h2 class="section-heading text-white fs-1 mt-3 mb-3">Join the Evaluation System</h2>
      <p class="text-white-50 mb-5 fs-5" style="max-width:500px;margin:0 auto 32px;">
        Registered beekeepers and administrators can access the system to track progress and generate impact reports.
      </p>
      <a href="<?php echo base_url('auth/login'); ?>" class="btn-cta">
        <i class="ph ph-sign-in"></i> Administrator/Staff Login
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     FOOTER
══════════════════════════════════════ -->
<footer class="site-footer">
  <div class="container">
    <div class="row g-5 mb-4">
      <div class="col-lg-4">
        <div class="footer-logo">🐝 APIACORE</div>
        <p class="footer-desc mt-2">
          A smart apiary management platform supporting Philippine beekeepers with real-time monitoring, colony tracking, and data-driven honey production insights.
        </p>
        <div class="footer-social mt-3">
          <a href="#" title="Facebook"><i class="ph ph-facebook-logo"></i></a>
          <a href="#" title="Twitter"><i class="ph ph-twitter-logo"></i></a>
          <a href="#" title="Instagram"><i class="ph ph-instagram-logo"></i></a>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="footer-heading">Quick Links</div>
        <a href="<?php echo base_url('website/index'); ?>" class="footer-link">Home</a>
        <a href="<?php echo base_url('website/news'); ?>" class="footer-link">News & Updates</a>
        <a href="<?php echo base_url('website/about'); ?>" class="footer-link">About NARTDI</a>
        <a href="<?php echo base_url('website/contact'); ?>" class="footer-link">Contact Us</a>
      </div>
      <div class="col-6 col-lg-3">
        <div class="footer-heading">Management</div>
        <a href="<?php echo base_url('auth/login'); ?>" class="footer-link">Dashboard Login</a>
        <a href="<?php echo base_url('beekeeper/'); ?>" class="footer-link">Beekeepers List</a>
        <a href="<?php echo base_url('production/'); ?>" class="footer-link">Production Data</a>
      </div>
      <div class="col-6 col-lg-2">
        <div class="footer-heading">Support</div>
        <a href="<?php echo base_url('website/contact'); ?>" class="footer-link">Contact</a>
        <a href="#" class="footer-link">Documentation</a>
        <a href="#" class="footer-link">Privacy Policy</a>
        <a href="#" class="footer-link">Terms of Use</a>
      </div>
    </div>
    <hr class="footer-divider">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <p class="footer-copy mb-0">© <?php echo date('Y'); ?> APIACORE · National Apiculture Research, Training & Development Institute</p>
      <p class="footer-copy mb-0">Philippines 🇵🇭</p>
    </div>
  </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ── Navbar scroll effect ────────────────────── */
(function() {
  var nav = document.getElementById('mainNav');
  function onScroll() {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
})();

/* ── Scroll reveal ────────────────────── */
(function() {
  var els = document.querySelectorAll('.reveal');
  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  els.forEach(function(el) { io.observe(el); });
})();
</script>
</body>
</html>
ase_url('website/contact'); ?>" class="footer-link">Contact</a>
        <a href="#" class="footer-link">Documentation</a>
        <a href="#" class="footer-link">Privacy Policy</a>
        <a href="#" class="footer-link">Terms of Use</a>
      </div>
    </div>
    <hr class="footer-divider">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <p class="footer-copy mb-0">© <?php echo date('Y'); ?> APIACORE · National Apiculture Research, Training & Development Institute</p>
      <p class="footer-copy mb-0">Philippines 🇵🇭</p>
    </div>
  </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ── Navbar scroll effect ────────────────────── */
(function() {
  var nav = document.getElementById('mainNav');
  function onScroll() {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
})();

/* ── Scroll reveal ────────────────────── */
(function() {
  var els = document.querySelectorAll('.reveal');
  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  els.forEach(function(el) { io.observe(el); });
})();
</script>
</body>
</html>
