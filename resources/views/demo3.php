<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Checklist Demo Taller (Símbolos)</title>

<!-- Bootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
  body{font-family:Arial,sans-serif;background:#fff;}
  .page{max-width:1100px;margin:0 auto;padding-bottom:90px;}

  /* Leyenda (coherente con botones) */
  .legend{
    border:2px solid #000; padding:10px 12px; margin-bottom:10px;
    display:flex; align-items:center; justify-content:space-between;
    flex-wrap:nowrap;
    font-size:14px;
  }
  .legend .title{font-weight:bold;}
  .legend-items{display:flex; gap:18px; align-items:center; flex-wrap:wrap;}
  .sym{display:inline-flex;align-items:center;justify-content:center;width:18px; font-weight:800;}
  .sym.good{color:#128a2e}
  .sym.reg{color:#e08b00}
  .sym.bad{color:#d10000}
  .sym.na{color:#000}

  @media (max-width: 768px){
    .legend{flex-direction:column; align-items:flex-start; gap:6px;}
    .legend-items{gap:14px;}
  }

  /* Tarjeta item */
  .item{
    border:1px solid #ddd; border-radius:10px;
    padding:10px; margin-bottom:10px;
    background:#fff;
  }
  .name{
    font-weight:700; text-transform:uppercase; font-size:14px;
    line-height:1.2;
  }

  /* Botones por símbolos (alineados) */
  .btn-state{display:flex; flex-wrap:nowrap;}
  .btn-state .btn{
    height:40px;
    min-width:44px;
    padding:0 !important;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-weight:900;
    font-size:18px;     /* símbolo se ve claro */
    line-height:1;
    user-select:none;
  }

  /* Nota y comentario */
  .note-row{margin-top:6px;}
  .btn-note{font-size:13px;padding:0;text-decoration:none;}
  .btn-note:hover{text-decoration:underline;}
  .tip{font-size:12px;}
  .comment{display:none; margin-top:8px;}
  .comment input{height:40px;}

  /* Mejor UX móvil */
  .no-select, .btn, .item{ -webkit-user-select:none; user-select:none; }
  input[type="text"]{ -webkit-user-select:text; user-select:text; }

  /* Barra inferior fija */
  .bottom-bar{
    position:fixed; left:0; right:0; bottom:0;
    background:#fff; border-top:2px solid #000;
    padding:10px 12px; z-index:9999;
  }

  /* Ajustes en móvil */
  @media (max-width: 575px){
    .btn-state .btn{height:42px; min-width:46px; font-size:19px;}
    .name{font-size:13px;}
  }
</style>
</head>

<body>
<div class="container-fluid page mt-3">

  <h5 class="mb-2"><strong>Checklist Vehicular</strong></h5>

  <div class="legend">
    <div class="title">Leyenda:</div>
    <div class="legend-items">
      <span><span class="sym good">✓</span> Bueno</span>
      <span><span class="sym reg">△</span> Regular</span>
      <span><span class="sym bad">✖</span> Malo</span>
      <span><span class="sym na">●</span> No aplica</span>
    </div>
  </div>

  <!-- Grid Bootstrap para mantener orden por filas en PC -->
  <div class="row" id="list"></div>

</div>

<!-- Barra inferior fija -->
<div class="bottom-bar">
  <div class="d-flex align-items-center flex-wrap" style="gap:10px;">
    <button class="btn btn-success btn-sm" id="btnAllGood">Marcar todo Bueno</button>

    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" id="onlyIssues">
      <label class="custom-control-label" for="onlyIssues">Solo Regular/Malo</label>
    </div>

    <button class="btn btn-outline-secondary btn-sm" id="btnReset">Reiniciar demo</button>

    <small class="ml-auto text-muted" id="progress"></small>
  </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  const KEY = "checklist_demo_symbols_v1";

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

  // Estados (valores pensados como tu backend: correcto/recomendable/urgente/no_aplica)
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
        <div class="item no-select" data-name="${esc(name)}" data-status="${row.status}">
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

    // Tooltips (PC)
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

    // abrir comentario automático en Regular/Malo
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

  $("#onlyIssues").on("change", function(){ applyOnlyIssues(); });

  $("#btnReset").on("click", function(){
    localStorage.removeItem(KEY);
    store = {};
    items.forEach(n => store[n] = {status:"correcto", comment:"", noteOpen:false});
    saveState(store);
    render();
  });

  render();
</script>
</body>
</html>
