<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <?php 
    require_once('template_menu.php'); 
    renderMenuToHTML('calculateur'); 
    ?>
    <main>
    <div class="container-calculateur">
        <h1 class="my-custom-h1">Calculateur de Besoins Énergétiques</h1>
        <p class=p-text>Ce calculateur repose sur la formule de Harris-Benedict, qui permet le calcul du métabolisme de base.<br>
        Un multiplicateur y est ensuite associé en fonction de votre activité physique.</p>
        <p class=p-text>Vous pouvez utiliser ce calculateur pour avoir un idée de votre besoin énergétique quotidien, et reporter cette valeur dans votre profil.</p>
        <div class="form-group">
            <label for="age">Âge :</label>
            <input type="number" id="age" placeholder="Entrez votre âge">
        </div>
        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select id="sexe">
                <option value="homme">Homme</option> <!-- Attention ici on considère le champs sexe comme du texte -->
                <option value="femme">Femme</option>
            </select>
        </div>
        <div class="form-group">
            <label for="poids">Poids (kg) :</label>
            <input type="number" id="poids" placeholder="Entrez votre poids">
        </div>
        <div class="form-group">
            <label for="taille">Taille (cm) :</label>
            <input type="number" id="taille" placeholder="Entrez votre taille">
        </div>
        <div class="form-group">
            <label for="niveauActivite">Niveau d'activité :</label> <!-- Attention ici on les valeurs possibles du champs niveauActivite ne sont pas eleve, moyen, bas -->
            <select id="niveauActivite">
                <option value="sedentaire">Sédentaire</option>
                <option value="legerement_actif">Légèrement Actif</option>
                <option value="moderement_actif">Modérément Actif</option>
                <option value="tres_actif">Très Actif</option>
                <option value="extremement_actif">Extrêmement Actif</option>
            </select>
        </div>
        <p class=p-text-left>Besoins énergétiques journaliers : <div id="resultat"></div></p>
    </div>
</main>
    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>
    <script src="JS/script_calculateur.js"></script>
</body>

</html>