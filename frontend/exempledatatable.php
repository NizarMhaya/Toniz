<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <title>exo2</title>
    <script>
        PREFIX = 'http://localhost/IDAW';
        $(document).ready(function() {
            $('#myTable').DataTable({
                ajax: {
                    url: PREFIX + '/users.php',
                    dataSrc: ''
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    }
                ],
                columnDefs: [{
                        orderable: false,
                        targets: 10,
                        data: null,
                        defaultContent: '<button id=edit>Edit</button>'
                    },
                    {
                        orderable: false,
                        targets: 11,
                        data: null,
                        defaultContent: '<button id=delete>Delete</button>'
                    }
                ]
            });
        });
    </script>

</head>

<body>
    <table id="myTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
            </tr>
        </thead>

    </table>
</body>

</html>