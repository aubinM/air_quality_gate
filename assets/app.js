/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.scss"; 

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('jquery-ui');
require('bootstrap');
require('bootstrap-datepicker');
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr');

// Initialisation du calendrier de séléction de date
$(document).ready(function () {
  // you may need to change this code if you are not using Bootstrap Datepicker
  $(".js-datepicker").datepicker({
    format: "dd/mm/yyyy",
    startDate: "-29d",
    endDate: "-1d",
    language: "fr",
  });
});
