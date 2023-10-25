function getAllDataFromServer() {
    $.ajax({
        type: "GET", // Utilisez la méthode GET pour récupérer des données
        url: "http://localhost/Toniz/backend/api_aliments.php", // URL de votre API pour récupérer tous les éléments
        success: function (response) {
            // Traitez la réponse du serveur ici
            console.log("Réponse du serveur :", response);

            // Mettez à jour votre interface utilisateur avec les données reçues du serveur
            // Par exemple, si response est un tableau d'objets, vous pouvez les afficher dans un tableau HTML
            // Utilisez la boucle pour parcourir la réponse et mettre à jour votre interface utilisateur
            // Exemple d'affichage dans une table HTML (supposons que #data-table est l'ID de votre élément de tableau dans HTML) :
            for (let i = 0; i < response.length; i++) {
                $("#studentsTableBody").append(`<tr>
                        <td>${response[i].id}</td>
                        <td>${response[i].name}</td>
                        <td><button class="btn btn-info btn-sm editBtn">Éditer</button></td>
            <td><button class="btn btn-danger btn-sm deleteBtn">Supprimer</button></td>
                    </tr>`);
            }
        },
        error: function (error) {
            // Traitez les erreurs ici 
            console.error("Erreur :", error);
        }
    });
}


function sendDataToServer(name) {

    $.ajax({
        type: "POST", // Utilisez la méthode POST pour envoyer des données
        url: "http://localhost/Toniz/backend/api_aliments.php", // URL de votre API
        data: JSON.stringify({
            name: name,
        }),
        dataType: "json",
        success: function (response) {
            // Traitez la réponse du serveur si nécessaire
            console.log("Réponse du serveur :" + response);
        },
        error: function (error) {
            // Traitez les erreurs
            console.error("Erreur :" + error);
        }
    });
}

