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
            url: apiUrl + '?CODE_BARRES=' + data.CODE_BARRES, // Dans votre méthode DELETE API, vous utilisez $_GET['CODE_BARRES'] pour récupérer l'ID de l'aliment favori. Par conséquent, dans votre requête AJAX, nous devons passer l'ID de cette manière avec '?CODE_BARRES=' et non '?id'
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


});

