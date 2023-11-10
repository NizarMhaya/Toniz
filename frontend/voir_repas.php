<!doctype html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <?php require_once('template_menu.php'); ?>
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('voir_repas'); ?>
    </header>
    <main>
    <h1 class="my-custom-h1">Vos repas</h1>

    <?php
    if (isset($_COOKIE['login'])) {
        echo '<h2 id="custom-description">Voici l\'ensemble des repas que vous avez créés.</h2>';

        // Utilisateur est connecté, affichez la liste des repas
        echo '
        <table id="myTable">
            <thead>
                <tr>
                    <th scope="col">ID_REPAS</th>
                    <th scope="col">NOM_REPAS</th>
                    <th scope="col">DATE</th>
                    <th scope="col">ALIMENTS</th>
                    <th scope="col">MARQUES</th>
                    <th scope="col">QUANTITE_TOTAL</th>
                    <th scope="col">Supprimer repas</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
            </tbody>
        </table>

        <button type="button" id="saveButton" class="btn btn-primary " style="display: none;">Enregistrer</button>
        ';
    } else {
        // Utilisateur non connecté, affichez un message
        echo "<p class='p-text'>Veuillez vous connecter pour voir vos repas.</p>";
    }
    ?>
    </main>
    <script>
        let apiUrl = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL_VOIR_REPAS; ?> "; // utilisation de la variable définie dans config
    </script>
    <script src="JS/script_voir_repas.js" defer></script>
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>
    </footer>
</body>

</html>
