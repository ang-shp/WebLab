<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Аналіз експресії генів — головна</title>
  <link rel="stylesheet" href="assets/styles.css?v=2" />

</head>
<body>
  <header class="topbar">
    <div class="container topbar__inner">
      <a class="brand" href="index.php">
        <span class="brand__dot"></span>
        <span class="brand__text">Gene Expression Heatmap</span>
      </a>

      <nav class="nav">
        <a class="active" href="index.php">Головна</a>
        <a href="essence.html">Суть</a>
        <a href="heatmap.html">Heatmap</a>
        <a href="updown.html">Up/Down</a>
        <a href="example.html">Приклад</a>
        <a href="bootstrap-page.php">Bootstrap</a>
        <a href="grayscale.php">Grayscale</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="container hero__grid">
        <div class="hero__text">
          <h1>Аналіз експресії генів і heatmap</h1>
          <p class="muted">
            Порівняння активності генів у різних умовах (контроль vs досліджувана умова),
            з поясненням up-regulated / down-regulated та прикладами застосування.
          </p>

          <div class="hero__chips">
            <span class="chip">Біоінформатика</span>
            <span class="chip">Диференціальна експресія</span>
            <span class="chip">Heatmap</span>
          </div>

          <div class="hero__cta">
            <a class="btn btn--primary" href="heatmap.html">Відкрити heatmap</a>
            <a class="btn btn--ghost" href="essence.html">Читати теорію</a>
          </div>
        </div>

        <div class="card">
          <h2 class="h3">Що є на сайті</h2>
          <ul class="list">
            <li>Суть аналізу експресії генів</li>
            <li>Heatmap експресії генів</li>
            <li>Пояснення up/down-regulated</li>
            <li>Приклад застосування: рак, стрес, лікування</li>
          </ul>
        </div>
      </div>
    </section>

    <section class="section section--alt">
      <div class="container">
        <div class="grid grid--2">
          <a class="card" href="essence.html">
            <h3>Суть явища</h3>
            <p class="muted">Що таке експресія генів і навіщо її порівнюють між умовами.</p>
          </a>

          <a class="card" href="heatmap.html">
            <h3>Heatmap</h3>
            <p class="muted">Інтерактивна теплова карта: легенда, підказки, нормалізація.</p>
          </a>

          <a class="card" href="updown.html">
            <h3>Up/Down</h3>
            <p class="muted">Як інтерпретувати up-regulated та down-regulated гени.</p>
          </a>

          <a class="card" href="example.html">
            <h3>Приклад застосування</h3>
            <p class="muted">Рак, стрес, лікування — і як heatmap використовується на практиці.</p>
          </a>
        </div>
      </div>
    </section>

    <!-- НОВИЙ БЛОК: запит до БД через HTMX -->
    <section class="section">
      <div class="container">
        <div class="section__head">
          <h2>Запит до бази даних через HTMX</h2>
          <p class="muted">
            Натисни кнопку, щоб без перезавантаження сторінки отримати дані з MySQL.
          </p>
        </div>

        <div class="card">
          <button
            class="btn btn--primary"
            hx-get="load_genes.php"
            hx-target="#genes-result"
            hx-swap="innerHTML">
            Завантажити дані з БД
          </button>

          <div id="genes-result" style="margin-top:20px;">
            <p class="muted">Тут з’являться результати запиту.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section section--alt">
      <div class="container">
        <div class="section__head">
          <h2>Форма з AJAX-відправкою</h2>
          <p class="muted">
            Приклад форми, яка надсилається без перезавантаження сторінки.
          </p>
        </div>

        <div class="card ajax-form-card">
          <form id="feedbackForm" class="ajax-form">
            <div class="ajax-form__grid">
              <div class="ajax-form__field">
                <label for="name">Ім’я</label>
                <input type="text" id="name" name="name" placeholder="Введіть ім’я" required>
              </div>

              <div class="ajax-form__field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@email.com" required>
              </div>
            </div>

            <div class="ajax-form__field">
              <label for="message">Повідомлення</label>
              <textarea id="message" name="message" rows="6" placeholder="Введіть повідомлення" required></textarea>
            </div>

            <div class="ajax-form__actions">
              <button type="submit" class="btn btn--primary ajax-form__submit">Надіслати</button>
            </div>

            <div id="formStatus" class="ajax-form__status muted small">
              Форма ще не відправлена.
            </div>
          </form>
        </div>
      </div>
    </section>
    
    <footer class="footer">
      <div class="container footer__inner">
        <span class="muted small">© Навчальний проєкт</span>
        <span class="muted small">Автори: Анжеліка Шпіть</span>
      </div>
    </footer>
  </main>

  <script src="https://unpkg.com/htmx.org"></script>
  <script src="assets/form.js"></script>


</body>
</html>