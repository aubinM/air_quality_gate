const Highcharts = require('highcharts/highcharts');
window.Highcharts = Highcharts;


// Fonction pour créer le graphique Highcharts initial
export function creerGraphique(data) {
    // Manipuler les données récupérées
    var aqiData = [];
    data.forEach(function (obj) {
      aqiData.push(obj.aqi);
    });
  
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
          data: aqiData,
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
  
  // récupération des valeurs retournées par l'API pour construire le graphique
  document.addEventListener("DOMContentLoaded", function () {
    const JSdataForm = document.querySelector(".js-data-form");
    const dataForm = JSON.parse(JSdataForm.getAttribute("data-form"));
    creerGraphique(dataForm);
  });
  