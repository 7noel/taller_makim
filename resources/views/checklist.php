<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Extraer datos - OCR (pegar imagen)</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style>
    body{font-family: Arial, Helvetica, sans-serif; background:#f4f4f6; padding:20px;}
    .card{background:#fff;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.06);max-width:980px;margin:0 auto;}
    h2{margin-top:0}
    #pasteZone{border:2px dashed #9aa0a6; padding:18px; border-radius:6px; text-align:center; color:#666; margin-bottom:10px; background:#fafafa}
    #preview{max-width:100%; margin:8px 0; border:1px solid #ddd}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    label{font-weight:600;font-size:13px}
    input[type=text], textarea{width:100%; padding:8px;border:1px solid #ccc;border-radius:4px}
    button{padding:10px 14px;border:0;background:#2b6cb0;color:#fff;border-radius:6px;cursor:pointer}
    .small{font-size:12px;color:#666}
    pre{white-space:pre-wrap;background:#f7f7f8;padding:10px;border-radius:4px;border:1px solid #eee}
  </style>
</head>
<body>
  <div class="card">
    <h2>Formulario: pegar imagen desde portapapeles y extraer datos</h2>

    <div id="pasteZone" tabindex="0">
      <div style="font-size:14px">Pega la imagen aquí (Ctrl+V) o arrastra/soltar. También puedes usar el botón de subir.</div>
      <div class="small">Recomendado: imagen similar al PDF/imagen que mostraste (texto claro en blanco/negro).</div>
      <img id="preview" alt="preview" src="" style="display:none"/>
      <div style="margin-top:8px">
        <input type="file" id="fileInput" accept="image/*">
        <button id="btnOCR" type="button">Ejecutar OCR</button>
        <button id="btnLeerClipboard">Pegar imagen del portapapeles</button>
      </div>
    </div>

    <div style="margin-top:12px">
      <strong>Salida OCR (sin parsear):</strong>
      <pre id="ocrRaw">Pendiente...</pre>
    </div>

    <hr/>

    <form id="datosForm">
      <div class="grid">
        <div>
          <label>N° PLACA</label>
          <input type="text" id="placa" name="placa">
        </div>
        <div>
          <label>N° SERIE</label>
          <input type="text" id="serie" name="serie">
        </div>
        <div>
          <label>N° VIN</label>
          <input type="text" id="vin" name="vin">
        </div>
        <div>
          <label>N° MOTOR</label>
          <input type="text" id="motor" name="motor">
        </div>
        <div>
          <label>COLOR</label>
          <input type="text" id="color" name="color">
        </div>
        <div>
          <label>MARCA</label>
          <input type="text" id="marca" name="marca">
        </div>
        <div>
          <label>MODELO</label>
          <input type="text" id="modelo" name="modelo">
        </div>
        <div>
          <label>PLACA VIGENTE</label>
          <input type="text" id="placa_vigente" name="placa_vigente">
        </div>
        <div>
          <label>PLACA ANTERIOR</label>
          <input type="text" id="placa_anterior" name="placa_anterior">
        </div>
        <div>
          <label>ESTADO</label>
          <input type="text" id="estado" name="estado">
        </div>
        <div style="grid-column:1/3">
          <label>ANOTACIONES</label>
          <input type="text" id="anotaciones" name="anotaciones">
        </div>
        <div>
          <label>SEDE</label>
          <input type="text" id="sede" name="sede">
        </div>
        <div>
          <label>AÑO DE MODELO</label>
          <input type="text" id="anio" name="anio">
        </div>
        <div style="grid-column:1/3">
          <label>PROPIETARIO(S)</label>
          <textarea id="propietario" rows="2"></textarea>
        </div>
      </div>

      <div style="margin-top:12px">
        <button type="button" id="btnCopyJson">Copiar JSON</button>
        <span class="small" style="margin-left:10px">Resultado final listo para enviar a tu backend.</span>
      </div>
    </form>

    <div style="margin-top:12px">
      <strong>JSON resultado:</strong>
      <pre id="jsonOut">{} </pre>
    </div>

  </div>

  <!-- Tesseract.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>
  <script>
  // --- Helpers ---
  function setPreview(src) {
    const img = document.getElementById('preview');
    img.src = src;
    img.style.display = src ? 'block' : 'none';
  }

  function setRaw(text) {
    document.getElementById('ocrRaw').textContent = text || '';
  }

  function setField(id, value) {
    if(typeof value !== 'string') value = value === undefined || value === null ? '' : String(value);
    document.getElementById(id).value = value.trim();
  }

  // Preprocesado simple: escala y contraste en canvas
  function preprocessImage(img, maxWidth = 1200) {
    return new Promise((resolve) => {
      const canvas = document.createElement('canvas');
      const ctx = canvas.getContext('2d');

      let w = img.width, h = img.height;
      if (w > maxWidth) {
        const ratio = maxWidth / w;
        w = maxWidth; h = Math.round(h * ratio);
      }
      canvas.width = w; canvas.height = h;
      // draw resized
      ctx.drawImage(img, 0, 0, w, h);

      // get image data and convert to grayscale + contrast
      const id = ctx.getImageData(0,0,w,h);
      const d = id.data;
      // simple contrast/brightness
      const contrast = 1.2; // 1 = normal
      const brightness = 10; // -255..255
      for (let i=0;i<d.length;i+=4) {
        // gray
        const r = d[i], g = d[i+1], b = d[i+2];
        let v = 0.299*r + 0.587*g + 0.114*b;
        // contrast
        v = ((v - 128) * contrast) + 128 + brightness;
        v = Math.max(0, Math.min(255, v));
        d[i] = d[i+1] = d[i+2] = v;
      }
      ctx.putImageData(id,0,0);
      resolve(canvas.toDataURL('image/png'));
    });
  }

  // OCR usando Tesseract v5 sin worker manual
  async function doOCR(src) {
    const { data: { text } } = await Tesseract.recognize(
      src,
      'spa',                             // idioma
      { logger: m => console.log(m) }    // opcional
    );
    return text;
  }

  // Patrones más tolerantes a errores de OCR (N°, N9, N*, Ne, etc.)
  // y evitando confundir "PLACA" con "PLACA VIGENTE"
  const fieldPatterns = {
    placa: [
      /^(?:N[°º\*9eE]?\s*)?PLACA(?!\s+VIGENTE)\s*[:\-]?\s*([A-Z0-9\- ]{4,12})$/i
    ],
    serie: [
      /^(?:N[°º\*9eE]?\s*)?SERIE\s*[:\-]?\s*([A-Z0-9]+)$/i
    ],
    vin: [
      /^(?:N[°º\*9eE]?\s*)?VIN\s*[:\-]?\s*([A-Z0-9]+)$/i
    ],
    motor: [
      /^(?:N[°º\*9eE]?\s*)?MOTOR\s*[:\-]?\s*([A-Z0-9]+)$/i
    ],
    color: [/^COLOR\s*[:\-]?\s*(.+)$/i],
    marca: [/^MARCA\s*[:\-]?\s*(.+)$/i],
    modelo: [/^MODELO\s*[:\-]?\s*(.+)$/i],
    placa_vigente: [/^PLACA\s+VIGENTE\s*[:\-]?\s*([A-Z0-9\- ]{3,12})$/i],
    placa_anterior: [/^PLACA\s+ANTERIOR\s*[:\-]?\s*(.+)$/i],
    estado: [/^ESTADO\s*[:\-]?\s*(.+)$/i],
    anotaciones: [/^ANOTACIONES\s*[:\-]?\s*(.+)$/i],
    sede: [/^SEDE\s*[:\-]?\s*(.+)$/i],
    anio: [/^A[ÑN]O\s+DE\s+MODELO\s*[:\-]?\s*(\d{4})$/i, /^AÑO\s*[:\-]?\s*(\d{4})$/i],
    // propietario lo trataremos aparte porque suele estar en la línea siguiente
  };

  function parseFieldsFromText(text) {
    const rawLines = text.split(/\r?\n/);
    // limpiar líneas: quitar espacios extra y guiones largos sueltos
    const lines = rawLines.map(l => l.replace(/\s+/g, ' ').trim()).filter(Boolean);

    const result = {};

    // 2.1. Intentar mapear por patrones estándar (excepto propietario)
    for (const [field, patterns] of Object.entries(fieldPatterns)) {
      for (const patt of patterns) {
        const hit = lines.find(line => patt.test(line));
        if (hit) {
          const m = hit.match(patt);
          if (m && m[1]) {
            result[field] = m[1].trim();
            break;
          }
        }
      }
    }

    // 2.2. Propietario: puede venir vacío en la misma línea y el dato en la siguiente
    let idxProp = lines.findIndex(l => /PROPIETARIO/i.test(l));
    if (idxProp !== -1) {
      // intentar leer después de los dos puntos en la misma línea
      let sameLine = lines[idxProp].split(/[:\-]/).slice(1).join(':').trim();
      if (sameLine && !/^\(?S\)?$/i.test(sameLine)) { // evitar "(S):" o variantes
        result.propietario = sameLine;
      } else {
        // tomar la siguiente línea no vacía
        for (let j = idxProp + 1; j < lines.length; j++) {
          if (lines[j] && !/^(Publicado|Sunarp|Consulta)/i.test(lines[j])) {
            result.propietario = lines[j].trim();
            break;
          }
        }
      }
    }

    // 2.3. Normalizaciones
    const toUpperNoSpaces = v => v ? v.replace(/\s+/g, '').toUpperCase() : v;

    // Evitar que "placa" tome "PLACA VIGENTE"
    if (!result.placa && result.placa_vigente) {
      result.placa = result.placa_vigente;
    }

    if (result.placa) result.placa = toUpperNoSpaces(result.placa).replace('-', '');
    if (result.placa_vigente) result.placa_vigente = toUpperNoSpaces(result.placa_vigente).replace('-', '');
    if (result.serie) result.serie = toUpperNoSpaces(result.serie);
    if (result.vin) result.vin = toUpperNoSpaces(result.vin);
    if (result.motor) result.motor = toUpperNoSpaces(result.motor);

    // limpiar "— NINGUNA" -> "NINGUNA"
    if (result.anotaciones) result.anotaciones = result.anotaciones.replace(/^[—\-]\s*/, '');

    return { parsed: result, lines };
  }


  // Update form inputs from parsed object
  function fillForm(parsed) {
    setField('placa', parsed.placa || parsed.placa_vigente || '');
    setField('serie', parsed.serie || '');
    setField('vin', parsed.vin || '');
    setField('motor', parsed.motor || '');
    setField('color', parsed.color || '');
    setField('marca', parsed.marca || '');
    setField('modelo', parsed.modelo || '');
    setField('placa_vigente', parsed.placa_vigente || '');
    setField('placa_anterior', parsed.placa_anterior || '');
    setField('estado', parsed.estado || '');
    setField('anotaciones', parsed.anotaciones || '');
    setField('sede', parsed.sede || '');
    setField('anio', parsed.anio || '');
    setField('propietario', parsed.propietario || '');
    // mostrar JSON
    const json = {
      placa: document.getElementById('placa').value,
      serie: document.getElementById('serie').value,
      vin: document.getElementById('vin').value,
      motor: document.getElementById('motor').value,
      color: document.getElementById('color').value,
      marca: document.getElementById('marca').value,
      modelo: document.getElementById('modelo').value,
      placa_vigente: document.getElementById('placa_vigente').value,
      placa_anterior: document.getElementById('placa_anterior').value,
      estado: document.getElementById('estado').value,
      anotaciones: document.getElementById('anotaciones').value,
      sede: document.getElementById('sede').value,
      anio: document.getElementById('anio').value,
      propietario: document.getElementById('propietario').value
    };
    document.getElementById('jsonOut').textContent = JSON.stringify(json, null, 2);
  }

  // --- Event wiring ---
  const pasteZone = document.getElementById('pasteZone');
  pasteZone.addEventListener('paste', async (ev) => {
    ev.preventDefault();
    const items = (ev.clipboardData || ev.originalEvent.clipboardData).items;
    for (const item of items) {
      if (item.type.indexOf('image') === 0) {
        const blob = item.getAsFile();
        handleImageFile(blob);
        return;
      }
    }
    alert('No se detectó imagen en el portapapeles. Asegúrate de copiar la imagen (copiar imagen) y pegarla aquí.');
  });

  // soporte drag & drop
  pasteZone.addEventListener('drop', async (ev) => {
    ev.preventDefault();
    const f = ev.dataTransfer.files && ev.dataTransfer.files[0];
    if (f && f.type.startsWith('image')) handleImageFile(f);
  });
  pasteZone.addEventListener('dragover', ev=>ev.preventDefault());

  // file input
  document.getElementById('fileInput').addEventListener('change', (e)=>{
    const f = e.target.files[0];
    if (f) handleImageFile(f);
  });

  // boton OCR
  document.getElementById('btnOCR').addEventListener('click', async () => {
    if (!currentImage) { alert('Primero pega o sube una imagen'); return; }
    await runOcrAndParse(currentImage);
  });

  // Copiar al portapapeles con fallback (HTTPS/localhost usa Clipboard API; si no, execCommand)
  function copyToClipboard(text) {
    if (navigator.clipboard && window.isSecureContext) {
      // disponible en HTTPS o localhost
      return navigator.clipboard.writeText(text);
    } else {
      // fallback para file:// o HTTP
      const ta = document.createElement('textarea');
      ta.value = text;
      ta.setAttribute('readonly', '');
      ta.style.position = 'fixed';
      ta.style.top = '-1000px';
      ta.style.opacity = '0';
      document.body.appendChild(ta);
      ta.select();
      try {
        document.execCommand('copy');
        document.body.removeChild(ta);
        return Promise.resolve();
      } catch (e) {
        document.body.removeChild(ta);
        return Promise.reject(e);
      }
    }
  }

  // Reemplaza tu listener del botón "Copiar JSON"
  document.getElementById('btnCopyJson').addEventListener('click', () => {
    const txt = document.getElementById('jsonOut').textContent || '';
    copyToClipboard(txt)
      .then(() => alert('JSON copiado al portapapeles'))
      .catch(err => {
        console.error(err);
        alert('No se pudo copiar. Selecciona y copia manualmente.');
      });
  });


  // image handling
  let currentImage = null; // HTMLImageElement
  function handleImageFile(fileOrBlob) {
    const url = URL.createObjectURL(fileOrBlob);
    const img = new Image();
    img.onload = async () => {
      setPreview(url);
      currentImage = img;
      // automáticamente lanzar OCR tras pegar - opcional
      await runOcrAndParse(img);
      URL.revokeObjectURL(url);
    };
    img.onerror = ()=> alert('No se pudo cargar la imagen.');
    img.src = url;
  }

  // main routine: preprocesa -> OCR -> parse -> fill
  async function runOcrAndParse(img) {
    setRaw('Procesando imagen...');
    try {
      const processedDataUrl = await preprocessImage(img, 1400);
      setPreview(processedDataUrl);
      setRaw('Ejecutando OCR, espera unos segundos...');
      const text = await doOCR(processedDataUrl);
      setRaw(text);
      const parsed = parseFieldsFromText(text);
      fillForm(parsed.parsed);
    } catch (err) {
      console.error(err);
      alert('Error en OCR: ' + err.message);
      setRaw('');
    }
  }
// lectura de imágenes del clipboard (solo navegadores que soporten ClipboardItem con tipos de imagen)
async function readImageFromClipboard() {
  try {
    const items = await navigator.clipboard.read(); // requiere permisos y contexto seguro
    for (const item of items) {
      for (const type of item.types) {
        if (type.startsWith('image/')) {
          const blob = await item.getType(type);
          handleImageFile(blob);
          return;
        }
      }
    }
    alert('No se encontró imagen en el portapapeles');
  } catch (e) {
    console.error(e);
    alert('Clipboard API no soportada o permiso denegado');
  }
}
document.getElementById("btnLeerClipboard").addEventListener("click", readImageFromClipboard);

  // al cargar, poner foco en la zona de pegado para facilitar Ctrl+V
  pasteZone.focus();

  </script>
</body>
</html>
