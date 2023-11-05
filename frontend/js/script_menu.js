// Code JavaScript pour gérer la déconnexion
$(document).ready(function () {
    // Gestionnaire de clic pour le bouton "Se déconnecter"
    $('#logout-button').on('click', function (e) {
        e.preventDefault();

        // Envoyer une requête AJAX pour se déconnecter
        $.ajax({
            url: apiUrlDeco, // L'URL de votre point de terminaison de déconnexion
            type: 'GET', // Utilisez GET pour la déconnexion
            dataType: 'json',
            success: function (response) {
                // Rediriger l'utilisateur vers la page d'accueil
                window.location.href = response.redirect; // Redirigez vers la page d'accueil
            },
            error: function (error) {
                // Gérer les erreurs de déconnexion
                console.error('Erreur de déconnexion : ', error);
            }
        });
    });

    // Gestionnaire de clic pour le bouton "Se connecter"
    $('#login-button').on('click', function () {
        window.location.href = 'profil.php'; // Redirigez vers la page profil.php
    });

    // Gestionnaire de clic pour le bouton "S'inscrire"
    $('#signup-button').on('click', function () {
        window.location.href = 'inscription.php'; // Redirigez vers la page inscription.php
    });
});
