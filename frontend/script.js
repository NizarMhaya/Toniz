$(document).ready(function () {
    var table = $('#myTable').DataTable({
        ajax: {
            url: apiUrl,
            dataSrc: ''
        },
        columns: [
            { "data": "id" },
            { "data": "name" },
            { "data": null, "defaultContent": '<button class="btn btn-info btn-sm editBtn">Edit</button>' },
            { "data": null, "defaultContent": '<button class="btn btn-danger btn-sm deleteBtn" id="delete">Delete</button>' }
        ]
    });

    // Action lorsque le bouton submit est cliqué
    $('#submitButton').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs des champs du formulaire (remplacez avec les vrais ID des champs)
        var id = $('#idInput').val();
        var name = $('#nameInput').val();

        // Créer un nouvel objet avec les données du formulaire
        var newData = {
            "id": id,
            "name": name
        };

        // Envoyer les données à votre API (remplacez avec votre méthode d'envoi de données)
        $.ajax({
            url: apiUrl, // Spécifiez l'URL de votre API pour ajouter des données
            type: 'POST', // Méthode HTTP à utiliser (peut varier selon votre API)
            data: JSON.stringify(newData), // Les données que vous voulez envoyer à l'API
            dataType: 'json',
            success: function (response) {
                // Si l'ajout est réussi, ajoutez la nouvelle ligne à votre DataTable et redessinez-le
                table.row.add(newData).draw();

                // Réinitialisez les champs du formulaire si nécessaire
                $('#idInput').val('');
                $('#nameInput').val('');
            },
            error: function (error) {
                // Gérez les erreurs si l'ajout échoue
                console.error('Erreur lors de l\'ajout de la nouvelle ligne : ', error);
            }
        });
    });


    $('#myTable').on('click', '#delete', function () {
        var data = table.row($(this).parents('tr')).data(); // Obtenez les données de la ligne associée au bouton "Delete"
        var id = data.id; // Supposons que l'ID à supprimer est stocké dans la propriété "id" des données

        // Envoyez une requête DELETE à votre API pour supprimer l'entrée avec l'ID spécifié
        $.ajax({
            url: apiUrl + '?id=' + id, // Ajoutez l'ID à l'URL de l'API
            type: 'DELETE',
            dataType: 'json',
            success: function () {
                // Si la suppression est réussie, supprimez la ligne du DataTable
                table.row($(this).parents('tr')).remove().draw();
            },
            error: function (error) {
                // Gérez les erreurs si la suppression échoue
                console.error('Erreur lors de la suppression de la ligne : ', error);
            }
        });
    });
});






// $("#submitButton").click(function (event) {
//     // Empêche l'envoi du formulaire au serveur
//     event.preventDefault();

//     // Récupère la valeur des champs
//     let id = $("#inputid").val();
//     let name = $("#inputname").val();
//     // Appelle la fonction pour envoyer les données au serveur
//     sendDataToServer(name);
//     // Ajoute une nouvelle ligne à la table en utilisant .row.add()
//     table.row.add([
//         id,
//         name,
//         '<button class="btn btn-info btn-sm editBtn">Éditer</button>',
//         '<button class="btn btn-danger btn-sm deleteBtn">Supprimer</button>'
//     ]).draw(false); // Redessine la table après l'ajout de la ligne


//     // Réinitialise le champ id et le champs Name après l'ajout
//     $("#inputid").val("");
//     $("#inputname").val("");
// });




// function getAllDataFromServer() {

//     $.ajax({
//         type: "GET",
//         url: apiUrl,
//         success: function (response) {
//             console.log("Réponse du serveur :", response);

//             // Effacer le contenu de la table DataTables avant d'ajouter de nouvelles données
//             table.clear();

//             // Ajouter les données de la réponse à la table DataTables en utilisant .row.add()
//             for (let i = 0; i < response.length; i++) {
//                 table.row.add([
//                     response[i].id,
//                     response[i].name,
//                     '<button class="btn btn-info btn-sm editBtn">Éditer</button>',
//                     '<button class="btn btn-danger btn-sm deleteBtn">Supprimer</button>'
//                 ]).draw(false); // Redessiner la table après chaque ajout de ligne
//             }
//         },
//         error: function (error) {
//             console.error("Erreur :", error);
//         }
//     });
// }



// function sendDataToServer(name) {

//     $.ajax({
//         type: "POST", // Utilisez la méthode POST pour envoyer des données
//         url: apiUrl, // URL de votre API
//         data: JSON.stringify({
//             name: name,
//         }),
//         dataType: "json",
//         success: function (response) {
//             // Traitez la réponse du serveur si nécessaire
//             console.log("Réponse du serveur :" + response);
//         },
//         error: function (error) {
//             // Traitez les erreurs
//             console.error("Erreur :" + error);
//         }
//     });
// }

