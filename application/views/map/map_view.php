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

            <!-- Side Overlay for Stats & Controls -->
            <div class="map-controls-overlay">
                <!-- Stats Card -->
                <div class="card border-0 shadow rounded-4 bg-white bg-opacity-90 backdrop-blur p-3 mb-3" style="width: 240px;">
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
                </div>

                <!-- Available Layers Card -->
                <div class="card border-0 shadow rounded-4 bg-white bg-opacity-90 backdrop-blur p-3 mb-3" style="width: 240px;">
                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="ph ph-stack me-2 text-primary"></i> Available Layers
                    </h6>
                    <div class="form-check form-switch mb-3 border-bottom pb-2">
                        <input class="form-check-input" type="checkbox" id="toggleApiaries" checked>
                        <label class="form-check-label small fw-bold text-primary" for="toggleApiaries">Apiary Locations</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="toggleWeather" checked>
                        <label class="form-check-label small fw-bold" for="toggleWeather">Weather Alerts</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="toggleFire" checked>
                        <label class="form-check-label small fw-bold" for="toggleFire">Fire Risk</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="togglePesticide" checked>
                        <label class="form-check-label small fw-bold" for="togglePesticide">Pesticide Zones</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="toggleAirQuality" checked>
                        <label class="form-check-label small fw-bold" for="toggleAirQuality">Air Quality (AQI)</label>
                    </div>
                </div>

                <!-- Legend Card -->
                <div class="card border-0 shadow rounded-4 bg-white bg-opacity-90 backdrop-blur p-3" style="width: 240px;">
                    <h6 class="fw-bold mb-2 small text-uppercase l-spacing-1">Map Legend</h6>
                    <div class="d-flex align-items-center mb-2 pb-2 border-bottom">
                        <div style="background:#1a4b9c;width:12px;height:12px;border-radius:4px;border:1.5px solid #fff;box-shadow:0 0 0 1px #1a4b9c;" class="me-2"></div>
                        <span class="small fw-bold text-dark">Apiary Site</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <span class="risk-dot bg-danger me-2"></span>
                        <span class="small">High Risk Area</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <span class="risk-dot bg-warning me-2"></span>
                        <span class="small">Moderate Risk</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <span class="risk-dot bg-success me-2"></span>
                        <span class="small">Low Risk / Safe</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="risk-dot bg-primary me-2"></span>
                        <span class="small">Optimal Conditions</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>

<!-- Styles for Map View -->
<style>
    .backdrop-blur { backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
    .map-controls-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1000;
        max-height: calc(100% - 40px);
        overflow-y: auto;
        padding-right: 5px;
    }
    .map-controls-overlay::-webkit-scrollbar { width: 4px; }
    .map-controls-overlay::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
    
    #apiaryMap { z-index: 1; }

    .risk-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
    }

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
    .apiary-popup { padding: 5px; text-align: left !important; min-width: 240px; }
    .apiary-popup-header { 
        display: flex; 
        align-items: center; 
        gap: 12px; 
        margin-bottom: 15px; 
        padding: 10px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
    }
    .apiary-popup-icon {
        width: 42px;
        height: 42px;
        background: white;
        color: #1a4b9c;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .apiary-popup-title { font-weight: 800; color: #1a202c; font-size: 1.05rem; margin: 0; line-height: 1.2; }
    .apiary-popup-body { font-size: 0.9rem; color: #4a5568; line-height: 1.7; padding: 0 5px; }
    .apiary-popup-footer { margin-top: 15px; padding-top: 12px; border-top: 1px solid #edf2f7; }
    
    .apiary-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .apiary-badge-active { background: #d1e7dd; color: #0f5132; }
    .apiary-badge-inactive { background: #f8d7da; color: #842029; }

    .popup-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }
    .popup-info-icon {
        width: 24px;
        height: 24px;
        background: #f1f5f9;
        color: #64748b;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    /* Marker Animations */
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    .bee-marker-active { animation: pulse 2s infinite ease-in-out; }

    /* Warning Marker */
    .bee-marker-warning {
        position: relative;
    }
    .bee-marker-warning::after {
        content: '!';
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        z-index: 2;
    }

    /* Hazard Zone Tooltip/Pin */
    .hazard-pin-popup .leaflet-popup-content-wrapper {
        border-top: 5px solid #ef4444;
        padding: 0;
        overflow: hidden;
    }
    .hazard-popup-header {
        padding: 15px;
        background: #fff5f5;
        border-bottom: 1px solid #fee2e2;
    }
    .hazard-popup-body {
        padding: 15px;
    }
    .severity-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
</style>

<!-- Turf.js for Spatial Analysis -->
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

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

        /* ── Map Layers & Hazards ──────────────────────────────── */
        
        var hazardLayers = {
            weather: L.layerGroup(),
            fire: L.layerGroup(),
            pesticide: L.layerGroup(),
            airQuality: L.layerGroup()
        };

        // Mock Hazard Data
        var mockHazards = [
            {
                type: 'pesticide',
                severity: 'High',
                color: '#ef4444',
                name: 'Pesticide Application Zone A',
                desc: 'Scheduled spraying of Neonicotinoids. Highly toxic to bees.',
                polygon: [[16.6200, 120.3100], [16.6400, 120.3300], [16.6400, 120.3500], [16.6100, 120.3400]]
            },
            {
                type: 'fire',
                severity: 'Medium',
                color: '#f59e0b',
                name: 'Wildfire Risk Area',
                desc: 'Dry conditions increasing fire risk in forest boundaries.',
                polygon: [[16.5700, 120.2900], [16.5900, 120.3100], [16.5800, 120.3300], [16.5600, 120.3100]]
            },
            {
                type: 'weather',
                severity: 'High',
                color: '#ef4444',
                name: 'Severe Storm Warning',
                desc: 'Projected heavy rainfall and high winds (above 60km/h).',
                circle: [16.6500, 120.3800],
                radius: 3000
            },
            {
                type: 'airQuality',
                severity: 'Low',
                color: '#0d6efd', // Blue
                name: 'Optimal Air Quality',
                desc: 'Clean air conditions detected. Excellent for bee foraging.',
                circle: [16.5500, 120.3500],
                radius: 4000
            },
            {
                type: 'weather',
                severity: 'Low',
                color: '#198754', // Green
                name: 'Safe Foraging Zone',
                desc: 'Calm winds and clear skies. Ideal conditions for hive activity.',
                polygon: [[16.5200, 120.2500], [16.5400, 120.2700], [16.5400, 120.2900], [16.5100, 120.2800]]
            }
        ];

        var activeHazardZones = [];

        function drawHazards() {
            // Clear existing
            Object.values(hazardLayers).forEach(layer => layer.clearLayers());
            activeHazardZones = [];

            mockHazards.forEach(function(h) {
                var layer;
                var turfFeature;

                if (h.polygon) {
                    layer = L.polygon(h.polygon, {
                        color: h.color,
                        fillColor: h.color,
                        fillOpacity: 0.3,
                        weight: 2
                    });
                    // Convert to Turf Polygon for collision detection
                    var coords = h.polygon.map(p => [p[1], p[0]]); // Swap to [lng, lat] for Turf
                    coords.push(coords[0]); // Close polygon
                    turfFeature = turf.polygon([coords], h);
                } else if (h.circle) {
                    layer = L.circle(h.circle, {
                        radius: h.radius,
                        color: h.color,
                        fillColor: h.color,
                        fillOpacity: 0.3,
                        weight: 2
                    });
                    // Convert to Turf Circle
                    turfFeature = turf.circle([h.circle[1], h.circle[0]], h.radius / 1000, { units: 'kilometers', properties: h });
                }

                if (layer) {
                    var iconHtml = h.type === 'fire' ? '<i class="ph-bold ph-flame"></i>' : 
                                   h.type === 'pesticide' ? '<i class="ph-bold ph-flask"></i>' : 
                                   h.type === 'weather' ? '<i class="ph-bold ph-cloud-rain"></i>' : '<i class="ph-bold ph-warning"></i>';

                    layer.bindPopup(`
                        <div class="hazard-pin-popup-container" style="min-width:260px;">
                            <div class="hazard-popup-header" style="background:${h.color}11; border-color:${h.color}33">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div style="width:32px; height:32px; background:${h.color}; color:white; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.2rem;">
                                        ${iconHtml}
                                    </div>
                                    <h6 class="fw-bold mb-0 text-uppercase" style="color:${h.color}; font-size:0.9rem;">${h.name}</h6>
                                </div>
                                <div class="severity-badge" style="background:${h.color}; color:white;">
                                    ${h.severity} SEVERITY
                                </div>
                            </div>
                            <div class="hazard-popup-body">
                                <p class="small mb-3 text-secondary" style="line-height:1.5;">${h.desc}</p>
                                <div class="p-2 rounded-3 bg-light border small text-muted mb-3">
                                    <i class="ph ph-info me-1"></i> Precautionary measures recommended for beekeepers in this area.
                                </div>
                                <button class="btn btn-sm btn-light w-100 border rounded-3 fw-bold text-uppercase py-2" style="font-size:0.7rem;" onclick="this.closest('.leaflet-popup').remove()">
                                    Acknowledge & Close
                                </button>
                            </div>
                        </div>
                    `, { className: 'hazard-pin-popup', padding: [0, 0] });

                    // Pinning functionality: Pin on click
                    layer.on('click', function(e) {
                        this.openPopup();
                    });

                    layer.addTo(hazardLayers[h.type]);
                    activeHazardZones.push(turfFeature);
                }
            });

            // Add layers to map if toggled
            if ($('#toggleWeather').is(':checked')) hazardLayers.weather.addTo(map);
            if ($('#toggleFire').is(':checked')) hazardLayers.fire.addTo(map);
            if ($('#togglePesticide').is(':checked')) hazardLayers.pesticide.addTo(map);
            if ($('#toggleAirQuality').is(':checked')) hazardLayers.airQuality.addTo(map);
        }

        /* ── Custom Marker Icons ────────────────────────────────── */
        function createBeeIcon(active, inHazard) {
            var color = active ? '#1a4b9c' : '#adb5bd';
            var shadow = active ? 'rgba(26,75,156,0.3)' : 'rgba(0,0,0,0.1)';
            var className = (active ? 'bee-marker-active ' : '') + (inHazard ? 'bee-marker-warning' : '');
            
            return L.divIcon({
                className: className,
                html: `<div style="background:${color};width:34px;height:34px;border-radius:12px;border:3px solid #fff;box-shadow:0 4px 12px ${shadow};display:flex;align-items:center;justify-content:center;font-size:16px;color:white;">
                         <i class="ph-bold ph-sketch-logo"></i>
                       </div>`,
                iconSize: [34, 34],
                iconAnchor: [17, 17],
                popupAnchor: [0, -20]
            });
        }

        /* ── Render Markers with Risk Check ──────────────────────── */
        var apiaryMarkers = [];
        
        function renderMarkers() {
            // Remove existing markers
            apiaryMarkers.forEach(m => map.removeLayer(m));
            apiaryMarkers = [];
            
            locations.forEach(function(loc) {
                var markerPos = [parseFloat(loc.lat), parseFloat(loc.lng)];
                markerBounds.push(markerPos);

                // Risk Detection using Turf.js
                var pt = turf.point([parseFloat(loc.lng), parseFloat(loc.lat)]);
                var hazardsFound = [];
                
                activeHazardZones.forEach(zone => {
                    // Only check if the layer type is enabled
                    if ($('#toggle' + zone.properties.type.charAt(0).toUpperCase() + zone.properties.type.slice(1)).is(':checked')) {
                        if (turf.booleanPointInPolygon(pt, zone)) {
                            hazardsFound.push(zone.properties);
                        }
                    }
                });

                var inHazard = hazardsFound.length > 0;
                var icon = createBeeIcon(loc.active == 1, inHazard);
                var marker = L.marker(markerPos, { icon: icon }).addTo(map);
                apiaryMarkers.push(marker);

                // Hazard Warning for Popup
                var hazardWarning = '';
                if (inHazard) {
                    hazardWarning = `
                        <div class="mt-3 p-3 rounded-4 border-0 d-flex flex-column gap-2" style="background: #fff1f2; border: 1px solid #ffe4e6 !important;">
                            <div class="d-flex align-items-center text-danger fw-bold small">
                                <i class="ph-bold ph-warning-octagon me-2 fs-5"></i>
                                ACTIVE RISK DETECTED
                            </div>
                            <div class="text-secondary" style="font-size: 0.75rem;">
                                ${hazardsFound[0].name} (${hazardsFound[0].severity})
                            </div>
                            <div class="mt-1">
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 rounded-pill" style="font-size:0.6rem;">EVACUATION ADVISED</span>
                            </div>
                        </div>
                    `;
                }

                // Detailed Popup
                var popupContent = `
                    <div class="apiary-popup">
                        <div class="apiary-popup-header">
                            <div class="apiary-popup-icon"><i class="ph ph-house-line"></i></div>
                            <div>
                                <h6 class="apiary-popup-title">${loc.name}</h6>
                                <div class="apiary-badge ${loc.active == 1 ? 'apiary-badge-active' : 'apiary-badge-inactive'} mt-1">
                                    ${loc.active == 1 ? 'Active Site' : 'Inactive'}
                                </div>
                            </div>
                        </div>
                        <div class="apiary-popup-body">
                            <div class="popup-info-item">
                                <div class="popup-info-icon"><i class="ph ph-user"></i></div>
                                <div><small class="text-muted d-block" style="font-size:0.65rem;">OWNER / BEEKEEPER</small><strong>${loc.beekeeper}</strong></div>
                            </div>
                            <div class="popup-info-item">
                                <div class="popup-info-icon"><i class="ph ph-cube"></i></div>
                                <div><small class="text-muted d-block" style="font-size:0.65rem;">COLONY COUNT</small><strong>${loc.colonies} Registered Hives</strong></div>
                            </div>
                            ${hazardWarning}
                        </div>
                        <div class="apiary-popup-footer">
                            <a href="<?php echo base_url('apiary/update/'); ?>${loc.id}" class="btn btn-primary w-100 rounded-3 py-2 fw-bold l-spacing-1 shadow-sm border-0">
                                <i class="ph ph-magnifying-glass me-2"></i> VIEW FULL PROFILE
                            </a>
                        </div>
                    </div>
                `;

                marker.bindPopup(popupContent, { maxWidth: 260 });
            });
        }

        // Initial Draw
        drawHazards();
        renderMarkers();

        // Layer Toggles
        $('.form-check-input').on('change', function() {
            var inputId = $(this).attr('id');
            
            if (inputId === 'toggleApiaries') {
                if ($(this).is(':checked')) {
                    apiaryMarkers.forEach(m => map.addLayer(m));
                } else {
                    apiaryMarkers.forEach(m => map.removeLayer(m));
                }
                return;
            }

            var layerId = inputId.replace('toggle', '');
            layerId = layerId.charAt(0).toLowerCase() + layerId.slice(1);
            
            if ($(this).is(':checked')) {
                hazardLayers[layerId].addTo(map);
            } else {
                map.removeLayer(hazardLayers[layerId]);
            }
            
            // Re-render markers to update risk status
            renderMarkers();
        });

        /* Auto Fit Map to Markers if data exists */
        if (markerBounds.length > 0) {
            map.fitBounds(markerBounds, { padding: [50, 50] });
        }
    });
</script>