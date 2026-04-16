<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Shared Auth Stylesheet -->
<link rel="stylesheet" href="<?= base_url('assets/css/auth.css'); ?>">

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var wrapper = document.getElementById('main-wrapper');
    if (wrapper) {
      wrapper.classList.add('auth-wrapper');
      wrapper.style.cssText = 'display:flex;min-height:100vh;margin:0;padding:0;overflow:hidden;';
    }
    document.body.style.margin = '0';
    document.body.style.padding = '0';
    document.body.style.background = 'linear-gradient(135deg, #d97706 0%, #78350f 100%)';
  });
</script>

<div class="row g-0 w-100 min-vh-100" style="margin:0;">

  <!-- ====== LEFT PANEL ====== -->
  <div class="col-md-6 auth-left">


    <!-- Brand -->
    <div class="auth-brand">
      <div class="auth-logo-wrap">
        <img src="<?= base_url('assets/images/meb.png'); ?>" alt="MEB Logo">
      </div>
      <div>
        <span class="auth-brand-name">NARTDI</span>
        <span class="auth-brand-tagline">National Apiculture Research, Training Development Institute</span>
      </div>
    </div>

    <!-- Hero -->
    <div class="auth-hero">
   
  
     
      <h1 class="auth-hero-title">
       Monitoring & Evaluation<br><span> of Beekeepers</span>
      </h1>
      <p class="auth-tagline">Monitoring and evaluating beekeeping activities across the Philippines.</p>

      <ul class="auth-feature-list">
        <li>
          <div class="feat-icon"><i class="bi bi-hexagon-fill"></i></div>
          <div>
            <strong>Activity Monitoring</strong>
            <span>Track and evaluate beekeeping activities</span>
          </div>
        </li>
        <li>
          <div class="feat-icon"><i class="bi bi-shield-lock-fill"></i></div>
          <div>
            <strong>Secure Access</strong>
            <span>Role-based authentication system</span>
          </div>
        </li>
        <li>
          <div class="feat-icon"><i class="bi bi-bar-chart-steps"></i></div>
          <div>
            <strong>Evaluation Reports</strong>
            <span>Comprehensive analytics and insights</span>
          </div>
        </li>
      </ul>
    </div>

    <!-- Footer -->
    <div class="auth-left-footer">
      &copy; <?= date('Y') ?> National Apiculture Research, Training Development Institute<br>
      <!-- <span style="opacity:0.55;">Developed by <span style="font-weight:600;">John Doe</span></span> -->
    </div>
  </div>

  <!-- ====== RIGHT PANEL ====== -->
  <div class="col-md-6 auth-right">
    <div class="auth-card">

      <!-- Card Top Logo (mobile) -->
      <div class="auth-card-logo d-md-none">
        <img src="<?= base_url('assets/images/meb.png'); ?>" alt="MEB">
      </div>

      <div class="auth-card-header">
        <h2 class="auth-card-title">Welcome Back</h2>
        <p class="auth-card-subtitle">Sign in to your institutional account</p>
      </div>

      <!-- Error -->
      <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger auth-alert d-flex align-items-center gap-2 py-2 mb-4" role="alert">
          <i class="bi bi-exclamation-circle-fill"></i>
          <span><?= $errors ?></span>
        </div>
      <?php endif; ?>

      <form id="loginForm" method="post" action="<?= base_url('auth/login') ?>" novalidate>
<?php if (isset($this->security)): ?>
<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
<?php endif; ?>

        <!-- Username -->
        <div class="mb-4">
          <label for="loginUsername" class="auth-label">Username</label>
          <div class="input-group auth-input-group">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input
              name="username"
              type="text"
              class="form-control"
              id="loginUsername"
              placeholder="Enter your username"
              autocomplete="username"
              value="<?= htmlspecialchars($remembered_username ?? '') ?>"
            >
          </div>
          <?= form_error('username', '<div class="text-danger mt-1" style="font-size:0.8rem;">', '</div>') ?>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="loginPassword" class="auth-label">Password</label>
          <div class="input-group auth-input-group has-toggle">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input
              name="password"
              type="password"
              class="form-control"
              id="loginPassword"
              placeholder="Enter your password"
              autocomplete="current-password"
            >
            <button type="button" class="auth-toggle-pw" onclick="toggleLoginPassword()" title="Show/Hide password">
              <i class="bi bi-eye" id="loginToggleIcon"></i>
            </button>
          </div>
          <?= form_error('password', '<div class="text-danger mt-1" style="font-size:0.8rem;">', '</div>') ?>
        </div>

        <!-- Forgot + Remember -->
        <div class="d-flex align-items-center justify-content-between mb-4">
          <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" style="border-radius:5px;" <?= !empty($remembered_username) ? 'checked' : '' ?>>
            <label class="form-check-label" for="rememberMe" style="font-size:0.85rem; color:#5a6a85;">Remember me</label>
          </div>
          <!-- <a href="<?= base_url('login/forgot_password') ?>" class="auth-forgot">Forgot Password?</a> -->
        </div>

        <!-- Sign In -->
        <button type="submit" class="btn btn-auth mb-3" id="loginBtn">
          <span class="btn-auth-text"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In</span>
          <span class="btn-auth-loader d-none"><span class="spinner-border spinner-border-sm me-2"></span>Signing in...</span>
        </button>

        <p class="auth-footer-text">
          Don't have an account?
          <a href="<?= base_url('register') ?>" class="link-green">Create Account</a>
        </p>

      </form>
    </div>
  </div>

</div>

<script>
  function toggleLoginPassword() {
    var input = document.getElementById('loginPassword');
    var icon  = document.getElementById('loginToggleIcon');
    if (!input) return;
    if (input.type === 'password') {
      input.type = 'text';
      if (icon) { icon.classList.replace('bi-eye', 'bi-eye-slash'); }
    } else {
      input.type = 'password';
      if (icon) { icon.classList.replace('bi-eye-slash', 'bi-eye'); }
    }
  }

  // Loader only activates after simple client-side check
  document.getElementById('loginForm').addEventListener('submit', function (e) {
    var username = document.getElementById('loginUsername').value.trim();
    var pass  = document.getElementById('loginPassword').value.trim();

    // Clear previous inline errors
    document.querySelectorAll('.js-field-err').forEach(function(el){ el.remove(); });
    document.querySelectorAll('.is-invalid-js').forEach(function(el){ el.classList.remove('is-invalid-js','border-danger'); });

    var ok = true;
    function fieldErr(inputId, msg) {
      var inp = document.getElementById(inputId);
      inp.classList.add('is-invalid-js', 'border-danger');
      var d = document.createElement('div');
      d.className = 'js-field-err text-danger mt-1';
      d.style.fontSize = '0.8rem';
      d.textContent = msg;
      inp.closest('.input-group').insertAdjacentElement('afterend', d);
      ok = false;
    }

    if (!username)   fieldErr('loginUsername',    'Username is required.');
    if (!pass)    fieldErr('loginPassword',  'Password is required.');

    if (!ok) { e.preventDefault(); return; }

    // Valid — show loader
    var btn = document.getElementById('loginBtn');
    if (btn) {
      btn.querySelector('.btn-auth-text').classList.add('d-none');
      btn.querySelector('.btn-auth-loader').classList.remove('d-none');
      btn.disabled = true;
    }
  });
</script>
