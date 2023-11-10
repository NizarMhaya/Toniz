// Fonction pour supprimer le graphe
function removeNutrimentChart() {
    $('#nutriment-chart').remove();
}
function getNutrimentData(startDate, endDate, selectedNutriment) {
    // Requête AJAX pour obtenir les données du nutriment spécifié avec la période sélectionnée
    $.ajax({
        url: apiUrlNutriment,
        method: 'POST',
        dataType: 'json',
        data: {
            start_date: startDate,
            end_date: endDate,
            nutriment_type: selectedNutriment
        },
        success: function (data) {
            // Mettez à jour les informations sur le nutriment
            if (data.dailyNutriments !== undefined && data.dailyNutriments.length > 0) {
                // Calculez le total du nutriment à partir des données
                const totalNutriment = data.dailyNutriments.reduce((acc, entry) => acc + parseFloat(entry.totalNutriment), 0);

                // Arrondir le totalNutriment à deux chiffres après la virgule
                const roundedTotal = parseFloat(totalNutriment).toFixed(2);

                // Affichez la valeur de KCAL_JOUR sur la page
                const userKcal = data.userKcal;
                document.getElementById('user-kcal-value').textContent = 'KCAL_JOUR: ' + userKcal;

                $('#nutriments-info').html('Total de ' + selectedNutriment + ' du ' + startDate + ' au ' + endDate + ' : ' + roundedTotal);
                // Appel à la fonction pour créer le graphe
                createNutrimentChart(data.dailyNutriments, selectedNutriment, userKcal);
            } else {
                $('#nutriments-info').html('Aucune donnée disponible');
                // Supprimez le graphe s'il existe
                removeNutrimentChart();
            }
        },
        error: function () {
            $('#nutriments-info').html('Erreur lors de la récupération des données');
            // Supprimez le graphe s'il existe
            removeNutrimentChart();
        }
    });
}
function createNutrimentChart(dailyNutriments, nutrimentType, userKcal) {
    // Supprimez le graphe s'il existe
    removeNutrimentChart();

    // Créez un tableau de dates et un tableau de valeurs pour le graphe
    let dates = dailyNutriments.map(entry => entry.jour);
    let values = dailyNutriments.map(entry => entry.totalNutriment);

    // Créez un élément canvas pour le graphe avec des dimensions plus petites
    $('#calories-section').append('<div id="nutriment-chart-container"><canvas id="nutriment-chart" width="300" height="150"></canvas></div>');

    var ctx = document.getElementById('nutriment-chart').getContext('2d');
    
    if (nutrimentType === 'ENERGIE_100G') {
        // Si le nutriment choisi est "Énergie (kcal)", tracez la ligne droite en rouge
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: nutrimentType,
                    data: values,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'KCAL_JOUR',
                    data: Array(dates.length).fill(userKcal), // Créez un tableau avec la valeur de l'utilisateur répétée
                    borderColor: 'rgba(255, 0, 0, 1)', // Rouge
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: dates,
                        position: 'bottom'
                    },
                    y: {
                        type: 'linear',
                        position: 'left'
                    }
                }
            }
        });
    } else {
        // Si le nutriment choisi n'est pas "Énergie (kcal)", tracez uniquement le graphique
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: nutrimentType,
                    data: values,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: dates,
                        position: 'bottom'
                    },
                    y: {
                        type: 'linear',
                        position: 'left'
                    }
                }
            }
        });
    }
}

// Écouteur d'événement pour la soumission du formulaire
$('#nutriment-form').submit(function (event) {
    event.preventDefault(); // Empêche le formulaire de se soumettre normalement

    console.log('Formulaire soumis');

    var startDate = $('#start-date').val();
    var endDate = $('#end-date').val();
    var selectedNutriment = $('#nutriment-type').val();

    console.log('Période sélectionnée :', startDate, 'au', endDate);
    console.log('Nutriment sélectionné :', selectedNutriment);

    getNutrimentData(startDate, endDate, selectedNutriment);
});

// Appel initial pour afficher les données pour la période actuelle et le nutriment par défaut
var currentDate = new Date().toISOString().slice(0, 10);
$('#start-date').val(currentDate);
$('#end-date').val(currentDate);
var defaultNutriment = $('#nutriment-type').val();
getNutrimentData(currentDate, currentDate, defaultNutriment);
