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
        <?php
        if (isset($_COOKIE['login'])) {
            // Utilisateur est connecté, affichez le formulaire de création de repas et la liste des aliments
            echo '<h1 class="my-custom-h1">Créez votre repas</h1>
                  <h2 id="custom-description">Entrez le nom et la date du repas et ajoutez autant d\'aliments que vous le souhaitez en précisant leur quantités.</h2>

                  <form id="formulaire-repas">
                      <label for="nom-repas">Nom du repas :</label><br></br>
                      <input type="text" id="nom-repas" name="nom-repas" required><br><br>

                      <label for="date-repas">Date du repas :</label><br></br>
                      <input type="datetime-local" id="date-repas" name="date-repas" required><br><br>

                      <div id="aliments-container">
                          <!-- Les champs d\'ajout d\'aliments seront ajoutés ici dynamiquement -->
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
            <label for="aliment-${alimentIndex}">Aliment (code barres) :</label><br></br>
            <input type="number" class="aliment-input" id="aliment-${alimentIndex}" name="aliment-${alimentIndex}" required><br><br>

            <label for="quantite-${alimentIndex}">Quantité (g) :</label><br></br>
            <input type="number" class="quantite-input" id="quantite-${alimentIndex}" name="quantite-${alimentIndex}" required><br><br>
        `;

                alimentsContainer.appendChild(nouvelAlimentDiv);
                alimentIndex++;
            });
        </script>

                  <button id="toggleButton">Afficher les aliments favoris</button>

                  <div id="secondTableContainer" class="table-container" style="display: none;">
                      <h1 class="my-custom-h1">Vos aliments favoris</h1>
                      <h2 id="custom-description">Votre sélection favorite</h2>
                      <table id="secondTable">
                          <!-- Contenu du deuxième tableau -->
                          <thead>
                              <tr>
                                  <th scope="col">Copier le code-barres</th>
                                  <th scope="col">CODE BARRES</th>
                                  <th scope="col">NOM</th>
                                  <th scope="col">MARQUE</th>
                                  <th scope="col">CATEGORIE</th>
                                  <th scope="col">ENERGIE_100G</th>
                              </tr>
                          </thead>
                      </table>
                  </div>';
        } else {
            // Utilisateur non connecté, affichez le message approprié
            echo '<h1 class="my-custom-h1">Créez votre repas</h1>';
            echo '<p>Veuillez vous connecter pour créer votre repas.</p>';
        }
        ?>

        <div class="container">
            <div id="firstTableContainer" class="table-container">
                <h1 class="my-custom-h1">Tableau des aliments</h1>
                <h2 id="custom-description">Recopiez le code barre des aliments de votre choix</h2>
                <table id="myTable">
                    <!-- Contenu du premier tableau -->
                    <thead>
                        <tr>
                            <th scope="col">Copier le code-barres</th>
                            <th scope="col">CODE BARRES</th>
                            <th scope="col">NOM</th>
                            <th scope="col">MARQUE</th>
                            <th scope="col">CATEGORIE</th>
                            <th scope="col">ENERGIE_100G</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
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
        let apiUrlFavoris = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                            echo _API_URL_FAVORIS; ?> "; // utilisation de la variable définie dans config
    </script>

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>
    </footer>
</body>

</html>
