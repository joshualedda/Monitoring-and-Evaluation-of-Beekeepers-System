document.addEventListener('DOMContentLoaded', function() {
    // Handle sidebar dropdown collapses - let Bootstrap handle toggle, we just sync UI
    document.querySelectorAll('.sidebar-dropdown[data-bs-toggle="collapse"]').forEach(function(link) {
      // Get the collapse target
      const targetId = link.getAttribute('href') || link.getAttribute('data-bs-target');
      if (!targetId) return;
      
      const target = document.querySelector(targetId);
      if (!target) return;

      // Listen to Bootstrap's collapse events to update UI state
      target.addEventListener('shown.bs.collapse', function() {
        link.setAttribute('aria-expanded', 'true');
        const icon = link.querySelector('.nav-small-cap-icon');
        if (icon) {
          icon.classList.add('rotate');
        }
      });

      target.addEventListener('hidden.bs.collapse', function() {
        link.setAttribute('aria-expanded', 'false');
        const icon = link.querySelector('.nav-small-cap-icon');
        if (icon) {
          icon.classList.remove('rotate');
        }
      });
    });
  });