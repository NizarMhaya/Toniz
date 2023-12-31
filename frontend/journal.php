<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php require_once('template_menu.php'); ?>
    
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('journal'); ?>
    </header>

    <main>
        <?php
        if (isset($_COOKIE['login'])) {
            // Utilisateur est connecté, affichez le contenu de la page
        ?>
        <h1 class="my-custom-h1">Journal</h1>
        <!-- Section pour afficher les nutriments de la veille -->

        <!-- Formulaire pour sélectionner une période -->
        <form id="nutriment-form">
            <label for="start-date">Choisir la date de début : </label>
            <input type="date" id="start-date" name="start_date" required>

            <label for "end-date">Choisir la date de fin : </label>
            <input type="date" id="end-date" name="end_date" required>

            <label for="nutriment-type">Choisir le type de nutriment : </label>
            <select id="nutriment-type" name="nutriment_type">
                <option value="ENERGIE_100G">Énergie (kcal)</option>
                <option value="MAT_GRASSES">Matières grasses (g)</option>
                <option value="GRAISSES_SATUREES">Graisses saturées (g)</option>
                <option value="GLUCIDES">Glucides (g)</option>
                <option value="SUCRES">Sucres (g)</option>
                <option value="FIBRES">Fibres (g)</option>
                <option value="PROTEINES">Protéines (g)</option>
                <option value="SEL">Sel (g)</option>
                <option value="SODIUM">Sodium (mg)</option>
                <option value="CALCIUM">Calcium (mg)</option>
            </select>
            <button type="submit" id="ajouter-aliment">Afficher les données</button>
        </form>

        <!-- Section pour afficher les nutriments par jour -->
        <section id="calories-section">
            <h3>Nutriment sur une période donnée</h3>   
            <p id="nutriments-info">Chargement en cours...</p>
            <!-- Ajoutez un paragraphe pour afficher KCAL_JOUR -->
            <p id="user-kcal-info">KCAL_JOUR: <span id="user-kcal-value"></span></p>
            <div id="nutriment-chart-container">
                <canvas id="nutriment-chart" width="400" height="200"></canvas>
            </div>
        </section>
        <?php
        } else {
            // Utilisateur non connecté, affichez le message approprié
        ?>
        <h1 class="my-custom-h1">Journal</h1>
        <p class="p-text">Veuillez vous connecter pour accéder à votre journal.</p>
        <?php
        }
        ?>
    </main>

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>
    </footer>

    <script>
        let apiUrlNutriment = "<?php require_once 'config.php';
                                echo _API_URL_NUTRIMENT; ?>";
    </script>
    <script src="JS/script_nutriment.js" defer></script>
</body>

</html>
