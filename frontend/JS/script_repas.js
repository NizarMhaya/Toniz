$(document).ready(function () {
    // Sélectionnez le bouton "Enregistrer le repas"
    const enregistrerRepasButton = document.getElementById("enregistrer-repas-button");

    // Ajoutez un gestionnaire d'événements au bouton
    enregistrerRepasButton.addEventListener("click", function () {
        // Récupérez les valeurs des champs du formulaire
        const nomRepas = document.getElementById("nom-repas").value;
        const dateRepas = document.getElementById("date-repas").value;

        // Récupérez les valeurs des champs d'aliments et de quantités dynamiques
        const alimentsInputs = document.querySelectorAll(".aliment-input");
        const quantiteInputs = document.querySelectorAll(".quantite-input");


        const aliments = [];
        for (let i = 0; i < alimentsInputs.length; i++) {
            const aliment = alimentsInputs[i].value;
            const quantite = quantiteInputs[i].value;
            aliments.push({ aliment, quantite });
        }


        // Créez un objet avec les données à envoyer
        const dataToSend = {
            nomRepas: nomRepas,
            dateRepas: dateRepas,
            aliments: aliments
        };

        // Effectuez l'appel AJAX de type POST pour enregistrer le repas
        $.ajax({
            url: apiUrlRepas, // Remplacez ceci par l'URL de votre API ou script de traitement PHP
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(dataToSend), // Convertissez l'objet en chaîne JSON
            success: function (response) {
                // Traitez la réponse de l'API si nécessaire
                console.log("Repas enregistré avec succès :", response);

                // Affichez un message de succès à l'utilisateur
                afficherMessageSucces("Repas enregistré avec succès !");
            },
            error: function (error) {
                // Gérez les erreurs si l'appel échoue
                console.error("Erreur lors de l'enregistrement du repas :", error);

                // Affichez un message d'erreur à l'utilisateur
                afficherMessageErreur("Erreur lors de l'enregistrement du repas. Veuillez réessayer.");
            }
        });
    });

    // Fonction pour afficher un message de succès
    function afficherMessageSucces(message) {
        const messageDiv = document.getElementById("message");
        messageDiv.innerText = message;
        messageDiv.classList.add("alert", "alert-success");
        messageDiv.style.display = "block";
    }

    // Fonction pour afficher un message d'erreur
    function afficherMessageErreur(message) {
        const messageDiv = document.getElementById("message");
        messageDiv.innerText = message;
        messageDiv.classList.add("alert", "alert-danger");
        messageDiv.style.display = "block";
    }

    document.getElementById("toggleButton").addEventListener("click", function () {
        var secondTableContainer = document.getElementById("secondTableContainer");

        // Inversez la visibilité du conteneur du deuxième tableau
        if (secondTableContainer.style.display === "none" || secondTableContainer.style.display === "") {
            secondTableContainer.style.display = "block";
        } else {
            secondTableContainer.style.display = "none";
        }
    });






});