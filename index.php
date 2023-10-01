<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

$has_filters = !empty($_GET);

if ($has_filters) {
    $filters = $_GET;

    if (isset($filters['parking'])) {
        if($filters['parking'] != 'both') {

            $temp_hotels = [];
            foreach($hotels as $hotel) {
                if((bool) $filters['parking'] === $hotel['parking']) {
                    $temp_hotels[] = $hotel;
                }
            }
            $hotels = $temp_hotels; 
        }
    }

    if (isset($filters['vote'])) {
        $temp_hotel = [];
        foreach($hotels as $hotel) {
            if($hotel['vote'] >= (int) $filters['vote']) {
                $temp_hotels[] = $hotel;
            }
        }
        $hotels = $temp_hotels; 
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>

<div class="container mt-5">
    <h1> Hotels  </h1>
    <div class="hotel-filter">
    <h4> Filtri </h4>
    
    <form method="GET">
        <div class="parking">
            <label for="parking" class="parking">Cerchi parcheggio? </label>
            <select name = "parking" id= "parking" class="form-select" required>
                <option value=""> Scegli </option>
                <option value="1" <?php echo "1" == ($filters['parking'] ?? '') ? 'selected' : '' ?>> Sì </option>
                <option value="0" <?php echo "0" == ($filters['parking']?? '') ? 'selected' : '' ?>> No </option>
                <option value="both" <?php echo "both" == ($filters['parking']?? '') ? 'selected' : ''?>> Indifferente </option>
            </select>
        </div>
        <div class= "vote">
            <label for="vote" class="vote"> Filtra hotel per voto </label>
            <input type="number" name="vote" min="1" max="5" id="vote"
            value = <?php echo $filters['vote'] ?? '' ?>>
        </div>
        <button class= "btn btn-success mt-3"> Filtra servizi </button>
    </form>
    
</div>

    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Descrizione</th>
      <th scope="col">Parcheggio</th>
      <th scope="col">Voto</th>
      <th scope="col">Distanza dal centro</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($hotels as $hotel): ?>
    <tr>
        <th scope="row">
            <?php echo $hotel ['name']?>
        </th>
      <td>
        <?php echo $hotel ['description']?>
      </td>
      <td>
        <?php echo $hotel ['parking'] ? 'Sì' : 'No' ?>
      </td>
      <td>
         <?php echo $hotel ['vote']?>
      </td>
      <td>
         <?php echo $hotel ['distance_to_center']?> KM
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


</div>

</body>

</html>