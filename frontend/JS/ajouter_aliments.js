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
            { "data": null, "defaultContent": '<button class="btn btn-success btn-sm addBtn">Ajouter</button>' }
        ]
    });


    $('#myTable').on('click', '.addBtn', function () {
        var row = $(this).closest('tr');
        var data = table.row(row).data();

        // Faites la requête AJAX pour ajouter l'aliment aux favoris de l'utilisateur
        $.ajax({
            url: apiUrl, // Remplacez apiUrl par l'URL de votre API de gestion des aliments favoris
            type: 'POST',
            data: JSON.stringify({ "CODE_BARRES": data.CODE_BARRES }),
            contentType: 'application/json',
            success: function (response) {
                // Si l'ajout est réussi, vous pouvez mettre à jour l'interface utilisateur ou effectuer d'autres actions nécessaires
                console.log("Aliment ajouté aux favoris avec succès :", response);

                // Par exemple, vous pouvez mettre à jour le tableau après l'ajout
                // table.ajax.reload(); // Rechargez les données du tableau si nécessaire
            },
            error: function (error) {
                // Gérez les erreurs si l'ajout échoue
                console.error('Erreur lors de l\'ajout de l\'aliment aux favoris : ', error);
            }
        });
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


});

