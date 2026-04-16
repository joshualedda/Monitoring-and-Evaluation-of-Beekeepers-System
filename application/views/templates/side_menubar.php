<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Dashboard shared stylesheet -->
<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css'); ?>">

<?php
  $seg1 = $this->uri->segment(1);
  $seg2 = $this->uri->segment(2);
  $seg3 = $this->uri->segment(3);

  $isActive = function ($patterns) use ($seg1, $seg2, $seg3) {
    foreach ($patterns as $p) {
      if ($p === "$seg1" || $p === "$seg1/$seg2" || $p === "$seg1/$seg2/$seg3") return 'active';
      if (substr($p, -1) === '*') {
        $base = rtrim($p, '*');
        if (strpos("$seg1/$seg2/$seg3", $base) === 0) return 'active';
      }
    }
    return '';
  };
?>

<aside class="left-sidebar" id="leftSidebar">

  <!-- Brand -->
  <a href="<?= base_url('dashboard'); ?>" class="sb-brand">
    <div class="sb-logo-wrap">
      <img src="<?= base_url('assets/images/meb.png'); ?>" alt="MEB Logo">
    </div>
    <div class="sb-brand-text">
      <span class="sb-brand-name">MEB</span>
      <span class="sb-brand-sub">System</span>
    </div>
  </a>

  <!-- Scrollable nav -->
  <nav class="scroll-sidebar">
    <ul id="sidebarnav">

      <!-- Section: Main -->
      <li class="nav-small-cap">
        <span>Main</span>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link <?= $isActive(['dashboard', 'dashboard*']) ?>" href="<?php echo base_url('dashboard') ?>">
          <i class="ph ph-gauge"></i>
          <span class="hide-menu"><?php echo $this->lang->line('Dashboard'); ?></span>
        </a>
      </li>

      <?php if($user_permission): ?>  

        <?php if(in_array('viewPost', $user_permission)): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?= $isActive(['post/view', 'post*']) ?>" href="<?php echo base_url('post/view') ?>">
              <i class="ph ph-newspaper"></i>
              <span class="hide-menu"><?php echo $this->lang->line('News'); ?></span>
            </a>
          </li>
        <?php endif; ?>         

        <?php if(in_array('createBeekeeper', $user_permission) || in_array('updateBeekeeper', $user_permission) || in_array('viewBeekeeper', $user_permission) || in_array('deleteBeekeeper', $user_permission)): ?>
             <?php if(in_array('updateBeekeeper', $user_permission) || in_array('viewBeekeeper', $user_permission) || in_array('deleteBeekeeper', $user_permission)): ?>
              <li class="sidebar-item">
                <a class="sidebar-link <?= $isActive(['Beekeeper', 'Beekeeper*']) ?>" href="<?php echo base_url('Beekeeper') ?>">
                  <i class="ph ph-users"></i>
                  <span class="hide-menu"><?php echo $this->lang->line('Beekeepers'); ?></span>
                </a>
              </li>
              <?php endif; ?>
        <?php endif; ?>

        <?php if(in_array('createApiary', $user_permission) || in_array('updateApiary', $user_permission) || in_array('viewApiary', $user_permission) || in_array('deleteApiary', $user_permission)): ?>
             <?php if(in_array('updateApiary', $user_permission) || in_array('viewApiary', $user_permission) || in_array('deleteApiary', $user_permission)): ?>
              <li class="sidebar-item">
                <a class="sidebar-link <?= $isActive(['Apiary', 'Apiary*']) ?>" href="<?php echo base_url('Apiary') ?>">
                  <i class="ph ph-hexagon"></i>
                  <span class="hide-menu"><?php echo $this->lang->line('Apiaries'); ?></span>
                </a>
              </li>
              <?php endif; ?>
        <?php endif; ?>

        <?php if(in_array('createColony', $user_permission) || in_array('updateColony', $user_permission) || in_array('viewColony', $user_permission) || in_array('deleteColony', $user_permission)): ?>
             <?php if(in_array('updateColony', $user_permission) || in_array('viewColony', $user_permission) || in_array('deleteColony', $user_permission)): ?>
              <li class="sidebar-item">
                <a class="sidebar-link <?= $isActive(['Colony', 'Colony*']) ?>" href="<?php echo base_url('Colony') ?>">
            <i class="ph ph-cube"></i>
                  <span class="hide-menu"><?php echo $this->lang->line('Colonies'); ?></span>
                </a>
              </li>
              <?php endif; ?>
        <?php endif; ?>

        <!-- Section: Office / Admin Tools -->
        <li class="nav-small-cap"><span>Tools & Options</span></li>

        <?php if(in_array('viewReport', $user_permission)): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?= $isActive(['report', 'report*']) ?>" href="<?php echo base_url('report') ?>">
              <i class="ph ph-chart-bar"></i>
              <span class="hide-menu"><?php echo $this->lang->line('Reports'); ?></span>
            </a>
          </li>
        <?php endif; ?>  

        <?php if(in_array('updateSetting', $user_permission)): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?= $isActive(['setting', 'setting*']) ?>" href="<?php echo base_url('setting/') ?>">
              <i class="ph ph-gear"></i>
              <span class="hide-menu"><?php echo $this->lang->line('Settings'); ?></span>
            </a>
          </li>
        <?php endif; ?>

      <?php endif; ?>

      <li class="nav-small-cap"><span>External Links</span></li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="<?php echo base_url('documentation/user_guide/') ?>">
          <i class="ph ph-book"></i>
          <span class="hide-menu"><?php echo $this->lang->line('Documentation'); ?></span>
        </a>
      </li>  
      
      <li class="sidebar-item">
        <a class="sidebar-link" href="<?php echo base_url('website/') ?>">
          <i class="ph ph-globe"></i>
          <span class="hide-menu"><?php echo $this->lang->line('Website'); ?></span>
        </a>
      </li>

    </ul>
  </nav>
</aside>