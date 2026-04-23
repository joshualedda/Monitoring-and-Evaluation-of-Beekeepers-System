<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<body>
  <main class="page-main">
    <div class="login-container">
      <div class="login-card">
        <!-- Header -->
        <div class="login-card-header">
          <img src="<?= base_url('assets/images/meb.png') ?>" alt="MEB Logo" class="login-logo-img">
          <h2>Monitoring & Evaluation<br>of Beekeepers</h2>
          <p>National Apiculture Research, Training & Development Institute</p>
        </div>

        <!-- Body -->
        <div class="login-card-body">
          <div class="section-label">Institutional Access</div>

          <?php if (!empty($errors)) : ?>
            <div class="meb-alert" role="alert">
              <i class="bi bi-exclamation-triangle-fill"></i>
              <span><?= $errors ?></span>
            </div>
          <?php endif; ?>

          <form id="loginForm" method="post" action="<?= base_url('auth/login') ?>" novalidate>
            <?php if (isset($this->security)): ?>
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            <?php endif; ?>

            <!-- Username -->
            <div class="field-wrap">
              <label for="loginUsername" class="field-label">Username</label>
              <div class="input-wrap">
                <i class="bi bi-person-fill input-icon"></i>
                <input name="username" type="text" class="form-control" id="loginUsername" placeholder="Enter your username" autocomplete="username" value="<?= htmlspecialchars($remembered_username ?? '') ?>">
              </div>
              <?= form_error('username', '<div class="field-error">', '</div>') ?>
            </div>

            <!-- Password -->
            <div class="field-wrap">
              <label for="loginPassword" class="field-label">Password</label>
              <div class="input-wrap">
                <i class="bi bi-shield-lock-fill input-icon"></i>
                <input name="password" type="password" class="form-control" id="loginPassword" placeholder="Enter your password" autocomplete="current-password">
                <button type="button" class="pw-toggle" id="pwToggleBtn">
                  <i class="bi bi-eye-fill" id="pwToggleIcon"></i>
                </button>
              </div>
              <?= form_error('password', '<div class="field-error">', '</div>') ?>
            </div>

            <!-- Remember Me -->
            <div class="d-flex align-items-center justify-content-between mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" <?= !empty($remembered_username) ? 'checked' : '' ?>>
                <label class="form-check-label" for="rememberMe" style="font-size: 0.85rem; color: var(--text-mid);">Keep me signed in</label>
              </div>
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
              <span id="btnText">Sign In</span>
              <div id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status"></div>
            </button>
          </form>

          <!-- <div class="auth-footer-links">
            Don't have an account? <a href="<?= base_url('register') ?>">Request Access</a>
          </div> -->

          <div class="notice-box">
            <i class="bi bi-info-circle-fill"></i>
            <span>Authorized personnel only. All access and activities are logged for security purposes.</span>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="page-footer">
    <p>&copy; <?= date('Y') ?> NARTDI &mdash; MEB System</p>
    <p style="font-size: 0.75rem; opacity: 0.6;">National Apiculture Research, Training and Development Institute</p>
  </footer>

  <script>
    // Password toggle
    const pwBtn = document.getElementById('pwToggleBtn');
    const pwInput = document.getElementById('loginPassword');
    const pwIcon = document.getElementById('pwToggleIcon');

    pwBtn.addEventListener('click', () => {
      const isHidden = pwInput.type === 'password';
      pwInput.type = isHidden ? 'text' : 'password';
      pwIcon.className = isHidden ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
    });

    // Form submit loading
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    loginForm.addEventListener('submit', (e) => {
      // Basic validation check to prevent loader on obviously empty fields
      const username = document.getElementById('loginUsername').value.trim();
      const pass = document.getElementById('loginPassword').value.trim();
      
      if (username && pass) {
        btnText.style.display = 'none';
        btnLoader.classList.remove('d-none');
        loginBtn.disabled = true;
      }
    });
  </script>
</body>
</html>
