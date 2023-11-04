<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php require_once('template_menu.php'); 
    renderMenuToHTML('profil'); 
    ?>
    <h2>Inscription</h2>
    <form id="inscription-form">
        <label for="login">Nom :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="taille">Taille (en cm) :</label>
        <input type="number" id="taille" name="taille" required><br><br>

        <label for="poids">Poids (en kg) :</label>
        <input type="number" id="poids" name="poids" required><br><br>

        <label for="sexe">Sexe :</label>
        <input type="radio" id="sexe" name="sexe" value="Homme" required> Homme
        <input type="radio" id="sexe" name="sexe" value="Femme" required> Femme<br><br>

        <label for="activite">Activité sportive :</label>
        <select id="activite" name="activite" required>
            <option value="1">Sédentaire</option>
            <option value="2">Actif faible</option>
            <option value="3">Actif</option>
            <option value="4">Sportif</option>
            <option value="5">Athlète professionnel</option>
        </select><br><br>

        <button type="button" id="inscription-button">S'inscrire</button>
    </form>

    <footer>
        <!-- Pied de page -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let apiUrlProfil = "<?php require_once 'config.php';
                        echo _API_URL_PROFIL; ?> ";
    </script>
    <script src="JS/script_inscription.js" defer></script>
</body>
</html>
