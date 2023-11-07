<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <form id="formulaire-repas">
        <label for="nom-repas">Nom du repas :</label>
        <input type="text" id="nom-repas" name="nom-repas" required><br><br>

        <label for="date-repas">Date du repas :</label>
        <input type="datetime-local" id="date-repas" name="date-repas" required><br><br>

        <div id="aliments-container">
            <!-- Les champs d'ajout d'aliments seront ajoutés ici dynamiquement -->
        </div>

        <button type="button" id="ajouter-aliment">Ajouter un aliment</button><br><br>

        <button type="submit">Enregistrer le repas</button>
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


    <body>
        <h1 class="my-custom-h1">Tableau des aliments</h1>
        <h2 id="custom-description">Recopiez le code barre des aliments de votre choix</h2>
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
        <script src="JS/script_repas.js" defer></script>
        <script>
            let apiUrlRepas = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                                echo _API_URL_NEW_REPAS; ?> "; // utilisation de la variable définie dans config
        </script>


    </body>

</html>