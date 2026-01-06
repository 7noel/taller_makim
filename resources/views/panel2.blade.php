<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <title>Panel Taller - Mock</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Jquery ui js -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <!-- Botones -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed&family=Roboto&family=Roboto+Condensed&display=swap" rel="stylesheet">

  <style>
    body { background:#f6f7fb; }
    .panel-header { background:#fff; border:1px solid rgba(0,0,0,.08); border-radius:10px; }
    .nav-tabs .nav-link { border-radius:10px 10px 0 0; }
    .tab-pane { padding-top: 15px; }

    .card-soft {
      border: 1px solid rgba(0,0,0,.08);
      border-radius: 12px;
      box-shadow: 0 1px 2px rgba(0,0,0,.04);
    }

    /* Walk-in / Tránsito visual */
    .walkin-card {
      border-left: 6px solid #ffc107 !important;
      background: #fffdf4;
    }

    /* Mini badges summary */
    .mini-badge { font-size: 12px; padding: .15rem .45rem; border-radius: 20px; }

    /* Estado badge colores (simple demo) */
    .st-PEND { background:#e9ecef; color:#343a40; }
    .st-DIAG { background:#cfe2ff; color:#084298; }
    .st-PREAP{ background:#fff3cd; color:#664d03; }
    .st-APROB{ background:#d1e7dd; color:#0f5132; }
    .st-REPAR{ background:#f8d7da; color:#842029; }
    .st-CONTR{ background:#e2e3e5; color:#41464b; }
    .st-ENTR { background:#d1ecf1; color:#0c5460; }
    .st-CERR { background:#d4edda; color:#155724; }
    .st-ANUL { background:#f5c6cb; color:#721c24; }

    .mono { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
    .small-muted { font-size: 12px; color:#6c757d; }
  </style>
</head>

<body>
<div class="container-fluid py-3">

  <!-- Header / filtros -->
  <div class="panel-header p-3 mb-3">
    <div class="d-flex flex-wrap align-items-center justify-content-between">
      <div class="mb-2 mb-md-0">
        <h4 class="mb-0">Panel Operativo</h4>
        <div class="small-muted">Inventarios (vehículos en taller) + Presupuestos en tránsito (walk-in)</div>
      </div>

      <div class="d-flex flex-wrap">
        <div class="mr-2 mb-2">
          <input id="searchInput" class="form-control form-control-sm" style="min-width:260px"
                 placeholder="Buscar placa / cliente / #doc">
        </div>
        <div class="mr-2 mb-2">
          <select id="branchSelect" class="form-control form-control-sm">
            <option value="">Todos los locales</option>
            <option value="1">Local 1</option>
            <option value="2">Local 2</option>
          </select>
        </div>
        <div class="mb-2">
          <button class="btn btn-sm btn-outline-secondary" id="btnReset">
            <i class="fas fa-undo"></i> Reset
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabs principales -->
  <ul class="nav nav-tabs" id="mainTabs" role="tablist">
    <!-- Se renderizan por JS -->
  </ul>

  <div class="tab-content" id="mainTabsContent">
    <!-- Se renderiza por JS -->
  </div>

</div>


<script>
  // ====== Config de estados ======
  const INVENTORY_STATUS = {
    PEND: 'RECEPCIÓN',
    DIAG: 'DIAGNÓSTICO',
    PREAP:'APROBACIÓN DEL SEGURO',
    APROB:'APROBACIÓN',
    REPAR:'REPARACIÓN',
    CONTR:'CONTROL DE CALIDAD',
    ENTR: 'ENTREGA',
    ANUL: 'ANULADO',
    CERR: 'CERRADO'
  };

  // Para presupuesto (sin DIAG normalmente)
  const QUOTE_STATUS = {
    PEND: 'RECEPCIÓN',
    PREAP:'APROBACIÓN DEL SEGURO',
    APROB:'APROBACIÓN',
    REPAR:'REPARACIÓN',
    CONTR:'CONTROL DE CALIDAD',
    ENTR: 'ENTREGA',
    ANUL: 'ANULADO',
    CERR: 'CERRADO'
  };

  const INVENTORY_ORDER = ['PEND','DIAG','PREAP','APROB','REPAR','CONTR','ENTR','CERR','ANUL'];
  const QUOTE_ORDER     = ['PEND','PREAP','APROB','REPAR','CONTR','ENTR','CERR','ANUL'];

  // ====== Datos de prueba ======
  // Inventarios (order_type=inventory)
  const inventories = [
    {
      id: 101, sn:'INV', series:'I001', number:'000101',
      placa:'ABC-123', cliente:'Juan Perez', branch_id:1,
      status:'REPAR', created_at:'2025-12-20 10:15',
      quotes_summary: { PEND:0, PREAP:0, APROB:1, REPAR:1, CONTR:1, ENTR:0, CERR:0, ANUL:0 }
    },
    {
      id: 102, sn:'INV', series:'I001', number:'000102',
      placa:'XYZ-987', cliente:'Maria Ruiz', branch_id:2,
      status:'DIAG', created_at:'2025-12-21 09:40',
      quotes_summary: { PEND:2, PREAP:0, APROB:0, REPAR:0, CONTR:0, ENTR:0, CERR:0, ANUL:0 }
    },
    {
      id: 103, sn:'INV', series:'I001', number:'000103',
      placa:'BCD-222', cliente:'Compañía Seguros S.A.C.', branch_id:1,
      status:'PREAP', created_at:'2025-12-22 16:10',
      quotes_summary: { PEND:0, PREAP:1, APROB:0, REPAR:0, CONTR:0, ENTR:0, CERR:0, ANUL:0 }
    }
  ];

  // Presupuestos walk-in (order_type=output_quotes, is_walk_in=1)
  const walkins = [
    { id: 201, sn:'PRES', series:'Q001', number:'000201', placa:'TRN-111', cliente:'Carlos Medina', branch_id:1,
      status:'PEND', created_at:'2025-12-22 11:00', is_walk_in:true },
    { id: 202, sn:'PRES', series:'Q001', number:'000202', placa:'TRN-222', cliente:'Andrea Salazar', branch_id:2,
      status:'APROB', created_at:'2025-12-21 15:10', is_walk_in:true },
    { id: 203, sn:'PRES', series:'Q001', number:'000203', placa:'TRN-333', cliente:'Empresa Demo SAC', branch_id:1,
      status:'PREAP', created_at:'2025-12-20 17:35', is_walk_in:true },
    { id: 204, sn:'PRES', series:'Q001', number:'000204', placa:'TRN-444', cliente:'Luis Soto', branch_id:1,
      status:'REPAR', created_at:'2025-12-19 09:20', is_walk_in:true }
  ];

  // ====== Helpers ======
  function fmtDoc(o){ return `${o.sn}-${o.series}-${o.number}`; }
  function badgeStatus(status){
    return `<span class="badge st-${status}">${(INVENTORY_STATUS[status] || QUOTE_STATUS[status] || status)}</span>`;
  }
  function matchesSearch(o, q){
    if(!q) return true;
    const hay = `${o.placa||''} ${o.cliente||''} ${fmtDoc(o)}`.toLowerCase();
    return hay.includes(q.toLowerCase());
  }
  function matchesBranch(o, b){
    if(!b) return true;
    return String(o.branch_id) === String(b);
  }

  function renderInventoryCard(inv){
    const qs = inv.quotes_summary || {};
    const badges = Object.keys(qs)
      .filter(k => qs[k] > 0)
      .map(k => `<span class="mini-badge badge badge-light mr-1">${k}: ${qs[k]}</span>`)
      .join('') || `<span class="small-muted">Sin presupuestos asociados</span>`;

    return `
      <div class="col-lg-4 col-md-6 mb-3 item-card"
           data-placa="${inv.placa}" data-cliente="${inv.cliente}" data-doc="${fmtDoc(inv)}"
           data-branch="${inv.branch_id}">
        <div class="card card-soft">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small-muted">${inv.created_at}</div>
                <div class="font-weight-bold">${inv.placa} <span class="text-muted mono">(${fmtDoc(inv)})</span></div>
                <div class="text-muted">${inv.cliente}</div>
              </div>
              <div class="text-right">
                ${badgeStatus(inv.status)}
              </div>
            </div>

            <hr class="my-2">

            <div class="small-muted mb-1">Presupuestos asociados</div>
            <div class="mb-2">${badges}</div>

            <div class="d-flex">
              <button class="btn btn-sm btn-outline-primary mr-2" onclick="alert('Ir a Inventario #${inv.id}')">
                <i class="fas fa-car"></i> Ver inventario
              </button>
              <button class="btn btn-sm btn-outline-secondary" onclick="alert('Ver presupuestos de Inventario #${inv.id}')">
                <i class="fas fa-file-invoice"></i> Ver presupuestos
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  function renderWalkinCard(q){
    return `
      <div class="col-lg-4 col-md-6 mb-3 item-card"
           data-placa="${q.placa}" data-cliente="${q.cliente}" data-doc="${fmtDoc(q)}"
           data-branch="${q.branch_id}">
        <div class="card card-soft walkin-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small-muted">${q.created_at}</div>
                <div class="font-weight-bold">${q.placa} <span class="text-muted mono">(${fmtDoc(q)})</span></div>
                <div class="text-muted">${q.cliente}</div>
              </div>
              <div class="text-right">
                <span class="badge badge-warning mr-1"><i class="fas fa-walking"></i> TRÁNSITO</span>
                ${badgeStatus(q.status)}
              </div>
            </div>

            <hr class="my-2">

            <div class="d-flex">
              <button class="btn btn-sm btn-outline-primary mr-2" onclick="alert('Editar presupuesto #${q.id}')">
                <i class="fas fa-edit"></i> Ver / Editar
              </button>
              <button class="btn btn-sm btn-outline-success" onclick="alert('Acción seguimiento #${q.id}')">
                <i class="fas fa-phone"></i> Seguimiento
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  // ====== Render ======
  function buildMainTabs(){
    // Tabs: estados inventario + tab tránsito
    const invCounts = {};
    INVENTORY_ORDER.forEach(s => invCounts[s] = 0);
    inventories.forEach(i => invCounts[i.status] = (invCounts[i.status]||0)+1);

    const walkinCount = walkins.length;

    // Nav tabs
    let navHtml = '';
    INVENTORY_ORDER.forEach((st, idx) => {
      navHtml += `
        <li class="nav-item" role="presentation">
          <a class="nav-link ${idx===0?'active':''}" id="tab-${st}" data-toggle="tab" href="#pane-${st}"
             role="tab" aria-controls="pane-${st}" aria-selected="${idx===0}">
            ${INVENTORY_STATUS[st]}
            <span class="badge badge-light ml-1">${invCounts[st]||0}</span>
          </a>
        </li>
      `;
    });

    navHtml += `
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-walkin" data-toggle="tab" href="#pane-walkin"
           role="tab" aria-controls="pane-walkin" aria-selected="false">
          <i class="fas fa-walking text-warning"></i> TRÁNSITO
          <span class="badge badge-light ml-1">${walkinCount}</span>
        </a>
      </li>
    `;

    $('#mainTabs').html(navHtml);

    // Tab panes for inventory statuses
    let panesHtml = '';
    INVENTORY_ORDER.forEach((st, idx) => {
      panesHtml += `
        <div class="tab-pane fade ${idx===0?'show active':''}" id="pane-${st}" role="tabpanel" aria-labelledby="tab-${st}">
          <div class="row" id="grid-${st}"></div>
          <div class="text-center small-muted mt-2" id="empty-${st}" style="display:none;">Sin registros</div>
        </div>
      `;
    });

    // Walkin pane with inner pills by quote status
    panesHtml += `
      <div class="tab-pane fade" id="pane-walkin" role="tabpanel" aria-labelledby="tab-walkin">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
          <div>
            <h5 class="mb-0">Presupuestos en tránsito</h5>
            <div class="small-muted">Solo cotización (is_walk_in=1)</div>
          </div>
        </div>

        <ul class="nav nav-pills mt-3" id="walkinPills" role="tablist"></ul>
        <div class="tab-content mt-3" id="walkinPillsContent"></div>
      </div>
    `;

    $('#mainTabsContent').html(panesHtml);

    // Fill inventories per status
    INVENTORY_ORDER.forEach(st => {
      const items = inventories.filter(i => i.status === st);
      const $grid = $(`#grid-${st}`);
      if(items.length === 0){
        $(`#empty-${st}`).show();
      } else {
        $grid.html(items.map(renderInventoryCard).join(''));
      }
    });

    // Build walkin pills
    const wCounts = {};
    QUOTE_ORDER.forEach(s => wCounts[s] = 0);
    walkins.forEach(q => wCounts[q.status] = (wCounts[q.status]||0)+1);

    let pillsNav = '';
    let pillsContent = '';

    QUOTE_ORDER.forEach((st, idx) => {
      pillsNav += `
        <li class="nav-item">
          <a class="nav-link ${idx===0?'active':''}" id="wp-${st}" data-toggle="tab" href="#wpane-${st}"
             role="tab" aria-controls="wpane-${st}" aria-selected="${idx===0}">
            ${QUOTE_STATUS[st]}
            <span class="badge badge-light ml-1">${wCounts[st]||0}</span>
          </a>
        </li>
      `;

      pillsContent += `
        <div class="tab-pane fade ${idx===0?'show active':''}" id="wpane-${st}" role="tabpanel" aria-labelledby="wp-${st}">
          <div class="row" id="wgrid-${st}"></div>
          <div class="text-center small-muted mt-2" id="wempty-${st}" style="display:none;">Sin registros</div>
        </div>
      `;
    });

    $('#walkinPills').html(pillsNav);
    $('#walkinPillsContent').html(pillsContent);

    QUOTE_ORDER.forEach(st => {
      const items = walkins.filter(q => q.status === st);
      const $grid = $(`#wgrid-${st}`);
      if(items.length === 0){
        $(`#wempty-${st}`).show();
      } else {
        $grid.html(items.map(renderWalkinCard).join(''));
      }
    });

    // tooltips (si luego los agregas)
    $('[data-toggle="tooltip"]').tooltip();
  }

  // Filtrado simple por búsqueda + local (demo)
  function applyFilters(){
    const q = $('#searchInput').val().trim();
    const b = $('#branchSelect').val();

    $('.item-card').each(function(){
      const placa = $(this).data('placa') || '';
      const cliente = $(this).data('cliente') || '';
      const doc = $(this).data('doc') || '';
      const branch = String($(this).data('branch') || '');

      const okSearch = matchesSearch({placa, cliente, sn:'', series:'', number:'', _doc:doc}, q) ||
                       `${placa} ${cliente} ${doc}`.toLowerCase().includes(q.toLowerCase());

      const okBranch = !b || branch === String(b);

      $(this).toggle(okSearch && okBranch);
    });
  }

  $(function(){
    buildMainTabs();

    $('#searchInput').on('keyup', applyFilters);
    $('#branchSelect').on('change', applyFilters);
    $('#btnReset').on('click', function(){
      $('#searchInput').val('');
      $('#branchSelect').val('');
      applyFilters();
    });
  });
</script>
</body>
</html>
