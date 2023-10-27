<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <title>Users</title>
    <style>
        body {
            margin-top: 5em;
        }

        .table {
            margin-top: 100px;
            margin-bottom: 100px;
        }
    </style>
</head>

<body>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">CRUD</th>
                <th scope="col">CRUD</th>
            </tr>
        </thead>
        <tbody id="studentsTableBody">
        </tbody>
    </table>
    <form id="addStudentForm" action="" onsubmit="onFormSubmit();">
        <div class="form-group row">
            <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputNom">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputEmail">
            </div>
        </div>
        <div class="form-group row">
            <span class="col-sm-2"></span>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary form-control">Ajouter</button>
            </div>
        </div>
    </form>

    <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modification</h5>
                    <button type="button" class="btn-close" id="croix" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="idModif" class="col-sm-3 col-form-label">Id</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control" id="idModif" value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomModif" class="col-sm-3 col-form-label">Nom</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nomModif" value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emailModif" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="emailModif" value=''>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-primary" id="ValidModif" value="Valider">
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-danger alert-dismissible fade" id="myAlert" role="alert">
        <span id="msgError">Une erreur est survenue.</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        var table = new DataTable('#myTable', {
            //ajax: 'data/arrays.txt',
            columnDefs: [{
                    data: "id",
                    targets: 0
                },
                {
                    data: "nom",
                    targets: 1
                },
                {
                    data: "email",
                    targets: 2
                },
                {
                    data: "modifier",
                    defaultContent: '<input type="button" id="Modif" value="Modifier">',
                    targets: -2
                },
                {
                    data: null,
                    defaultContent: '<input type="button" id="Suppr" value="Supprimer">',
                    targets: -1
                }
            ]
        });

        //Fonction pour lancer une erreur
        function throwAlert(text) {
            var alertElement = document.getElementById("myAlert");
            var msgError = document.getElementById("msgError");

            alertElement.style.display = "block";
            msgError.innerHTML = text;
            alertElement.classList.add("show");

            setTimeout(function() {
                alertElement.style.display = "none";
                alertElement.classList.remove("show");
            }, 5000);
        }

        //Initialisation du tableau
        $.ajax({
            url: 'http://localhost/IDAW/TP4/exo5/api_aliments.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                //console.log(data);

                for (let i = 0; i < data.length; i++) {
                    table.row.add({
                        "id": data[i].id,
                        "nom": data[i].name,
                        "email": data[i].email
                    }).draw();
                }
            },
            error: function(error) {
                throwAlert('Erreur lors de la récupération des données : ' + error);
                console.error('Erreur lors de la récupération des données : ', error);
            }
        })


        //Gestion de la modification
        table.on('click', '#Modif', function(e) {
            let row = table.row(e.target.closest('tr'));

            $("#nomModif").val(table.cell(row, 1).data());
            $("#emailModif").val(table.cell(row, 2).data());
            $("#idModif").val(table.cell(row, 0).data());

            $('#myModal').modal('show');
        });

        function fermeModal() {
            $('#myModal').modal('hide');
        }

        $('#close').on('click', function(e) {
            fermeModal();
        })

        $('#croix').on('click', function(e) {
            fermeModal();
        })

        $('#ValidModif').on('click', function(e) {

            let nom = $("#nomModif").val();
            let email = $("#emailModif").val();
            let id = $("#idModif").val();

            let firstColumnData = table.column(0).data().toArray();
            let row = table.row(0);
            let numRows = table.rows().toArray()[0];

            //console.log(firstColumnData);
            for (let i = 0; i < firstColumnData.length; i++) {
                let value = firstColumnData[i];
                if (value == id) {
                    //console.log(table.rows().toArray());
                    //console.log("Numéro dans le tableau : " + i);
                    //console.log("Numéro de ligne : " + numRows[i]);
                    row = table.row(numRows[i]);
                    //console.log("Id dans la ligne : " + table.cell(row, 0).data());
                    break;
                }
            }

            var formData = {
                name: nom,
                email: email
            }

            $.ajax({
                url: 'http://localhost/IDAW/TP4/exo5/users.php?userId=' + id,
                method: 'PUT',
                data: JSON.stringify(formData),
                dataType: 'json',
                success: function(data) {
                    row.data({
                        "id": table.cell(row, 0).data(),
                        "nom": nom,
                        "email": email
                    })
                    row.draw();
                },
                error: function(error) {
                    throwAlert('Erreur lors de la modification des données : ' + error);
                    console.error('Erreur lors de la modification des données : ', error);
                }
            })
            fermeModal();
        });


        //Permet de gérer la suppression
        table.on('click', '#Suppr', function(e) {
            let row = table.row(e.target.closest('tr'));
            $.ajax({
                url: 'http://localhost/IDAW/TP4/exo5/users.php?userId=' + table.cell(row, 0).data(),
                method: 'DELETE',
                dataType: 'json',
                success: function(data) {
                    row.remove().draw();
                },
                error: function(error) {
                    throwAlert('Erreur lors de la suppression des données : ' + error);
                    console.error('Erreur lors de la suppression des données : ', error);
                }
            })
        });


        //Permet de gérer l'ajout
        function onFormSubmit() {
            // prevent the form to be sent to the server
            event.preventDefault();
            let nom = $("#inputNom").val();
            let email = $("#inputEmail").val();

            var formData = {
                name: nom,
                email: email
            }

            if (nom.length != 0) {
                $.ajax({
                    url: 'http://localhost/IDAW/TP4/exo5/users.php',
                    method: 'POST',
                    data: JSON.stringify(formData),
                    dataType: 'json',
                    success: function(data) {
                        table.row.add({
                            "id": data,
                            "nom": formData.name,
                            "email": formData.email
                        }).draw();
                    },
                    error: function(error) {
                        throwAlert('Erreur lors de l\'ajout des données : ' + error);
                        console.error('Erreur lors de l\'ajout des données : ', error);
                    }
                })
            } else {
                $("#inputNom").css("border-color", "red")
            }
        }
    </script>
</body>

</html>