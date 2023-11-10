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

        // Réinitialiser le message d'erreur précédent
        $('#error-message').text('');
        $('#error-message').hide();

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

                if (response.message === 'Connexion réussie') {
                    $('#session-status').text('Connecté : ' + connexionLogin);
                    window.location.href = 'index.php'; // Remplacez 'index.php' par l'URL de votre page d'accueil
                } else {
                    // Afficher un message d'erreur
                    $('#error-message').text('Nom d\'utilisateur ou mot de passe incorrect.');
                    $('#error-message').show();
                }
            },
            error: function (error) {
                console.error('Erreur de connexion : ', error);
                console.log('Réponse de la requête :', error.responseText); // Affichez la réponse du serveur
                $('#error-message').text('Erreur de connexion : ' + error.responseText);
                $('#error-message').show();
            }
        });
    });

});
