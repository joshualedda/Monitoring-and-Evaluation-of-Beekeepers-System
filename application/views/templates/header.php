<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/jpeg" href="<?= base_url('assets/images/logo.jpg'); ?>" />
  <link rel="icon" type="image/jpeg" href="<?= base_url('assets/images/logo.jpg'); ?>" />
  <!-- <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css'); ?>" /> -->
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>" />

  <!-- Main Css for additional components -->
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_custom.css'); ?>" />
  <!-- Shared dashboard layout (sidebar + navbar) -->
  <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css'); ?>" />
  <!-- Reusable dashboard card components -->
  <link rel="stylesheet" href="<?= base_url('assets/css/cards.css'); ?>" />
  <!-- Reusable DataTable styles -->
  <link rel="stylesheet" href="<?= base_url('assets/css/datatable.css'); ?>" />
  <!-- Reusable Form widget styles -->
  <link rel="stylesheet" href="<?= base_url('assets/css/forms.css'); ?>" />


  <!-- End Test -->
   <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  
  <!-- Phosphor Icons (modern React/Tailwind ecosystem icon set) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/bold/style.css">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
<!-- Unified SV Layout Details -->
  <link rel="stylesheet" href="<?= base_url('assets/css/scholarship_view.css') ?>">

  <!-- Leaflet CSS (Philippine Map) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>

  <!-- Datatable -->
  <!-- Style -->

  <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap5.min.css') ?>" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="<?= base_url('assets/js/jquery-3.5.1.js') ?>"></script>
  <script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/dataTables.bootstrap5.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Toast Notifications -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- forms JQUERY -->
  <script src="<?= base_url('assets/js/forms/refferences.js ') ?>"></script>

  <!-- Select Filter -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>


  <!-- Charts Nice Admin -->

  <script src="<?= base_url('assets/vendor/chart.js/chart.umd.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>



  <style>
 
    /* Custom scrollbar styles */
    .scroll-sidebar {
      position: relative;
      height: 100%;
      overflow: hidden;
    }

    .scroll-sidebar::-webkit-scrollbar {
      width: 3px;
      height: 3px;
    }

    .scroll-sidebar::-webkit-scrollbar-track {
      background: #f1f1f1;
      /* Track color */
    }

    .scroll-sidebar::-webkit-scrollbar-thumb {
      background: #888;
      /* Scrollbar color */
      border-radius: 10px;
    }

    .scroll-sidebar::-webkit-scrollbar-thumb:hover {
      background: #555;
      /* Scrollbar color on hover */
    }

    .scroll-sidebar::-webkit-scrollbar-corner {
      background: transparent;
    }

    #main {
      padding: 20px 30px;
      transition: all 0.3s;
    }

    .main-container {
      margin-top: 80px;
    }

    @media (max-width: 1199px) {
      #main {
        padding: 20px;
      }
    }

    .nav-content {
      max-height: 0;
      /* Start with a height of 0 */
      opacity: 0;
      /* Start with opacity 0 */
      overflow: hidden;
      /* Hide overflow to prevent content from showing */
      transition: max-height 0.3s ease, opacity 0.3s ease;
      /* Smooth transition */
    }

    .nav-content.show {
      max-height: 1000px;
      /* Arbitrary large value to allow content expansion */
      opacity: 1;
      /* Fade in the content */
    }

    .nav-small-cap-icon {
      transition: transform 0.3s ease;
      /* Smooth rotation */
    }

    .nav-small-cap-icon.rotate {
      transform: rotate(180deg);
      /* Rotate the icon */
    }


    /* For Inputs */
    .custom-select {
      padding: 5px 5px;
      border-radius: 7px;
      border-color: gainsboro;

    }

    /* ==== Improved Input Design (applies globally) ==== */
    .form-label {
      font-weight: 600;
      color: #2f3a4c;
    }

    .form-control,
    .form-select {
      border: 1px solid #dfe3e8;
      border-radius: 8px;
      padding: 10px 12px;
      line-height: 1.4;
      background-color: #fff;
      transition: border-color .15s ease, box-shadow .15s ease, background-color .15s ease;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #5a8dee;
      box-shadow: 0 0 0 0.2rem rgba(90, 141, 238, 0.15);
      outline: none;
      background-color: #fff;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.08);
    }

    .form-text {
      color: #6c757d;
    }

    /* Spacing between form rows */
    .row.g-3 > [class^="col-"],
    .row.g-3 > [class*=" col-"] {
      margin-bottom: 6px;
    }

    /* ==== Select2 Styling to match inputs ==== */
    .select2-container--default .select2-selection--single {
      height: 42px;
      border: 1px solid #dfe3e8;
      border-radius: 8px;
      display: flex;
      align-items: center;
      padding: 3px 40px 3px 12px; /* leave room for arrow */
      background-color: #fff;
      transition: border-color .15s ease, box-shadow .15s ease;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 1.4;
      color: #2f3a4c;
      padding-left: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
      color: #6c757d;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 100%;
      right: 10px;
    }

    .select2-container--default.select2-container--focus .select2-selection--single {
      border-color: #5a8dee;
      box-shadow: 0 0 0 0.2rem rgba(90, 141, 238, 0.15);
    }

    .select2-dropdown {
      border: 1px solid #dfe3e8;
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    .select2-results__option {
      padding: 8px 12px;
    }

    .select2-search--dropdown .select2-search__field {
      border: 1px solid #dfe3e8 !important;
      border-radius: 6px;
      padding: 8px 10px;
      outline: none;
    }

    /* Fix DataTables pagination dropdown arrow position */
    .dataTables_wrapper .dataTables_length {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .dataTables_wrapper .dataTables_length label {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 0;
      flex-wrap: nowrap;
      white-space: nowrap;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_length .form-select {
      padding-right: 35px !important;
      padding-left: 12px !important;
      appearance: none !important;
      -webkit-appearance: none !important;
      -moz-appearance: none !important;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: right 12px center !important;
      background-size: 12px !important;
      margin-left: 8px !important;
      margin-right: 8px !important;
      width: auto !important;
      min-width: 70px;
      display: inline-block;
    }

    /* Remove any default browser arrow */
    .dataTables_wrapper .dataTables_length select::-ms-expand {
      display: none;
    }

    /* Ensure proper text order */
    .dataTables_wrapper .dataTables_length label > * {
      order: 0;
    }

    .dataTables_wrapper .dataTables_length label select,
    .dataTables_wrapper .dataTables_length label .form-select {
      order: 1;
    }

    /* Remove transitions from sidebar dropdowns for instant response */
    .nav-content,
    .nav-content.collapse,
    .nav-content.collapsing {
      transition: none !important;
      transition-duration: 0s !important;
      transition-delay: 0s !important;
    }
  </style>

<style>
  /* Filter Section */
  .filter-label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: #899bbd;
    margin-bottom: 5px;
    display: block;
  }

  .form-select-sm {
    border-radius: 20px;
    border-color: #e2e8f0;
    font-size: 0.85rem;
    padding: 8px 15px;
    box-shadow: none;
    transition: all 0.2s;
  }
  .form-select-sm:focus {
    border-color: #4154f1;
    box-shadow: 0 0 0 3px rgba(65, 84, 241, 0.1);
  }

  /* Table Styling */
  .datatable-wrapper {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
  }

  .table thead th {
    background-color: #f8f9fa;
    color: #444;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    padding: 15px;
    border-bottom: 2px solid #e9ecef;
  }

  .table tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    font-size: 0.9rem;
    color: #495057;
    border-bottom: 1px solid #f1f3f5;
  }

  .table tbody tr:hover {
    background-color: #fdfdfd;
  }

  /* Status Badges */
  .badge-status {
    padding: 6px 12px;
    border-radius: 30px;
    font-weight: 500;
    font-size: 0.75rem;
  }
  .badge-success { background-color: #d1e7dd; color: #0f5132; }
  .badge-warning { background-color: #fff3cd; color: #664d03; }
  .badge-danger  { background-color: #f8d7da; color: #842029; }
  .badge-info    { background-color: #cff4fc; color: #055160; }
  .badge-primary { background-color: #cfe2ff; color: #084298; }
  .badge-secondary { background-color: #e2e3e5; color: #41464b; }
  .badge-dark    { background-color: #d3d3d4; color: #1a1e21; }

  /* Action Buttons */
  .btn-action {
    width: 32px;
    height: 32px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.2s;
    border: none;
  }
  .btn-view { background: #e2e6ea; color: #4154f1; }
  .btn-view:hover { background: #4154f1; color: #fff; }
  
  .btn-edit { background: #fff3cd; color: #ffc107; }
  .btn-edit:hover { background: #ffc107; color: #fff; }

  /* Course Badge */
  .course-badge {
    background: #f8f9fa;
    color: #495057;
    border: 1px solid #e9ecef;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
  }
  .summary-card {
            border-radius: 12px !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .summary-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
        }

  /* Mobile sidebar z-index override removed — handled by dashboard.css (z-index: 1050) */
</style>



<!-- sidebar -->
 

  <style>
 
    /* Custom scrollbar styles */
    .scroll-sidebar {
      position: relative;
      height: 100%;
      overflow: hidden;
    }

    .scroll-sidebar::-webkit-scrollbar {
      width: 3px;
      height: 3px;
    }

    .scroll-sidebar::-webkit-scrollbar-track {
      background: #f1f1f1;
      /* Track color */
    }

    .scroll-sidebar::-webkit-scrollbar-thumb {
      background: #888;
      /* Scrollbar color */
      border-radius: 10px;
    }

    .scroll-sidebar::-webkit-scrollbar-thumb:hover {
      background: #555;
      /* Scrollbar color on hover */
    }

    .scroll-sidebar::-webkit-scrollbar-corner {
      background: transparent;
    }

    #main {
      padding: 20px 30px;
      transition: all 0.3s;
    }

    .main-container {
      margin-top: 80px;
    }

    @media (max-width: 1199px) {
      #main {
        padding: 20px;
      }
    }

    .nav-content {
      max-height: 0;
      /* Start with a height of 0 */
      opacity: 0;
      /* Start with opacity 0 */
      overflow: hidden;
      /* Hide overflow to prevent content from showing */
      transition: max-height 0.3s ease, opacity 0.3s ease;
      /* Smooth transition */
    }

    .nav-content.show {
      max-height: 1000px;
      /* Arbitrary large value to allow content expansion */
      opacity: 1;
      /* Fade in the content */
    }

    .nav-small-cap-icon {
      transition: transform 0.3s ease;
      /* Smooth rotation */
    }

    .nav-small-cap-icon.rotate {
      transform: rotate(180deg);
      /* Rotate the icon */
    }


    /* For Inputs */
    .custom-select {
      padding: 5px 5px;
      border-radius: 7px;
      border-color: gainsboro;

    }

    /* ==== Improved Input Design (applies globally) ==== */
    .form-label {
      font-weight: 600;
      color: #2f3a4c;
    }

    .form-control,
    .form-select {
      border: 1px solid #dfe3e8;
      border-radius: 8px;
      padding: 10px 12px;
      line-height: 1.4;
      background-color: #fff;
      transition: border-color .15s ease, box-shadow .15s ease, background-color .15s ease;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #5a8dee;
      box-shadow: 0 0 0 0.2rem rgba(90, 141, 238, 0.15);
      outline: none;
      background-color: #fff;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.08);
    }

    .form-text {
      color: #6c757d;
    }

    /* Spacing between form rows */
    .row.g-3 > [class^="col-"],
    .row.g-3 > [class*=" col-"] {
      margin-bottom: 6px;
    }

    /* ==== Select2 Styling to match inputs ==== */
    .select2-container--default .select2-selection--single {
      height: 42px;
      border: 1px solid #dfe3e8;
      border-radius: 8px;
      display: flex;
      align-items: center;
      padding: 3px 40px 3px 12px; /* leave room for arrow */
      background-color: #fff;
      transition: border-color .15s ease, box-shadow .15s ease;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 1.4;
      color: #2f3a4c;
      padding-left: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
      color: #6c757d;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 100%;
      right: 10px;
    }

    .select2-container--default.select2-container--focus .select2-selection--single {
      border-color: #5a8dee;
      box-shadow: 0 0 0 0.2rem rgba(90, 141, 238, 0.15);
    }

    .select2-dropdown {
      border: 1px solid #dfe3e8;
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    .select2-results__option {
      padding: 8px 12px;
    }

    .select2-search--dropdown .select2-search__field {
      border: 1px solid #dfe3e8 !important;
      border-radius: 6px;
      padding: 8px 10px;
      outline: none;
    }

    /* Fix DataTables pagination dropdown arrow position */
    .dataTables_wrapper .dataTables_length {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .dataTables_wrapper .dataTables_length label {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 0;
      flex-wrap: nowrap;
      white-space: nowrap;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_length .form-select {
      padding-right: 35px !important;
      padding-left: 12px !important;
      appearance: none !important;
      -webkit-appearance: none !important;
      -moz-appearance: none !important;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: right 12px center !important;
      background-size: 12px !important;
      margin-left: 8px !important;
      margin-right: 8px !important;
      width: auto !important;
      min-width: 70px;
      display: inline-block;
    }

    /* Remove any default browser arrow */
    .dataTables_wrapper .dataTables_length select::-ms-expand {
      display: none;
    }

    /* Ensure proper text order */
    .dataTables_wrapper .dataTables_length label > * {
      order: 0;
    }

    .dataTables_wrapper .dataTables_length label select,
    .dataTables_wrapper .dataTables_length label .form-select {
      order: 1;
    }

    /* Remove transitions from sidebar dropdowns for instant response */
    .nav-content,
    .nav-content.collapse,
    .nav-content.collapsing {
      transition: none !important;
      transition-duration: 0s !important;
      transition-delay: 0s !important;
    }
  </style>


















</head>
 <!-- For the color -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">