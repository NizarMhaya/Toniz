<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <?php
    require_once('template_menu.php');
    renderMenuToHTML('profil');
    ?>
    <h1 class="my-custom-h1">Profil</h1>


    <?php if (!isset($_SESSION['login']) && !isset($_COOKIE['login'])) : ?>
        <p class="p-text">Veuillez vous connecter ci-dessous pour voir vos informations personnelles.</p>
        <p class="p-text">Pas encore de compte ? Rendez-vous sur la page <a href="inscription.php">Inscription</a> pour nous rejoindre.</p>
    <div class="connexion-form">
        <h2>Connexion</h2>
        <form id="connexion-form">
            <!-- Formulaire de connexion -->
            <label for="login">Nom :</label>
            <input type="text" id="connexion-login" name="login" required><br>

            <label for "mdp">Mot de passe :</label>
            <input type="password" id="connexion-mdp" name="mdp" required><br>

            <button type="button" id="connexion-button">Se connecter</button>
        </form>
    </div>
    <?php else : ?>


        <p class="p-text">Vos informations personnelles :</p>
        <table id="myTable">
            <thead>
                <tr>
                    <!-- <th scope="col">ID_USER</th> -->
                    <th scope="col">LOGIN</th>
                    <!-- <th scope="col">MDP</th> -->

                    <th scope="col">AGE</th>
                    <th scope="col">TAILLE</th>
                    <th scope="col">POIDS</th>
                    <th scope="col">SEXE</th>
                    <th scope="col">ACTIVITE</th>
                    <th scope="col">KCAL_JOUR</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody"></tbody>
        </table>
        <!-- Afficher les informations personnelles de l'utilisateur ici -->
    <?php endif; ?>
    <button type="button" id="modifier-profil-button">Modifier votre profil</button>
    <button type="button" id="valider-modifications-button">Valider les modifications</button>


    <div id="message"></div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let apiUrlProfil = "<?php require_once 'config.php';
                            echo _API_URL_PROFIL; ?> ";
    </script>
    <script src="JS/script_profil.js" defer></script>



    <!-- Formulaire d'inscription (masqué par défaut) -->
    <form id="inscription-form" style="display: none;">
        <label for="login">Nom :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="taille">Taille (en cm) :</label>
        <input type="number" id="taille" name="taille" required><br><br>

        <label for="poids">Poids (en kg) :</label>
        <input type="number" id="poids" name="poids" required><br><br>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe" required>
            <option value="1">Homme</option>
            <option value="2">Femme</option>
        </select><br><br>


        <label for="activite">Activité sportive :</label>
        <select id="activite" name="activite" required>
            <option value="1">Sédentaire</option>
            <option value="2">Actif faible</option>
            <option value="3">Actif</option>
            <option value="4">Sportif</option>
            <option value="5">Athlète professionnel</option>
        </select><br><br>

        <label for="kcal">Kcal par jour (en kg) :</label>
        <input type="number" id="kcal" name="kcal" required><br><br>

    </form>

    <script>
        // Récupérez le bouton, le formulaire et les cellules de la table par leur ID
        const modifierProfilButton = document.getElementById("modifier-profil-button");
        const inscriptionForm = document.getElementById("inscription-form");
        const validerModificationsButton = document.getElementById("valider-modifications-button");
        modifierProfilButton.style.display = "block";


        var table = $('#myTable').DataTable({
            ajax: {
                url: apiUrlProfil,
                dataSrc: ''
            },
            columns: [
                // { "data": "ID_USER" },
                {
                    "data": "LOGIN"
                },
                // { "data": "MDP" },
                {
                    "data": "AGE"
                },
                {
                    "data": "TAILLE"
                },
                {
                    "data": "POIDS"
                },
                {
                    "data": "SEXE"
                },
                {
                    "data": "ACTIVITE"
                },
                {
                    "data": "KCAL_JOUR"
                }
            ]
        });

        // Ajoutez un gestionnaire d'événements au bouton
        modifierProfilButton.addEventListener("click", function() {
            // Obtenez l'indice de la première ligne affichée dans DataTable
            const rowIndex = table.row(':eq(0)').index();

            // Obtenez les données de la première ligne à l'aide de l'indice de la ligne
            const rowData = table.row(rowIndex).data();




            // Préremplissez les champs du formulaire avec les valeurs des cellules
            document.getElementById("login").value = rowData.LOGIN;
            document.getElementById("age").value = rowData.AGE;
            document.getElementById("taille").value = rowData.TAILLE;
            document.getElementById("poids").value = rowData.POIDS;
            document.getElementById("sexe").value = rowData.SEXE;
            document.getElementById("activite").value = rowData.ACTIVITE;
            document.getElementById("kcal").value = rowData.KCAL_JOUR;

            inscriptionForm.style.display = "block";
            modifierProfilButton.style.display = "none";
            validerModificationsButton.style.display = "block";

            // Assurez-vous de traiter les valeurs de texte selon vos besoins.
            // Par exemple, pour les valeurs numériques, vous pouvez utiliser parseInt() ou parseFloat() selon le cas.

            validerModificationsButton.addEventListener("click", function() {
                // Récupérez les valeurs des champs du formulaire
                const login = document.getElementById("login").value;
                const age = document.getElementById("age").value;
                const taille = document.getElementById("taille").value;
                const poids = document.getElementById("poids").value;
                const sexe = document.getElementById("sexe").value;
                const activite = document.getElementById("activite").value;
                const kcal = document.getElementById("kcal").value;

                // Créez un objet avec les données à envoyer
                const formData = {
                    login: login,
                    age: age,
                    taille: taille,
                    poids: poids,
                    sexe: sexe,
                    activite: activite,
                    kcal_jour: kcal
                };

                // Effectuez l'appel AJAX de type PUT
                $.ajax({
                    url: apiUrlProfil, // Remplacez ceci par l'URL de votre API PUT
                    type: "PUT",
                    contentType: "application/json",
                    data: JSON.stringify(formData), // Convertissez l'objet en chaîne JSON
                    success: function(response) {
                        console.log("Modification réussie :", response);
                        // Traitez la réponse de l'API si nécessaire
                    }
                    // error: function(error) {
                    //     console.error("Erreur lors de la modification :", error);
                    //     // Gérez les erreurs si l'appel échoue
                    // }
                    // Je mets ceci en commentaire sinon j'ai tout le temps cette erreur alors que ça marche
                });
                window.location.href = 'profil.php';
            });
        });
    </script>


    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>
</body>

</html>