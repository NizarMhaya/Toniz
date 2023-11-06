<!DOCTYPE html>
<html lang="en">
<?php
require_once('template_settings.php');
?>

<body>

    <!-- Header-->
    <header class="bg-dark py-1">
        <?php require_once('template_menu.php'); ?>

        <?php renderMenuToHTML('index'); ?>
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Toniz'Food</h1>
                        <p class="lead text-white-50 mb-4">Manger c'est cool. Manger bien c'est mieux.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <img src="assets/icon1.png" alt="icon1" />
                    <h2 class="h4 fw-bolder mt-3">Un objectif adapté</h2>
                    <p>Inscrivez-vous. Rentrez vos informations (âge, sexe, activités sportives...) permettant de fixer votre propre norme d'alimentation quotidienne.</p>
                    <a class="text-decoration-none" href="#!">
                        Voir la page Profil
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <img src="assets/icon2.png" alt="icon2" />
                    <h2 class="h4 fw-bolder mt-3">Des milliers d'aliments</h2>
                    <p>Notre base de données contient plus de 100 000 aliments. Vous pouvez retrouver les informations sur tout ce que vous mangez dans la page dédiée.</p>
                    <a class="text-decoration-none" href="#!">
                        Voir la page Aliments
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4">
                    <img src="assets/icon3.png" alt="icon3" />
                    <h2 class="h4 fw-bolder mt-3">Un historique de vos repas</h2>
                    <p>Recréez les repas que vous mangez chaque jour et consultez les nutriments que vous absorbez quotidiennement.</p>
                    <a class="text-decoration-none" href="#!">
                        Voir la page Journal
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-5">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Toniz - Acceuil</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/faviconV2.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="CSS/styles_bootstrap.css" rel="stylesheet" />
    <link href="CSS/styles.css" rel="stylesheet" />

</head>

<body>

    <!-- Header-->
    <header class="bg-dark py-1">
        <?php require_once('template_menu.php'); ?>

        <?php renderMenuToHTML('index'); ?>
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Toniz'Food</h1>
                        <p class="lead text-white-50 mb-4">Manger c'est cool. Manger bien c'est mieux.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                    <h2 class="h4 fw-bolder">Un objectif adapté</h2>
                    <p>Inscrivez-vous. Rentrez vos informations (âge, sexe, activités sportives...) permettant de fixer votre propre norme d'alimentation quotidienne.</p>
                    <a class="text-decoration-none" href="#!">
                        Voir la page Profil
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                    <h2 class="h4 fw-bolder">Des milliers d'aliments</h2>
                    <p>Notre base de données contient plus de 100 000 aliments. Vous pouvez retrouver les informations sur tout ce que vous mangez dans la page dédiée.</p>
                    <a class="text-decoration-none" href="#!">
                        Voir la page Aliments
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                    <h2 class="h4 fw-bolder">Un historique de vos repas</h2>
                    <p>Recréez les repas que vous mangez chaque jour et consultez les nutriments que vous absorbez quotidiennement.</p>
                    <a class="text-decoration-none" href="#!">
                        Voir la page Journal
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-5">
            <p class="m-0 text-center text-white">Copyright &copy; Toniz 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>