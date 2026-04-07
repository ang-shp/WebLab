'use strict';

(function initSingleGallery() {
  const root = document.getElementById('degGallerySingle');
  if (!root) return;

  const btn = root.querySelector('.gallery-single__btn');
  const imgA = root.querySelector('img.img-a');
  const imgB = root.querySelector('img.img-b');
  const captionEl = root.querySelector('#degCaption');
  const hintEl = root.querySelector('#degHint');
  const errorEl = root.querySelector('#degError');

  if (!btn || !imgA || !imgB || !captionEl || !hintEl || !errorEl) return;

  const items = [
    {
      name: 'fig1.jpg',
      src: 'assets/images/fig1.jpg',
      caption:
        'Differentially expressed gene (DEG) analysis.  A) Manhattan plot for associations between different degree ionizing radiation damages and control, the first 3 genes with the highest significance were highlighted. [4]',
    },
    {
      name: 'fig2.jpg',
      src: 'assets/images/fig2.jpg',
      caption:
        'Differentially expressed gene (DEG) analysis. B) Common DEGs in dose_0.56 Gy control, dose_2.2 Gy control, dose_4.45 Gy control, rate_1.1 Gy/min control, and rate_3.1 mGy/min control. [4]',
    },
    {
      name: 'fig3.jpg',
      src: 'assets/images/fig3.jpg',
      caption:
        'Differentially expressed gene (DEG) analysis. C) (a) Heatmap of 54 common DEGs in different dose controls. (b) Heatmap of 54 common DEGs in different rate controls. [4]',
    },
  ];

  let index = 0;
  let animating = false;

  function setText() {
    captionEl.textContent = items[index].caption;
    const next = items[(index + 1) % items.length];
    hintEl.textContent = `Поточне: ${items[index].name} (клік → ${next.name})`;
  }

  function showError(msg) {
    errorEl.hidden = false;
    errorEl.textContent = msg;
  }

  function hideError() {
    errorEl.hidden = true;
    errorEl.textContent = '';
  }

  function loadImage(imgEl, src) {
    return new Promise((resolve, reject) => {
      imgEl.onload = () => resolve(true);
      imgEl.onerror = () => reject(new Error(`Не вдалося завантажити: ${src}`));
      imgEl.src = src;
    });
  }

  // Ми будемо міняти "активне" та "резервне" зображення місцями
  let front = imgA; // те, що зараз видно
  let back = imgB;  // те, що під'їжджає під fade

  async function init() {
    hideError();
    setText();

    try {
      await loadImage(front, items[index].src);
      const nextIndex = (index + 1) % items.length;
      await loadImage(back, items[nextIndex].src);
    } catch (e) {
      showError(`⚠️ ${e.message}`);
    }
  }

  btn.addEventListener('click', async () => {
    if (animating) return;
    animating = true;
    hideError();

    const nextIndex = (index + 1) % items.length;

    try {
      // 1) Гарантуємо, що back = next і повністю завантажено перед переходом
      await loadImage(back, items[nextIndex].src);
      
      // 2) Переконуємося, що зображення повністю відрендерено перед анімацією
      await new Promise(resolve => requestAnimationFrame(() => requestAnimationFrame(resolve)));

      // 3) Запускаємо fade (CSS робить back видимим, front невидимим)
      root.classList.add('is-fading');

      window.setTimeout(async () => {
        try {
          // 4) Завершили анімацію: робимо next "поточним"
          index = nextIndex;

          // 5) Свопаємо ролі: тепер те, що було back, стає front
          const oldFront = front;
          front = back;
          back = oldFront;

          // 6) Скидаємо клас fade — тепер "front" має бути видимим як img-a
          // Але у нас в DOM класи фіксовані (img-a/img-b), тож ми міняємо їх місцями:
          // front завжди має бути img-a, back — img-b.
          front.classList.add('img-a');
          front.classList.remove('img-b');

          back.classList.add('img-b');
          back.classList.remove('img-a');

          // 7) Прибираємо fade після того, як DOM оновився
          requestAnimationFrame(() => {
            root.classList.remove('is-fading');
          });

          // 8) Тихо підвантажуємо наступне (після поточного) у back (воно невидиме)
          const afterIndex = (index + 1) % items.length;
          await loadImage(back, items[afterIndex].src);

          setText();
          animating = false;
        } catch (e2) {
          root.classList.remove('is-fading');
          setText();
          showError(`⚠️ ${e2.message}`);
          animating = false;
        }
      }, 360);
    } catch (e) {
      setText();
      showError(`⚠️ ${e.message}`);
      animating = false;
    }
  });

  init();
})();
