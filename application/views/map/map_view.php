<div id="main">
  <div class="main-container">

    <div class="page-header-card mb-0 rounded-bottom-0">
      <div>
        <h4><i class="ph ph-map-trifold me-2 text-primary"></i><?php echo $page_title; ?></h4>
        <p>Geographic distribution of registered apiaries and hive activity.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item active small text-primary fw-medium">Map View</li>
        </ol>
      </nav>
    </div>

    <!-- Map Container Card -->
    <div class="card border-0 shadow-sm rounded-4 rounded-top-0 overflow-hidden">
        <div class="card-body p-0 position-relative">
            <!-- Map Element -->
            <div id="apiaryMap" style="height: calc(100vh - 220px); min-height: 500px; width: 100%;"></div>

            <!-- Side Overlay for Stats (Optional/Floating) -->
            <div class="map-stats-overlay d-none d-md-block">
                <div class="card border-0 shadow rounded-4 bg-white bg-opacity-90 backdrop-blur p-3" style="width: 240px;">
                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="ph ph-chart-pie-slice me-2 text-primary"></i> Map Overview
                    </h6>
                    <div class="d-flex flex-column gap-2 text-start">
                        <div class="p-2 rounded-3 bg-light">
                            <small class="text-muted d-block l-spacing-1 text-uppercase fw-bold" style="font-size: 0.65rem;">Total Apiaries</small>
                            <span class="fw-bold fs-5"><?php echo count($apiary_locations); ?> Sites</span>
                        </div>
                        <div class="p-2 rounded-3 bg-light">
                            <small class="text-muted d-block l-spacing-1 text-uppercase fw-bold" style="font-size: 0.65rem;">Active Locations</small>
                            <span class="fw-bold text-success fs-5">
                                <?php 
                                    $active_count = 0;
                                    foreach($apiary_locations as $loc) if($loc['active'] == 1) $active_count++;
                                    echo $active_count;
                                ?>
                            </span>
                        </div>
                    </div>
                    <hr class="my-3 opacity-10">
                    <p class="small text-muted mb-0">Markers represent Registered Apiary locations. Click on a marker to see more details.</p>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>

<!-- Styles for Map View -->
<style>
    .backdrop-blur { backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
    .map-stats-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }
    #apiaryMap { z-index: 1; }

    /* Customizing Leaflet Elements to match Premium UI */
    .leaflet-popup-content-wrapper {
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        padding: 5px;
    }
    .leaflet-popup-tip-container { display: none; }
    .leaflet-container a.leaflet-popup-close-button {
        padding: 8px 8px 0 0;
        color: #adb5bd;
    }
    .apiary-popup { padding: 8px; text-start: left !important; }
    .apiary-popup-header { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
    .apiary-popup-icon {
        width: 36px;
        height: 36px;
        background: #e8f1ff;
        color: #1a4b9c;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    .apiary-popup-title { font-weight: 700; color: #1a202c; font-size: 1rem; margin: 0; }
    .apiary-popup-body { font-size: 0.85rem; color: #4a5568; line-height: 1.6; }
    .apiary-popup-footer { margin-top: 12px; padding-top: 10px; border-top: 1px solid #edf2f7; }
    .apiary-badge {
        background: #f7fafc;
        border: 1px solid #e2e8f0;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #4a5568;
    }

    /* Marker Animations */
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    .bee-marker-active { animation: pulse 2s infinite ease-in-out; }
</style>

<!-- Scripts -->
<script type="text/javascript">
    $(document).ready(function() {
        // Set Sidebar Nav Active
        $("#gmapsNav").addClass('active');

        var locations = <?php echo json_encode($apiary_locations); ?>;

        /* ── Map Initialization ─────────────────────────────────── */
        var map = L.map('apiaryMap', {
            center: [16.6000, 120.3200], // Default center (La Union)
            zoom: 11,
            scrollWheelZoom: true,
            zoomControl: false // Manual placement below
        });

        // Custom Zoom Control position
        L.control.zoom({ position: 'bottomleft' }).addTo(map);

        /* Premium Map Layer (OpenStreetMap with adjusted style if needed) */
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Custom Marker Icons */
        function createBeeIcon(active) {
            var color = active ? '#1a4b9c' : '#adb5bd';
            var shadow = active ? 'rgba(26,75,156,0.3)' : 'rgba(0,0,0,0.1)';
            return L.divIcon({
                className: active ? 'bee-marker-active' : '',
                html: `<div style="background:${color};width:34px;height:34px;border-radius:12px;border:3px solid #fff;box-shadow:0 4px 12px ${shadow};display:flex;align-items:center;justify-content:center;font-size:16px;color:white;">
                         <i class="ph-bold ph-sketch-logo"></i>
                       </div>`,
                iconSize: [34, 34],
                iconAnchor: [17, 17],
                popupAnchor: [0, -20]
            });
        }

        /* Bounds to auto-fit markers */
        var markerBounds = [];

        /* Add Markers to Map */
        locations.forEach(function(loc) {
            var markerPos = [parseFloat(loc.lat), parseFloat(loc.lng)];
            markerBounds.push(markerPos);

            var icon = createBeeIcon(loc.active == 1);
            var marker = L.marker(markerPos, { icon: icon }).addTo(map);

            // Detailed Popup
            var popupContent = `
                <div class="apiary-popup">
                    <div class="apiary-popup-header">
                        <div class="apiary-popup-icon"><i class="ph ph-house-line"></i></div>
                        <div>
                            <h6 class="apiary-popup-title">${loc.name}</h6>
                            <span class="apiary-badge">${loc.active == 1 ? 'Active' : 'Inactive'}</span>
                        </div>
                    </div>
                    <div class="apiary-popup-body">
                        <div class="mb-1"><strong><i class="ph ph-user me-1 text-primary"></i> Beekeeper:</strong> ${loc.beekeeper}</div>
                        <div><strong><i class="ph ph-cube me-1 text-warning"></i> Colonies:</strong> ${loc.colonies} Registered</div>
                    </div>
                    <div class="apiary-popup-footer">
                        <a href="<?php echo base_url('apiary/update/'); ?>${loc.id}" class="btn btn-primary btn-sm w-100 rounded-3 py-1 fw-bold l-spacing-1">
                            VIEW DETAILS
                        </a>
                    </div>
                </div>
            `;

            marker.bindPopup(popupContent, { maxWidth: 260 });
        });

        /* Auto Fit Map to Markers if data exists */
        if (markerBounds.length > 0) {
            map.fitBounds(markerBounds, { padding: [50, 50] });
        }
    });
</script>