document.addEventListener("DOMContentLoaded", function() {
    const inscriptionForm = document.getElementById("inscription-form");
    const messageDiv = document.getElementById("message");
    const inscriptionButton = document.getElementById("inscription-button");

    inscriptionButton.addEventListener("click", function() {
        // Récupération des données du formulaire
        const nom = document.getElementById("nom").value;
        const mdp = document.getElementById("mdp").value;

        // Création de l'objet JSON à envoyer
        const data = {
            nom: nom,
            mdp: mdp
        };

        // Envoi des données au serveur via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "api_profil.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Réponse du serveur
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    messageDiv.textContent = "Inscription réussie.";
                } else {
                    messageDiv.textContent = "Erreur d'inscription : " + response.message;
                }
            }
        };

        xhr.send(JSON.stringify(data));
    });
});
