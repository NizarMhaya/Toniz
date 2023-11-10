<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>


</head>

<body>
    <?php require_once('template_menu.php'); ?>
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('repas'); ?>
    </header>

    <main>
    <h1 class="my-custom-h1">Créez votre repas</h1>
    <h2 id="custom-description">Entrez le nom et la date du repas et ajoutez autant d'aliments que vous le souhaitez en précisant leur quantités.</h2>

    <form id="formulaire-repas">
        <label for="nom-repas">Nom du repas :</label>
        <input type="text" id="nom-repas" name="nom-repas" required><br><br>

        <label for="date-repas">Date du repas :</label>
        <input type="datetime-local" id="date-repas" name="date-repas" required><br><br>

        <div id="aliments-container">
            <!-- Les champs d'ajout d'aliments seront ajoutés ici dynamiquement -->
        </div>

        <button type="button" id="ajouter-aliment">Ajouter un aliment</button><br><br>

        <button type="submit" id="enregistrer-repas-button">Enregistrer le repas</button>
    </form>


    <script>
        const alimentsContainer = document.getElementById("aliments-container");
        const ajouterAlimentButton = document.getElementById("ajouter-aliment");
        let alimentIndex = 1;

        ajouterAlimentButton.addEventListener("click", function() {
            const nouvelAlimentDiv = document.createElement("div");
            nouvelAlimentDiv.innerHTML = `
            <label for="aliment-${alimentIndex}">Aliment (code barres) :</label>
            <input type="number" class="aliment-input" id="aliment-${alimentIndex}" name="aliment-${alimentIndex}" required><br><br>

            <label for="quantite-${alimentIndex}">Quantité (g) :</label>
            <input type="number" class="quantite-input" id="quantite-${alimentIndex}" name="quantite-${alimentIndex}" required><br><br>
        `;

            alimentsContainer.appendChild(nouvelAlimentDiv);
            alimentIndex++;
        });
    </script>


    <h1 class="my-custom-h1">Tableau des aliments</h1>
    <h2 id="custom-description">Recopiez le code barre des aliments de votre choix</h2>
    <table id="myTable">
        <thead>
            <tr>
                <th scope="col">Copier le code-barres</th> <!-- Colonne pour le bouton Ajouter aux repas -->
                <th scope="col">CODE BARRES</th>
                <th scope="col">NOM</th>
                <th scope="col">MARQUE</th>
                <th scope="col">CATEGORIE</th>
                <th scope="col">ENERGIE_100G</th>
            </tr>
        </thead>
        <tbody id="studentsTableBody">
        </tbody>
    </table>

    </main>

    <script>
        let apiUrl = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL_INTEGRATION; ?> "; // utilisation de la variable définie dans config
    </script>
    <script src="JS/script_aliments_integration.js" defer></script>
    <script src="JS/script_repas.js" defer></script>
    <script>
        let apiUrlRepas = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                            echo _API_URL_NEW_REPAS; ?> "; // utilisation de la variable définie dans config
    </script>
    <script>
        let apiUrlNutriment = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL_NUTRIMENT; ?> "; // utilisation de la variable définie dans config
    </script>
    <script src="JS/script_nutriment.js" defer></script>
        
    
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>
</body>

</html>