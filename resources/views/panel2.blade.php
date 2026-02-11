<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Checklist Demo (Taller)</title>
  <style>
    body{font-family: Arial, sans-serif; margin:0; padding:16px; background:#fff;}
    .wrap{max-width: 980px; margin:0 auto;}
    .toolbar{
      display:flex; gap:10px; flex-wrap:wrap; align-items:center;
      margin-bottom:10px;
    }
    .btn{
      border:1px solid #000; background:#f5f5f5; padding:8px 10px; cursor:pointer;
      font-size:14px; border-radius:4px;
    }
    .btn:active{transform:scale(.98)}
    .toggle{display:flex; gap:8px; align-items:center; user-select:none;}
    .toggle input{transform:scale(1.2)}
    .legend{
      border:2px solid #000; padding:8px 10px; margin-bottom:8px;
      display:flex; gap:28px; flex-wrap:wrap; align-items:center;
      font-size:14px; font-weight:bold;
    }
    .legend .item{display:flex; gap:8px; align-items:center; font-weight:normal;}
    .table{
      width:100%; border-collapse:collapse; table-layout:fixed;
      border:2px solid #000;
    }
    .table td, .table th{
      border:2px solid #000;
      padding:4px 6px;
      font-size:14px;
    }
    .cell{
      display:flex; align-items:center; justify-content:space-between;
      gap:8px;
    }
    .name{
      font-weight:bold;
      letter-spacing:0.2px;
      text-transform:uppercase;
      overflow:hidden;
      white-space:nowrap;
      text-overflow:ellipsis;
    }
    .mark{
      width:34px; height:26px;
      display:flex; align-items:center; justify-content:center;
      border:1px solid transparent;
      cursor:pointer;
      user-select:none;
      border-radius:4px;
      font-size:18px;
      line-height:1;
      flex: 0 0 auto;
    }
    .mark:active{transform:scale(.95)}
    /* Estados */
    .st-na{color:#000;}            /* ● */
    .st-good{color:#128a2e;}       /* ✓ */
    .st-reg{color:#e08b00;}        /* △ */
    .st-bad{color:#d10000;}        /* ✖ */
    /* Opcional: resaltar cuando no es N/A */
    .mark:not(.st-na){border-color:#000;}
    .comment{
      display:none;
      margin-top:6px;
    }
    .comment input{
      width:100%;
      padding:6px 8px;
      border:1px solid #000;
      border-radius:4px;
      font-size:13px;
    }
    .rowbox{padding-bottom:6px;}
    /* Móvil */
    @media (max-width: 768px){
      body{padding:10px;}
      .table td{font-size:13px;}
      .mark{width:38px; height:30px; font-size:20px;}
      .legend{gap:18px; font-size:13px;}
    }
  </style>
</head>
<body>
<div class="wrap">

  <div class="toolbar">
    <button class="btn" id="btnAllGood">Marcar todo Bueno</button>
    <button class="btn" id="btnAllNA">Marcar todo No aplica</button>
    <label class="toggle">
      <input type="checkbox" id="onlyIssues"/>
      Mostrar solo Regular/Malo
    </label>
    <div id="progress" style="margin-left:auto; font-size:13px;"></div>
  </div>

  <div class="legend">
    <div><b>Leyenda Checklist:</b></div>
    <div class="item"><span class="mark st-good" style="border-color:transparent">✓</span> Bueno</div>
    <div class="item"><span class="mark st-reg"  style="border-color:transparent">△</span> Regular</div>
    <div class="item"><span class="mark st-bad"  style="border-color:transparent">✖</span> Malo</div>
    <div class="item"><span class="mark st-na"   style="border-color:transparent">●</span> No aplica</div>
  </div>

  <table class="table" id="tbl">
    <tbody id="tbody"></tbody>
  </table>

</div>

<script>
  // Estados en ciclo: NA -> GOOD -> REG -> BAD -> NA
  const STATES = [
    {key:'na',   cls:'st-na',   sym:'●'},
    {key:'good', cls:'st-good', sym:'✓'},
    {key:'reg',  cls:'st-reg',  sym:'△'},
    {key:'bad',  cls:'st-bad',  sym:'✖'},
  ];
  const nextStateIndex = (idx) => (idx + 1) % STATES.length;

  // Lista de items (los de tu imagen; puedes agregar más)
  const items = [
    "PLUMILLAS","PARABRISA DELANTERO","FARO POSTERIOR","SEGURO DE AROS","TAPA DE COMBUSTIBLE",
    "BRAZO DE PLUMILLAS","PARABRISA POSTERIOR","MANIJA EXTERIOR","MOL. PUERTA","LLANTAS",
    "ESPEJOS EXTERIORES","FARO DELANTERO","NEBLINEROS","SEGURO DE VASOS","ANTENA",
    "VASO/COPA","BATERIA","PURIFICADOR",
    "TAPA LIQUI. EMBRAGUE","TAPA DE RADIADOR","SOPORTE DE BATERIA","TAPA LIQUI. FRENO","TAPA LIQUI. DIRECCION",
    "TAPA DE ACEITE","GNV-GLP","VARILLA ATM","VARILLA DE ACEITE","TABLERO","CENICERO","CABEZAL DE ASIENTO",
    "ABRE PUERTAS","PISOS SOBRE ALFOMBRAS","TAPIZ DE ASIENTOS","ENCENDEDOR","RADIO","ALZA LUNAS",
    "TAPASOL","TAPIZ DE PUERTA","ESPEJOS INTERIORES","RELOJ","CLAXON","CODERAS","ALARMA",
    "ALFOMBRA EN MALETERA","GATA","PALANCA DE GATA","HERRAMIENTAS","LLAVE DE RUEDAS","EXTINGUIDOR",
    "TRIANGULO","COCODRILLOS","LLANTA DE REPUESTO"
  ];

  // Para simular exactamente tu screenshot: algunos valores pre-set
  const preset = {
    "TAPA LIQUI. FRENO": "bad",
    "TAPA LIQUI. DIRECCION": "bad",
    "TAPA DE ACEITE": "bad",
    "GNV-GLP": "bad",

    "VARILLA ATM": "reg",
    "VARILLA DE ACEITE": "reg",
    "PISOS SOBRE ALFOMBRAS": "reg",
    "TAPIZ DE ASIENTOS": "reg",
    "ENCENDEDOR": "reg",
    "RADIO": "reg",

    "TAPIZ DE PUERTA": "good",
    "ESPEJOS INTERIORES": "good",
    "RELOJ": "good",
    "CLAXON": "good",

    "PALANCA DE GATA": "reg",
    "HERRAMIENTAS": "reg",
    "LLAVE DE RUEDAS": "reg",
    "EXTINGUIDOR": "reg",
  };

  // Construir en 3 columnas como tu PDF (col1 col2 col3)
  const COLS = 3;
  const rows = Math.ceil(items.length / COLS);
  const columns = Array.from({length: COLS}, (_, c) => items.slice(c*rows, (c+1)*rows));

  const tbody = document.getElementById('tbody');

  function stateByKey(key){
    return STATES.findIndex(s => s.key === key);
  }

  function render(){
    tbody.innerHTML = "";
    for(let r=0; r<rows; r++){
      const tr = document.createElement('tr');

      for(let c=0; c<COLS; c++){
        const name = (columns[c] && columns[c][r]) ? columns[c][r] : "";

        const td = document.createElement('td');
        td.style.width = "33.33%";

        if(!name){
          td.innerHTML = "&nbsp;";
          tr.appendChild(td);
          continue;
        }

        const rowbox = document.createElement('div');
        rowbox.className = "rowbox";
        rowbox.dataset.name = name;

        const line = document.createElement('div');
        line.className = "cell";

        const nm = document.createElement('div');
        nm.className = "name";
        nm.textContent = name;

        const mk = document.createElement('div');
        mk.className = "mark";
        mk.tabIndex = 0;

        // set initial state
        const initKey = preset[name] || "na";
        let idx = stateByKey(initKey);
        applyState(mk, idx);

        mk.addEventListener('click', () => {
          idx = nextStateIndex(idx);
          applyState(mk, idx);
          toggleComment(rowbox, STATES[idx].key);
          applyFilters();
          updateProgress();
        });

        // comment
        const comment = document.createElement('div');
        comment.className = "comment";
        comment.innerHTML = `<input type="text" placeholder="Comentario (solo si aplica)">`;

        line.appendChild(nm);
        line.appendChild(mk);

        rowbox.appendChild(line);
        rowbox.appendChild(comment);

        // mostrar comentario por defecto si ya es reg o bad
        toggleComment(rowbox, STATES[idx].key);

        td.appendChild(rowbox);
        tr.appendChild(td);
      }

      tbody.appendChild(tr);
    }

    applyFilters();
    updateProgress();
  }

  function applyState(el, idx){
    // limpiar clases
    STATES.forEach(s => el.classList.remove(s.cls));
    el.classList.add(STATES[idx].cls);
    el.textContent = STATES[idx].sym;
    el.dataset.state = STATES[idx].key;
  }

  // Mostrar comentario solo en Regular o Malo (puedes cambiar la regla)
  function toggleComment(rowbox, stateKey){
    const cmt = rowbox.querySelector('.comment');
    cmt.style.display = (stateKey === 'bad' || stateKey === 'reg') ? 'block' : 'none';
  }

  function applyFilters(){
    const onlyIssues = document.getElementById('onlyIssues').checked;
    const all = document.querySelectorAll('.rowbox');
    all.forEach(rb => {
      const st = rb.querySelector('.mark').dataset.state;
      rb.style.display = (!onlyIssues || (st === 'reg' || st === 'bad')) ? '' : 'none';
    });
  }

  function updateProgress(){
    const marks = document.querySelectorAll('.mark');
    const total = marks.length;
    const counts = {good:0, reg:0, bad:0, na:0};
    marks.forEach(m => counts[m.dataset.state]++);
    document.getElementById('progress').textContent =
      `Total: ${total} | ✓ ${counts.good}  △ ${counts.reg}  ✖ ${counts.bad}  ● ${counts.na}`;
  }

  document.getElementById('onlyIssues').addEventListener('change', applyFilters);

  document.getElementById('btnAllGood').addEventListener('click', () => {
    document.querySelectorAll('.mark').forEach(m => {
      applyState(m, stateByKey('good'));
      toggleComment(m.closest('.rowbox'), 'good');
    });
    applyFilters(); updateProgress();
  });

  document.getElementById('btnAllNA').addEventListener('click', () => {
    document.querySelectorAll('.mark').forEach(m => {
      applyState(m, stateByKey('na'));
      toggleComment(m.closest('.rowbox'), 'na');
    });
    applyFilters(); updateProgress();
  });

  render();
</script>
</body>
</html>
