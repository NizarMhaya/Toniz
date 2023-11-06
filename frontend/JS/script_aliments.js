$(document).ready(function () {
    var apiUrl = "<?php require_once 'config.php'; echo _API_URL_ALIMENT; ?>";

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

    $('#submitButton').on('click', function (e) {
        e.preventDefault();

        var codeBarres = $('#codeBarresInput').val();
        var nom = $('#nomInput').val();
        var marque = $('#marqueInput').val();
        var categorie = $('#categorieInput').val();
        var energie = $('#energieInput').val();

        var newData = {
            "CODE_BARRES": codeBarres,
            "NOM": nom,
            "MARQUE": marque,
            "CATEGORIE": categorie,
            "ENERGIE_100G": energie
        };

        $.ajax({
            url: apiUrl,
            type: 'POST',
            data: JSON.stringify(newData),
            dataType: 'json',
            success: function (response) {
                table.row.add(newData).draw();

                $('#codeBarresInput').val('');
                $('#nomInput').val('');
                $('#marqueInput').val('');
                $('#categorieInput').val('');
                $('#energieInput').val('');
            },
            error: function (error) {
                console.error('Erreur lors de l\'ajout de la nouvelle ligne : ', error.responseText);
            }
        });
    });

    $('#myTable').on('click', '#delete', function () {
        var row = $(this).closest('tr');
        var data = table.row(row).data();

        $.ajax({
            url: apiUrl + '?id=' + data.CODE_BARRES,
            type: 'DELETE',
            dataType: 'json',
            success: function () {
                console.log("Aliment supprimé avec succès :", data);
                table.row(row).remove().draw();
            },
            error: function (error) {
                console.error('Erreur lors de la suppression de l\'aliment : ', error.responseText);
            }
        });
    });

    $('#myTable').on('click', '#edit', function () {
        var row = $(this).closest('tr');
        var data = table.row(row).data();

        $('#codeBarresInput').val(data.CODE_BARRES);
        $('#nomInput').val(data.NOM);
        $('#marqueInput').val(data.MARQUE);
        $('#categorieInput').val(data.CATEGORIE);
        $('#energieInput').val(data.ENERGIE_100G);

        $('#saveButton').show();
        $('#submitButton').hide();

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

            $.ajax({
                type: "PUT",
                url: apiUrl,
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function (data) {
                    console.log("Aliment mis à jour avec succès :", data);
                    table.row(row).data(formData).draw();
                    $('#codeBarresInput').val('');
                    $('#nomInput').val('');
                    $('#marqueInput').val('');
                    $('#categorieInput').val('');
                    $('#energieInput').val('');
                    $('#saveButton').hide();
                    $('#submitButton').show();
                },
                error: function (error) {
                    console.error('Erreur lors de la modification de l\'aliment : ', error.responseText);
                }
            });
        });
    });
});
