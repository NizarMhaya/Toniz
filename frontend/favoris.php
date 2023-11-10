<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <?php require_once('template_menu.php'); ?>

    <header class="bg-dark py-1">
        <?php renderMenuToHTML('favoris'); ?>
    </header>

    <main>
        <?php
        if (isset($_COOKIE['login'])) {
            // Utilisateur est connecté, affichez le contenu de la page
        ?>
        <h1 class="my-custom-h1">Vos favoris</h1>
        <h2 id="custom-description">Voici l'ensemble des aliments que vous avez mis en favoris</h2>
        <table id="myTable">
            <thead>
                <tr>
                    <th scope="col">CODE BARRES</th>
                    <th scope="col">NOM</th>
                    <th scope="col">MARQUE</th>
                    <th scope="col">CATEGORIE</th>
                    <th scope="col">ENERGIE_100G</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
            </tbody>
        </table>

        <button type="button" id="saveButton" class="btn btn-primary " style="display: none;">Enregistrer</button>
        <?php
        } else {
            // Utilisateur non connecté, affichez le message approprié
        ?>
        <h1 class="my-custom-h1">Aliments favoris</h1>
        <p class="p-text">Veuillez vous connecter pour accéder à vos aliments favoris.</p>
        <?php
        }
        ?>
    </main>

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>
    </footer>

    <script>
        let apiUrl = "<?php require_once 'config.php';
                        echo _API_URL_FAVORIS; ?>";
    </script>
    <script src="JS/script_favoris.js" defer></script>

</body>

</html>
