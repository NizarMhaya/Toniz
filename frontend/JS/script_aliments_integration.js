$(document).ready(function () {
    var table = $('#myTable').DataTable({
        ajax: {
            url: apiUrl,
            dataSrc: ''
        },
        columns: [
            { "data": null, "defaultContent": '<button class="custom-button"> <img src="assets/clipboard.png" alt="Icône personnalisée" style="width: 32px; height: 32px; "> </button>' },
            { "data": "CODE_BARRES" },
            { "data": "NOM" },
            { "data": "MARQUE" },
            { "data": "CATEGORIE" },
            { "data": "ENERGIE_100G" }

        ]
    });



    $('#myTable').on('click', '.custom-button', function (event) {
        var row = $(this).closest('tr');
        var data = table.row(row).data();
        var codeBarres = data.CODE_BARRES; // Assurez-vous d'ajuster le nom de la propriété selon votre structure de données

        // Copiez le code-barres dans le presse-papiers
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(codeBarres).select();
        document.execCommand('copy');
        tempInput.remove();

        // Votre logique ici
        $(this).addClass('clic-effectue');



    });


    var table2 = $('#secondTable').DataTable({
        ajax: {
            url: apiUrlFavoris,
            dataSrc: ''
        },
        columns: [
            { "data": null, "defaultContent": '<button class="custom-button"> <img src="assets/clipboard.png" alt="Icône personnalisée" style="width: 32px; height: 32px; "> </button>' },
            { "data": "CODE_BARRES" },
            { "data": "NOM" },
            { "data": "MARQUE" },
            { "data": "CATEGORIE" },
            { "data": "ENERGIE_100G" }
        ]
    });




    $('#secondTable').on('click', '.custom-button', function (event) {
        var row = $(this).closest('tr');
        var data = table2.row(row).data();
        var codeBarres = data.CODE_BARRES; // Assurez-vous d'ajuster le nom de la propriété selon votre structure de données

        // Copiez le code-barres dans le presse-papiers
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(codeBarres).select();
        document.execCommand('copy');
        tempInput.remove();

        // Votre logique ici
        $(this).addClass('clic-effectue');


    });

});

