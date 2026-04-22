<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
  // User session data
  $user = $this->session->userdata('user_data') ?? [
    'first_name' => 'Admin',
    'last_name'  => 'User',
    'role_id'    => 1,
    'email'      => 'admin@gmail.com'
  ];
  $initials   = strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1));
  $role_label = ($user['role_id'] == 1) ? 'Administrator' : 'Officer';
  $full_name  = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
?>

<div class="body-wrapper">
  <header class="app-header">
    <nav class="navbar w-100 d-flex align-items-center justify-content-between p-0">

      <!-- LEFT: Toggle + Page Title -->
      <div class="d-flex align-items-center gap-2">
        <!-- Mobile sidebar toggle -->
        <button class="sb-toggle-btn" onclick="window.toggleSidebar && toggleSidebar()" aria-label="Toggle sidebar">
          <i class="ph-bold ph-list"></i>
        </button>

        <!-- Page title -->
        <div class="nb-page-title d-none d-sm-flex">
          <div class="nb-page-icon">
            <i class="ph ph-gauge"></i>
          </div>
          <div>
            <p class="nb-title-text">Admin Panel</p>
            <p class="nb-title-sub">MEB Dashboard</p>
          </div>
        </div>
      </div>

      <!-- RIGHT: Actions -->
      <div class="nb-actions">

        <!-- Live clock -->
        <div class="nb-time-chip">
          <i class="ph ph-clock"></i>
          <span id="nbLiveClock">--:--:-- --</span>
        </div>


        <!-- User profile dropdown -->
        <div class="dropdown">
          <a class="nb-user-pill dropdown-toggle-no-caret" href="#" id="nbUserDrop"
             data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none;">
            <div class="nb-user-avatar"><?= $initials ?></div>
            <div class="d-none d-md-block">
              <p class="nb-user-name"><?= $full_name ?></p>
              <p class="nb-user-role"><?= $role_label ?></p>
            </div>
            <i class="ph ph-caret-down nb-chevron d-none d-md-block"></i>
          </a>

          <div class="dropdown-menu dropdown-menu-end nb-dropdown-menu" aria-labelledby="nbUserDrop">

            <!-- Header -->
            <div class="nb-dropdown-header">
              <div class="nb-dropdown-avatar"><?= $initials ?></div>
              <p class="nb-dropdown-name"><?= $full_name ?></p>
              <p class="nb-dropdown-role"><?= $role_label ?></p>
              <p class="nb-dropdown-email"><?= htmlspecialchars($user['email']) ?></p>
            </div>

            <!-- Actions -->
            <div class="nb-dropdown-body">
              <a href="<?= base_url('profile') ?>" class="nb-dropdown-item">
                <i class="ph ph-user-circle"></i>
                <span>My Profile</span>
              </a>
              <hr style="border-color:#e5e7eb; margin: 8px 0;">
              <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">
                <i class="ph ph-sign-out"></i>
                Log Out
              </a>
            </div>

          </div>
        </div>

      </div>
    </nav>
  </header>

<script>
  /* Live clock */
  (function () {
    function pad(n) { return n < 10 ? '0' + n : n; }
    function tick() {
      var now = new Date();
      var h   = now.getHours();
      var m   = pad(now.getMinutes());
      var s   = pad(now.getSeconds());
      var ap  = h >= 12 ? 'PM' : 'AM';
      h = h % 12 || 12;
      var el = document.getElementById('nbLiveClock');
      if (el) el.textContent = pad(h) + ':' + m + ':' + s + ' ' + ap;
    }
    tick();
    setInterval(tick, 1000);
  })();
</script>