<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <?php require_once('template_menu.php'); ?>

    <header class="bg-dark py-1">
        <?php renderMenuToHTML('ajouter_favoris'); ?>
    </header>

    <main>
        <?php
        if (isset($_COOKIE['login'])) {
            // Utilisateur est connecté, affichez le contenu de la page
        ?>
        <h1 class="my-custom-h1">Ajout de favoris</h1>
        <h2 id="custom-description">Cette page vous permet de visualiser l'ensemble des aliments disponibles dans notre base de données et d'en ajouter à votre liste d'aliments favoris.</h2>
        <table id="myTable">
            <thead>
                <tr>
                    <th scope="col">CODE BARRES</th>
                    <th scope="col">NOM</th>
                    <th scope="col">MARQUE</th>
                    <th scope="col">CATEGORIE</th>
                    <th scope="col">ENERGIE_100G</th>
                    <th scope="col">Ajouter aux aliments favoris</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
            </tbody>
        </table>

        <script>
            let apiUrl = "<?php require_once 'config.php';
                            echo _API_URL_ALIMENT_FAVORIS; ?>";
        </script>
        <script src="JS/script_aliments_ajouter_favoris.js" defer></script>
        <?php
        } else {
            // Utilisateur non connecté, affichez le message approprié
        ?>
        <h1 class="my-custom-h1">Ajout d'aliments favoris</h1>
        <p class="p-text">Veuillez vous connecter pour ajouter des aliments à votre liste de favoris.</p>
        <?php
        }
        ?>
    </main>

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>
    </footer>

</body>

</html>
