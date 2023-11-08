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
    <button id="createAlimentButton" class="btn btn-success">Créer un nouvel aliment</button>
    <form id="addAlimentForm">
        <div class="form-group row">
            <label for="codeBarresInput" class="col-sm-2 col-form-label">CODE BARRES*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="codeBarresInput">
            </div>
        </div>
        <div class="form-group row">
            <label for "nomInput" class="col-sm-2 col-form-label">NOM*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="nomInput">
            </div>
        </div>
        <!-- Ajoutez ici les champs pour MARQUE, CATEGORIE, ENERGIE_100G, MATIERES_GRASSES, GRAISSES_SATUREES, GLUCIDES, SUCRES, FIBRES, PROTEINES, SEL, SODIUM, et CALCIUM -->
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
            <label for="matieresGrassesInput" class="col-sm-2 col-form-label">MATIERES_GRASSES*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="matieresGrassesInput">
            </div>
        </div>
        <!-- Ajoutez ici les champs pour GRAISSES_SATUREES, GLUCIDES, SUCRES, FIBRES, PROTEINES, SEL, SODIUM et CALCIUM -->
        <div class="form-group row">
            <label for="graissesSatureesInput" class="col-sm-2 col-form-label">GRAISSES_SATUREES*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="graissesSatureesInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="glucidesInput" class="col-sm-2 col-form-label">GLUCIDES*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="glucidesInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="sucresInput" class="col-sm-2 col-form-label">SUCRES*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="sucresInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="fibresInput" class="col-sm-2 col-form-label">FIBRES*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="fibresInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="proteinesInput" class="col-sm-2 col-form-label">PROTEINES*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="proteinesInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="selInput" class="col-sm-2 col-form-label">SEL*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="selInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="sodiumInput" class="col-sm-2 col-form-label">SODIUM*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="sodiumInput">
            </div>
        </div>
        <div class="form-group row">
            <label for="calciumInput" class="col-sm-2 col-form-label">CALCIUM*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="calciumInput">
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
    <table id="myTable">
        <thead>
            <tr>
                <th scope="col">CODE BARRES</th>
                <th scope="col">NOM</th>
                <th scope="col">MARQUE</th>
                <th scope="col">CATEGORIE</th>
                <th scope="col">ENERGIE_100G</th>
                <th scope="col">MATIERES_GRASSES</th>
                <th scope="col">GRAISSES_SATUREES</th>
                <th scope="col">GLUCIDES</th>
                <th scope="col">SUCRES</th>
                <th scope="col">FIBRES</th>
                <th scope="col">PROTEINES</th>
                <th scope="col">SEL</th>
                <th scope="col">SODIUM</th>
                <th scope="col">CALCIUM</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody id="studentsTableBody"></tbody>
    </table>
    
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>
    </footer>
    <script>
        let apiUrl = "<?php require_once 'config.php'; 
        echo _API_URL; ?>";
    </script>
    <script src="JS/script_aliments.js" defer></script>
</body>
</html>
