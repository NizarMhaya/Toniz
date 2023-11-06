<!doctype html>
<html>
<head>
    <?php require_once('template_settings.php'); ?>
</head>


<body>
<?php require_once('template_menu.php'); ?>
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('favoris'); ?>
    </header>
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
                <th scope="col">Delete</th> <!-- Colonne pour le bouton Delete -->
            </tr>
        </thead>
        <tbody id="studentsTableBody">
        </tbody>
    </table>

    <button type="button" id="saveButton" class="btn btn-primary " style="display: none;">Enregistrer</button>

    <script>
        let apiUrl = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL_FAVORIS; ?> "; // utilisation de la variable définie dans config
    </script>
    <script src="JS/script_favoris.js" defer></script>

</body>

</html>