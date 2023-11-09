$(document).ready(function () {
    var table = $('#myTable').DataTable({
        ajax: {
            url: apiUrl,
            dataSrc: ''
        },
        columns: [
            { "data": "ID_REPAS" },
            { "data": "NOM_REPAS" },
            { "data": "DATE" },
            { "data": "ALIMENTS" },
            { "data": "MARQUES" },
            { "data": "QUANTITE_TOTAL" },
            { "data": null, "defaultContent": '<button class="btn btn-danger btn-sm deleteBtn" id="delete">Delete</button>' }

        ]
    });

    $('#myTable').on('click', '#delete', function () {
        var row = $(this).closest('tr');
        var data = table.row(row).data();

        $.ajax({
            url: apiUrl + '?id=' + data.ID_REPAS,
            type: 'DELETE',
            dataType: 'json',
            success: function () {
                console.log("Repas supprimé avec succès :", data);
                table.row(row).remove().draw();
            },
            error: function (error) {
                console.error('Erreur lors de la suppression de l\'aliment : ', error.responseText);
            }
        });
    });

    // ... Votre code existant pour le bouton submit et l'ajout de données ...

});
