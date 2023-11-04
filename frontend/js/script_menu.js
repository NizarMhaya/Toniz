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
});
