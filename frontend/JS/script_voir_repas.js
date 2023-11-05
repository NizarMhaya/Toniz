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
            { "data": null, "defaultContent": '<button class="btn btn-info btn-sm editBtn" id="edit">Edit</button>' },

        ]
    });

    // ... Votre code existant pour le bouton submit et l'ajout de données ...

});
