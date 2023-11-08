<!DOCTYPE html>
<html>
<head>
    <?php require_once('template_settings.php'); ?>
</head>
<body>
    <?php require_once('template_menu.php'); ?>
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('aliments'); ?>
    </header>
    <h1 class="my-custom-h1">Gestionnaire de la base de données des aliments</h1>
    <h2 id="custom-description">Cette page vous permet de visualiser l'ensemble des aliments disponibles dans notre base de données de la table aliment avec toutes les actions CRUD associées</h2>
    <table id="myTable">
        <thead>
            <tr>
                <th scope="col">CODE BARRES</th>
                <th scope="col">NOM</th>
                <th scope="col">MARQUE</th>
                <th scope="col">CATEGORIE</th>
                <th scope="col">ENERGIE_100G</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody id="studentsTableBody"></tbody>
    </table>
    <form id="addStudentForm">
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
            <label for="marqueInput" class="col-sm-2 col-form-label">MARQUE*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="marqueInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="categorieInput" class="col-sm-2 col-form-label">CATEGORIE*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="categorieInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="energieInput" class="col-sm-2 col-form-label">ENERGIE_100G*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="energieInput">
            </div>
        </div>
        <div class="form-group row">
            <span class="col-sm-2"></span>
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary form-control" id="submitButton" style="display: block;">Submit</button>
            </div>
        </div>
    </form>
    <button type="button" id="saveButton" class="btn btn-primary" style="display: none;">Enregistrer</button>
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>
    <script>
        let apiUrl = "<?php require_once 'config.php'; 
        echo _API_URL; ?>";
    </script>
    <script src="JS/script_aliments.js" defer></script>
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>
</body>
</html>
