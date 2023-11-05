$(document).ready(function () {
    // Action lorsque le bouton submit est cliqué
    $('#inscription-button').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs des champs du formulaire
        var login = $('#login').val();
        var mdp = $('#mdp').val();
        var age = $('#age').val();
        var taille = $('#taille').val();
        var poids = $('#poids').val();
        var sexe = $('#sexe').val();
        var activite = $('#activite').val();

        // Vérifier si les champs "mdp" et "login" sont vides
        if (login.trim() === '' || mdp.trim() === '') {
            $('#success-message').text(''); // Réinitialisez le message de succès
            $('#error-message').text('Les champs "Nom" et "Mot de passe" sont obligatoires.'); // Affichez un message d'erreur
            return; // Arrêtez la soumission du formulaire
        }

        // Créer un nouvel objet avec les données du formulaire
        var newData = {
            "login": login,
            "mdp": mdp,
            "age": age,
            "taille": taille,
            "poids": poids,
            "sexe": sexe,
            "activite": activite
        };

        // Envoyer les données à votre API (remplacez avec votre méthode d'envoi de données)
        $.ajax({
            url: apiUrlSignIn,
            type: 'POST',
            data: JSON.stringify(newData),
            dataType: 'json',
            success: function (response) {
                // Réinitialisez les champs du formulaire
                $('#login').val('');
                $('#mdp').val('');
                $('#age').val('');
                $('#taille').val('');
                $('#poids').val('');
                $('#sexe').val('');
                $('#activite').val('');

                // Réinitialisez les messages d'erreur
                $('#success-message').text('Inscription réussie');
                $('#error-message').text('');
            },
            error: function (error) {
                // Gérez les erreurs si l'ajout échoue
                console.error('Erreur lors de l\'inscription : ', error);
                $('#success-message').text('');
                $('#error-message').text('Erreur lors de l\'inscription : ' + error.responseText);
            }
        });
    });
});
