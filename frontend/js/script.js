$(document).ready(function () {
    var table = $('#myTable').DataTable({
        ajax: {
            url: apiUrl,
            dataSrc: ''
        },
        columns: [
            { "data": "id" },
            { "data": "name" },
            { "data": null, "defaultContent": '<button class="btn btn-info btn-sm editBtn" id="edit">Edit</button>' },
            { "data": null, "defaultContent": '<button class="btn btn-danger btn-sm deleteBtn" id="delete">Delete</button>' }
        ]
    });

    // Action lorsque le bouton submit est cliqué
    $('#submitButton').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs des champs du formulaire (remplacez avec les vrais ID des champs)
        var id = $('#idInput').val();
        var name = $('#nameInput').val();

        // Créer un nouvel objet avec les données du formulaire
        var newData = {
            "id": id,
            "name": name
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

                // Réinitialisez les champs du formulaire si nécessaire
                $('#idInput').val('');
                $('#nameInput').val('');
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
            url: apiUrl + '?id=' + data.id,
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
        $('#idInput').val(data.id);
        $('#nameInput').val(data.name);

        // Affichez le bouton "Enregistrer" et masquez le bouton "Soumettre"
        $('#saveButton').show();
        $('#submitButton').hide();

        // Attachez un gestionnaire d'événements au bouton "Enregistrer" pour appliquer les modifications
        $('#saveButton').off('click').on('click', function () {
            var newId = $('#idInput').val();
            var newName = $('#nameInput').val();

            var formData = {
                id: newId,
                name: newName
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
                    data.id = newId;
                    data.name = newName;
                    table.row(row).data(data).draw();

                    // Réinitialisez les champs du formulaire de modification et masquez le bouton "Enregistrer"
                    $('#idInput').val('');
                    $('#nameInput').val('');
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