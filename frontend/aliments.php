<!doctype html>
<html lang="fr">

<?php
require_once('template_settings.php');
?>




<body>
    <h1 class="my-custom-h1">Gestionnaire de la base de données des aliments</h1>
    <h2 id="custom-description">Cette page vous permet de visualiser l'ensemble des aliments disponibles dans notre base de données de la table aliment avec toutes les actions CRUD associées</h2>
    <?php require_once('template_menu.php'); ?>
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('aliments'); ?>
    </header>

    <table id="myTable">
        <thead>
            <tr>
                <th scope="col">CODE BARRES</th>
                <th scope="col">NOM</th>
                <th scope="col">MARQUE</th>
                <th scope="col">CATEGORIE</th>
                <th scope="col">ENERGIE_100G</th>
                <th scope="col">Edit</th> <!-- Colonne pour le bouton Edit -->
                <th scope="col">Delete</th> <!-- Colonne pour le bouton Delete -->
            </tr>
        </thead>
        <tbody id="studentsTableBody">
        </tbody>
    </table>
    <form id="addStudentForm">
        <div class="form-group row">
            <div class="form-group row">
                <label for="codeBarresInput" class="col-sm-2 col-form-label">CODE BARRES*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="codeBarresInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="nomInput" class="col-sm-2 col-form-label">NOM*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="nomInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="idInput" class="col-sm-2 col-form-label">MARQUE*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="marqueInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="nameInput" class="col-sm-2 col-form-label">CATEGORIE*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="categorieInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="nameInput" class="col-sm-2 col-form-label">ENERGIE_100G*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="energieInput">
                </div>
            </div>
            <div class="form-group row">
                <span class="col-sm-2"></span>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary form-control" id="submitButton" style="display: block;">Submit</button>
                    <!--type="submit" : Lorsque ce bouton est cliqué à l'intérieur d'un formulaire, le formulaire est soumis au serveur pour traitement. Cela signifie que les données du formulaire sont envoyées au serveur pour être traitées par un script ou un programme. -->
                    <!--type="button" : Cela signifie que le bouton est un bouton ordinaire. Il n'a pas de comportement par défaut lorsqu'il est cliqué. Vous pouvez définir un comportement personnalisé en utilisant JavaScript-->
                </div>
            </div>
    </form>
    <button type="button" id="saveButton" class="btn btn-primary " style="display: none;">Enregistrer</button>

    <script>
        let apiUrl = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL_ALIMENT; ?> "; // utilisation de la variable définie dans config
    </script>
    <script src="JS/script_aliments.js" defer></script>

</body>

</html>
<!DOCTYPE html>
<html>

<?php
require_once('template_settings.php');
?>

<body>
    <?php require_once('template_menu.php');
    renderMenuToHTML('aliments'); ?>

    <main>
        <!-- Contenu de la page "profil.php" -->
        <h1>Aliments</h1>
        <p>Ceci est la page listant les aliments</p>



    </main>

    <!-- Autres sections ou contenu ici -->

    <footer>
        <!-- Pied de page -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>