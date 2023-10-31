$(document).ready(function () {
    var table = $('#myTable').DataTable({
        ajax: {
            url: apiUrl,
            dataSrc: ''
        },
        columns: [
            { "data": "ID_USER" },
            { "data": "NOM" },
            { "data": "AGE" },
            { "data": "SEXE" },
            { "data": "SPORT" },
            { "data": "KCAL_JOUR" },
            { "data": null, "defaultContent": '<button class="btn btn-info btn-sm editBtn" id="edit">Edit</button>' },
            { "data": null, "defaultContent": '<button class="btn btn-danger btn-sm deleteBtn" id="delete">Delete</button>' }
        ]
    });

    // Action lorsque le bouton submit est cliqué
    $('#submitButton').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs des champs du formulaire
        var id = $('#idInput').val();
        var nom = $('#nomInput').val();
        var age = $('#ageInput').val();
        var sexe = $('#sexeInput').val();
        var sport = $('#sportInput').val();
        var kcal = $('#kcalInput').val();

        // Créer un nouvel objet avec les données du formulaire
        var newData = {
            "ID_USER": id,
            "NOM": nom,
            "AGE": age,
            "SEXE": sexe,
            "SPORT": sport,
            "KCAL_JOUR": kcal
        };

        // Envoyer les données à votre API (remplacez avec votre méthode d'envoi de données)
        $.ajax({
            url: apiUrl, // Spécifiez l'URL de votre API pour ajouter des données
            type: 'POST', // Méthode HTTP à utiliser (peut varier selon votre API)
            data: JSON.stringify(newData), // Les données que vous voulez envoyer à l'API
            dataType: 'json',
            success: function (response) {
                // Si l'ajout est réussi, ajoutez la nouvelle ligne à votre DataTable et redessinez-le
                table.row.add(newData).draw();

                // Réinitialisez les champs du formulaire
                $('#idInput').val('');
                $('#nomInput').val('');
                $('#ageInput').val('');
                $('#sexeInput').val('');
                $('#sportInput').val('');
                $('#kcalInput').val('');
            },
            error: function (error) {
                // Gérez les erreurs si l'ajout échoue
                console.error('Erreur lors de l\'ajout de la nouvelle ligne : ', error);
            }
        });
    });


    $('#myTable').on('click', '#delete', function () {
        var row = $(this).closest('tr'); // Obtenez l'élément DOM de la ligne à supprimer
        var data = table.row(row).data(); // Obtenez les données de la ligne

        $.ajax({
            url: apiUrl + '?id=' + data.ID_USER,
            type: 'DELETE',
            dataType: 'json',
            success: function () {
                console.log("Utilisateur supprimé avec succès :", data);

                // Supprimez la ligne du DataTable en utilisant l'élément DOM de la ligne
                table.row(row).remove().draw();
            },
            error: function (error) {
                console.error('Erreur lors de la suppression de la ligne : ', error);
            }
        });
    });


    $('#myTable').on('click', '#edit', function () {
        var row = $(this).closest('tr'); // Obtenez l'élément DOM de la ligne à éditer
        var data = table.row(row).data(); // Obtenez les données de la ligne

        // Remplissez votre formulaire de modification avec les données récupérées
        $('#idInput').val(data.ID_USER);
        $('#nomInput').val(data.NOM);
        $('#ageInput').val(data.age);
        $('#sexeInput').val(data.sexe);
        $('#sportInput').val(data.sport);
        $('#kcalInput').val(data.kcal_100G);

        // Affichez le bouton "Enregistrer" et masquez le bouton "Soumettre"
        $('#saveButton').show();
        $('#submitButton').hide();

        // Attachez un gestionnaire d'événements au bouton "Enregistrer" pour appliquer les modifications
        $('#saveButton').off('click').on('click', function () {
            var newid = $('#idInput').val();
            var newNom = $('#nomInput').val();
            var newage = $('#ageInput').val();
            var newsexe = $('#sexeInput').val();
            var newsport = $('#sportInput').val();
            var newkcal = $('#kcalInput').val();

            var formData = {
                "ID_USER": newid,
                "NOM": newNom,
                "age": newage,
                "sexe": newsexe,
                "sport": newsport,
                "kcal_100G": newkcal
            }

            // Envoyez une requête PUT à votre API pour appliquer les modifications
            $.ajax({
                type: "PUT",
                url: apiUrl,
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function (data) {
                    console.log("Utilisateur mis à jour avec succès :", data);

                    // Mettez à jour les données de la ligne dans le DataTable
                    table.row(row).data(formData).draw();

                    // Réinitialisez les champs du formulaire de modification et masquez le bouton "Enregistrer"
                    $('#idInput').val('');
                    $('#nomInput').val('');
                    $('#ageInput').val('');
                    $('#sexeInput').val('');
                    $('#sportInput').val('');
                    $('#kcalInput').val('');
                    $('#saveButton').hide();
                    $('#submitButton').show();
                },
                error: function (error) {
                    // Gérez les erreurs si la modification échoue
                    console.error('Erreur lors de la modification de la ligne : ', error);
                }
            });
        });
    });










});

