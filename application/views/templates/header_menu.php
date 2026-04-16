<div class="body-wrapper">
    <div class="container-fluid">
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ph ph-list fs-7"></i>
                </a>
            </li>
            <li class="nav-item">
                <div class="nb-page-title d-none d-sm-flex">
                    <div class="nb-page-icon">
                        <i class="ph ph-layout"></i>
                    </div>
                    <div>
                        <h6 class="nb-title-text"><?php echo $this->data['page_title'] ?? 'MEB System'; ?></h6>
                        <p class="nb-title-sub">Monitoring & Evaluation System</p>
                    </div>
                </div>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item me-2 d-none d-md-block">
                    <div class="nb-time-chip shadow-sm">
                        <i class="ph ph-clock"></i>
                        <span id="current-time"><?php echo date('H:i'); ?></span>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nb-user-pill border border-2 border-primary-light">
                            <div class="nb-user-avatar fw-bold">
                                <?php echo substr($_SESSION['name'] ?? 'U', 0, 1) ?>
                            </div>
                            <div class="d-none d-sm-block">
                                <p class="nb-user-name mb-0"><?php echo $_SESSION['name'] ?? 'User' ?></p>
                                <p class="nb-user-role mb-0"><?php echo $_SESSION['username'] ?? '' ?></p>
                            </div>
                            <i class="ph ph-caret-down nb-chevron ms-1"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up nb-dropdown-menu" aria-labelledby="drop2">
                        <div class="nb-dropdown-header">
                            <div class="nb-dropdown-avatar">
                                <?php echo substr($_SESSION['name'] ?? 'U', 0, 1) ?>
                            </div>
                            <h6 class="nb-dropdown-name"><?php echo $_SESSION['name'] ?? 'User' ?></h6>
                            <p class="nb-dropdown-role">Member</p>
                        </div>
                        <div class="message-body p-3">
                            <a href="<?php echo base_url('user/my_account') ?>" class="d-flex align-items-center gap-2 dropdown-item py-2 px-3 rounded-3">
                                <i class="ph ph-user-circle fs-6"></i>
                                <p class="mb-0">My Account</p>
                            </a>
                            <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-outline-danger w-100 mt-3 rounded-3 py-2 fw-semibold border-2 d-flex align-items-center justify-content-center gap-2">
                                <i class="ph ph-sign-out fw-bold"></i> Sign Out
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

  <!-- Left side column. contains the logo and sidebar -->
  