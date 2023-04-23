<?php

require_once 'libs/modele.php';

$data = testApi();

$timeRuntime = getMovieTime($_SESSION['userID']);

echo "<br><br>";
echo "Temps total de visionnage : " . $timeRuntime . " minutes";

$favorite_genres = getFavoriteGenresWithCount($_SESSION['userID']);

echo "<br><br>";
echo "Genres favoris : ";
var_dump($favorite_genres);
echo "<br><br>";
foreach ($favorite_genres as $genre_id => $count) {
    echo $genre_id . " : " . $count . "<br>";
}

// Créer un tableau de données
$data = array(
    "Janvier" => 10,
    "Février" => 20,
    "Mars" => 30,
    "Avril" => 40,
    "Mai" => 50,
);

// Convertir les données en format JSON
$data_json = json_encode(array_values($data));

// Créer un tableau d'étiquettes
$labels = array_keys($data);

// Convertir les étiquettes en format JSON
$labels_json = json_encode($labels);

?>
<?php

// Créer un script JavaScript pour initialiser le graphique
/*echo "
  <script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: $labels_json,
          datasets: [{
              data: $data_json,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
              ],
              borderWidth: 1
          }]
      },
      options: {
          responsive: true,
          legend: {
              position: 'bottom',
          }
      }
  });
  </script>
  ";*/

// Conversion du tableau associatif en objet JSON
$genresJson = json_encode($favorite_genres);
?>
<!-- Création du conteneur pour le graphique -->
<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>


<script>
    // Récupération des données JSON créées en PHP
    var genresData = <?php echo $genresJson; ?>;

    // Récupération des clés et des valeurs du tableau associatif
    var genresLabels = Object.keys(genresData);
    var genresValues = Object.values(genresData);

    // Création du graphique avec Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: genresLabels,
            datasets: [{
                label: 'Genres favoris',
                data: genresValues,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(25, 120, 92)'
                ]
            }]
        },
        options: {}
    });
</script>