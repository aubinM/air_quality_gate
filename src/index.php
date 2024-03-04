<?php
require_once('classes/City.php');
require_once('src/utils.php');
session_start();

// Mise à jour des variables en fonction de la session de l'utilisateur
if (isset($_SESSION['selectedCity'])) {
  $selectedCity = $_SESSION['selectedCity'];
} else {
  $selectedCity  = $paris;
}

if (isset($_SESSION['selectedDate'])) {
  $selectedDate = $_SESSION['selectedDate'];
} else {
  $selectedDate = "";
}

if (isset($_SESSION['datas'])) {
  $datas = $_SESSION['datas'];
} else {
  $datas = [];
}

if (isset($_SESSION['APIerror'])) {
  $error = $_SESSION['APIerror'];
}

?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="This page display the air quality via a request to the Google Air Quality API." />
  <meta name="author" content="Aubin Mathieu, 2024" />
  <meta name="generator" content="Aubin Mathieu 1.0.0" />
  <title>Air Quality Gate</title>

  <!-- Imports css -->
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css" />
  <link href="assets/css/custom.css" rel="stylesheet" />
</head>

<body>
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>

  <main>
    <div class="container py-4">
      <header class="pb-3 mb-4 border-bottom">
        <h3>Air Quality <span class="badge text-bg-success">Gate</span></h3>
      </header>

      <div class="row align-items-md-stretch">
        <div class="col-md-6">
          <div class="h-100 p-5 text-bg-dark rounded-3">
            <h3>Sélectionner une ville</h3>
            <!-- Formulaire de sélection de la ville et de la date souhaitée -->
            <form action="src/getDataFromApi.php" method="get" id="form-country-selector" class="py-4">
              <div class="mb-3">
                <select class="form-select" name="city" aria-label="Default select example">
                  <option <?php if ($selectedCity->getName() === 'Paris') echo 'selected';  ?> value="paris">Paris</option>
                  <option <?php if ($selectedCity->getName() === 'Reims') echo 'selected';  ?> value="reims">Reims</option>
                </select>
              </div>
              <div class="mb-3">
                <input class="datepicker" name="date" data-date-format="mm/dd/yyyy" value=<?php echo $selectedDate ?>>
              </div>
              <button type="submit" class="btn btn-success">Valider</button>
              <?php
              if (isset($error)) {
                echo '<div class="pt-2">
                <div class="alert alert-danger" role="alert">
                  '.$error.'
                </div>
              </div>';
              }
              ?>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            <h2>Informations</h2>
            <p>
              Cette simple page permet d'afficher la qualité de l'air d'une
              ville sur les 30 derniers jours. Cette page utilise l'API Air
              Quality de Google comme fournisseur de données.
            </p>
            <a href="https://developers.google.com/maps/documentation/air-quality/overview?hl=fr" target="_blank">
              <button class="btn btn-outline-secondary" type="button">
                En savoir plus
              </button>
            </a>
          </div>
        </div>
      </div>
      <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold pb-3">
            Historique de la qualité de l'air
          </h1>
          <h4>Ville sélectionnée : <span class="badge text-bg-success"><?php echo ($selectedCity->getName()); ?></span></h4>

          <div class="table-responsive">
            <!-- Tableau de restitution des données de qualité de l'air -->
            <table id="dataViewver" class="table table-borderless table-striped align-middle">
              <thead>
                <tr>
                  <th scope="col">Heure</th>
                  <th scope="col">Qualité de l'air</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($datas !== "") {
                  foreach ($datas as $key => $data) {
                    echo '<tr>
                    <th>' . convertDateToDisplayFormat($data['dateTime']) . '</th>
                    <td><span class="badge bg-primary ' . getDisplayFromAqi($data['aqi']) . '">' . $data['category'] . '</span></td>
                  </tr>';
                  }
                }

                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <footer class="pt-3 mt-4 text-body-secondary border-top">
        &copy; 2024 - This page is an exercice
      </footer>
    </div>
  </main>

  <!-- Imports javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.fr.min.js" integrity="sha512-fx3aztaUjb4NyoD+Tso5g7R1l29bU3jnnTfNRKBiY9fdQOHzVhKJ10wEAgQ1zM/WXCzB9bnVryHD1M40775Tsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>