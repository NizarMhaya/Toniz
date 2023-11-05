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
            { "data": "QUANTITE_TOTAL" }
        ]
    });

    // ... Votre code existant pour le bouton submit et l'ajout de données ...

});
