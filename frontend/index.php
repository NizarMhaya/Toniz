<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
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
    <main>

        <!-- Features section-->
        <section class="py-5 border-bottom" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <img src="assets/icon1.png" alt="icon1" />
                        <h2 class="h4 fw-bolder mt-3">Un objectif adapté</h2>
                        <p>Inscrivez-vous. Rentrez vos informations (âge, sexe, activités sportives...) permettant de fixer votre propre norme d'alimentation quotidienne.</p>
                        <a class="text-decoration-none" href="profil.php">
                            Voir la page Profil
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <img src="assets/icon2.png" alt="icon2" />
                        <h2 class="h4 fw-bolder mt-3">Des milliers d'aliments</h2>
                        <p>Notre base de données contient plus de 100 000 aliments. Vous pouvez retrouver les informations sur tout ce que vous mangez dans la page dédiée.</p>
                        <a class="text-decoration-none" href="aliments.php">
                            Voir la page Aliments
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <img src="assets/icon3.png" alt="icon3" />
                        <h2 class="h4 fw-bolder mt-3">Un historique de vos repas</h2>
                        <p>Recréez les repas que vous mangez chaque jour et consultez les nutriments que vous absorbez quotidiennement.</p>
                        <a class="text-decoration-none" href="journal.php">
                            Voir la page Journal
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer-->
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>
    <!-- Bootstrap core JS-->
    <!-- Core theme JS-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
</body>

</html>