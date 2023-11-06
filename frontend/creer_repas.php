<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
    <title>tabletest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="icon" type="image/x-icon" href="assets/faviconV2.png" />




</head>

<body>
    <?php require_once('template_menu.php'); ?>
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('creer_repas'); ?>
    </header>

    <h1 class="my-custom-h1">Créer un Repas</h1>
    <h2 id="custom-description">Cette page vous permet simplement d'ajouter dans la table repas une ligne</h2>

    <form id="addStudentForm">
        <div class="form-group row">
            <div class="form-group row">
                <label for="nomInput" class="col-sm-2 col-form-label">Nom du repas</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="nomInput">
                </div>
            </div>

            <label for="date_heure">Date et Heure du Repas :</label>
            <input type="datetime-local" id="date_heureInput" name="date_heure" required> <br><br>



            <input type="submit" id="submitButton" value="Enregistrer le Repas">
            <script>
                // il n'y a pas de fichier JS à part pour frontçcreer_repas
                // Action lorsque le bouton submit est cliqué
                $('#submitButton').on('click', function(e) {
                    e.preventDefault();

                    // Récupérer les valeurs des champs du formulaire
                    var ID_USER = 1; // remplacer par la méchanique de session
                    var nom = $('#nomInput').val();
                    var date = $('#date_heureInput').val();


                    // Créer un nouvel objet avec les données du formulaire
                    var newData = {
                        "ID_USER": ID_USER,
                        "NOM_REPAS": nom,
                        "DATE": date
                    };

                    // Envoyer les données à votre API (remplacez avec votre méthode d'envoi de données)
                    $.ajax({
                        url: apiUrl, // Spécifiez l'URL de votre API pour ajouter des données
                        type: 'POST', // Méthode HTTP à utiliser (peut varier selon votre API)
                        data: JSON.stringify(newData), // Les données que vous voulez envoyer à l'API
                        dataType: 'json',
                        success: function(response) {
                            // Affichez la boîte de dialogue modale de confirmation
                            $('#confirmationModal').modal('show');

                            // Réinitialisez les champs du formulaire
                            $('#nomInput').val('');
                            $('#date_heureInput').val('');
                        },
                        error: function(error) {
                            // Gérez les erreurs si l'ajout échoue
                            console.error('Erreur lors de l\'ajout de la nouvelle ligne : ', error);
                        }
                    });
                });
            </script>
    </form>
    <script>
        let apiUrl = "<?php require_once 'config.php'; // j'utilise en chemin relatif vers config dont le but est de ne plus utiliser de lien en dur pour l'API...
                        echo _API_URL_REPAS; ?> "; // utilisation de la variable définie dans config
    </script>
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Votre repas a été ajouté avec succès !
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>