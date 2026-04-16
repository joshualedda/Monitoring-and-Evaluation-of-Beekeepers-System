<div id="main">
  <div class="main-container">
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h3 class="fw-bold mb-0"><?php echo $this->lang->line('Dashboard'); ?></h3>
                    <p class="text-muted mb-0">Welcome back, <strong><?php echo $_SESSION['name'] ?></strong>. Here's what's happening with the system today.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <form action="<?php echo base_url('dashboard') ?>" method="post" class="d-flex align-items-center gap-2 bg-white px-3 py-2 rounded-3 shadow-sm border">
                        <i class="ph ph-calendar-blank text-primary"></i>
                        <select name="year" class="form-select border-0 bg-transparent fw-semibold" style="cursor: pointer; min-width: 100px;">
                            <?php
                            $startYear = date('Y');
                            $endYear = $startYear - 10;
                            $yearArray = range($startYear, $endYear);
                            foreach ($yearArray as $year) {
                                $selected = ($year == $select_year) ? 'selected' : '';
                                echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm px-3 rounded-2">
                            <i class="ph ph-funnel"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistics Row -->
        <div class="row g-4">
            <!-- News Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-light-danger p-3 rounded-4">
                                <i class="ph ph-newspaper text-danger" style="font-size: 1.8rem;"></i>
                            </div>
                            <span class="badge bg-light-danger text-danger rounded-pill px-3 py-2 fw-semibold">Daily Updates</span>
                        </div>
                        <h2 class="mb-2 fw-bold"><?php echo $total_post ?></h2>
                        <p class="text-muted mb-4 fw-medium"><?php echo $this->lang->line('Latest News'); ?></p>
                        <a href="<?php echo base_url('post/view') ?>" class="text-danger fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">
                            View All News <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Colonies Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-light-info p-3 rounded-4">
                                <i class="ph ph-cube text-info" style="font-size: 1.8rem;"></i>
                            </div>
                            <span class="badge bg-light-info text-info rounded-pill px-3 py-2 fw-semibold">Global count</span>
                        </div>
                        <h2 class="mb-2 fw-bold"><?php echo $total_colony ?></h2>
                        <p class="text-muted mb-4 fw-medium"><?php echo $this->lang->line('Total Colonies'); ?></p>
                        <a href="<?php echo base_url('colony/') ?>" class="text-info fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">
                            Colony Details <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Beekeepers Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-light-warning p-3 rounded-4">
                                <i class="ph ph-users-three text-warning" style="font-size: 1.8rem;"></i>
                            </div>
                            <span class="badge bg-light-warning text-warning rounded-pill px-3 py-2 fw-semibold">Active Members</span>
                        </div>
                        <h2 class="mb-2 fw-bold"><?php echo $total_beekeeper; ?></h2>
                        <p class="text-muted mb-4 fw-medium"><?php echo $this->lang->line('Total Beekeepers'); ?></p>
                        <a href="<?php echo base_url('beekeeper/') ?>" class="text-warning fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">
                            Manage Beekeepers <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Production Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift" style="background: linear-gradient(135deg, #1a4b9c 0%, #0d2245 100%);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-white bg-opacity-25 p-3 rounded-4">
                                <i class="ph ph-drop text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-2 fw-semibold">Year: <?php echo $select_year; ?></span>
                        </div>
                        <h2 class="mb-2 fw-bold text-white"><?php echo number_format($total_production['total_production'] ?? 0, 2) ?> <small class="fs-6 fw-normal op-7">KG</small></h2>
                        <p class="text-white text-opacity-75 mb-4 fw-medium">Honey Production Summary</p>
                        <a href="<?php echo base_url('production/') ?>" class="text-white fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">
                            Yield Reports <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Section (Placeholder for Charts or maps in smaller scale) -->
        <div class="row mt-4">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-0">🗺️ Apiary Locations Map</h5>
                            <p class="text-muted small mb-0">Registered apiary sites across La Union & nearby provinces.</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-light-success text-success rounded-pill px-3 py-2 fw-semibold">
                                <i class="ph ph-map-pin"></i> <?php echo count($dummy_apiaries ?? []); ?> Sites
                            </span>
                            <div class="p-2 bg-light rounded-3">
                                <i class="ph ph-map-trifold fs-5 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 overflow-hidden rounded-bottom-4">
                        <div id="apiaryMap" style="height: 430px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 py-4 px-4">
                        <h5 class="fw-bold mb-0">Regional Focus</h5>
                        <p class="text-muted small mb-0">La Union Provincial Colonies</p>
                    </div>
                    <div class="card-body p-4">
                         <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-4 bg-light">
                             <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary fw-bold">PHL2561</div>
                             <div>
                                <h6 class="fw-bold mb-0">La Union</h6>
                                <p class="text-muted small mb-0">Province Data</p>
                             </div>
                         </div>
                         <div class="p-4 rounded-4 border-dashed text-center">
                            <h2 class="fw-bold text-primary mb-1"><?php echo $total_colony_province ?></h2>
                            <p class="text-muted mb-0 small uppercase fw-bold tracking-wider">Total Colonies in Province</p>
                         </div>
                         <div class="mt-4">
                            <a href="<?php echo base_url('colony/') ?>" class="btn btn-light-primary w-100 py-2 fw-semibold rounded-3">Explore Province View</a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .bg-light-primary  { background-color: #e8f1ff; }
    .bg-light-danger   { background-color: #fff0f0; }
    .bg-light-info     { background-color: #e6f7ff; }
    .bg-light-warning  { background-color: #fff9e6; }
    .bg-light-success  { background-color: #e8f8f0; }
    .text-success      { color: #1a8a4b !important; }
    .text-primary      { color: #1a4b9c !important; }
    .btn-primary       { background-color: #1a4b9c; border-color: #1a4b9c; }
    .btn-primary:hover { background-color: #143b7a; border-color: #143b7a; }
    .btn-light-primary       { background-color: #e8f1ff; color: #1a4b9c; }
    .btn-light-primary:hover { background-color: #1a4b9c; color: #fff; }
    .border-dashed { border: 2px dashed #dfe3e8; }
    .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important; }
    .op-7 { opacity: 0.7; }
    .min-vh-25 { min-height: 250px; }
    .hover-link:hover { text-decoration: underline !important; }
    .hover-link i { transition: transform 0.2s ease; }
    .hover-link:hover i { transform: translateX(3px); }

    /* ── Map Card ────────────────────────────────────────────── */
    #apiaryMap { z-index: 0; border-radius: 0 0 1rem 1rem; }
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,.12);
        font-family: inherit;
    }
    .apiary-popup-title {
        font-weight: 700;
        font-size: .95rem;
        color: #1a4b9c;
        margin-bottom: 4px;
    }
    .apiary-popup-meta {
        font-size: .8rem;
        color: #6c757d;
        line-height: 1.5;
    }
    .apiary-popup-badge {
        display: inline-block;
        background: #e8f1ff;
        color: #1a4b9c;
        border-radius: 20px;
        padding: 2px 10px;
        font-size: .75rem;
        font-weight: 600;
        margin-top: 6px;
    }
</style>


<script type="text/javascript">
    $(document).ready(function() {
        $("#dashboardMainMenu").addClass('active');

        /* ── Dummy Apiary Data ──────────────────────────────────── */
        var apiaries = [
            {
                name: "San Fernando Apiary",
                beekeeper: "José Dela Cruz",
                colonies: 18,
                status: "Active",
                lat: 16.6159,
                lng: 120.3167
            },
            {
                name: "Bauang Honey Farm",
                beekeeper: "Maria Santos",
                colonies: 12,
                status: "Active",
                lat: 16.5301,
                lng: 120.3394
            },
            {
                name: "Agoo Bee Garden",
                beekeeper: "Ricardo Reyes",
                colonies: 9,
                status: "Active",
                lat: 16.3224,
                lng: 120.3679
            },
            {
                name: "Aringay Highland Apiary",
                beekeeper: "Lorna Bautista",
                colonies: 7,
                status: "Inactive",
                lat: 16.3962,
                lng: 120.3583
            },
            {
                name: "Bagnotan Forest Bees",
                beekeeper: "Eduardo Flores",
                colonies: 15,
                status: "Active",
                lat: 16.6901,
                lng: 120.3471
            },
            {
                name: "Caba Valley Hives",
                beekeeper: "Ana Villanueva",
                colonies: 11,
                status: "Active",
                lat: 16.4655,
                lng: 120.3541
            },
            {
                name: "Luna Coastal Apiary",
                beekeeper: "Pedro Evangelista",
                colonies: 6,
                status: "Inactive",
                lat: 16.8513,
                lng: 120.3706
            },
            {
                name: "Naguilian Mountain Hives",
                beekeeper: "Gloria Mendoza",
                colonies: 20,
                status: "Active",
                lat: 16.5492,
                lng: 120.3924
            }
        ];

        /* ── Map Initialization ─────────────────────────────────── */
        var map = L.map('apiaryMap', {
            center: [16.6000, 120.3200],   // La Union centre
            zoom: 10,
            scrollWheelZoom: true
        });

        /* OpenStreetMap tile layer */
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Custom marker icons */
        var activeIcon = L.divIcon({
            className: '',
            html: '<div style="background:#1a4b9c;width:32px;height:32px;border-radius:50%;border:3px solid #fff;box-shadow:0 3px 10px rgba(26,75,156,.45);display:flex;align-items:center;justify-content:center;font-size:15px;">🐝</div>',
            iconSize: [32, 32],
            iconAnchor: [16, 16],
            popupAnchor: [0, -18]
        });

        var inactiveIcon = L.divIcon({
            className: '',
            html: '<div style="background:#adb5bd;width:32px;height:32px;border-radius:50%;border:3px solid #fff;box-shadow:0 3px 10px rgba(0,0,0,.2);display:flex;align-items:center;justify-content:center;font-size:15px;">🐝</div>',
            iconSize: [32, 32],
            iconAnchor: [16, 16],
            popupAnchor: [0, -18]
        });

        /* Place markers */
        apiaries.forEach(function(a) {
            var icon   = (a.status === 'Active') ? activeIcon : inactiveIcon;
            var color  = (a.status === 'Active') ? '#1a8a4b'  : '#6c757d';
            var marker = L.marker([a.lat, a.lng], { icon: icon }).addTo(map);

            marker.bindPopup(
                '<div class="apiary-popup-title">🏡 ' + a.name + '</div>' +
                '<div class="apiary-popup-meta">' +
                    '<b>Beekeeper:</b> ' + a.beekeeper + '<br>' +
                    '<b>Colonies:</b> ' + a.colonies + '<br>' +
                    '<b>Status:</b> <span style="color:' + color + ';font-weight:600;">' + a.status + '</span>' +
                '</div>' +
                '<div class="apiary-popup-badge">🍯 ' + a.colonies + ' colonies</div>',
                { maxWidth: 220 }
            );
        });

        /* ── Legend ─────────────────────────────────────────────── */
        var legend = L.control({ position: 'bottomright' });
        legend.onAdd = function() {
            var div = L.DomUtil.create('div', '');
            div.style.cssText = 'background:#fff;padding:10px 14px;border-radius:10px;box-shadow:0 3px 12px rgba(0,0,0,.12);font-size:.8rem;line-height:1.8;';
            div.innerHTML =
                '<b style="font-size:.85rem;">Apiary Status</b><br>' +
                '<span style="color:#1a4b9c;">🐝</span> Active &nbsp;&nbsp;' +
                '<span style="color:#adb5bd;">🐝</span> Inactive';
            return div;
        };
        legend.addTo(map);
    });
</script>
