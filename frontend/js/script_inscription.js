$(document).ready(function () {

    // Gestionnaire de clic pour le bouton d'inscription
    $('#inscription-button').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs des champs du formulaire d'inscription
        var login = $('#login').val();
        var mdp = $('#mdp').val();
        var age = $('#age').val();
        var taille = $('#taille').val();
        var poids = $('#poids').val();
        var sexe = $('input[name="sexe"]:checked').val();
        var activite = $('#activite').val();

        // Créer un objet avec les données du formulaire d'inscription
        var inscriptionData = {
            "login": login,
            "mdp": mdp,
            "age": age,
            "taille": taille,
            "poids": poids,
            "sexe": sexe,
            "activite": activite
        };

        // Afficher les données à des fins de débogage
        console.log('Données d\'inscription envoyées :', inscriptionData);

        // Envoyer les données d'inscription à votre API (utilisez une URL différente pour l'inscription)
        $.ajax({
            url: apiUrlProfil, // Remplacez par l'URL de votre API d'inscription
            type: 'POST',
            data: JSON.stringify(inscriptionData),
            dataType: 'json',
            success: function (response) {
                // Gérez la réponse de l'inscription, par exemple, redirigez l'utilisateur ou affichez un message
                // Vous pouvez également ajouter des vérifications supplémentaires ici
                console.log('Réponse de l\'inscription :', response);
                $('#message').text('Inscription réussie'); // Affichez un message d'inscription réussie

                if (response.message === 'Inscription réussie') {
                    window.location.href = 'profil.php'; // Redirigez l'utilisateur vers la page de profil
                }
            },
            error: function (error) {
                console.error('Erreur d\'inscription :', error);
                console.log('Réponse de la requête :', error.responseText); // Affichez la réponse du serveur
                $('#message').text('Erreur d\'inscription : ' + error.responseText);
            }
        });
    });

});
