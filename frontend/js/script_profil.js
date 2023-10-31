$(document).ready(function () {
    var table = $('#myTable').DataTable({
        ajax: {
            url: apiUrlProfil,
            dataSrc: ''
        },
        columns: [
            { "data": "id" },
            { "data": "login" },
            { "data": "mdp" },
            { "data": "age" }, // Champ âge ajouté
            { "data": "taille" }, // Champ taille ajouté
            { "data": "poids" }, // Champ poids ajouté
            { "data": "sexe" }, // Champ sexe ajouté
            { "data": "activite" }, // Champ activité ajouté
            { "data": null, "defaultContent": '<button class="btn btn-info btn-sm editBtn" id="edit">Edit</button>' },
            { "data": null, "defaultContent": '<button class="btn btn-danger btn-sm deleteBtn" id="delete">Delete</button>' }
        ]
    });
    // Gestionnaire de clic pour le bouton de connexion
$('#connexion-button').on('click', function (e) {
    e.preventDefault();

    // Récupérer les valeurs des champs du formulaire de connexion
    var login = $('#login').val();
    var mdp = $('#mdp').val();

    // Créer un objet avec les données du formulaire de connexion
    var loginData = {
        "login": login,
        "mdp": mdp
    };

    // Envoyer les données de connexion à votre API (utilisez une URL différente pour la connexion)
    $.ajax({
        url: apiUrlProfil,
        type: 'POST',
        data: JSON.stringify(loginData),
        dataType: 'json',
        success: function (response) {
            // Gérez la réponse de la connexion, par exemple, redirigez l'utilisateur ou affichez un message
            // Vous pouvez également ajouter des vérifications supplémentaires ici
            $('#message').text('Connexion réussie'); // Affichez un message de connexion réussie
        },
        error: function (error) {
            // Gérez les erreurs de connexion, par exemple, affichez un message d'erreur
            console.error('Erreur de connexion : ', error);
            $('#message').text('Erreur de connexion : ' + error.responseText);
        }
    });
});

    // Action lorsque le bouton submit est cliqué
    $('#inscription-button').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs des champs du formulaire
        var login = $('#login').val();
        var mdp = $('#mdp').val();
        var age = $('#age').val(); // Champ âge ajouté
        var taille = $('#taille').val(); // Champ taille ajouté
        var poids = $('#poids').val(); // Champ poids ajouté
        var sexe = $('#sexe').val(); // Champ sexe ajouté
        var activite = $('#activite').val(); // Champ activité ajouté

        // Créer un nouvel objet avec les données du formulaire
        var newData = {
            "login": login,
            "mdp": mdp,
            "age": age, // Champ âge ajouté
            "taille": taille, // Champ taille ajouté
            "poids": poids, // Champ poids ajouté
            "sexe": sexe, // Champ sexe ajouté
            "activite": activite // Champ activité ajouté
        };

        // Envoyer les données à votre API (remplacez avec votre méthode d'envoi de données)
        $.ajax({
            url: apiUrlProfil,
            type: 'POST',
            data: JSON.stringify(newData),
            dataType: 'json',
            success: function (response) {
                // Si l'ajout est réussi, ajoutez la nouvelle ligne à votre DataTable et redessinez-le
                table.row.add(newData).draw();

                // Réinitialisez les champs du formulaire
                $('#login').val('');
                $('#mdp').val('');
                $('#age').val(''); // Champ âge ajouté
                $('#taille').val(''); // Champ taille ajouté
                $('#poids').val(''); // Champ poids ajouté
                $('#sexe').val(''); // Champ sexe ajouté
                $('#activite').val(''); // Champ activité ajouté
                $('#message').text('Inscription réussie');
            },
            error: function (error) {
                // Gérez les erreurs si l'ajout échoue
                console.error('Erreur lors de l\'inscription : ', error);
                $('#message').text('Erreur lors de l\'inscription : ' + error.responseText);
            }
        });
    });


});
