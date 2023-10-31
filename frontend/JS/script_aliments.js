$(document).ready(function () {
    var table = $('#myTable').DataTable({
        ajax: {
            url: apiUrl,
            dataSrc: ''
        },
        columns: [
            { "data": "CODE_BARRES" },
            { "data": "NOM" },
            { "data": "MARQUE" },
            { "data": "CATEGORIE" },
            { "data": "ENERGIE_100G" },
            { "data": null, "defaultContent": '<button class="btn btn-info btn-sm editBtn" id="edit">Edit</button>' },
            { "data": null, "defaultContent": '<button class="btn btn-danger btn-sm deleteBtn" id="delete">Delete</button>' }
        ]
    });

    // Action lorsque le bouton submit est cliqué
    $('#submitButton').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs des champs du formulaire
        var codeBarres = $('#codeBarresInput').val();
        var nom = $('#nomInput').val();
        var marque = $('#marqueInput').val();
        var categorie = $('#categorieInput').val();
        var energie = $('#energieInput').val();

        // Créer un nouvel objet avec les données du formulaire
        var newData = {
            "CODE_BARRES": codeBarres,
            "NOM": nom,
            "MARQUE": marque,
            "CATEGORIE": categorie,
            "ENERGIE_100G": energie
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
                $('#codeBarresInput').val('');
                $('#nomInput').val('');
                $('#marqueInput').val('');
                $('#categorieInput').val('');
                $('#energieInput').val('');
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
            url: apiUrl + '?id=' + data.CODE_BARRES,
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
        $('#codeBarresInput').val(data.CODE_BARRES);
        $('#nomInput').val(data.NOM);
        $('#marqueInput').val(data.MARQUE);
        $('#categorieInput').val(data.CATEGORIE);
        $('#energieInput').val(data.ENERGIE_100G);

        // Affichez le bouton "Enregistrer" et masquez le bouton "Soumettre"
        $('#saveButton').show();
        $('#submitButton').hide();

        // Attachez un gestionnaire d'événements au bouton "Enregistrer" pour appliquer les modifications
        $('#saveButton').off('click').on('click', function () {
            var newCodeBarres = $('#codeBarresInput').val();
            var newNom = $('#nomInput').val();
            var newMarque = $('#marqueInput').val();
            var newCategorie = $('#categorieInput').val();
            var newEnergie = $('#energieInput').val();

            var formData = {
                "CODE_BARRES": newCodeBarres,
                "NOM": newNom,
                "MARQUE": newMarque,
                "CATEGORIE": newCategorie,
                "ENERGIE_100G": newEnergie
            }

            // Envoyez une requête PUT à votre API pour appliquer les modifications
            $.ajax({
                type: "PUT",
                url: apiUrl,
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function (data) {
                    console.log("Produit mis à jour avec succès :", data);

                    // Mettez à jour les données de la ligne dans le DataTable
                    table.row(row).data(formData).draw();

                    // Réinitialisez les champs du formulaire de modification et masquez le bouton "Enregistrer"
                    $('#codeBarresInput').val('');
                    $('#nomInput').val('');
                    $('#marqueInput').val('');
                    $('#categorieInput').val('');
                    $('#energieInput').val('');
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

