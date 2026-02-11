<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Demo Formulario Inventario (Daños + Fotos + Checklist)</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
  body{font-family:Arial,sans-serif;background:#f5f6f7;}
  .page{max-width:1100px;margin:0 auto;padding-bottom:40px;}
  .card{border-radius:10px;}
  .section-title{font-weight:800; text-transform:uppercase; letter-spacing:.3px;}
  .small-muted{font-size:12px;color:#6c757d;}
  .sticky-save{
    position:fixed; left:0; right:0; bottom:0; z-index:9998;
    background:#fff; border-top:2px solid #e9ecef;
    padding:10px 12px;
  }

  /* ====== DAÑOS (demo simple) ====== */
  .damage-board{
    background:#fff; border:1px solid #ddd; border-radius:10px;
    padding:10px;
  }
  .car-stage{
    position:relative;
    width:100%;
    height:360px;
    border:1px dashed #cfd4da;
    border-radius:10px;
    background:linear-gradient(#fff,#fafafa);
    overflow:hidden;
  }
  .car-stage .hint{
    position:absolute; inset:0;
    display:flex; align-items:center; justify-content:center;
    color:#adb5bd; font-weight:700;
    user-select:none;
  }
  .mark{
    position:absolute;
    width:18px; height:18px;
    transform:translate(-50%,-50%);
    pointer-events:none;
  }
  .mark svg{display:block}

  /* Leyenda símbolos daños */
  .damage-legend{
    display:flex; gap:16px; flex-wrap:wrap; align-items:center;
    padding:6px 0 0 0;
  }
  .sym{display:inline-flex;align-items:center;justify-content:center;width:18px;font-weight:900;}
  .sym.rayon{color:#128a2e}
  .sym.aboll{color:#d10000}
  .sym.quine{color:#0047ff}

  /* ====== CHECKLIST (símbolos) ====== */
  .legend{
    border:2px solid #000; padding:10px 12px; margin-bottom:10px;
    display:flex; align-items:center; justify-content:space-between;
    flex-wrap:nowrap; font-size:14px; background:#fff;
  }
  .legend .title{font-weight:bold;}
  .legend-items{display:flex; gap:18px; align-items:center; flex-wrap:wrap;}
  .sym.good{color:#128a2e}
  .sym.reg{color:#e08b00}
  .sym.bad{color:#d10000}
  .sym.na{color:#000}
  @media (max-width:768px){
    .legend{flex-direction:column; align-items:flex-start; gap:6px;}
    .legend-items{gap:14px;}
  }

  .item{
    border:1px solid #ddd; border-radius:10px;
    padding:10px; margin-bottom:10px;
    background:#fff;
  }
  .name{
    font-weight:700; text-transform:uppercase; font-size:14px; line-height:1.2;
  }

  .btn-state{display:flex; flex-wrap:nowrap;}
  .btn-state .btn{
    height:40px; min-width:44px; padding:0 !important;
    display:inline-flex; align-items:center; justify-content:center;
    font-weight:900; font-size:18px; line-height:1;
    user-select:none;
  }

  .note-row{margin-top:6px;}
  .btn-note{font-size:13px;padding:0;text-decoration:none;}
  .btn-note:hover{text-decoration:underline;}
  .tip{font-size:12px;}
  .comment{display:none; margin-top:8px;}
  .comment input{height:40px;}

  /* Barra contextual checklist (solo aparece en checklist) */
  #checklistBar{
    position:fixed; left:0; right:0; bottom:56px; /* encima del save global */
    background:#fff; border-top:2px solid #000;
    padding:10px 12px; z-index:9999;
    display:none;
  }

  /* Save global */
  .save-row{
    display:flex; gap:10px; align-items:center; flex-wrap:wrap;
  }

  /* Ajustes móvil */
  @media (max-width:575px){
    .btn-state .btn{height:42px; min-width:46px; font-size:19px;}
    .name{font-size:13px;}
    .car-stage{height:320px;}
  }
</style>
</head>

<body>

<div class="container-fluid page mt-3 mb-5">

  <!-- CABECERA -->
  <div class="card mb-3">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div>
          <div class="section-title">Inventario Vehicular (Demo)</div>
          <div class="small-muted">Simulación tipo fields.blade.php con Daños + Fotos + Checklist + Barra contextual.</div>
        </div>
        <div class="ml-auto text-right">
          <div><strong>PR01-0000123</strong></div>
          <div class="small-muted">11/02/2026 09:15 pm</div>
        </div>
      </div>
    </div>
  </div>

  <!-- DATOS VEHÍCULO / CLIENTE -->
  <div class="card mb-3">
    <div class="card-body">
      <div class="section-title mb-2">Datos del Vehículo</div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <label class="mb-1">Placa</label>
          <input class="form-control form-control-sm" value="ABC-123" />
        </div>
        <div class="form-group col-md-3">
          <label class="mb-1">Marca</label>
          <input class="form-control form-control-sm" value="Toyota" />
        </div>
        <div class="form-group col-md-3">
          <label class="mb-1">Modelo</label>
          <input class="form-control form-control-sm" value="Corolla" />
        </div>
        <div class="form-group col-md-3">
          <label class="mb-1">Color</label>
          <input class="form-control form-control-sm" value="Gris" />
        </div>
      </div>

      <div class="section-title mt-2 mb-2">Datos del Cliente</div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label class="mb-1">Cliente</label>
          <input class="form-control form-control-sm" value="Carlos Arias Torres" />
        </div>
        <div class="form-group col-md-3">
          <label class="mb-1">DNI/RUC</label>
          <input class="form-control form-control-sm" value="12345678" />
        </div>
        <div class="form-group col-md-3">
          <label class="mb-1">Teléfono</label>
          <input class="form-control form-control-sm" value="999 999 999" />
        </div>
      </div>

      <div class="form-group mb-0">
        <label class="mb-1">Comentarios generales</label>
        <input class="form-control form-control-sm" placeholder="Escribe aquí..." />
      </div>
    </div>
  </div>

  <!-- DAÑOS -->
  <div class="card mb-3" id="damagesSection">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="section-title">Daños</div>
        <div class="ml-auto small-muted">Demo: clic en el recuadro para colocar marcas</div>
      </div>

      <div class="damage-board">
        <div class="form-row align-items-center mb-2">
          <div class="form-group col-md-4 mb-2 mb-md-0">
            <label class="mb-1">Tipo de vehículo</label>
            <select class="form-control form-control-sm">
              <option>Sedán</option>
              <option>Hatchback</option>
              <option>SUV</option>
              <option>Pickup</option>
            </select>
          </div>
          <div class="form-group col-md-8 mb-0">
            <label class="mb-1 d-block">Tipo de daño</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="damageType">
              <label class="btn btn-outline-success btn-sm active">
                <input type="radio" name="dmg" value="rayon" checked> Rayón (△ verde)
              </label>
              <label class="btn btn-outline-danger btn-sm">
                <input type="radio" name="dmg" value="aboll"> Abolladura (○ rojo)
              </label>
              <label class="btn btn-outline-primary btn-sm">
                <input type="radio" name="dmg" value="quine"> Quiñe (✖ azul)
              </label>
            </div>
          </div>
        </div>

        <div class="mb-2">
          <button type="button" class="btn btn-sm btn-outline-danger" id="btnClearMarks">Borrar marcas</button>
          <button type="button" class="btn btn-sm btn-outline-secondary" id="btnUndoMark">Deshacer</button>
        </div>

        <div class="car-stage" id="carStage">
          <div class="hint">ZONA DE DIBUJO (DEMO)</div>
          <!-- marcas se inyectan aquí -->
        </div>

        <div class="damage-legend mt-2">
          <span class="small-muted mr-2"><strong>Leyenda:</strong></span>
          <span><span class="sym rayon">△</span> Rayón</span>
          <span><span class="sym aboll">○</span> Abolladura</span>
          <span><span class="sym quine">✖</span> Quiñe</span>
        </div>
      </div>
    </div>
  </div>

  <!-- FOTOS -->
  <div class="card mb-3" id="photosSection">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="section-title">Fotos</div>
        <div class="ml-auto small-muted">Demo (no sube): simula selección</div>
      </div>

      <div class="form-row align-items-center">
        <div class="col-md-6 mb-2 mb-md-0">
          <input type="file" class="form-control-file" multiple>
        </div>
        <div class="col-md-6 text-md-right">
          <button class="btn btn-primary btn-sm" type="button">Tomar Foto</button>
          <button class="btn btn-outline-secondary btn-sm" type="button">Subir</button>
        </div>
      </div>

      <hr>
      <div class="small-muted">Preview (demo):</div>
      <div class="d-flex flex-wrap" style="gap:8px;">
        <div class="border rounded p-2 bg-white" style="width:110px;height:80px;display:flex;align-items:center;justify-content:center;color:#adb5bd;">IMG 1</div>
        <div class="border rounded p-2 bg-white" style="width:110px;height:80px;display:flex;align-items:center;justify-content:center;color:#adb5bd;">IMG 2</div>
        <div class="border rounded p-2 bg-white" style="width:110px;height:80px;display:flex;align-items:center;justify-content:center;color:#adb5bd;">IMG 3</div>
      </div>
    </div>
  </div>

  <!-- CHECKLIST -->
  <div class="card mb-3" id="checklistSection">
    <div class="card-body">
      <div class="section-title mb-2">Checklist Vehicular</div>

      <div class="legend">
        <div class="title">Leyenda:</div>
        <div class="legend-items">
          <span><span class="sym good">✓</span> Bueno</span>
          <span><span class="sym reg">△</span> Regular</span>
          <span><span class="sym bad">✖</span> Malo</span>
          <span><span class="sym na">●</span> No aplica</span>
        </div>
      </div>

      <div class="row" id="list"></div>
    </div>
  </div>

  <!-- FIRMA / AUTORIZACIÓN (mock) -->
  <div class="card mb-3" id="signatureSection">
    <div class="card-body">
      <div class="section-title mb-2">Autorización</div>
      <div class="small-muted mb-2">Demo: aquí iría tu firma digital / autorización del cliente (según tu flujo).</div>
      <div class="border rounded bg-white" style="height:140px;display:flex;align-items:center;justify-content:center;color:#adb5bd;">
        Área de Firma (DEMO)
      </div>
    </div>
  </div>

</div>

<!-- Barra contextual del checklist (solo aparece cuando checklist se ve) -->
<div id="checklistBar">
  <div class="d-flex align-items-center flex-wrap" style="gap:10px;">
    <button class="btn btn-success btn-sm" id="btnAllGood">Marcar todo Bueno</button>

    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" id="onlyIssues">
      <label class="custom-control-label" for="onlyIssues">Solo Regular/Malo</label>
    </div>

    <button class="btn btn-outline-secondary btn-sm" id="btnReset">Reiniciar checklist</button>

    <small class="ml-auto text-muted" id="progress"></small>
  </div>
</div>

<!-- Barra global “Guardar” (simula tu botón Crear Inventario) -->
<div class="sticky-save">
  <div class="save-row">
    <button class="btn btn-primary btn-sm">Crear Inventario</button>
    <button class="btn btn-outline-secondary btn-sm">Guardar borrador</button>
    <span class="small-muted">Barra global (siempre visible) — La del checklist es contextual.</span>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
/* =========================
   DAÑOS (demo)
========================= */
(function(){
  const $stage = $('#carStage');
  const marks = []; // stack para deshacer

  function currentType(){
    return $('#damageType input[name="dmg"]:checked').val();
  }

  function svgFor(type){
    // Triángulo verde vacío, círculo rojo vacío, X azul
    if(type === 'rayon'){
      return `<svg width="18" height="18" viewBox="0 0 18 18">
        <polygon points="9,2 16,16 2,16" fill="none" stroke="#128a2e" stroke-width="2"/>
      </svg>`;
    }
    if(type === 'aboll'){
      return `<svg width="18" height="18" viewBox="0 0 18 18">
        <circle cx="9" cy="9" r="6" fill="none" stroke="#d10000" stroke-width="2"/>
      </svg>`;
    }
    return `<svg width="18" height="18" viewBox="0 0 18 18">
      <line x1="3" y1="3" x2="15" y2="15" stroke="#0047ff" stroke-width="2"/>
      <line x1="15" y1="3" x2="3" y2="15" stroke="#0047ff" stroke-width="2"/>
    </svg>`;
  }

  $stage.on('click', function(e){
    const rect = this.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const type = currentType();
    const $m = $('<div class="mark"></div>');
    $m.css({left: x+'px', top: y+'px'}).html(svgFor(type));
    $stage.append($m);

    marks.push($m);
    $stage.find('.hint').hide();
  });

  $('#btnClearMarks').on('click', function(){
    marks.forEach($m => $m.remove());
    marks.length = 0;
    $stage.find('.hint').show();
  });

  $('#btnUndoMark').on('click', function(){
    const last = marks.pop();
    if(last) last.remove();
    if(marks.length === 0) $stage.find('.hint').show();
  });
})();

/* =========================
   CHECKLIST (símbolos)
========================= */
(function(){
  const KEY = "demo_full_form_checklist_v1";

  const items = [
    "PLUMILLAS","PARABRISA DELANTERO","FARO POSTERIOR","SEGURO DE AROS","TAPA DE COMBUSTIBLE",
    "BRAZO DE PLUMILLAS","PARABRISA POSTERIOR","MANIJA EXTERIOR","MOL. PUERTA","LLANTAS",
    "ESPEJOS EXTERIORES","FARO DELANTERO","NEBLINEROS","SEGURO DE VASOS","ANTENA",
    "VASO/COPA","BATERIA","PURIFICADOR",
    "TAPA LIQUI. EMBRAGUE","TAPA DE RADIADOR","SOPORTE DE BATERIA","TAPA LIQUI. FRENO",
    "TAPA LIQUI. DIRECCION","TAPA DE ACEITE","GNV-GLP","VARILLA ATM","VARILLA DE ACEITE",
    "TABLERO","CENICERO","CABEZAL DE ASIENTO","ABRE PUERTAS","PISOS SOBRE ALFOMBRAS",
    "TAPIZ DE ASIENTOS","ENCENDEDOR","RADIO","ALZA LUNAS",
    "TAPASOL","TAPIZ DE PUERTA","ESPEJOS INTERIORES","RELOJ","CLAXON",
    "CODERAS","ALARMA","ALFOMBRA EN MALETERA","GATA","PALANCA DE GATA",
    "HERRAMIENTAS","LLAVE DE RUEDAS","EXTINGUIDOR","TRIANGULO","COCODRILLOS",
    "LLANTA DE REPUESTO"
  ];

  const STATES = [
    {key:"correcto",     sym:"✓", title:"Bueno",    btn:"btn-outline-success"},
    {key:"recomendable", sym:"△", title:"Regular",  btn:"btn-outline-warning"},
    {key:"urgente",      sym:"✖", title:"Malo",     btn:"btn-outline-danger"},
    {key:"no_aplica",    sym:"●", title:"No aplica",btn:"btn-outline-dark"}
  ];

  function loadState(){
    try{
      const raw = localStorage.getItem(KEY);
      return raw ? (JSON.parse(raw) || {}) : {};
    }catch(e){ return {}; }
  }
  function saveState(data){
    localStorage.setItem(KEY, JSON.stringify(data));
  }

  function esc(str){
    return String(str).replace(/[&<>"']/g, s => ({
      "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"
    }[s]));
  }
  function escAttr(str){ return esc(str).replace(/"/g,'&quot;'); }

  let store = loadState();
  items.forEach(n => {
    if(!store[n]) store[n] = {status:"correcto", comment:"", noteOpen:false};
  });

  function setTip($item, status){
    const $tip = $item.find(".tip");
    if(status === "urgente") $tip.text("Comentario obligatorio (Malo).");
    else if(status === "recomendable") $tip.text("Comentario recomendado (Regular).");
    else $tip.text("");
  }

  function applyOnlyIssues(){
    const only = $("#onlyIssues").is(":checked");
    $(".item").each(function(){
      const st = $(this).attr("data-status");
      if(!only) $(this).closest('[data-col]').show();
      else $(this).closest('[data-col]').toggle(st === "recomendable" || st === "urgente");
    });
  }

  function updateProgress(){
    let good=0, reg=0, bad=0, na=0;
    $(".item").each(function(){
      const st = $(this).attr("data-status");
      if(st==="correcto") good++;
      else if(st==="recomendable") reg++;
      else if(st==="urgente") bad++;
      else if(st==="no_aplica") na++;
    });
    $("#progress").text(`✓ ${good} | △ ${reg} | ✖ ${bad} | ● ${na}`);
  }

  function render(){
    const $list = $("#list").empty();

    items.forEach((name, idx) => {
      const row = store[name];

      const card = $(`
        <div class="item" data-name="${esc(name)}" data-status="${row.status}">
          <div class="d-flex align-items-start">
            <div class="name flex-grow-1 pr-2">${esc(name)}</div>

            <div class="btn-group btn-group-toggle btn-state" data-toggle="buttons" role="group" aria-label="estado">
              ${STATES.map(s => `
                <label class="btn ${s.btn} ${row.status===s.key?'active':''}" title="${s.title}">
                  <input type="radio" name="st_${idx}" value="${s.key}" ${row.status===s.key?'checked':''}>
                  ${s.sym}
                </label>
              `).join("")}
            </div>
          </div>

          <div class="d-flex align-items-center note-row">
            <a href="javascript:void(0)" class="btn-note">📝 Nota</a>
            <span class="ml-2 text-muted tip"></span>
          </div>

          <div class="comment">
            <input type="text" class="form-control form-control-sm"
                   placeholder="Comentario..." value="${escAttr(row.comment)}">
          </div>
        </div>
      `);

      const shouldOpen = (row.status === "recomendable" || row.status === "urgente" || row.noteOpen);
      if(shouldOpen) card.find(".comment").show();

      setTip(card, row.status);

      const $col = $(`<div class="col-lg-4 col-md-6 col-12" data-col="1"></div>`);
      $col.append(card);
      $list.append($col);
    });

    $('[title]').tooltip({container:'body', trigger:'hover'});
    applyOnlyIssues();
    updateProgress();
  }

  $(document).on("change",".item input[type=radio]",function(){
    const $item = $(this).closest(".item");
    const name = $item.data("name");
    const val = $(this).val();

    store[name].status = val;
    $item.attr("data-status", val);

    if(val === "recomendable" || val === "urgente"){
      store[name].noteOpen = true;
      $item.find(".comment").show();
    }else{
      if(!store[name].noteOpen){
        $item.find(".comment").hide();
      }
    }

    setTip($item, val);
    saveState(store);
    applyOnlyIssues();
    updateProgress();
  });

  $(document).on("click",".btn-note",function(){
    const $item = $(this).closest(".item");
    const name = $item.data("name");
    const $cmt = $item.find(".comment");

    $cmt.toggle();
    store[name].noteOpen = $cmt.is(":visible");
    saveState(store);

    if($cmt.is(":visible")) $cmt.find("input").focus();
  });

  $(document).on("input",".comment input",function(){
    const $item = $(this).closest(".item");
    const name = $item.data("name");
    store[name].comment = $(this).val();
    saveState(store);
  });

  $("#btnAllGood").on("click",function(){
    $(".item").each(function(){
      const name = $(this).data("name");
      store[name].status = "correcto";
    });
    saveState(store);
    render();
  });

  $("#btnReset").on("click", function(){
    localStorage.removeItem(KEY);
    store = {};
    items.forEach(n => store[n] = {status:"correcto", comment:"", noteOpen:false});
    saveState(store);
    render();
  });

  $("#onlyIssues").on("change", function(){ applyOnlyIssues(); });

  render();
})();

/* =========================
   Barra contextual checklist:
   aparece SOLO cuando checklist se ve
========================= */
$(function(){
  const $bar = $('#checklistBar');
  const target = document.getElementById('checklistSection');
  if(!target) return;

  if(!('IntersectionObserver' in window)){
    $(window).on('scroll', function(){
      const top = $(target).offset().top;
      const bottom = top + $(target).outerHeight();
      const scrollTop = $(window).scrollTop();
      const viewBottom = scrollTop + $(window).height();
      const visible = (viewBottom > top + 120) && (scrollTop < bottom - 120);
      $bar.toggle(visible);
    }).trigger('scroll');
    return;
  }

  const obs = new IntersectionObserver((entries)=>{
    $bar.toggle(entries[0].isIntersecting);
  }, {threshold: 0.15});

  obs.observe(target);
});
</script>

</body>
</html>
