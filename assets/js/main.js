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
