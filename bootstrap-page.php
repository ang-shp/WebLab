<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap Page — Gene Expression</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/htmx.org@1.9.12"></script>

  <style>
    body {
      background:
        radial-gradient(1200px 600px at 20% 10%, rgba(124,92,255,0.18), transparent 55%),
        radial-gradient(900px 500px at 80% 20%, rgba(0,212,255,0.12), transparent 55%),
        radial-gradient(900px 500px at 60% 90%, rgba(255,77,109,0.08), transparent 55%),
        #0b1020;
      color: #f4f7fb;
      min-height: 100vh;
    }

    .hero-section {
      padding: 90px 0 60px;
    }

    .hero-card,
    .info-card,
    .db-card,
    .faq-card {
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.10);
      backdrop-filter: blur(10px);
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }

    .hero-card {
      padding: 40px;
    }

    .info-card,
    .db-card,
    .faq-card {
      padding: 28px;
    }

    .section-title {
      font-weight: 700;
      margin-bottom: 12px;
    }

    .muted-text {
      color: rgba(255,255,255,0.72);
    }

    .badge-soft {
      background: rgba(255,255,255,0.08);
      color: #fff;
      border: 1px solid rgba(255,255,255,0.10);
      padding: 10px 14px;
      border-radius: 999px;
      font-weight: 500;
    }

    .accordion-item {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.10);
      color: #fff;
    }

    .accordion-button {
      background: rgba(255,255,255,0.04);
      color: #fff;
      font-weight: 600;
      box-shadow: none !important;
    }

    .accordion-button:not(.collapsed) {
      background: rgba(124,92,255,0.18);
      color: #fff;
    }

    .accordion-button::after {
      filter: invert(1);
    }

    .accordion-body {
      color: rgba(255,255,255,0.82);
    }

    #genes-result table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 18px;
      color: #fff;
      overflow: hidden;
      border-radius: 16px;
    }

    #genes-result th,
    #genes-result td {
      border: 1px solid rgba(255,255,255,0.12);
      padding: 12px;
      text-align: left;
    }

    #genes-result th {
      background: rgba(124,92,255,0.18);
    }

    #genes-result tr:nth-child(even) {
      background: rgba(255,255,255,0.03);
    }

    .navbar-custom {
      background: rgba(11,16,32,0.75) !important;
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .footer-text {
      color: rgba(255,255,255,0.62);
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .hero-card,
      .info-card,
      .db-card,
      .faq-card {
        padding: 20px;
        border-radius: 20px;
      }

      .hero-section {
        padding: 70px 0 40px;
      }

      h1.display-4 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">Gene Expression</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Головна</a></li>
          <li class="nav-item"><a class="nav-link" href="essence.html">Суть</a></li>
          <li class="nav-item"><a class="nav-link" href="heatmap.html">Heatmap</a></li>
          <li class="nav-item"><a class="nav-link" href="updown.html">Up/Down</a></li>
          <li class="nav-item"><a class="nav-link" href="example.html">Приклад</a></li>
          <li class="nav-item"><a class="nav-link active" href="bootstrap-page.php">Bootstrap</a></li>
          <li class="nav-item"><a class="nav-link" href="grayscale.php">Grayscale</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <section class="hero-section">
      <div class="container">
        <div class="hero-card">
          <div class="row align-items-center g-4">
            <div class="col-lg-8">
              <h1 class="display-4 fw-bold mb-3">Bootstrap-сторінка для аналізу експресії генів</h1>
              <p class="lead muted-text mb-4">
                Ця сторінка створена на Bootstrap і адаптована під тему проєкту:
                heatmap, диференціальна експресія генів, up-regulated та down-regulated гени.
              </p>

              <div class="d-flex flex-wrap gap-2">
                <span class="badge-soft">Bootstrap 5</span>
                <span class="badge-soft">HTMX</span>
                <span class="badge-soft">MySQL</span>
                <span class="badge-soft">PHP</span>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="info-card h-100">
                <h3 class="h4 mb-3">Що реалізовано</h3>
                <ul class="mb-0">
                  <li class="mb-2">Bootstrap Navbar</li>
                  <li class="mb-2">Bootstrap Accordion</li>
                  <li class="mb-2">HTMX-запит до БД</li>
                  <li class="mb-2">Адаптивний дизайн</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="pb-5">
      <div class="container">
        <div class="row g-4">

          <div class="col-lg-6">
            <div class="faq-card h-100">
              <h2 class="section-title">FAQ на Bootstrap</h2>
              <p class="muted-text mb-4">
                Це приклад елемента, який керується Bootstrap.
              </p>

              <div class="accordion" id="geneAccordion">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Що таке up-regulated гени?
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#geneAccordion">
                    <div class="accordion-body">
                      Up-regulated гени — це гени, рівень експресії яких підвищується у досліджуваній умові порівняно з контролем.
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Що таке down-regulated гени?
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#geneAccordion">
                    <div class="accordion-body">
                      Down-regulated гени — це гени, рівень експресії яких знижується відносно контрольної групи.
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Для чого використовують heatmap?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#geneAccordion">
                    <div class="accordion-body">
                      Heatmap допомагає швидко побачити загальні патерни експресії генів у різних зразках та умовах.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="db-card h-100">
              <h2 class="section-title">HTMX-запит до бази даних</h2>
              <p class="muted-text mb-4">
                Натисни кнопку, щоб підвантажити дані з таблиці <strong>genes</strong> без перезавантаження сторінки.
              </p>

              <button
                class="btn btn-primary btn-lg"
                hx-get="load_genes_bootstrap.php"
                hx-target="#genes-result"
                hx-swap="innerHTML">
                Завантажити дані з БД
              </button>

                <div id="genes-result" class="mt-4">
                    <div class="alert alert-secondary mb-0">
                        Тут з’являться результати запиту.
                    </div>
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <footer class="py-4">
    <div class="container text-center">
      <div class="footer-text">© Навчальний проєкт — Bootstrap Page</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>