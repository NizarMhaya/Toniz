$(document).ready(function () {
    console.log(apiUrl);
    let table = $('#myTable').DataTable({
        ajax: {
            url: apiUrl,
            dataSrc: ''
        },
        columns: [{
            data: 'id'
        },
        {
            data: 'name'
        }],
        columnDefs: [{
            target: 2,
            render: function (data, type, row) {
                return `
                    <button class="btn btn-sm btn-outline-dark" onclick="editResource(${data})">Edit</button>
                `;
            }
        }]
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

