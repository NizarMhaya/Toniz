$(document).ready(function () {

// Gestionnaire de clic pour le bouton de connexion
$('#connexion-button').on('click', function (e) {
    e.preventDefault();

    // Récupérer les valeurs des champs du formulaire de connexion
    var connexionLogin = $('#connexion-login').val();
    var connexionMdp = $('#connexion-mdp').val();

    // Créer un objet avec les données du formulaire de connexion
    var loginData = {
        "login": connexionLogin,
        "mdp": connexionMdp
    };

    // Afficher les données à des fins de débogage
    console.log('Données de connexion envoyées :', loginData);

    // Envoyer les données de connexion à votre API (utilisez une URL différente pour la connexion)
    $.ajax({
        url: apiUrlProfil,
        type: 'POST',
        data: JSON.stringify(loginData),
        dataType: 'json',
        success: function (response) {
            // Gérez la réponse de la connexion, par exemple, redirigez l'utilisateur ou affichez un message
            // Vous pouvez également ajouter des vérifications supplémentaires ici
            console.log('Réponse de la connexion :', response);
            $('#message').text('Connexion réussie'); // Affichez un message de connexion réussie

            if (response.message === 'Connexion réussie') {
                $('#session-status').text('Connecté : ' + connexionLogin);
                window.location.href = 'index.php'; // Remplacez 'index.php' par l'URL de votre page d'accueil
            }
        },
        error: function (error) {
            console.error('Erreur de connexion : ', error);
            console.log('Réponse de la requête :', error.responseText); // Affichez la réponse du serveur
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