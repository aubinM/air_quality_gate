// Initialisation du calendrier de séléction de date
$(".datepicker").datepicker({
  format: "dd/mm/yyyy",
  startDate: "-29d",
  endDate: "-1d",
  language: "fr",
});

// Initialisation du tableau d'historique
var table = new DataTable("#dataViewver", {
  language: {
    url: "//cdn.datatables.net/plug-ins/2.0.1/i18n/fr-FR.json",
  },
});

// Fonction pour créer le graphique Highcharts initial
function creerGraphique(data) {
  Highcharts.chart("container", {
    chart: {
      type: "line",
    },
    title: {
      text: "Graphe de la qualité de l'air heure par heure",
    },
    xAxis: {
      categories: [
        "00:00",
        "01:00",
        "02:00",
        "03:00",
        "04:00",
        "05:00",
        "06:00",
        "07:00",
        "08:00",
        "09:00",
        "10:00",
        "11:00",
        "12:00",
        "13:00",
        "14:00",
        "15:00",
        "16:00",
        "17:00",
        "18:00",
        "19:00",
        "20:00",
        "21:00",
        "22:00",
        "23:00",
      ],
    },
    yAxis: {
      title: {
        text: "Aqi",
      },
    },

    series: [
      {
        name: "Qualité de l'air",
        data: data,
      },
    ],

    responsive: {
      rules: [
        {
          condition: {
            maxWidth: 500,
          },
          chartOptions: {
            legend: {
              layout: "horizontal",
              align: "center",
              verticalAlign: "bottom",
            },
          },
        },
      ],
    },
  });
}

$(document).ready(function () {
  // Soumettre le formulaire
  $("#form-country-selector").submit(function (e) {
    e.preventDefault(); // Empêcher le rechargement de la page

    // Récupérer les données du formulaire
    var formData = $(this).serialize();

    // Effectuer une requête AJAX pour récupérer les données depuis data.php
    $.ajax({
      url: "getDataFromApi.php?" + formData, // Ajouter les données du formulaire à l'URL
      type: "GET",
      dataType: "json",
      success: function (data) {
        // Manipuler les données récupérées
        var aqiData = [];
        data.forEach(function (obj) {
          aqiData.push(obj.aqi);
        });
        // Créer le graphique Highcharts initial avec les données obtenues
        creerGraphique(aqiData);
      },
      error: function (xhr, status, error) {
        console.error(
          "Erreur lors de la récupération des données:",
          status,
          error
        );
      },
    });
  });
});
