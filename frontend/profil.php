<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles_perso.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php require_once('template_menu.php'); 
    renderMenuToHTML('profil'); 
    ?>
    <h2>Profil</h2>

    <?php if (!isset($_SESSION['login']) && !isset($_COOKIE['login'])) : ?>
        <p>Veuillez vous connecter ci-dessous pour voir vos informations personnelles.</p>

        <h2>Connexion</h2>
        <form id="connexion-form">
            <!-- Formulaire de connexion -->
            <label for="login">Nom :</label>
            <input type="text" id="connexion-login" name="login" required><br><br>

            <label for "mdp">Mot de passe :</label>
            <input type="password" id="connexion-mdp" name="mdp" required><br><br>

            <button type="button" id="connexion-button">Se connecter</button>
        </form>
    <?php else : ?>
        <p>Vos informations personnelles :</p>
        <!-- Afficher les informations personnelles de l'utilisateur ici -->
    <?php endif; ?>

    <div id="message"></div>

    <footer>
        <!-- Pied de page -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let apiUrlProfil = "<?php require_once 'config.php';
                        echo _API_URL_PROFIL; ?> ";
    </script>
    <script src="JS/script_profil.js" defer></script>
</body>
</html>
