<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
    <title>tabletest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <style>
        body {
            margin-top: 5em;
        }

        .table {
            margin-top: 100px;
            margin-bottom: 100px;
        }
    </style>
</head>

<body>
    <table id="myTable">
        <thead>
            <tr>
                <th scope="col">ID_USER</th>
                <th scope="col">NOM</th>
                <th scope="col">AGE</th>
                <th scope="col">SEXE</th>
                <th scope="col">SPORT</th>
                <th scope="col">KCAL_JOUR</th>
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
                <label for="idInput" class="col-sm-2 col-form-label">ID_USER*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="idInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="nomInput" class="col-sm-2 col-form-label">NOM*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="nomInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="ageInput" class="col-sm-2 col-form-label">AGE*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="ageInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="sexeInput" class="col-sm-2 col-form-label">SEXE*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="sexeInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="sportInput" class="col-sm-2 col-form-label">SPORT*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="sportInput">
                </div>
            </div>
            <div class="form-group row">
                <label for="kcalInput" class="col-sm-2 col-form-label">KCAL_JOUR*</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="kcalInput">
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
                        echo _API_URL_UTILISATEURS; ?> "; // utilisation de la variable définie dans config
    </script>
    <script src="JS/script_utilisateurs.js" defer></script>

</body>

</html>