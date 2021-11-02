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

$unique = [];
foreach ($weatherData as $weather) {
  $date = date('Ymd', strtotime($weather['datetime']));
  $unique[] = $date;
  $res = array_unique($unique);
}
/* var_dump($weatherData); */
/* die; */
?>

<div class="row">
  <div class="col-md-10">
    <h1>Gempa Terakhir</h1>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?= $quake['shakemap'] ?>" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Tanggal: <?= $quake['tanggal'] ?></li>
                <li class="list-group-item">Lokasi: <?= $quake['jam'] ?></li>
                <li class="list-group-item">Magnitudo: <?= $quake['magnitude'] ?></li>
                <li class="list-group-item">Kedalaman: <?= $quake['kedalaman'] ?></li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Pusat gempa berada di <?= $quake['wilayah'] ?></li>
          <li class="list-group-item"><?= $quake['potensi'] ?></li>
          <li class="list-group-item">Dirasakan (Skala MMI): <?= $quake['dirasakan'] ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-10">
    <h1>Info Cuaca</h1>
    <ul class="nav nav-tabs">
      <?php foreach ($res as $r) : ?>
        <li class="mr-1"><a href="#home" data-toggle="tab"><?= date('dM', strtotime($r)) ?></a></li>
      <?php endforeach; ?>
      <!-- <li><a href="#profile" data-toggle="tab">Profile</a></li>
      <li><a href="#messages" data-toggle="tab">Messages</a></li>
      <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" id="home">
        <div class="card-group">
          <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="profile">This is the profile page</div>
      <div class="tab-pane fade" id="messages">This is the message page content </div>
      <!-- <div class="tab-pane fade" id="settings">This is the settings content</div> -->
    </div>
  </div>
</div>

<?php require '../layout/footer.php' ?>
