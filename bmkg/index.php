<?php require '../layout/header.php' ?>
<?php
// JSON Gempa
$urlQuake = 'https://cuaca-gempa-rest-api.vercel.app/quake';
$getJSON = file_get_contents($urlQuake);
$result = json_decode($getJSON, 1);
$quake = $result['data'];
// JSON Cuaca
$urlWeather = 'https://cuaca-gempa-rest-api.vercel.app/weather/banten/Kota-Tangerang';
$getJSONWeather = file_get_contents($urlWeather);
$result = json_decode($getJSONWeather, 1);
/* $weather = $result['data']['params'][6]; */
$weatherData = $result['data']['params'][6]['times'];
/* var_dump($weatherData['times']); */
$unique = [];
foreach ($weatherData as $weather) {
  $date = date('Ymd', strtotime($weather['datetime']));
  $unique[] = $date;
  $resDate = array_unique($unique);

  /*   $cuaca = $weather['name']; */
  /*   echo $cuaca; */
  /*   echo '<br>'; */
}
/* var_dump($weatherData); */
/* die; */
/* $unique = []; */
/* foreach ($weatherData as $weather) { */
/*   $date = date('Ymd', strtotime($weather['datetime'])); */
/*   $unique[] = $date; */
/*   $res = array_unique($unique); */
/* } */

/* foreach ($res as $tgl) { */
/*   /1* $tanggal = $tgl; *1/ */
/*   $hari = date('l', strtotime($tgl)); */
/*   $hari_indonesia = array( */
/*     'Monday'  => 'Senin', */
/*     'Tuesday'  => 'Selasa', */
/*     'Wednesday' => 'Rabu', */
/*     'Thursday' => 'Kamis', */
/*     'Friday' => 'Jumat', */
/*     'Saturday' => 'Sabtu', */
/*     'Sunday' => 'Minggu' */
/*   ); */
/*   echo $hari_indonesia[$hari]; */
/*   echo '<br>'; */
/* } */
/* var_dump($weatherDate); */
/* die; */
?>

<div class="row">
  <div class="col-md-12">
    <h1>Prakiraan Cuaca Tangerang</h1>
    <div class="card-deck">
      <?php $i = 0; ?>
      <?php foreach ($weatherData as $cuaca) : ?>
        <?php if ($i < 6) : ?>
          <div class="card text-center">
            <?php $string = strtolower(str_replace(" ", "-", $cuaca['name'])); ?>
            <img src="../assets/img/<?= $string ?>.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?= $cuaca['name']; ?></h5>
              <p class="card-text"><?= date('D,d M', strtotime($cuaca['datetime'])); ?></p>
            </div>
            <div class="card-footer text-center">
              <!-- <p class="card-text"><?= date('H:i:s', strtotime($cuaca['datetime'])) ?></p> -->
              <small class="text-muted"><?= date('H:i:s', strtotime($cuaca['datetime'])) ?></small>
            </div>
          </div>
        <?php endif; ?>
        <?php $i += 1 ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h1 class="my-2">Berita Gempa Terbaru</h1>
    <div class="card" style="width: 18rem;">
      <img src="<?= $quake['shakemap'] ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Tanggal: <?= $quake['tanggal'] ?></li>
          <li class="list-group-item">Jam: <?= $quake['jam'] ?> </li>
          <li class="list-group-item">Lokasi: <?= $quake['wilayah'] ?></li>
          <li class="list-group-item">Magnitudo: <?= $quake['magnitude'] ?></li>
          <li class="list-group-item">Potensi: <?= $quake['potensi'] ?></li>
          <li class="list-group-item">Kedalaman: <?= $quake['kedalaman'] ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- <tbody>
        <?php foreach ($resDate as $tgl) {
          $hari = date('l', strtotime($tgl));
          $tanggal = date('d', strtotime($tgl));
          $hari_indonesia = array(
            'Monday'  => 'Senin',
            'Tuesday'  => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
          );
        ?>
          <tr>
            <th scope="row"><?= $hari_indonesia[$hari] . ', ' . $tanggal ?></th>
            <td>Larry</td>
            <td><?= $weatherData[0]['name'] ?></td>
            <td>@twitter</td>
            <td>@twitter</td>
          </tr>
        <?php } ?>
      </tbody>-->
<?php require '../layout/footer.php' ?>
