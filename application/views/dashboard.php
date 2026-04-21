<div id="main">
  <div class="main-container">

    <!-- Page Heading -->
    <div class="mb-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h3 class="fw-bold mb-0"><?php echo $this->lang->line('Dashboard'); ?></h3>
          <p class="text-muted mb-0">Welcome back, <strong><?php echo $_SESSION['name'] ?></strong>. Here's what's happening today.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
          <form action="<?php echo base_url('dashboard') ?>" method="post" class="d-flex align-items-center gap-2 bg-white px-3 py-2 rounded-3 shadow-sm border">
            <i class="ph ph-calendar-blank text-primary"></i>
            <select name="year" class="form-select border-0 bg-transparent fw-semibold" style="cursor:pointer;min-width:100px;">
              <?php foreach (range(date('Y'), date('Y')-10) as $year) {
                echo '<option '.($year==$select_year?'selected':'').' value="'.$year.'">'.$year.'</option>';
              } ?>
            </select>
            <button type="submit" class="btn btn-primary btn-sm px-3 rounded-2"><i class="ph ph-funnel"></i></button>
          </form>
        </div>
      </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4">
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
          <div class="card-body p-4">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="bg-light-danger p-3 rounded-4"><i class="ph ph-newspaper text-danger" style="font-size:1.8rem;"></i></div>
              <span class="badge bg-light-danger text-danger rounded-pill px-3 py-2 fw-semibold">Daily Updates</span>
            </div>
            <h2 class="mb-2 fw-bold"><?php echo $total_post ?></h2>
            <p class="text-muted mb-4 fw-medium"><?php echo $this->lang->line('Latest News'); ?></p>
            <a href="<?php echo base_url('post/view') ?>" class="text-danger fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">View All <i class="ph ph-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
          <div class="card-body p-4">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="bg-light-info p-3 rounded-4"><i class="ph ph-cube text-info" style="font-size:1.8rem;"></i></div>
              <span class="badge bg-light-info text-info rounded-pill px-3 py-2 fw-semibold">Global count</span>
            </div>
            <h2 class="mb-2 fw-bold"><?php echo $total_colony ?></h2>
            <p class="text-muted mb-4 fw-medium"><?php echo $this->lang->line('Total Colonies'); ?></p>
            <a href="<?php echo base_url('colony/') ?>" class="text-info fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">Details <i class="ph ph-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
          <div class="card-body p-4">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="bg-light-warning p-3 rounded-4"><i class="ph ph-users-three text-warning" style="font-size:1.8rem;"></i></div>
              <span class="badge bg-light-warning text-warning rounded-pill px-3 py-2 fw-semibold">Active Members</span>
            </div>
            <h2 class="mb-2 fw-bold"><?php echo $total_beekeeper; ?></h2>
            <p class="text-muted mb-4 fw-medium"><?php echo $this->lang->line('Total Beekeepers'); ?></p>
            <a href="<?php echo base_url('beekeeper/') ?>" class="text-warning fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">Manage <i class="ph ph-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift" style="background:#1a4b9c;">
          <div class="card-body p-4">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="p-3 rounded-4" style="background:rgba(255,255,255,.15);"><i class="ph ph-drop text-white" style="font-size:1.8rem;"></i></div>
              <span class="badge text-white rounded-pill px-3 py-2 fw-semibold" style="background:rgba(255,255,255,.2);">Year: <?php echo $select_year; ?></span>
            </div>
            <h2 class="mb-2 fw-bold text-white"><?php echo number_format($total_production['total_production'] ?? 0, 2) ?> <small class="fs-6 fw-normal" style="opacity:.7">KG</small></h2>
            <p class="mb-4 fw-medium" style="color:rgba(255,255,255,.7)">Honey Production</p>
            <a href="<?php echo base_url('production/') ?>" class="text-white fw-semibold d-flex align-items-center gap-1 text-decoration-none hover-link">Reports <i class="ph ph-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Map + Regional Focus -->
    <div class="row mt-4">
      <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-header bg-white border-0 py-4 px-4 d-flex align-items-center justify-content-between">
            <div>
              <h5 class="fw-bold mb-1">🗺️ Apiary Locations Map</h5>
              <p class="text-muted small mb-0">Click any pin for details &amp; live weather.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
              <span class="badge bg-light-success text-success rounded-pill px-3 py-2 fw-semibold">
                <i class="ph ph-map-pin"></i> <?php echo count($apiary_locations); ?> Sites
              </span>
              <!-- Full Map Button -->
              <button id="openFullMapBtn" class="btn btn-sm px-3 rounded-3 fw-semibold" style="background:#f0f4ff;color:#1a4b9c;border:1px solid #d0dcf8;" onclick="openFullMap()">
                <i class="ph ph-arrows-out me-1"></i> Full Map
              </button>
            </div>
          </div>
          <div class="card-body p-0 overflow-hidden rounded-bottom-4">
            <div id="apiaryMap" style="height:400px;width:100%;"></div>
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
              <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary fw-bold small">Province: La Union</div>
            </div>
            <div class="p-4 rounded-4 border-dashed text-center">
              <h2 class="fw-bold text-primary mb-1"><?php echo $total_colony_province ?></h2>
              <p class="text-muted mb-0 small fw-bold text-uppercase">Total Colonies</p>
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

<!-- ============================================================
     FULL MAP ANALYTICS MODAL
     ============================================================ -->
<div class="modal fade" id="fullMapModal" tabindex="-1" role="dialog" style="z-index:1055;">
  <div class="modal-dialog" role="document" style="max-width:100vw;width:100vw;margin:0;height:100vh;">
    <div class="modal-content border-0 rounded-0" style="height:100vh;overflow:hidden;">

      <!-- ── Top Bar ── -->
      <div class="fullmap-topbar d-flex align-items-center justify-content-between px-4" style="height:62px;flex-shrink:0;z-index:10;background:#12243a;border-bottom:1px solid #1e3553;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center gap-2 me-2">
            <div style="width:32px;height:32px;background:rgba(255,255,255,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🗺️</div>
            <span class="fw-bold text-white" style="font-size:1rem;letter-spacing:-.01em;">Apiary Intelligence Map</span>
          </div>
          <!-- Layer Toggle Buttons -->
          <div class="d-flex gap-2" id="heatmap-toggles">
            <button class="fullmap-layer-btn active" data-layer="none" onclick="setLayer('none',this)"><i class="ph ph-map-pin me-1"></i>All Pins</button>
            <button class="fullmap-layer-btn" data-layer="production" onclick="setLayer('production',this)">🍯 Production</button>
            <button class="fullmap-layer-btn" data-layer="disease" onclick="setLayer('disease',this)">⚠️ Risk Zones</button>
            <button class="fullmap-layer-btn" data-layer="colonies" onclick="setLayer('colonies',this)">🐝 Clusters</button>
          </div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button class="fullmap-analytics-toggle" id="analyticsToggleBtn" onclick="toggleAnalyticsPanel()">
            <i class="ph ph-chart-bar me-1"></i> Analytics Panel
          </button>
          <button type="button" class="btn-close btn-close-white" data-dismiss="modal" style="opacity:.6;"></button>
        </div>
      </div>

      <div class="d-flex" style="height:calc(100vh - 62px);">

        <!-- ── Full Map ── -->
        <div id="fullMapContainer" style="flex:1;position:relative;">
          <div id="fullMap" style="width:100%;height:100%;"></div>

          <!-- Heatmap Legend -->
          <div id="heatmap-legend" class="d-none" style="position:absolute;bottom:24px;left:20px;z-index:999;background:#fff;padding:12px 16px;border-radius:12px;box-shadow:0 6px 20px rgba(0,0,0,.14);font-size:.78rem;min-width:180px;">
            <div class="fw-bold text-dark mb-1" id="hl-title" style="font-size:.82rem;">Intensity</div>
            <div class="d-flex align-items-center gap-2 mt-1">
              <div style="flex:1;height:8px;border-radius:4px;background:linear-gradient(90deg,#4575b4,#91cf60,#fc8d59,#d73027);"></div>
            </div>
            <div class="d-flex justify-content-between mt-1"><span class="text-muted" style="font-size:.68rem;">Low</span><span class="text-muted" style="font-size:.68rem;">High</span></div>
          </div>
        </div>

        <!-- ── Analytics Side Panel ── -->
        <div id="analyticsPanel" style="width:420px;height:100%;overflow-y:auto;background:#f4f6fb;border-left:2px solid #e0e6f0;flex-shrink:0;display:none;">

          <!-- Panel Header -->
          <div style="background:#1a4b9c;padding:16px 20px 12px;position:sticky;top:0;z-index:5;">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="text-white fw-bold" style="font-size:.95rem;">📊 Analytics</div>
                <div style="color:rgba(255,255,255,.6);font-size:.72rem;margin-top:1px;">Apiary performance insights</div>
              </div>
            </div>
            <!-- Tabs inside panel header -->
            <div class="d-flex gap-1 mt-3">
              <button class="ap-tab active" id="apTab-heatmap" onclick="switchTab2(this,'tab-heatmap-info')">🔥 Heatmaps</button>
              <button class="ap-tab" id="apTab-trends" onclick="switchTab2(this,'tab-trends')">📈 Trends</button>
            </div>
          </div>

          <div class="p-3">

            <!-- ══ HEATMAP INFO TAB ══ -->
            <div id="tab-heatmap-info">

              <p class="text-muted small mb-3" style="font-size:.78rem;">Select a layer above to overlay heatmaps on the map. Click any pin for detailed data.</p>

              <!-- Layer Cards -->
              <div class="fm-section-label">Available Layers</div>

              <div class="fm-layer-card mb-2" onclick="setLayer('production', document.querySelector('[data-layer=production]'))" style="--accent:#f39c12;">
                <div class="fm-layer-icon" style="background:rgba(243,156,18,.12);">🍯</div>
                <div class="flex-grow-1">
                  <div class="fw-bold small text-dark">Best Honey-Producing Areas</div>
                  <div class="text-muted" style="font-size:.72rem;margin-top:2px;">Total production (kg) per apiary. Red = highest yield.</div>
                </div>
                <div class="fm-layer-pill" style="background:rgba(243,156,18,.12);color:#f39c12;">Yield</div>
              </div>

              <div class="fm-layer-card mb-2" onclick="setLayer('disease', document.querySelector('[data-layer=disease]'))" style="--accent:#dc3545;">
                <div class="fm-layer-icon" style="background:rgba(220,53,69,.1);">⚠️</div>
                <div class="flex-grow-1">
                  <div class="fw-bold small text-dark">High Disease / Risk Zones</div>
                  <div class="text-muted" style="font-size:.72rem;margin-top:2px;">Inactive colony ratio — higher = more risk.</div>
                </div>
                <div class="fm-layer-pill" style="background:rgba(220,53,69,.1);color:#dc3545;">Risk</div>
              </div>

              <div class="fm-layer-card mb-3" onclick="setLayer('colonies', document.querySelector('[data-layer=colonies]'))" style="--accent:#1a8a4b;">
                <div class="fm-layer-icon" style="background:rgba(26,138,75,.1);">🐝</div>
                <div class="flex-grow-1">
                  <div class="fw-bold small text-dark">Strong Colony Clusters</div>
                  <div class="text-muted" style="font-size:.72rem;margin-top:2px;">Colony population density. Red = highest concentration.</div>
                </div>
                <div class="fm-layer-pill" style="background:rgba(26,138,75,.1);color:#1a8a4b;">Density</div>
              </div>

              <!-- Site Summary Table -->
              <div class="fm-section-label">Site Performance Summary</div>
              <div class="fm-table-wrap">
                <table class="table table-sm mb-0">
                  <thead>
                    <tr>
                      <th>Apiary</th>
                      <th class="text-end">Colonies</th>
                      <th class="text-end">Prod&nbsp;(kg)</th>
                      <th class="text-end">Survival</th>
                    </tr>
                  </thead>
                  <tbody id="analytics-table-body">
                    <tr><td colspan="4" class="text-muted text-center py-3">Loading...</td></tr>
                  </tbody>
                </table>
              </div>

            </div><!-- /tab-heatmap-info -->

            <!-- ══ TRENDS TAB ══ -->
            <div id="tab-trends" style="display:none;">

              <!-- KPI Cards -->
              <div class="row g-2 mb-3">
                <div class="col-6">
                  <div class="fm-kpi-card">
                    <div class="fm-kpi-icon" style="background:#fff9e6;">🍯</div>
                    <div class="fm-kpi-label">Highest Yield</div>
                    <div class="fm-kpi-value text-warning" id="kpi-highest-yield">0 kg</div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="fm-kpi-card">
                    <div class="fm-kpi-icon" style="background:#e8f8f0;">🐝</div>
                    <div class="fm-kpi-label">Avg Colony Survival</div>
                    <div class="fm-kpi-value text-success" id="kpi-avg-survival">0%</div>
                  </div>
                </div>
              </div>

              <!-- Hive Survival Rate -->
              <div class="fm-section-label">Hive Survival Rate</div>
              <div class="fm-chart-card mb-3">
                <div class="fm-chart-title">Active vs Inactive Colonies by Location</div>
                <div style="height:200px;"><canvas id="survivalChart"></canvas></div>
              </div>

              <!-- Productivity vs Environment -->
              <div class="fm-section-label">Productivity vs Environment</div>
              <div class="fm-chart-card mb-2">
                <div class="fm-chart-title">Avg Production by Topography</div>
                <div class="fm-chart-sub">How land type affects honey yield</div>
                <div style="height:180px;"><canvas id="topoChart"></canvas></div>
              </div>

              <div class="fm-chart-card mb-3">
                <div class="fm-chart-title">Avg Production by Honey Source</div>
                <div class="fm-chart-sub">Which forage sources yield the most</div>
                <div style="height:220px;"><canvas id="sourceChart"></canvas></div>
              </div>

              <!-- Yield Correlation -->
              <div class="fm-section-label">Yield Correlation</div>
              <div class="fm-chart-card mb-3">
                <div class="fm-chart-title">Production (kg) vs Total Colonies</div>
                <div class="fm-chart-sub">Scatter: does more colonies = more honey?</div>
                <div style="height:200px;"><canvas id="productivityChart"></canvas></div>
              </div>

              <!-- Top Producers -->
              <div class="fm-section-label">🏆 Top Producing Sites</div>
              <div id="top-producers" class="d-flex flex-column gap-2 mb-4"></div>

            </div><!-- /tab-trends -->

          </div><!-- /p-3 -->
        </div><!-- /analyticsPanel -->

      </div><!-- /d-flex -->
    </div>
  </div>
</div>

<!-- ============================================================
     APIARY DETAIL + WEATHER MODAL (pin click)
     ============================================================ -->
<!-- APIARY DETAIL + WEATHER MODAL -->
<div class="modal fade" id="apiaryWeatherModal" tabindex="-1" role="dialog" style="z-index:1060;">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width:800px;">
    <div class="modal-content border-0 rounded-4 overflow-hidden" style="box-shadow:0 24px 64px rgba(0,0,0,.22);">

      <!-- Modal Header -->
      <div class="px-4 pt-4 pb-0 bg-white">
        <div class="d-flex align-items-start justify-content-between mb-3">
          <div class="d-flex align-items-center gap-3">
            <div class="awm-icon-box">🏡</div>
            <div>
              <h5 class="fw-bold mb-0 text-dark" id="awm-name" style="font-size:1.1rem;">Apiary Name</h5>
              <p class="text-muted mb-0" id="awm-address" style="font-size:.82rem;">Loading...</p>
            </div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <span id="awm-accuracy-badge" class="badge rounded-pill px-3 py-2" style="font-size:.72rem;"></span>
            <button type="button" class="btn-close" data-dismiss="modal"></button>
          </div>
        </div>

        <!-- Weather Hero Strip -->
        <div class="awm-weather-strip">
          <div class="d-flex align-items-center gap-3">
            <div id="awm-weather-icon" style="font-size:3rem;line-height:1;">⏳</div>
            <div>
              <div class="fw-black text-dark" style="font-size:2.2rem;line-height:1;font-weight:800;" id="awm-temp">--°C</div>
              <div class="text-muted" style="font-size:.82rem;" id="awm-desc">Fetching weather...</div>
            </div>
          </div>
          <div class="awm-weather-stats">
            <div class="awm-stat"><div class="awm-stat-label">Feels Like</div><div class="awm-stat-val" id="awm-feels">--</div></div>
            <div class="awm-stat"><div class="awm-stat-label">Humidity</div><div class="awm-stat-val" id="awm-humidity">--</div></div>
            <div class="awm-stat"><div class="awm-stat-label">Wind</div><div class="awm-stat-val" id="awm-wind">--</div></div>
            <div class="awm-stat"><div class="awm-stat-label">Rain</div><div class="awm-stat-val" id="awm-rain">--</div></div>
            <div class="awm-stat"><div class="awm-stat-label">Cloud</div><div class="awm-stat-val" id="awm-cloud">--</div></div>
          </div>
          <div class="ms-auto" style="font-size:.68rem;color:#94a3b8;white-space:nowrap;" id="awm-timestamp"></div>
        </div>
      </div>

      <div class="modal-body px-4 py-3">
        <div class="row g-3">
          <!-- Left: Apiary Info -->
          <div class="col-md-6">
            <div class="awm-info-card h-100">
              <div class="awm-info-header"><i class="ph ph-house me-1"></i>Apiary Details</div>
              <?php foreach([
                ['awm-beekeeper','👤 Beekeeper'],['awm-barangay','📍 Barangay'],['awm-municipality','🏛️ Municipality'],
                ['awm-province','🗺️ Province'],['awm-area','📐 Area Size'],['awm-topo','🏔️ Topography'],['awm-source','🌸 Sources']
              ] as [$id,$label]): ?>
              <div class="awm-info-row">
                <span class="awm-info-lbl"><?php echo $label ?></span>
                <span class="awm-info-val" id="<?php echo $id ?>" >--</span>
              </div>
              <?php endforeach; ?>
              <div class="awm-info-row" style="border-bottom:none;">
                <span class="awm-info-lbl">🐝 Colonies</span>
                <span class="badge text-white rounded-pill px-3" id="awm-colonies" style="background:#1a4b9c;">--</span>
              </div>
              <div class="mt-2 pt-2" style="border-top:1px dashed #dfe3e8;">
                <div style="font-size:.7rem;color:#94a3b8;"><i class="ph ph-map-pin me-1"></i><span id="awm-coords">--</span></div>
              </div>
            </div>
          </div>

          <!-- Right: Outlook + Plants -->
          <div class="col-md-6 d-flex flex-column gap-3">
            <div class="awm-info-card">
              <div class="awm-info-header"><i class="ph ph-sun me-1"></i>Bee Activity Outlook</div>
              <div class="d-flex align-items-start gap-2 mt-1">
                <div id="awm-rec-icon" style="font-size:1.6rem;flex-shrink:0;">⏳</div>
                <div id="awm-recommendation" style="font-size:.83rem;color:#475569;line-height:1.5;">Analyzing conditions...</div>
              </div>
            </div>
            <div class="awm-info-card flex-grow-1">
              <div class="awm-info-header">
                <i class="ph ph-plant me-1"></i>Nearby Flowering Plants
                <span style="font-size:.65rem;font-weight:400;color:#94a3b8;text-transform:none;margin-left:4px;">within 10km · iNaturalist</span>
              </div>
              <div id="awm-plants-loading" style="font-size:.8rem;color:#94a3b8;margin-top:6px;"><i class="ph ph-circle-notch me-1"></i>Fetching nearby flora...</div>
              <div id="awm-plants-list" class="d-flex flex-column gap-2 mt-1"></div>
              <div id="awm-plants-empty" style="display:none;font-size:.8rem;color:#94a3b8;">No observations found nearby.</div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer border-0" style="background:#f8faff;padding:10px 20px;">
        <div class="text-muted" style="font-size:.7rem;">
          Weather: <a href="https://open-meteo.com" target="_blank" class="text-primary text-decoration-none">Open-Meteo</a> &nbsp;·&nbsp;
          Plants: <a href="https://www.inaturalist.org" target="_blank" class="text-primary text-decoration-none">iNaturalist</a>
        </div>
        <button type="button" class="btn btn-sm px-4 rounded-3 fw-semibold" style="background:#1a4b9c;color:#fff;" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ============================================================
     STYLES
     ============================================================ -->
<style>
  /* ── Base ── */
  .bg-light-primary  { background:#e8f1ff; }
  .bg-light-danger   { background:#fff0f0; }
  .bg-light-info     { background:#e6f7ff; }
  .bg-light-warning  { background:#fff9e6; }
  .bg-light-success  { background:#e8f8f0; }
  .text-success      { color:#1a8a4b!important; }
  .text-primary      { color:#1a4b9c!important; }
  .btn-primary       { background:#1a4b9c;border-color:#1a4b9c; }
  .btn-primary:hover { background:#143b7a;border-color:#143b7a; }
  .btn-light-primary       { background:#e8f1ff;color:#1a4b9c; }
  .btn-light-primary:hover { background:#1a4b9c;color:#fff; }
  .border-dashed { border:2px dashed #dfe3e8; }
  .hover-lift { transition:transform .2s,box-shadow .2s; }
  .hover-lift:hover { transform:translateY(-4px);box-shadow:0 10px 24px rgba(0,0,0,.07)!important; }
  .hover-link:hover { text-decoration:underline!important; }
  .hover-link i { transition:transform .2s; }
  .hover-link:hover i { transform:translateX(3px); }

  /* ── Maps ── */
  #apiaryMap, #fullMap { z-index:0; border-radius:0 0 1rem 1rem; }
  #fullMap { border-radius:0; }
  .leaflet-popup-content-wrapper { border-radius:14px;box-shadow:0 10px 28px rgba(0,0,0,.15);font-family:inherit; }
  .apiary-popup-title { font-weight:700;font-size:.92rem;color:#1a4b9c;margin-bottom:4px; }
  .apiary-popup-meta  { font-size:.78rem;color:#6c757d;line-height:1.6; }
  .apiary-popup-badge { display:inline-block;border-radius:20px;padding:2px 10px;font-size:.72rem;font-weight:600;margin-top:4px; }
  .apiary-popup-btn   {
    display:block;margin-top:8px;padding:7px 0;
    background:#1a4b9c;color:#fff;border:none;border-radius:8px;
    font-size:.78rem;font-weight:600;cursor:pointer;width:100%;text-align:center;
    transition:background .2s;
  }
  .apiary-popup-btn:hover { background:#143b7a; }

  /* ── Full Map Modal ── */
  #fullMapModal { padding:0!important; }
  #fullMapModal .modal-dialog { pointer-events:all; }

  /* Top bar layer buttons (dark theme) */
  .fullmap-layer-btn {
    padding:5px 13px;font-size:.74rem;font-weight:600;border-radius:20px;white-space:nowrap;
    border:1px solid rgba(255,255,255,.18);background:rgba(255,255,255,.08);color:rgba(255,255,255,.8);
    cursor:pointer;transition:all .15s;
  }
  .fullmap-layer-btn:hover { background:rgba(255,255,255,.18);color:#fff; }
  .fullmap-layer-btn.active { background:#fff;color:#12243a;font-weight:700;border-color:#fff; }

  /* Analytics toggle button */
  .fullmap-analytics-toggle {
    padding:6px 16px;font-size:.78rem;font-weight:600;border-radius:20px;white-space:nowrap;
    border:1px solid rgba(255,255,255,.25);background:rgba(255,255,255,.12);color:#fff;
    cursor:pointer;transition:all .2s;
    display:flex;align-items:center;gap:4px;
  }
  .fullmap-analytics-toggle:hover { background:rgba(255,255,255,.22);border-color:rgba(255,255,255,.4); }
  .fullmap-analytics-toggle.open { background:#fff;color:#1a4b9c;border-color:#fff; }

  /* Analytics panel tabs */
  .ap-tab {
    flex:1;padding:6px 10px;font-size:.75rem;font-weight:600;border-radius:8px;cursor:pointer;
    border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.08);color:rgba(255,255,255,.7);
    transition:all .15s;text-align:center;
  }
  .ap-tab:hover { background:rgba(255,255,255,.15);color:#fff; }
  .ap-tab.active { background:#fff;color:#1a4b9c;font-weight:700;border-color:#fff; }

  /* Analytics section labels */
  .fm-section-label {
    font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;
    color:#94a3b8;margin:12px 0 8px;display:flex;align-items:center;gap:6px;
  }
  .fm-section-label::after { content:'';flex:1;height:1px;background:#e0e6f0; }

  /* Layer clickable cards */
  .fm-layer-card {
    display:flex;align-items:center;gap:10px;padding:10px 12px;
    background:#fff;border-radius:12px;border:1.5px solid #e0e6f0;
    cursor:pointer;transition:all .15s;
    border-left:3px solid var(--accent, #1a4b9c);
  }
  .fm-layer-card:hover { border-color:var(--accent, #1a4b9c);box-shadow:0 4px 14px rgba(0,0,0,.07);transform:translateY(-1px); }
  .fm-layer-icon { width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0; }
  .fm-layer-pill { font-size:.65rem;font-weight:700;border-radius:20px;padding:2px 8px;white-space:nowrap; }

  /* Analytics table */
  .fm-table-wrap { background:#fff;border-radius:10px;border:1px solid #e0e6f0;overflow:hidden; }
  .fm-table-wrap .table thead th { background:#f0f4ff;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#475569;border:none;padding:8px 10px; }
  .fm-table-wrap .table tbody td { font-size:.75rem;padding:7px 10px;border-color:#f0f4ff;vertical-align:middle; }
  .fm-table-wrap .table tbody tr:hover { background:#f8faff; }

  /* KPI cards */
  .fm-kpi-card { background:#fff;border-radius:12px;padding:14px 12px;border:1px solid #e0e6f0;text-align:center; }
  .fm-kpi-icon { width:36px;height:36px;border-radius:8px;margin:0 auto 6px;display:flex;align-items:center;justify-content:center;font-size:1.2rem; }
  .fm-kpi-label { font-size:.65rem;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.05em; }
  .fm-kpi-value { font-size:1.1rem;font-weight:800;margin-top:3px; }
  .text-warning { color:#f39c12!important; }

  /* Chart cards */
  .fm-chart-card { background:#fff;border-radius:12px;padding:14px;border:1px solid #e0e6f0; }
  .fm-chart-title { font-size:.82rem;font-weight:700;color:#1e293b;margin-bottom:2px; }
  .fm-chart-sub { font-size:.68rem;color:#94a3b8;margin-bottom:10px; }

  /* Top producer bars */
  .producer-bar { background:#f8faff;border-radius:10px;padding:10px 12px;border:1px solid #e0e6f0; }

  /* ── Apiary Detail / Weather Modal ── */
  .awm-icon-box { width:46px;height:46px;background:#f0f4ff;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0; }

  .awm-weather-strip {
    display:flex;align-items:center;gap:24px;flex-wrap:wrap;
    background:linear-gradient(135deg,#f0f4ff 0%,#e8f1ff 100%);
    border-radius:12px;padding:16px 20px;margin-bottom:4px;
    border:1px solid #d8e4ff;
  }
  .awm-weather-stats { display:flex;gap:20px;flex-wrap:wrap; }
  .awm-stat { text-align:center; }
  .awm-stat-label { font-size:.68rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.04em; }
  .awm-stat-val { font-size:.9rem;font-weight:700;color:#1e293b;margin-top:2px; }

  .awm-info-card { background:#f8f9fa;border-radius:14px;padding:14px;border:1px solid #e9ecef; }
  .awm-info-header { font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#94a3b8;margin-bottom:10px;display:flex;align-items:center;gap:4px; }
  .awm-info-row { display:flex;justify-content:space-between;align-items:center;padding:7px 0;border-bottom:1px solid #f0f4f8; }
  .awm-info-lbl { font-size:.78rem;color:#64748b; }
  .awm-info-val { font-size:.78rem;font-weight:600;color:#1e293b;text-align:right;max-width:55%; }

  /* Plant items */
  .plant-item { display:flex;align-items:center;gap:10px;padding:8px 10px;background:#fff;border-radius:10px;border:1px solid #eef0f4; }
  .plant-item img { width:40px;height:40px;object-fit:cover;border-radius:8px;flex-shrink:0; }
  .plant-item .plant-no-img { width:40px;height:40px;border-radius:8px;background:#e8f1ff;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0; }
  .plant-item .plant-name { font-size:.8rem;font-weight:600;color:#1a2a40;line-height:1.3; }
  .plant-item .plant-common { font-size:.72rem;color:#6c757d; }

  .weather-loading { animation:pulse 1.1s infinite; }
  @keyframes pulse { 0%,100%{opacity:1}50%{opacity:.4} }
</style>

<!-- ============================================================
     LEAFLET.HEAT CDN + CHART.JS
     ============================================================ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<!-- ============================================================
     JAVASCRIPT
     ============================================================ -->
<script type="text/javascript">
/* ── PHP Data → JS ──────────────────────────────────────────── */
var apiaries = [];
var analyticsData = [];

<?php
/* Resolve coordinates for all apiaries */
foreach($apiary_locations as $v):
    $lat = null; $lng = null; $accuracy = 'approximate';
    if(!empty($v['coordinate'])) {
        $parts = explode(',', $v['coordinate']);
        if(count($parts)==2 && is_numeric(trim($parts[0])) && is_numeric(trim($parts[1]))) {
            $lat=(float)trim($parts[0]); $lng=(float)trim($parts[1]); $accuracy='precise';
        }
    }
    if(($lat===null||$lng===null)&&!empty($v['map'])) {
        if(preg_match('/!2d(-?\d+\.\d+)!3d(-?\d+\.\d+)/', $v['map'], $matches)) {
            $lng=(float)$matches[1]; $lat=(float)$matches[2]; $accuracy='precise';
        }
    }
?>
apiaries.push({
    id:           <?php echo intval($v['id']) ?>,
    name:         "<?php echo addslashes($v['location']) ?>",
    beekeeper:    "<?php echo addslashes($v['beekeeper_name']) ?>",
    address:      "<?php echo addslashes($v['barangay_name'].', '.$v['municipality_name'].', '.$v['province_name']) ?>",
    barangay:     "<?php echo addslashes($v['barangay_name']) ?>",
    municipality: "<?php echo addslashes($v['municipality_name']) ?>",
    province:     "<?php echo addslashes($v['province_name']) ?>",
    area_size:    "<?php echo addslashes($v['area_size'] ?? '') ?>",
    topography:   "<?php echo addslashes($v['topography_names'] ?? '') ?>",
    source:       "<?php echo addslashes($v['source_names'] ?? '') ?>",
    colonies:     <?php echo intval($v['total_colonies'] ?? 0) ?>,
    lat:          <?php echo $lat!==null ? $lat : 'null' ?>,
    lng:          <?php echo $lng!==null ? $lng : 'null' ?>,
    accuracy:     "<?php echo $accuracy ?>"
});
<?php endforeach; ?>

<?php foreach($apiary_analytics as $a):
    $lat2 = null; $lng2 = null;
    if(!empty($a['coordinate'])) {
        $parts = explode(',', $a['coordinate']);
        if(count($parts)==2 && is_numeric(trim($parts[0])) && is_numeric(trim($parts[1]))) {
            $lat2=(float)trim($parts[0]); $lng2=(float)trim($parts[1]);
        }
    }
    if(($lat2===null||$lng2===null)&&!empty($a['map'])) {
        if(preg_match('/!2d(-?\d+\.\d+)!3d(-?\d+\.\d+)/', $a['map'], $matches)) {
            $lng2=(float)$matches[1]; $lat2=(float)$matches[2];
        }
    }
    if($lat2===null) continue; // skip apiaries without coords for heatmap
?>
analyticsData.push({
    name:             "<?php echo addslashes($a['location']) ?>",
    lat:              <?php echo $lat2 ?>,
    lng:              <?php echo $lng2 ?>,
    total_colonies:   <?php echo intval($a['total_colonies'] ?? 0) ?>,
    active_colonies:  <?php echo intval($a['active_colonies'] ?? 0) ?>,
    inactive_colonies:<?php echo intval($a['inactive_colonies'] ?? 0) ?>,
    total_production: <?php echo floatval($a['total_production'] ?? 0) ?>,
    yearly_production:<?php echo floatval($a['yearly_production'] ?? 0) ?>,
    topography:       "<?php echo addslashes($a['topography_names'] ?? 'None') ?>",
    source:           "<?php echo addslashes($a['source_names'] ?? 'None') ?>"
});
<?php endforeach; ?>

/* ══════════════════════════════════════════════════════════════
   WMO WEATHER CODES
══════════════════════════════════════════════════════════════ */
var WMO = {0:{d:'Clear Sky',i:'☀️'},1:{d:'Mainly Clear',i:'🌤️'},2:{d:'Partly Cloudy',i:'⛅'},3:{d:'Overcast',i:'☁️'},
  45:{d:'Fog',i:'🌫️'},48:{d:'Freezing Fog',i:'🌫️'},51:{d:'Light Drizzle',i:'🌦️'},53:{d:'Drizzle',i:'🌦️'},
  55:{d:'Heavy Drizzle',i:'🌧️'},61:{d:'Light Rain',i:'🌧️'},63:{d:'Moderate Rain',i:'🌧️'},65:{d:'Heavy Rain',i:'⛈️'},
  71:{d:'Light Snow',i:'🌨️'},73:{d:'Snow',i:'❄️'},75:{d:'Heavy Snow',i:'❄️'},80:{d:'Rain Showers',i:'🌦️'},
  81:{d:'Moderate Showers',i:'🌧️'},82:{d:'Violent Showers',i:'⛈️'},95:{d:'Thunderstorm',i:'⛈️'},99:{d:'Thunder+Hail',i:'🌩️'}};

function getBeeRec(temp,hum,wind,rain,code) {
  if(rain>2||code>=61) return {icon:'⛔',text:'Heavy rain or storms. Bees inactive — avoid inspections.',color:'#dc3545'};
  if(wind>30)  return {icon:'⚠️',text:'Strong winds. Bee flight disrupted. Limit harvesting.',color:'#f39c12'};
  if(temp<14)  return {icon:'🥶',text:'Too cold. Bees may be clustering inside the hive.',color:'#6c757d'};
  if(temp>36)  return {icon:'🌡️',text:'Extreme heat. Ensure water nearby. Limit hive opening.',color:'#e67e22'};
  if(temp>=18&&temp<=32&&hum<=70&&wind<=20&&code<=3) return {icon:'✅',text:'Excellent! Ideal for inspection and harvesting.',color:'#1a8a4b'};
  return {icon:'🐝',text:'Moderate conditions. Standard hive management is fine.',color:'#1a4b9c'};
}

/* ══════════════════════════════════════════════════════════════
   MINI MAP (Dashboard Preview)
══════════════════════════════════════════════════════════════ */
$(document).ready(function() {
  $("#dashboardMainMenu").addClass('active');

  var miniMap = L.map('apiaryMap', { center:[16.6,120.32], zoom:10, scrollWheelZoom:true });
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom:19, attribution:'&copy; OSM' }).addTo(miniMap);

  var preciseIcon = makeIcon('#1a4b9c',34,'📍');
  var approxIcon  = makeIcon('#f39c12',28,'📍');

  function makeIcon(bg,size,emoji) {
    return L.divIcon({
      className:'',
      html:'<div style="background:'+bg+';width:'+size+'px;height:'+size+'px;border-radius:50%;border:'+(size>30?'4':'3')+'px solid #fff;box-shadow:0 4px 12px '+bg+'80;display:flex;align-items:center;justify-content:center;font-size:'+(size>30?'16':'13')+'px;">'+emoji+'</div>',
      iconSize:[size,size],iconAnchor:[size/2,size/2],popupAnchor:[0,-size/2-4]
    });
  }

  var gcDelay = 0;
  apiaries.forEach(function(a) {
    if (a.lat !== null && a.lng !== null) {
      placeMiniMarker(miniMap, a, a.lat, a.lng, preciseIcon, approxIcon);
    } else {
      gcDelay += 700;
      (function(apiary, delay) {
        setTimeout(function() {
          var q = apiary.barangay+', '+apiary.municipality+', '+apiary.province+', Philippines';
          $.getJSON('https://nominatim.openstreetmap.org/search?format=json&q='+encodeURIComponent(q), function(data) {
            if(data&&data.length>0) {
              apiary.lat = parseFloat(data[0].lat); apiary.lng = parseFloat(data[0].lon);
              apiary.accuracy = 'approximate';
              placeMiniMarker(miniMap, apiary, apiary.lat, apiary.lng, preciseIcon, approxIcon);
            }
          });
        }, delay);
      })(a, gcDelay);
    }
  });

  var legend = L.control({position:'bottomright'});
  legend.onAdd = function() {
    var d = L.DomUtil.create('div','');
    d.style.cssText='background:#fff;padding:8px 12px;border-radius:10px;box-shadow:0 3px 12px rgba(0,0,0,.12);font-size:.76rem;line-height:1.9;';
    d.innerHTML='<b style="font-size:.78rem;">Location</b><br><span style="color:#1a4b9c;">📍</span> Precise<br><span style="color:#f39c12;">📍</span> Approx.';
    return d;
  };
  legend.addTo(miniMap);
});

function placeMiniMarker(mapObj, apiary, lat, lng, preciseIcon, approxIcon) {
  var icon = (apiary.accuracy==='precise') ? preciseIcon : approxIcon;
  var marker = L.marker([lat,lng],{icon:icon}).addTo(mapObj);
  var badge = (apiary.accuracy==='precise')
    ? '<span class="apiary-popup-badge" style="background:#e8f8f0;color:#1a8a4b;">Precise</span>'
    : '<span class="apiary-popup-badge" style="background:#fff9e6;color:#f39c12;">Approx.</span>';
  marker.bindPopup(
    '<div class="apiary-popup-title">'+apiary.name+'</div>'+
    '<div class="apiary-popup-meta"><b>Beekeeper:</b> '+apiary.beekeeper+'<br><b>Colonies:</b> '+apiary.colonies+'</div>'+
    badge+
    '<button class="apiary-popup-btn" onclick="openApiaryById('+apiary.id+','+lat+','+lng+')">Details &amp; Weather</button>',
    {maxWidth:240}
  );
}

/* ══════════════════════════════════════════════════════════════
   FULL MAP
══════════════════════════════════════════════════════════════ */
var fullMap = null;
var fullMarkers = [];
var heatLayer = null;
var activeLayer = 'none';
var chartsBuilt = false;

function makeFullIcon(bg, size, emoji) {
  return L.divIcon({
    className:'',
    html:'<div style="background:'+bg+';width:'+size+'px;height:'+size+'px;border-radius:50%;border:'+(size>30?'4':'3')+'px solid #fff;box-shadow:0 4px 12px '+bg+'80;display:flex;align-items:center;justify-content:center;font-size:'+(size>30?'16':'13')+'px;">'+emoji+'</div>',
    iconSize:[size,size],iconAnchor:[size/2,size/2],popupAnchor:[0,-size/2-4]
  });
}

window.openFullMap = function() {
  $('#fullMapModal').modal('show');
  setTimeout(function() {
    if (!fullMap) {
      fullMap = L.map('fullMap', { center:[16.6,120.32], zoom:11, scrollWheelZoom:true });
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom:19, attribution:'&copy; OSM' }).addTo(fullMap);
      buildFullMarkers();
      buildAnalyticsTable();
    }
    fullMap.invalidateSize();
  }, 350);
};

function buildFullMarkers() {
  var pIcon = makeFullIcon('#1a4b9c',34,'📍');
  var aIcon = makeFullIcon('#f39c12',28,'📍');
  apiaries.forEach(function(a) {
    if (a.lat!==null && a.lng!==null) {
      addFullMarker(a, a.lat, a.lng, pIcon, aIcon);
    } else {
      var q = a.barangay+', '+a.municipality+', '+a.province+', Philippines';
      $.getJSON('https://nominatim.openstreetmap.org/search?format=json&q='+encodeURIComponent(q), function(data) {
        if(data&&data.length>0) {
          a.lat=parseFloat(data[0].lat); a.lng=parseFloat(data[0].lon); a.accuracy='approximate';
          addFullMarker(a, a.lat, a.lng, pIcon, aIcon);
        }
      });
    }
  });
}

function addFullMarker(apiary, lat, lng, pIcon, aIcon) {
  var icon = (apiary.accuracy==='precise') ? pIcon : aIcon;
  var m = L.marker([lat,lng],{icon:icon}).addTo(fullMap);
  var badge = (apiary.accuracy==='precise')
    ? '<span class="apiary-popup-badge" style="background:#e8f8f0;color:#1a8a4b;">Precise</span>'
    : '<span class="apiary-popup-badge" style="background:#fff9e6;color:#f39c12;">Approx.</span>';
  m.bindPopup(
    '<div class="apiary-popup-title">'+apiary.name+'</div>'+
    '<div class="apiary-popup-meta"><b>Beekeeper:</b> '+apiary.beekeeper+'<br><b>Colonies:</b> '+apiary.colonies+'</div>'+
    badge+
    '<button class="apiary-popup-btn" onclick="openApiaryById('+apiary.id+','+lat+','+lng+')">Details &amp; Weather</button>',
    {maxWidth:240}
  );
  fullMarkers.push(m);
}

/* ── Heatmap Layers ──────────────────────────────────────────── */
window.setLayer = function(layer, btn) {
  // Update top-bar layer buttons
  document.querySelectorAll('.fullmap-layer-btn').forEach(function(b){ b.classList.remove('active'); });
  if (btn) btn.classList.add('active');
  activeLayer = layer;

  if (heatLayer) { fullMap.removeLayer(heatLayer); heatLayer = null; }
  $('#heatmap-legend').addClass('d-none');

  if (layer === 'none') return;

  var points = [];
  var maxVal = 0;

  analyticsData.forEach(function(a) {
    var val = 0;
    if (layer === 'production') val = a.total_production;
    else if (layer === 'disease')    val = (a.total_colonies > 0) ? (a.inactive_colonies / a.total_colonies) * 100 : 0;
    else if (layer === 'colonies')   val = a.total_colonies;
    if (val > maxVal) maxVal = val;
  });

  if (maxVal === 0) maxVal = 1;

  analyticsData.forEach(function(a) {
    var val = 0;
    if (layer === 'production') val = a.total_production;
    else if (layer === 'disease')    val = (a.total_colonies > 0) ? (a.inactive_colonies / a.total_colonies) * 100 : 0;
    else if (layer === 'colonies')   val = a.total_colonies;
    points.push([a.lat, a.lng, val / maxVal]);
  });

  heatLayer = L.heatLayer(points, { radius:45, blur:28, maxZoom:15, max:1.0 }).addTo(fullMap);

  var labels = {production:'🍯 Best Honey-Producing Areas', disease:'⚠️ High Disease / Risk Zones', colonies:'🐝 Strong Colony Clusters'};
  $('#hl-title').text(labels[layer] || 'Intensity');
  $('#heatmap-legend').removeClass('d-none');
};

/* ── Analytics Panel ─────────────────────────────────────────── */
window.toggleAnalyticsPanel = function() {
  var panel = document.getElementById('analyticsPanel');
  var btn   = document.getElementById('analyticsToggleBtn');
  var isVisible = panel.style.display !== 'none';
  panel.style.display = isVisible ? 'none' : 'block';
  if (btn) btn.classList.toggle('open', !isVisible);
  if (!isVisible && !chartsBuilt) { setTimeout(buildCharts, 250); chartsBuilt = true; }
  if (fullMap) setTimeout(function(){ fullMap.invalidateSize(); }, 320);
};

/* Tab switcher for the OLD nav-pills (kept for backward compat) */
window.switchTab = function(el, tabId) {
  document.querySelectorAll('#analyticsTabs .nav-link').forEach(function(a){ a.classList.remove('active'); });
  el.classList.add('active');
  document.getElementById('tab-heatmap-info').style.display = tabId==='heatmap-info' ? '' : 'none';
  document.getElementById('tab-trends').style.display       = tabId==='trends'       ? '' : 'none';
  if (tabId === 'trends' && !chartsBuilt) { buildCharts(); chartsBuilt = true; }
  return false;
};

/* Tab switcher for the NEW ap-tab buttons in the panel header */
window.switchTab2 = function(el, tabId) {
  document.querySelectorAll('.ap-tab').forEach(function(b){ b.classList.remove('active'); });
  el.classList.add('active');
  document.getElementById('tab-heatmap-info').style.display = tabId==='tab-heatmap-info' ? '' : 'none';
  document.getElementById('tab-trends').style.display       = tabId==='tab-trends'       ? '' : 'none';
  if (tabId === 'tab-trends' && !chartsBuilt) { buildCharts(); chartsBuilt = true; }
  return false;
};

function buildAnalyticsTable() {
  var html = '';
  var sorted = analyticsData.slice().sort(function(a,b){ return b.total_production - a.total_production; });
  if (!sorted.length) {
    $('#analytics-table-body').html('<tr><td colspan="4" class="text-muted text-center py-3" style="font-size:.78rem;">No apiary data available</td></tr>');
    return;
  }
  sorted.forEach(function(a, i) {
    var total = a.total_colonies;
    var survival = total > 0 ? Math.round((a.active_colonies / total) * 100) : 100;
    var sbg = survival >= 70 ? 'rgba(26,138,75,.1)' : survival >= 40 ? 'rgba(243,156,18,.1)' : 'rgba(220,53,69,.1)';
    var sc  = survival >= 70 ? '#1a8a4b'             : survival >= 40 ? '#f39c12'              : '#dc3545';
    html += '<tr>';
    html += '<td class="fw-semibold" style="font-size:.74rem;max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' + a.name + '</td>';
    html += '<td class="text-end" style="font-size:.74rem;">' + total.toLocaleString() + '</td>';
    html += '<td class="text-end" style="font-size:.74rem;">' + a.total_production.toFixed(1) + '</td>';
    html += '<td class="text-end"><span style="background:'+sbg+';color:'+sc+';font-weight:700;font-size:.68rem;padding:2px 7px;border-radius:10px;">' + survival + '%</span></td>';
    html += '</tr>';
  });
  $('#analytics-table-body').html(html);
}

var survivalChart = null;
var productivityChart = null;
var topoChart = null;
var sourceChart = null;

function buildCharts() {
  var sorted = analyticsData.slice().sort(function(a,b){ return b.total_production - a.total_production; }).slice(0,8);
  var labels = sorted.map(function(a){ return a.name.length > 14 ? a.name.substring(0,12)+'…' : a.name; });

  /* Update KPIs */
  if (sorted.length > 0) {
    $('#kpi-highest-yield').text(sorted[0].total_production.toFixed(1) + ' kg');
    var totalAct = 0, totalCol = 0;
    analyticsData.forEach(function(a){ totalAct += a.active_colonies; totalCol += a.total_colonies; });
    $('#kpi-avg-survival').text((totalCol > 0 ? Math.round((totalAct/totalCol)*100) : 0) + '%');
  }

  /* Survival Chart */
  if (survivalChart) survivalChart.destroy();
  var sCtx = document.getElementById('survivalChart').getContext('2d');
  survivalChart = new Chart(sCtx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        { label:'Active',   data: sorted.map(function(a){ return a.active_colonies; }),   backgroundColor:'#1a8a4b', borderRadius:4 },
        { label:'Inactive', data: sorted.map(function(a){ return a.inactive_colonies; }), backgroundColor:'#dc3545', borderRadius:4 }
      ]
    },
    options: {
      responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:'bottom', labels:{font:{size:10}, boxWidth:12} } },
      scales:{x:{ticks:{font:{size:9}}},y:{beginAtZero:true,ticks:{font:{size:10}}}}
    }
  });

  /* topoChart - Avg Prod by Topography */
  var topoMap = {};
  analyticsData.forEach(function(a){
    var t = a.topography || 'None';
    if(!topoMap[t]) topoMap[t] = {sum:0, count:0};
    topoMap[t].sum += a.total_production;
    topoMap[t].count++;
  });
  var topoLabels = Object.keys(topoMap);
  var topoData = topoLabels.map(function(k){ return (topoMap[k].sum / topoMap[k].count).toFixed(1); });

  if (topoChart) topoChart.destroy();
  var tCtx = document.getElementById('topoChart').getContext('2d');
  topoChart = new Chart(tCtx, {
    type: 'bar',
    data: {
      labels: topoLabels,
      datasets: [{ label: 'Avg Prod (kg)', data: topoData, backgroundColor: '#1a4b9c', borderRadius:4 }]
    },
    options: {
      indexAxis: 'y',
      responsive:true, maintainAspectRatio:false,
      plugins: { legend: { display:false } },
      scales: { x: { beginAtZero:true, ticks:{font:{size:9}} }, y: { ticks:{font:{size:9}} } }
    }
  });

  /* sourceChart - Avg Prod by Source */
  var sourceMap = {};
  analyticsData.forEach(function(a){
    var sStr = a.source || 'None';
    var sources = sStr.split(', ');
    sources.forEach(function(s){
      if(!sourceMap[s]) sourceMap[s] = {sum:0, count:0};
      sourceMap[s].sum += a.total_production;
      sourceMap[s].count++;
    });
  });
  var sourceLabels = Object.keys(sourceMap).sort(function(a,b){ return (sourceMap[b].sum/sourceMap[b].count) - (sourceMap[a].sum/sourceMap[a].count); });
  var sourceData = sourceLabels.map(function(k){ return (sourceMap[k].sum / sourceMap[k].count).toFixed(1); });

  if (sourceChart) sourceChart.destroy();
  var srcCtx = document.getElementById('sourceChart').getContext('2d');
  sourceChart = new Chart(srcCtx, {
    type: 'bar',
    data: {
      labels: sourceLabels,
      datasets: [{ label: 'Avg Prod (kg)', data: sourceData, backgroundColor: '#f39c12', borderRadius:4 }]
    },
    options: {
      indexAxis: 'y',
      responsive:true, maintainAspectRatio:false,
      plugins: { legend: { display:false } },
      scales: { x: { beginAtZero:true, ticks:{font:{size:9}} }, y: { ticks:{font:{size:9}} } }
    }
  });

  /* Productivity vs Colony Count */
  if (productivityChart) productivityChart.destroy();
  var pCtx = document.getElementById('productivityChart').getContext('2d');
  productivityChart = new Chart(pCtx, {
    type: 'scatter',
    data: {
      datasets: [{
        label: 'Apiary Sites',
        data: analyticsData.map(function(a){ return {x: a.total_colonies, y: a.total_production, name: a.name}; }),
        backgroundColor: '#1a4b9c99', pointRadius: 6, pointHoverRadius: 8
      }]
    },
    options: {
      responsive: true, maintainAspectRatio:false,
      plugins: {
        tooltip: { callbacks: { label: function(ctx){ return ctx.raw.name+': '+ctx.raw.x+' colonies, '+ctx.raw.y.toFixed(1)+' kg'; } } },
        legend: { display:false }
      },
      scales: {
        x: { title:{ display:true, text:'Colony Count', font:{size:10} }, ticks:{font:{size:9}} },
        y: { title:{ display:true, text:'Production (kg)', font:{size:10} }, ticks:{font:{size:9}} }
      }
    }
  });

  /* Top producers */
  var maxProd = Math.max.apply(null, analyticsData.map(function(a){ return a.total_production; })) || 1;
  var topHtml = '';
  sorted.slice(0,5).forEach(function(a,i) {
    var pct = Math.round((a.total_production / maxProd) * 100);
    topHtml += '<div class="producer-bar"><div class="d-flex justify-content-between small fw-semibold mb-1"><span>'+(i+1)+'. '+a.name+'</span><span>'+a.total_production.toFixed(1)+' kg</span></div>'+
      '<div style="height:6px;background:#e8f1ff;border-radius:4px;"><div style="width:'+pct+'%;height:100%;background:#1a4b9c;border-radius:4px;"></div></div></div>';
  });
  $('#top-producers').html(topHtml || '<div class="text-muted small">No production data available.</div>');
}

/* ══════════════════════════════════════════════════════════════
   APIARY DETAIL MODAL (shared between mini & full map)
══════════════════════════════════════════════════════════════ */
window.openApiaryById = function(id, lat, lng) {
  var a = apiaries.find(function(item){ return item.id == id; });
  if (a) openApiaryModal(a, lat, lng);
};

window.openApiaryModal = function(apiary, lat, lng) {
  if (typeof apiary === 'string') { try { apiary = JSON.parse(apiary); } catch(e){} }
  lat = parseFloat(lat); lng = parseFloat(lng);

  $('#awm-name').text(apiary.name);
  $('#awm-address').text(apiary.address);
  $('#awm-beekeeper').text(apiary.beekeeper || '--');
  $('#awm-barangay').text(apiary.barangay || '--');
  $('#awm-municipality').text(apiary.municipality || '--');
  $('#awm-province').text(apiary.province || '--');
  $('#awm-area').text(apiary.area_size || '--');
  $('#awm-topo').text(apiary.topography || '--');
  $('#awm-source').text(apiary.source || '--');
  $('#awm-colonies').text(apiary.colonies !== undefined ? apiary.colonies : '--');
  $('#awm-coords').text(lat.toFixed(5)+', '+lng.toFixed(5));

  if (apiary.accuracy==='precise') {
    $('#awm-accuracy-badge').text('Precise Location').css({background:'#e8f8f0',color:'#1a8a4b'});
  } else {
    $('#awm-accuracy-badge').text('Approximate Area').css({background:'#fff9e6',color:'#f39c12'});
  }

  $('#awm-weather-icon').text('⏳');
  $('#awm-temp').addClass('weather-loading').text('--°C');
  $('#awm-desc').text('Fetching...');
  ['#awm-feels','#awm-humidity','#awm-wind','#awm-rain','#awm-cloud'].forEach(function(id){ $(id).text('--'); });
  $('#awm-timestamp').text('');
  $('#awm-rec-icon').text('⏳');
  $('#awm-recommendation').text('Analyzing...').css('color','');
  $('#awm-plants-list').hide().html('');
  $('#awm-plants-loading').show();
  $('#awm-plants-empty').hide();

  $('#apiaryWeatherModal').modal('show');

  /* Weather */
  $.getJSON('https://api.open-meteo.com/v1/forecast?latitude='+lat+'&longitude='+lng+
    '&current=temperature_2m,apparent_temperature,relative_humidity_2m,wind_speed_10m,precipitation,cloud_cover,weather_code&wind_speed_unit=kmh&timezone=auto',
    function(data) {
      var c = data.current;
      var w = WMO[c.weather_code] || {d:'Unknown',i:'🌡️'};
      var r = getBeeRec(c.temperature_2m,c.relative_humidity_2m,c.wind_speed_10m,c.precipitation,c.weather_code);
      $('#awm-weather-icon').text(w.i);
      $('#awm-temp').removeClass('weather-loading').text(c.temperature_2m+'°C');
      $('#awm-desc').text(w.d);
      $('#awm-feels').text(c.apparent_temperature+'°C');
      $('#awm-humidity').text(c.relative_humidity_2m+'%');
      $('#awm-wind').text(c.wind_speed_10m+' km/h');
      $('#awm-rain').text(c.precipitation+' mm');
      $('#awm-cloud').text(c.cloud_cover+'%');
      $('#awm-rec-icon').text(r.icon);
      $('#awm-recommendation').text(r.text).css('color',r.color);
      $('#awm-timestamp').text('Updated: '+new Date().toLocaleTimeString());
    }
  ).fail(function(){ $('#awm-weather-icon').text('❌'); $('#awm-temp').removeClass('weather-loading').text('N/A'); $('#awm-desc').text('Unavailable.'); });

  /* Plants */
  $.getJSON('https://api.inaturalist.org/v1/observations?iconic_taxa=Plantae&lat='+lat+'&lng='+lng+'&radius=10&per_page=6&quality_grade=research&photos=true&order_by=votes',
    function(data) {
      $('#awm-plants-loading').hide();
      if (!data.results || !data.results.length) { $('#awm-plants-empty').show(); return; }
      var seen = {}, html = '';
      data.results.forEach(function(obs) {
        var t = obs.taxon, tname = t ? (t.preferred_common_name || t.name || 'Unknown') : 'Unknown';
        if (seen[tname]) return; seen[tname] = true;
        var imgHtml = (obs.photos && obs.photos.length)
          ? '<img src="'+obs.photos[0].url.replace('square','thumb')+'" alt="'+tname+'" />'
          : '<div class="plant-no-img">🌸</div>';
        html += '<div class="plant-item">'+imgHtml+'<div><div class="plant-name">'+tname+'</div>'+(t&&t.name?'<div class="plant-common"><em>'+t.name+'</em></div>':'')+'</div></div>';
      });
      if (html) $('#awm-plants-list').html(html).show(); else $('#awm-plants-empty').show();
    }
  ).fail(function(){ $('#awm-plants-loading').hide(); $('#awm-plants-empty').text('Could not fetch plants.').show(); });
};

function getBeeRec(temp,hum,wind,rain,code) {
  if(rain>2||code>=61) return {icon:'⛔',text:'Heavy rain/storm. Bees inactive — avoid inspections.',color:'#dc3545'};
  if(wind>30)  return {icon:'⚠️',text:'Strong winds. Bee flight disrupted. Limit harvesting.',color:'#f39c12'};
  if(temp<14)  return {icon:'🥶',text:'Too cold. Bees may be clustering.',color:'#6c757d'};
  if(temp>36)  return {icon:'🌡️',text:'Extreme heat. Ensure water nearby.',color:'#e67e22'};
  if(temp>=18&&temp<=32&&hum<=70&&wind<=20&&code<=3) return {icon:'✅',text:'Excellent! Great for inspection and harvesting.',color:'#1a8a4b'};
  return {icon:'🐝',text:'Moderate conditions. Standard management is fine.',color:'#1a4b9c'};
}
</script>
