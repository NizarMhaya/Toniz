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
            { "data": "MATIERES_GRASSES" },
            { "data": "GRAISSES_SATUREES" },
            { "data": "GLUCIDES" },
            { "data": "SUCRES" },
            { "data": "FIBRES" },
            { "data": "PROTEINES" },
            { "data": "SEL" },
            { "data": "SODIUM" },
            { "data": "CALCIUM" },
            { "data": null, "defaultContent": '<button class="btn btn-info btn-sm editBtn" id="edit">Edit</button>' },
            { "data": null, "defaultContent": '<button class="btn btn-danger btn-sm deleteBtn" id="delete">Delete</button>' }
        ]
    });
    // Cacher le formulaire de création au chargement de la page
    $('#addAlimentForm').hide();

    // Gérer le clic sur le bouton "Créer un nouvel aliment"
    $('#createAlimentButton').on('click', function () {
        // Afficher ou masquer le formulaire de création
        $('#addAlimentForm').toggle();

        // Effacer les valeurs du formulaire
        $('#addAlimentForm :input').val('');

        // Cacher le bouton "Enregistrer" et afficher le bouton "Submit"
        $('#saveButton').hide();
        $('#submitButton').show();
    });
    
    $('#submitButton').on('click', function (e) {
        e.preventDefault();

        var codeBarres = $('#codeBarresInput').val();
        var nom = $('#nomInput').val();
        var marque = $('#marqueInput').val();
        var categorie = $('#categorieInput').val();
        var energie = $('#energieInput').val();
        var matieresGrasses = $('#matieresGrassesInput').val();
        var graissesSaturees = $('#graissesSatureesInput').val();
        var glucides = $('#glucidesInput').val();
        var sucres = $('#sucresInput').val();
        var fibres = $('#fibresInput').val();
        var proteines = $('#proteinesInput').val();
        var sel = $('#selInput').val();
        var sodium = $('#sodiumInput').val();
        var calcium = $('#calciumInput').val();

        var newData = {
            "CODE_BARRES": codeBarres,
            "NOM": nom,
            "MARQUE": marque,
            "CATEGORIE": categorie,
            "ENERGIE_100G": energie,
            "MATIERES_GRASSES": matieresGrasses,
            "GRAISSES_SATUREES": graissesSaturees,
            "GLUCIDES": glucides,
            "SUCRES": sucres,
            "FIBRES": fibres,
            "PROTEINES": proteines,
            "SEL": sel,
            "SODIUM": sodium,
            "CALCIUM": calcium
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
                $('#matieresGrassesInput').val('');
                $('#graissesSatureesInput').val('');
                $('#glucidesInput').val('');
                $('#sucresInput').val('');
                $('#fibresInput').val('');
                $('#proteinesInput').val('');
                $('#selInput').val('');
                $('#sodiumInput').val('');
                $('#calciumInput').val('');
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
        $('#matieresGrassesInput').val(data.MATIERES_GRASSES);
        $('#graissesSatureesInput').val(data.GRAISSES_SATUREES);
        $('#glucidesInput').val(data.GLUCIDES);
        $('#sucresInput').val(data.SUCRES);
        $('#fibresInput').val(data.FIBRES);
        $('#proteinesInput').val(data.PROTEINES);
        $('#selInput').val(data.SEL);
        $('#sodiumInput').val(data.SODIUM);
        $('#calciumInput').val(data.CALCIUM);

        $('#saveButton').show();
        $('#submitButton').hide();

        $('#saveButton').off('click').on('click', function () {
            var newCodeBarres = $('#codeBarresInput').val();
            var newNom = $('#nomInput').val();
            var newMarque = $('#marqueInput').val();
            var newCategorie = $('#categorieInput').val();
            var newEnergie = $('#energieInput').val();
            var newMatieresGrasses = $('#matieresGrassesInput').val();
            var newGraissesSaturees = $('#graissesSatureesInput').val();
            var newGlucides = $('#glucidesInput').val();
            var newSucres = $('#sucresInput').val();
            var newFibres = $('#fibresInput').val();
            var newProteines = $('#proteinesInput').val();
            var newSel = $('#selInput').val();
            var newSodium = $('#sodiumInput').val();
            var newCalcium = $('#calciumInput').val();

            var formData = {
                "CODE_BARRES": newCodeBarres,
                "NOM": newNom,
                "MARQUE": newMarque,
                "CATEGORIE": newCategorie,
                "ENERGIE_100G": newEnergie,
                "MATIERES_GRASSES": newMatieresGrasses,
                "GRAISSES_SATUREES": newGraissesSaturees,
                "GLUCIDES": newGlucides,
                "SUCRES": newSucres,
                "FIBRES": newFibres,
                "PROTEINES": newProteines,
                "SEL": newSel,
                "SODIUM": newSodium,
                "CALCIUM": newCalcium
            };

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
                    $('#matieresGrassesInput').val('');
                    $('#graissesSatureesInput').val('');
                    $('#glucidesInput').val('');
                    $('#sucresInput').val('');
                    $('#fibresInput').val('');
                    $('#proteinesInput').val('');
                    $('#selInput').val('');
                    $('#sodiumInput').val('');
                    $('#calciumInput').val('');
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
