    </div> <!-- End .container-fluid -->
  </div> <!-- End .body-wrapper -->
</div> <!-- End .page-wrapper -->

<!-- Leaflet JS (Philippine Map) -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<!-- Charts -->
<script src="<?= base_url('assets/js/charts.js'); ?>"></script>




<script src="<?= base_url('assets/js/main.js'); ?>"></script>
<script src="<?= base_url('assets/js/index.js'); ?>"></script>


<!-- <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script> -->
<!-- <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.js'); ?>"></script> -->
<!-- Js -->
<script src="<?= base_url('assets/js/app.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/sidebarmenu.js'); ?>"></script>
<script src="<?= base_url('assets/js/dashboard.js'); ?>"></script>

<!-- Additional -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Forms -->
<script src="<?= base_url('assets/js/forms.js') ?>"></script>

<!-- Toast Notifications Script -->
<script>
    $(document).ready(function() {
        // Configure toastr
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Check for flash data and show toast
        <?php if ($this->session->flashdata('toast_message')): ?>
            var message = '<?= $this->session->flashdata('toast_message') ?>';
            var type = '<?= $this->session->flashdata('toast_type') ?: 'info' ?>';

            switch (type) {
                case 'success':
                    toastr.success(message);
                    break;
                case 'error':
                    toastr.error(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'info':
                default:
                    toastr.info(message);
                    break;
            }
        <?php endif; ?>
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle sidebar dropdowns - use Bootstrap collapse but with custom logic
        const dropdownToggles = document.querySelectorAll('.sidebar-dropdown[data-bs-toggle="collapse"]');
        const navContents = document.querySelectorAll('.nav-content');

        // Initialize all menus - preserve Bootstrap collapse classes but ensure proper state
        navContents.forEach(menu => {
            // Remove any transitions for instant response
            menu.style.transition = 'none';
            menu.style.transitionDuration = '0s';

            const isActive = menu.classList.contains('show');
            if (!isActive) {
                // If not active, ensure it's hidden
                menu.classList.remove('show', 'collapsing');
                menu.style.display = 'none';
            } else {
                // If active, ensure it's visible
                menu.style.display = 'block';
            }
        });

        // Handle each dropdown toggle
        dropdownToggles.forEach(toggle => {
            const targetId = toggle.getAttribute('href');
            if (!targetId) return;

            const targetMenu = document.querySelector(targetId);
            if (!targetMenu) return;

            // Set initial aria-expanded state based on show class
            const isInitiallyOpen = targetMenu.classList.contains('show');
            toggle.setAttribute('aria-expanded', isInitiallyOpen ? 'true' : 'false');

            // Add click handler - prevent Bootstrap default and handle ourselves
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const targetId = this.getAttribute('href');
                if (!targetId) return;

                const targetMenu = document.querySelector(targetId);
                if (!targetMenu) return;

                // Check if menu is currently open
                const isOpen = targetMenu.style.display === 'block' || targetMenu.classList.contains('show');

                // Disable transitions for instant response
                targetMenu.style.transition = 'none';
                targetMenu.style.transitionDuration = '0s';

                // Toggle the menu instantly
                if (isOpen) {
                    // Close the menu
                    targetMenu.style.display = 'none';
                    targetMenu.classList.remove('show', 'collapsing');
                    this.setAttribute('aria-expanded', 'false');

                    // Remove active class from parent
                    const parentItem = this.closest('.sidebar-item');
                    if (parentItem) {
                        parentItem.classList.remove('active');
                    }
                } else {
                    // Close all other menus first (optional - uncomment if you want only one open at a time)
                    // closeAllDropdownMenus(this);

                    // Open this menu instantly
                    targetMenu.style.display = 'block';
                    targetMenu.classList.add('show');
                    targetMenu.classList.remove('collapsing');
                    this.setAttribute('aria-expanded', 'true');

                    // Add active class to parent
                    const parentItem = this.closest('.sidebar-item');
                    if (parentItem) {
                        parentItem.classList.add('active');
                    }
                }
            });
        });

        // Helper function to close all dropdown menus except the one passed
        function closeAllDropdownMenus(exceptToggle) {
            navContents.forEach(menu => {
                // Skip if this is the menu we want to keep open
                if (exceptToggle) {
                    const exceptTargetId = exceptToggle.getAttribute('href');
                    if (menu.id && exceptTargetId === '#' + menu.id) {
                        return;
                    }
                }

                menu.style.display = 'none';
                menu.classList.remove('show');

                // Update toggle button state
                const toggle = document.querySelector(`.sidebar-dropdown[href="#${menu.id}"]`);
                if (toggle && toggle !== exceptToggle) {
                    toggle.setAttribute('aria-expanded', 'false');
                    const parentItem = toggle.closest('.sidebar-item');
                    if (parentItem) {
                        parentItem.classList.remove('active');
                    }
                }
            });
        }

        // Search functionality (your existing code)
        var input = document.getElementById('sidebarSearch');
        if (input) {
            input.addEventListener('input', function() {
                var filter = this.value.toLowerCase();
                var items = document.querySelectorAll('#sidebarnav li.sidebar-item');
                var smallCaps = document.querySelectorAll('#sidebarnav li.nav-small-cap');

                for (var i = 0; i < items.length; i++) {
                    var txt = items[i].textContent || items[i].innerText;
                    items[i].style.display = txt.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                }

                smallCaps.forEach(function(cap) {
                    var sectionVisible = false;
                    var nextElement = cap.nextElementSibling;

                    while (nextElement && !nextElement.classList.contains('nav-small-cap')) {
                        if (nextElement.style.display !== 'none') {
                            sectionVisible = true;
                            break;
                        }
                        nextElement = nextElement.nextElementSibling;
                    }

                    cap.style.display = sectionVisible ? '' : 'none';
                });
            });
        }
    });
</script>
</body>

</html>