<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Shared Auth Stylesheet -->
<link rel="stylesheet" href="<?= base_url('assets/css/auth.css'); ?>">

<style>
  /* Page specific background logic */
  .auth-full-page {
    background-image: url("<?= base_url('beekeeping_bg_1776865892735.png'); ?>");
  }
</style>

<div class="auth-full-page">
  <div class="auth-centered-content">
    <div class="glass-card">
      
      <!-- Logo -->
      <div class="text-center">
        <img src="<?= base_url('assets/images/meb.png'); ?>" alt="MEB Logo" class="auth-logo-modern">
      </div>

      <!-- Header -->
      <div class="text-center mb-4">
        <h1 class="auth-title-modern">Monitoring and Evaluation <span class="highlight-gold">of Beekeepers</span></h1>
        <p class="auth-subtitle-modern">Sign in to access your administrative dashboard</p>
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
        <div class="auth-input-group-glass">
          <label for="loginUsername" class="auth-label">Username</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
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
        <div class="auth-input-group-glass">
          <label for="loginPassword" class="auth-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
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

        <!-- Remember Me -->
        <div class="d-flex align-items-center justify-content-between mb-4">
          <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" style="border-radius:6px; cursor:pointer;" <?= !empty($remembered_username) ? 'checked' : '' ?>>
            <label class="form-check-label" for="rememberMe" style="font-size:0.85rem; color:#64748b; cursor:pointer;">Keep me signed in</label>
          </div>
        </div>

        <!-- Sign In -->
        <button type="submit" class="btn auth-btn-premium mb-4" id="loginBtn">
          <span class="btn-auth-text"><i class="bi bi-door-open-fill me-2"></i>Sign In</span>
          <span class="btn-auth-loader d-none"><span class="spinner-border spinner-border-sm me-2"></span>Authenticating...</span>
        </button>

        <p class="auth-footer-text m-0">
          Not yet a member?
          <a href="<?= base_url('register') ?>" class="link-green">Request Access</a>
        </p>

      </form>
    </div>

    <!-- Small Footer -->
    <div class="text-center mt-4">
      <p class="small text-white-50 m-0">&copy; <?= date('Y') ?> NARTDI - National Apiculture Research, Training Development Institute</p>
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

  document.getElementById('loginForm').addEventListener('submit', function (e) {
    var username = document.getElementById('loginUsername').value.trim();
    var pass  = document.getElementById('loginPassword').value.trim();

    document.querySelectorAll('.js-field-err').forEach(function(el){ el.remove(); });
    document.querySelectorAll('.is-invalid-js').forEach(function(el){ el.classList.remove('is-invalid-js','border-danger'); });

    var ok = true;
    function fieldErr(inputId, msg) {
      var inp = document.getElementById(inputId);
      var group = inp.closest('.input-group');
      group.classList.add('border-danger');
      var d = document.createElement('div');
      d.className = 'js-field-err text-danger mt-2 ps-2';
      d.style.fontSize = '0.8rem';
      d.style.fontWeight = '600';
      d.textContent = msg;
      group.insertAdjacentElement('afterend', d);
      ok = false;
    }

    if (!username) fieldErr('loginUsername', 'Username is required.');
    if (!pass) fieldErr('loginPassword', 'Password is required.');

    if (!ok) { e.preventDefault(); return; }

    var btn = document.getElementById('loginBtn');
    if (btn) {
      btn.querySelector('.btn-auth-text').classList.add('d-none');
      btn.querySelector('.btn-auth-loader').classList.remove('d-none');
      btn.disabled = true;
    }
  });
</script>
