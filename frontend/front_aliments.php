gi<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <title>tabletest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody id="studentsTableBody">
        </tbody>
    </table>
    <form id="addStudentForm">
        <div class="form-group row">
            <label for="inputid" class="col-sm-2 col-form-label">id*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputid">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputname" class="col-sm-2 col-form-label">Name*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputname">
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
        var apiUrl = "<?php require_once '../backend/config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL; ?>"; // utilisation de la variable définie dans config
    </script>
    <script src="script.js"></script>

    <script>
        // approche de jQuery avec $(document).ready(function() {...}) est utilisée pour gérer l'événement de clic du bouton
        $(document).ready(function() {







            getAllDataFromServer();
            $("#submitButton").click(function(event) {
                // Empêche l'envoi du formulaire au serveur
                event.preventDefault();

                // Récupère la valeur des champs
                let id = $("#inputid").val();
                let name = $("#inputname").val();
                // Appelle la fonction pour envoyer les données au serveur
                sendDataToServer(name);
                // Ajoute une nouvelle ligne au tableau avec le id et le Name
                $("#studentsTableBody").append(`<tr>
        <td>${id}</td>
        <td>${name}</td>
        <td><button class="btn btn-info btn-sm editBtn">Éditer</button></td>
        <td><button class="btn btn-danger btn-sm deleteBtn">Supprimer</button></td>
    </tr>`);

                // Réinitialise le champ id et le champs Name après l'ajout
                $("#inputid").val("");
                $("#inputname").val("");
            });
        });
    </script>
</body>

</html>