document.addEventListener('DOMContentLoaded', function () {
    const ageInput = document.getElementById('age');
    const sexeInput = document.getElementById('sexe');
    const poidsInput = document.getElementById('poids');
    const tailleInput = document.getElementById('taille');
    const niveauActiviteInput = document.getElementById('niveauActivite');
    const resultatDiv = document.getElementById('resultat');

    [ageInput, sexeInput, poidsInput, tailleInput, niveauActiviteInput].forEach(input => {
        input.addEventListener('input', calculerBesoinsEnergetiques);
    });

    function calculerBesoinsEnergetiques() {
        const age = parseInt(ageInput.value);
        const sexe = sexeInput.value;
        const poids = parseFloat(poidsInput.value);
        const taille = parseFloat(tailleInput.value);
        const niveauActivite = niveauActiviteInput.value;

        if (age && poids && taille) {
            let bmr;
            if (sexe === 'homme') {
                bmr = 88.362 + (13.397 * poids) + (4.799 * taille) - (5.677 * age);
            } else {
                bmr = 447.593 + (9.247 * poids) + (3.098 * taille) - (4.330 * age);
            }

            let tdee;
            switch (niveauActivite) {
                case 'sedentaire':
                    tdee = bmr * 1.2;
                    break;
                case 'legerement_actif':
                    tdee = bmr * 1.375;
                    break;
                case 'moderement_actif':
                    tdee = bmr * 1.55;
                    break;
                case 'tres_actif':
                    tdee = bmr * 1.725;
                    break;
                case 'extremement_actif':
                    tdee = bmr * 1.9;
                    break;
                default:
                    tdee = bmr * 1.2; // Par défaut, considérer un niveau sédentaire
            }

            // Afficher le résultat
            resultatDiv.textContent = `Besoins Énergétiques Journaliers : ${tdee.toFixed(2)} calories`;
        } else {
            // Si les champs ne sont pas tous remplis, afficher un message d'erreur
            resultatDiv.textContent = "Veuillez remplir tous les champs.";
        }
    }
});
