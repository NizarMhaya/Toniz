<!doctype html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
<?php require_once('template_menu.php'); ?>

<header class="bg-dark py-1">
        <?php renderMenuToHTML('ajouter_favoris'); ?>
    </header>
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
                <th scope="col">Ajouter aux aliments favoris</th> <!-- Colonne pour le bouton Ajouter aux repas -->
            </tr>
        </thead>
        <tbody id="studentsTableBody">
        </tbody>
    </table>


    <script>
        let apiUrl = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL_ALIMENT_FAVORIS; ?> "; // utilisation de la variable définie dans config
    </script>
    <script src="JS/script_aliments_ajouter_favoris.js" defer></script>
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>
</body>

</html>