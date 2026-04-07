'use strict';

const canvas = document.getElementById('heatmapCanvas');
const ctx = canvas.getContext('2d');

const tooltip = document.getElementById('tooltip');
const normalizeToggle = document.getElementById('normalizeToggle');

/**
 * Демо-дані: рядки = гени, стовпці = зразки
 * Значення умовні (можна замінити на свої).
 */
const samples = ['Control_1', 'Control_2', 'Treat_1', 'Treat_2', 'Treat_3'];
const genes = ['CDKN1A', 'MDM2', 'BAX', 'PHLDA3', 'ESR1', 'ATM', 'MYC', 'GADD45A', 'FAS', 'BBC3'];

// Матриця (genes x samples)
const rawData = [
  [ 2.4,  2.1,  5.2,  5.0,  4.6],
  [ 1.8,  1.6,  3.4,  3.7,  3.1],
  [ 0.9,  1.1,  2.8,  2.6,  2.9],
  [ 1.2,  1.0,  3.2,  3.0,  3.6],
  [ 2.2,  2.0,  1.3,  1.1,  1.4],
  [ 2.6,  2.5,  3.1,  3.2,  3.0],
  [ 3.0,  2.8,  4.2,  4.4,  4.0],
  [ 1.1,  1.2,  2.4,  2.6,  2.5],
  [ 1.0,  0.8,  2.1,  2.0,  2.2],
  [ 0.7,  0.9,  2.0,  2.3,  2.1],
];

function mean(arr) {
  return arr.reduce((a, b) => a + b, 0) / arr.length;
}

function std(arr) {
  const m = mean(arr);
  const v = arr.reduce((acc, x) => acc + (x - m) ** 2, 0) / arr.length;
  return Math.sqrt(v);
}

/**
 * z-score нормалізація по рядках (по кожному гену)
 */
function normalizeRows(matrix) {
  return matrix.map((row) => {
    const m = mean(row);
    const s = std(row) || 1;
    return row.map((x) => (x - m) / s);
  });
}

/**
 * Diverging color scale (blue -> white -> red)
 * value expected roughly in [-maxAbs, +maxAbs]
 */
function divergingColor(value, maxAbs) {
  const v = Math.max(-maxAbs, Math.min(maxAbs, value));
  const t = (v + maxAbs) / (2 * maxAbs); // 0..1

  // 0..0.5 -> blue to white, 0.5..1 -> white to red
  const lerp = (a, b, k) => Math.round(a + (b - a) * k);

  const blue = { r: 45, g: 108, b: 223 };
  const white = { r: 242, g: 242, b: 242 };
  const red = { r: 255, g: 59, b: 106 };

  if (t <= 0.5) {
    const k = t / 0.5;
    const r = lerp(blue.r, white.r, k);
    const g = lerp(blue.g, white.g, k);
    const b = lerp(blue.b, white.b, k);
    return `rgb(${r},${g},${b})`;
  }

  const k = (t - 0.5) / 0.5;
  const r = lerp(white.r, red.r, k);
  const g = lerp(white.g, red.g, k);
  const b = lerp(white.b, red.b, k);
  return `rgb(${r},${g},${b})`;
}

function getMatrix() {
  return normalizeToggle.checked ? normalizeRows(rawData) : rawData;
}

function getMaxAbs(matrix) {
  let maxAbs = 0;
  for (const row of matrix) {
    for (const x of row) {
      maxAbs = Math.max(maxAbs, Math.abs(x));
    }
  }
  // щоб кольори не “перегоріли” на дуже малих значеннях
  return maxAbs || 1;
}

/**
 * Layout
 */
function layout() {
  const paddingLeft = 140;
  const paddingTop = 42;
  const paddingRight = 18;
  const paddingBottom = 26;

  const w = canvas.width;
  const h = canvas.height;

  const gridW = w - paddingLeft - paddingRight;
  const gridH = h - paddingTop - paddingBottom;

  const cellW = gridW / samples.length;
  const cellH = gridH / genes.length;

  return { paddingLeft, paddingTop, paddingRight, paddingBottom, gridW, gridH, cellW, cellH };
}

function clear() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function drawText(text, x, y, opts = {}) {
  const {
    size = 12,
    color = 'rgba(255,255,255,0.86)',
    align = 'left',
    baseline = 'middle',
    weight = 500,
  } = opts;

  ctx.save();
  ctx.font = `${weight} ${size}px ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial`;
  ctx.fillStyle = color;
  ctx.textAlign = align;
  ctx.textBaseline = baseline;
  ctx.fillText(text, x, y);
  ctx.restore();
}

function draw() {
  const matrix = getMatrix();
  const maxAbs = getMaxAbs(matrix);
  const L = layout();

  clear();

  // background panel
  ctx.save();
  ctx.fillStyle = 'rgba(0,0,0,0.12)';
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.restore();

  // Column labels (samples)
  for (let j = 0; j < samples.length; j++) {
    const x = L.paddingLeft + j * L.cellW + L.cellW / 2;
    drawText(samples[j], x, 18, { size: 12, align: 'center', baseline: 'middle', color: 'rgba(255,255,255,0.72)' });
  }

  // Row labels (genes) + cells
  for (let i = 0; i < genes.length; i++) {
    const y = L.paddingTop + i * L.cellH + L.cellH / 2;
    drawText(genes[i], L.paddingLeft - 10, y, { size: 12, align: 'right', color: 'rgba(255,255,255,0.82)' });

    for (let j = 0; j < samples.length; j++) {
      const x0 = L.paddingLeft + j * L.cellW;
      const y0 = L.paddingTop + i * L.cellH;

      const v = matrix[i][j];
      const color = divergingColor(v, maxAbs);

      ctx.save();
      ctx.fillStyle = color;
      ctx.fillRect(x0, y0, L.cellW, L.cellH);

      // grid lines
      ctx.strokeStyle = 'rgba(255,255,255,0.10)';
      ctx.strokeRect(x0, y0, L.cellW, L.cellH);
      ctx.restore();
    }
  }

  // Title hint
  const modeText = normalizeToggle.checked ? 'z-score (по кожному гену)' : 'сирі значення (умовні)';
  drawText(`Палітра: синій → білий → червоний | Режим: ${modeText}`, 12, canvas.height - 14, {
    size: 12,
    color: 'rgba(255,255,255,0.65)',
    baseline: 'middle',
  });
}

function getCellFromMouse(px, py) {
  const L = layout();
  const x = px - L.paddingLeft;
  const y = py - L.paddingTop;

  if (x < 0 || y < 0) return null;
  const j = Math.floor(x / L.cellW);
  const i = Math.floor(y / L.cellH);
  if (i < 0 || j < 0 || i >= genes.length || j >= samples.length) return null;

  return { i, j, L };
}

function showTooltip(ev, cell) {
  const matrix = getMatrix();
  const v = matrix[cell.i][cell.j];
  const gene = genes[cell.i];
  const sample = samples[cell.j];

  // Tooltip position
  const rect = canvas.getBoundingClientRect();
  const x = ev.clientX - rect.left;
  const y = ev.clientY - rect.top;

  const mode = normalizeToggle.checked ? 'z-score' : 'значення';
  const vText = Number.isFinite(v) ? v.toFixed(3) : String(v);

  tooltip.innerHTML = `
    <div style="font-weight:700;margin-bottom:6px">${gene}</div>
    <div style="color:rgba(255,255,255,0.74);margin-bottom:6px">${sample}</div>
    <div><span style="color:rgba(255,255,255,0.65)">${mode}:</span> <strong>${vText}</strong></div>
  `;

  tooltip.style.left = `${Math.min(x + 14, rect.width - 260)}px`;
  tooltip.style.top = `${Math.max(y - 10, 8)}px`;
  tooltip.style.opacity = '1';
  tooltip.style.transform = 'translateY(0px)';
}

function hideTooltip() {
  tooltip.style.opacity = '0';
  tooltip.style.transform = 'translateY(-6px)';
}

canvas.addEventListener('mousemove', (ev) => {
  const rect = canvas.getBoundingClientRect();
  const px = (ev.clientX - rect.left) * (canvas.width / rect.width);
  const py = (ev.clientY - rect.top) * (canvas.height / rect.height);

  const cell = getCellFromMouse(px, py);
  if (!cell) {
    hideTooltip();
    return;
  }

  showTooltip(ev, cell);
});

canvas.addEventListener('mouseleave', () => hideTooltip());
normalizeToggle.addEventListener('change', () => draw());

draw();
