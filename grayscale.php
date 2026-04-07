<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Аналіз експресії генів, heatmap, HTMX та MySQL" />
    <meta name="author" content="" />
    <title>Gene Expression — Grayscale Adaptation</title>

    <link rel="icon" type="image/x-icon" href="grayscale/assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet" />
    <link href="grayscale/css/styles.css?v=2" rel="stylesheet" />
    <script src="https://unpkg.com/htmx.org@1.9.12"></script>

    <style>
        .db-result-wrap {
            margin-top: 2rem;
        }

        .db-result-wrap .table-responsive {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
        }

        .db-result-wrap .table {
            margin-bottom: 0;
        }

        .db-result-wrap .table thead th {
            background-color: #111;
            color: #fff;
            border-color: rgba(255,255,255,.08);
        }

        .db-result-wrap .table td,
        .db-result-wrap .table th {
            vertical-align: middle;
        }

        .custom-note {
            color: rgba(255,255,255,.75);
            max-width: 760px;
            margin: 0 auto 1.5rem auto;
        }

        .section-dark-card {
            background: rgba(0,0,0,.35);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 1rem;
            padding: 2rem;
        }
    </style>
</head>
<body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">Gene Expression</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Меню
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#about">Про тему</a></li>
                <li class="nav-item"><a class="nav-link" href="#projects">Приклади</a></li>
                <li class="nav-item"><a class="nav-link" href="#database">База даних</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php">На головну</a></li>
                <li class="nav-item"><a class="nav-link" href="bootstrap-page.php">Bootstrap</a></li>
                <li class="nav-item"><a class="nav-link active" href="grayscale.php">Grayscale</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Gene Expression</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">
                        Адаптована Bootstrap-сторінка про аналіз експресії генів, heatmap,
                        HTMX та інтеграцію з MySQL.
                    </h2>
                    <a class="btn btn-primary" href="#about">Почати</a>
                </div>
            </div>
        </div>
    </header>

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Аналіз експресії генів і heatmap</h2>
                    <p class="text-white-50">
                        Аналіз експресії генів дозволяє порівнювати активність генів у різних умовах,
                        визначати up-regulated та down-regulated гени і візуалізувати зміни за допомогою heatmap.
                        Це допомагає знаходити біомаркери та оцінювати молекулярні механізми реакції клітин.
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="grayscale/assets/img/fig1.jpg" alt="Gene expression visual" />
        </div>
    </section>

    <section class="projects-section bg-light" id="projects">
        <div class="container px-4 px-lg-5">

            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-8 col-lg-7">
                    <img class="img-fluid mb-3 mb-lg-0" src="grayscale/assets/img/fig1.jpg" alt="Heatmap context" />
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>Heatmap як інструмент аналізу</h4>
                        <p class="text-black-50 mb-0">
                            Heatmap дозволяє швидко побачити патерни експресії у матриці
                            «гени × зразки», де колір показує рівень змін експресії.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6">
                    <img class="img-fluid" src="grayscale/assets/img/fig2.jpg" alt="Up regulated genes" />
                </div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">Up-regulated гени</h4>
                                <p class="mb-0 text-white-50">
                                    Це гени, рівень експресії яких зростає у досліджуваній умові
                                    порівняно з контролем.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6">
                    <img class="img-fluid" src="grayscale/assets/img/fig3.jpg" alt="Down regulated genes" />
                </div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">Down-regulated гени</h4>
                                <p class="mb-0 text-white-50">
                                    Це гени, рівень експресії яких знижується у відповідь
                                    на зміну умов або вплив певного фактора.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="signup-section" id="database">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-10 mx-auto text-center">
                    <i class="fas fa-database fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-4">Запит до бази даних через HTMX</h2>
                    <p class="custom-note">
                        Натисни кнопку нижче, щоб без перезавантаження сторінки підвантажити
                        дані з таблиці <strong>genes</strong> з MySQL.
                    </p>

                    <div class="section-dark-card">
                        <button
                            class="btn btn-primary"
                            hx-get="load_genes_bootstrap.php"
                            hx-target="#genes-result-grayscale"
                            hx-swap="innerHTML">
                            Завантажити дані з БД
                        </button>

                        <div id="genes-result-grayscale" class="db-result-wrap">
                            <div class="alert alert-light mb-0">
                                Тут з’являться результати запиту.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">

                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-microscope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Тема</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">Аналіз експресії генів</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-area text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Інструмент</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">Heatmap і DEG analysis</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-server text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Технології</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">PHP, HTMX, MySQL, Bootstrap</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="index.php"><i class="fas fa-house"></i></a>
                <a class="mx-2" href="bootstrap-page.php"><i class="fas fa-layer-group"></i></a>
                <a class="mx-2" href="example.html"><i class="fas fa-image"></i></a>
            </div>
        </div>
    </section>

    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">
            Навчальний проєкт — адаптація шаблону Grayscale під тему аналізу експресії генів
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="grayscale/js/scripts.js"></script>
</body>
</html>